<template>
    <div>
        <div v-for="(section, key) in questions">
            <h2 class="heading-large" id="key">{{ key }}</h2>

            <dl class="govuk-check-your-answers">
                <div v-for="q in section">
                    <dt class="cya-question">
                        {{ q.question }}
                    </dt>
                    <dd class="cya-answer">
                        <f-display :data="q"></f-display>
                    </dd>
                    <dd class="cya-change">
                        <a href="#" @click="$modal.show('update-question', q)">
                        Change<span class="visually-hidden"> name</span>
                        </a>
                    </dd>

                </div>
            </dl>
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
            }
        },
        mounted() {
            this.d_questions = this.questions
        },
        data(){
            return {
                d_questions: null,
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
            }
        },
        methods: {
            updateAnswer(event) {
                let question = this.flat_questions.filter(x => x.id === event.id)[0]
                question.answer = event.answer
            }
        }
    }
</script>