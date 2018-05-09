<template>
    <div class="question_index">
        <div v-if="started_at">
            <div v-for="question in questions" :key="question.uuid" class="question">

                <div class="step" v-if="question.selected">
                    <builder :label="question.question" :type="question.field_type"></builder>
                    <h2>{{ question.number }}. {{ question.question }}</h2>
                    <p></p>
                </div>
                <ol v-else>
                    <li :class="{ done: question.done, notdone: !question.done }">
                        <h3 class="question">{{ question.number }}. {{ question.question }}</h3>
                        <div class="answer" v-if="question.done">
                            <strong>Test</strong>
                        </div>
                        <a class="action" @click="select(question)">
                            <span v-if="question.done">Change this answer</span>
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
    import Builder from './form/Builder'
    export default {
        props: {
            question_type: {
                type: Object,
                required: true
            }
        },
        components: { Builder },
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
                        'filter[question_type]': this.question_type.slug
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
            resetSelectedQuestion() {
                let question = this.questions.filter(x => x.selected === true)[0]
                if(question) {
                    question.selected = false
                }
            }
        }
    }
</script>
