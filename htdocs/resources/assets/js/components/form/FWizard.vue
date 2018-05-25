<template>
    <div class="f-wizard">
        <div class="f-navigation">

            <div class="f-section" v-for="section in d_questions">
                <h2>{{ section.name }}</h2>
                <ul v-if="section.groups[0].name !== section.name">
                    <li v-for="group in section.groups">
                        <span v-if="!group.selected"><a href="#" @click.prevent="selectGroup(group)">{{ group.name }}</a></span>
                        <span v-else><strong>{{ group.name }}</strong></span>
                    </li>
                </ul>
            </div>

            <div class="f-section">
                <h2><a href="#">Summary</a></h2>
            </div>
        </div>
        <div class="f-content">
            <div v-for="section in d_questions">
                <div v-if="group.selected" v-for="group in section.groups">
                    <div v-if="started" class="f-header">
                        <h3 class="heading-medium">{{ section.name }} <small v-if="group.location">({{ group.location }})</small></h3>
                        <small v-if="group.name !== section.name">{{ group.name }}</small>
                    </div>
                    <div class="f-form">
                        <div>
                            <form-builder v-for="(question, index) in group.questions" :key="index" :label="question.question" v-model="question.answer.answer" :field="question.field" :type="question.field_type" :options="question.options" help_text="" />

                            <a v-if="!started" class="button button-start" @click.prevent="start(group)"  href="#" role="button">Save and continue</a>
                        </div>
                    </div>
                    <div class="f-footer">
                        <div v-if="started">
                            <a href="" v-if="group.prev_group" @click.prevent="prevGroup(group)" >Prev</a>
                    &nbsp;   </div>
                        <div v-if="started">
                            <a href="">Save progress</a>
                            <button class="button" v-if="group.next_group" @click.prevent="nextGroup(group)">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="false">
                asd
                <question-index :questions="summary"></question-index>
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
                        flat_array[section.name] = group.questions
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

        },
        methods: {

            start(group) {
                this.started = true
                this.nextGroup(group)
            },

            defaultGroup() {
                let group = this.flat_groups.filter(x => x.name === 'Basic Details')[0]
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
            },



        }
    }
</script>