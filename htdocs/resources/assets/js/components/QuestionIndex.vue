<template>
    <div class="question_index">
        <div v-if="started_at">
            <f-button>Reset (testing)</f-button>
            <f-button>Save question progress</f-button>
            <f-button>Submit questions</f-button>


            <div v-for="question in questions" :key="question.uuid" class="question">

                <div class="step" v-if="question.selected">
                    <form-builder
                        :label="question.number + '. '+ question.question"
                        v-model="question.answer.answer"
                        :field="question.field"
                        :type="question.field_type"
                        :help_text="question.help_text"
                        :options="question.options"
                        @updated="question.answer.answer = $event"
                    />
                    <f-button @click="nextQuestion">Next question</f-button>
                </div>
                <ol v-else>
                    <li :class="{ done: question.answer.answer, notdone: !question.answer.answer }">
                        <h3 class="question">{{ question.number }}. {{ question.question }}</h3>
                        <div class="answer" v-if="question.answer.answer">
                            <strong>{{ question.answer.answer }}</strong>
                        </div>
                        <a class="action" @click="select(question)">
                            <span v-if="question.answer.answer">Change this answer</span>
                            <span v-else>Answer this question</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
        <div v-else>
            <a class="button button-start" @click="start" href="#" role="button">Start now</a>
        </div>

    </div>
</template>
<script>
    import FormBuilder from './FormBuilder'
    import FButton from './form/FButton'
    export default {
        props: {
            question_type: {
                type: Object,
                required: true
            }
        },
        components: { FormBuilder, FButton },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.index()
        },
        data(){
            return {
                started_at: true,
                questions: [],
            }
        },
        methods: {
            start() {
                this.started_at = true
                this.questions[0].selected = true
            },
            index() {
                let params = {
                    params: {
                        'filter[question_type]': this.question_type.slug,
                        'include': 'answer'
                    }
                }
                axios.get('/api/questions', params).then(this.refresh);
            },
            refresh({ data }) {
                this.questions = data.data;
                this.questions[2].done = true
            },
            select(question)  {
                this.resetSelectedQuestion()
                question.selected = true
            },
            nextQuestion() {

            },
            resetSelectedQuestion() {
                let question = this.questions.filter(x => x.selected === true)[0]
                if(question) {
                    question.selected = false
                }
            }
        }
    }
</script>
