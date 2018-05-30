<template>
    <div class="f-wizard">
        <div class="f-navigation">

            <div class="f-section" v-for="section in d_questions">
                <h2 name>{{ section.name }}</h2>
                <ul>
                    <li v-for="group in section.groups">
                        <span v-if="!group.selected"><a :href="'#' + group.slug" @click="selectGroup(group)">{{ group.name }}</a></span>
                        <span v-else><strong>{{ group.name }}</strong></span>
                    </li>
                </ul>
            </div>

            <div class="f-section">
                <h2><a href="#" @click.prevent="showSummary()">Summary</a></h2>
            </div>
        </div>
        <div class="f-content">
            <div v-for="section in d_questions">
                <div v-if="group.selected" v-for="group in section.groups" :id="group.slug">
                    <div v-if="started" class="f-header">
                        <h3 class="heading-medium">{{ section.name }} <small v-if="group.location">({{ group.location }})</small></h3>
                        <small v-if="group.name !== section.name">{{ group.name }}</small>
                    </div>
                    <div class="f-form">
                        <div>
                            <form-builder
                                v-for="(question, index) in group.questions"
                                :key="index" :label="question.question"
                                v-model="question.answer.answer"
                                :field="question.field"
                                :type="question.field_type"
                                :help_text="question.help_text"
                                :options="question.options"
                                :error="question.error"
                                @updated="fieldUpdated(question, $event)"
                            />

                            <a v-if="!started" class="button button-start" @click.prevent="start(group)"  href="#" role="button">Save and continue</a>
                        </div>
                    </div>
                    <div class="f-footer">
                        <a href="#" v-if="group.prev_group" @click="prevGroup(group)">Back</a>
                        <a v-else >Back</a>
                        <a href="#" @click.prevent="saveProgress">Save progress</a>
                        <a href="#" class="button" v-if="group.next_group" @click.prevent="nextGroup(group)">Next</a>
                        <a href="#" class="button" v-if="group.next_group === null" @click.prevent="showSummary">Next</a>
                    </div>
                </div>
            </div>

            <div v-if="show_summary">

                <div v-if="started" class="f-header">
                    <h3 class="heading-medium">Summary</h3>
                </div>
                <div class="f-form">
                    <question-index :questions="summary" :show_labels="true" :show_change="false"></question-index>
                </div>
                <div class="f-footer">
                    <button class="button" @click.prevent="finishWizard">Finish</button>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        name: 'f-wizard',
        props: {
            questions: {
                type: Array,
                required: true
            },
            worker_id: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                answer: '',
                selected_group: {
                    name: null
                },
                started: true,
                d_questions: [],
                show_summary: false
            }
        },
        mounted() {
            this.d_questions = this.questions
            this.defaultGroup()
        },
        computed: {

            summary() {
                let flat_array = {};

                let sections = this.questions;

                sections.forEach(function(section) {
                    section.groups.forEach(function(group) {
                        flat_array[section.name + ' - ' + group.name] = group.questions
                    })
                });

                return flat_array;
            },

            flat_groups() {

                let flat_array = [];

                let sections = this.questions;

                sections.forEach(function(section) {

                    section.groups.forEach(function(group) {
                        flat_array.push(group)
                    });

                });

                return flat_array;
            },

            flat_questions() {

                let flat_array = [];

                let sections = this.questions;

                let that = this

                sections.forEach(function(section) {

                    section.groups.forEach(function(group) {

                        group.questions.forEach(function(question) {

                            let data = {
                                id: question.id,
                                worker_id: that.worker_id,
                                answer: question.answer.answer,
                                text: question.answer.text
                            }

                            flat_array.push(data)
                        })

                    });

                });

                return flat_array;

            }

        },
        methods: {

            start(group) {
                this.started = true
                this.nextGroup(group)
            },

            defaultGroup() {
                let group = this.flat_groups.filter(x => x.name === 'Personal details')[0]
                group.selected = true
                this.selected_group = group
            },

            nextGroup(current) {
                current.selected = false
                let group = this.flat_groups.filter(x => x.id === current.next_group)[0]
                group.selected = true
                this.selected_group = group
            },

            prevGroup(current) {
                current.selected = false
                let group = this.flat_groups.filter(x => x.id === current.prev_group)[0]
                group.selected = true
                this.selected_group = group
            },

            selectGroup(group) {

                this.resetGroups()
                group.selected = true
                this.selected_group = group
            },

            resetGroups() {
                let group = this.flat_groups.filter(x => x.selected === true)[0]

                if(group)
                    group.selected = false

                this.selected_group = null

                this.show_summary = false
            },

            showSummary() {
                this.resetGroups();
                this.show_summary = true
            },

            fieldUpdated(question, event) {
                question.answer.answer = event.value
                question.answer.text = event.text
            },

            saveProgress() {
                let saved = axios
                    .put('/api/question_answers_bulk/' + this.worker_id + '/update', this.flat_questions)
                    .then((data) => {
                        this.reassignQuestions(data.data)
                        return true;
                    })
                    .catch((error) => {
                        console.log(error)
                        return false;
                    });
            },

            finishWizard() {
                axios
                    .post('/api/finish_create_worker_wizard', { 'worker_id': this.worker_id })
                    .then((data) => {
                        console.log(data.data)
                    })
            },

            reassignQuestions(questions) {

                let that = this

                questions.forEach(function(question) {
                    that.d_questions.forEach(function(section) {

                        section.groups.forEach(function(group) {
                            group.questions.forEach(function(q) {
                                if(q.id === question.id) {
                                    q.answer = question.answer

                                    if(question.errors) {
                                        q.error = question.errors
                                    }
                                }
                            })

                        });

                    });
                });
            }
        }
    }
</script>