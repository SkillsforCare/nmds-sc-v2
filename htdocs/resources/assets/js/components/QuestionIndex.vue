<template>
    <div class="question_index">
        <div v-if="started_at">
            <div>

                <div class="grid-row margin-bottom">
                    <div class="column-full">
                        <f-button>Reset (testing)</f-button>
                        <f-button @click="store('save')">Save question progress</f-button>
                        <f-button @click="store('submit')">Submit questions</f-button>
                    </div>
                </div>


                <div class="grid-row margin-bottom">
                    <div class="column-full">
                        <alert :status="status.status" :show="status.show">
                        {{ status.message }}
                        </alert>

                        <div v-for="(question, index) in questions" :key="question.id" class="question">

                        <div class="step" v-if="question.selected">
                            <form-builder
                                :label="question.number + '. '+ question.question"
                                v-model="question.answer.answer"
                                :field="question.field"
                                :type="question.field_type"
                                :help_text="question.help_text"
                                :options="question.options"
                                :error="question.error"
                                @updated="fieldUpdated(question, $event)"
                            />
                            <f-button v-if="index < questions.length - 1" @click="store(question, questions[index + 1])">Next question</f-button>
                            <f-button v-if="index === questions.length - 1"  @click="store(question, questions[index + 1])">Finish</f-button>
                        </div>
                        <ol v-else>
                            <li class="notdone" :class="{ done: question.answer.submitted_at, error: question.error }">
                                <h3 class="question">{{ question.number }}. {{ question.question }}</h3>
                                <div class="answer" v-if="question.answer.answer">
                                    <strong>{{ question.answer.text || question.answer.answer }}</strong>
                                </div>
                                <a class="action" @click="select(question)">
                                    <span v-if="question.answer.answer"><span v-if="question.error">Error! &bull; </span>Change this answer</span>
                                    <span v-else>Answer this question</span>
                                </a>
                            </li>
                        </ol>
                    </div>
                    </div>
                </div>
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
    import Alert from './layout/Alert'
    export default {
        props: {
            question_type: {
                type: Object,
                required: true
            }
        },
        components: { FormBuilder, FButton, Alert },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.index()
        },
        data(){
            return {
                started_at: true,
                status: {
                    show: false,
                    message: 'Loading questions...',
                    status: 'message'
                },
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
                this.status.show = true
                axios.get('/api/question_answers', params)
                    .then(this.refresh)
                    .catch(this.error);
            },
            store(question, next) {

                let params = {
                    id: question.id,
                    text: question.answer.text,
                    answer_id: question.answer.id,
                    answer: question.answer.answer
                }

                question.error = null

                axios
                    .post('/api/question_answers', params)
                    .then((data) => {
                        console.log(data.data.data)
                        question.answer = data.data.data.answer
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors.answer[0])
                        question.error = error.response.data.errors.answer[0]
                    });

                this.select(next)
            },
            refresh({ data }) {
                if(data.data) {
                    this.questions = data.data
                    this.questions[2].done = true
                }

                this.status.show = false
            },
            error({ error }) {
                this.status.show = true
                this.status.status = 'error'
                this.status.message = 'Error loading questions.'
            },
            select(question)  {
                this.resetSelectedQuestion()
                question.selected = true
            },
            resetSelectedQuestion() {
                let question = this.questions.filter(x => x.selected === true)[0]
                if(question) {
                    question.selected = false
                }
            },
            fieldUpdated(question, event) {
                question.answer.answer = event.value
                question.answer.text = event.text
            }
        }
    }
</script>
