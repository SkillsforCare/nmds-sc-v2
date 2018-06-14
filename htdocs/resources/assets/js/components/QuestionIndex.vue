<template>
    <div>
        <div>
            <div v-for="(section, key) in questions">
                <h2 class="heading-large" :id="key">{{ key }}</h2>

                <dl class="govuk-check-your-answers">
                    <div v-for="q in section">
                        <dt class="cya-question">
                            <span v-if="show_labels">{{ q.label }}</span>
                            <span v-else>{{ q.question }}</span>
                        </dt>
                        <dd class="cya-answer">
                            <f-display :data="q"></f-display>
                        </dd>
                        <dd v-if="show_change" class="cya-change">
                            <a href="#" @click.prevent="$modal.show('update-question', q)">
                            Change<span class="visually-hidden"> name</span>
                            </a>
                        </dd>

                    </div>
                </dl>
            </div>
        </div>
        <div v-show="d_show_training">
            <training-index></training-index>
        </div>

        <modal-component @modal-submitted="updateAnswer"/>
    </div>
</template>
<script>
    export default {
        name: 'QuestionIndex',
        props: {
            questions: {
                type: Object,
                required: true
            },
            show_labels: {
                type: Boolean,
                required: false,
                default: false
            },
            show_change: {
                type: Boolean,
                required: false,
                default: true
            }
        },
        mounted() {
            this.d_questions = this.questions
            this.show_training()
        },
        data(){
            return {
                d_questions: null,
                d_show_training: false
            }
        },
        computed: {

            flat_questions() {

                let flat_array = [];

                let questions = this.d_questions;

                Object.keys(questions).forEach(function(key, value) {

                    questions[key].forEach(function(question) {
                        flat_array.push(question)
                    });

                });

                return flat_array;
            },

        },
        methods: {
            updateAnswer(event) {
                let question = this.flat_questions.filter(x => x.id === event.id)[0]

                question.answer = event.answer

                this.show_training()
            },
            show_training() {

                let questions = this.flat_questions

                let question = questions.filter(x => x.field === 'TRAINING')[0]

                if(question.entity_type === 'establishment')
                    return false;

                if(!question.answer) {
                    return false
                }

                return this.d_show_training = question.answer.text === 'Yes'
            }
        }
    }
</script>