<template>
    <div class="question_index">
        <div v-if="started_at">
            <div v-if="status.show">
                <alert :status="status.status" :show="status.show">
                    {{ status.message }}
                </alert>
            </div>
            <div v-else>
                <f-button>Reset (testing)</f-button>
                <f-button @click="store">Save question progress</f-button>
                <f-button>Submit questions</f-button>

                <div v-for="(question, index) in questions" :key="question.uuid" class="question">

                    <div class="step" v-if="question.selected">
                        <form-builder
                            :label="question.number + '. '+ question.question"
                            v-model="question.answer.answer"
                            :field="question.field"
                            :type="question.field_type"
                            :help_text="question.help_text"
                            :options="question.options"
                            @updated="fieldUpdated(question, $event)"
                        />
                        <f-button v-if="index < questions.length - 1" @click="select(questions[index + 1])">Next question</f-button>
                    </div>
                    <ol v-else>
                        <li :class="{ done: question.answer.answer, notdone: !question.answer.answer }">
                            <h3 class="question">{{ question.number }}. {{ question.question }}</h3>
                            <div class="answer" v-if="question.answer.answer">
                                <strong>{{ question.answer.text || question.answer.answer }}</strong>
                            </div>
                            <a class="action" @click="select(question)">
                                <span v-if="question.answer.answer">Change this answer</span>
                                <span v-else>Answer this question</span>
                            </a>
                        </li>
                    </ol>
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
                    show: true,
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
                axios.get('/api/questions', params)
                    .then(this.refresh)
                    .catch(this.error);
            },
            store() {
                let params = {
                    questions: this.questions,
                    action: 'save'

                }
                axios
                    .post('/api/questions', params)
                    .then(this.refresh)
                    .error(this.error);
            },
            refresh({ data }) {
                this.questions = data.data
                this.questions[2].done = true
                this.loading = false
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
