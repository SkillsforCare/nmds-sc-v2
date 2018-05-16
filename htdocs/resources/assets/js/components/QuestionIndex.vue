<template>
    <div>
        <div v-for="q in questions">
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
        <modal-component :key="section" @modal-submitted="updateAnswer"/>
    </div>
</template>
<script>
    export default {
        name: 'QuestionIndex',
        props: {
            questions: {
                type: Array,
                required: true
            },
            section: {
                type: String,
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
        methods: {
            updateAnswer(event) {
                let question = this.d_questions.filter(x => x.id === event.id)[0]
                console.log(this.d_questions, event.id)
            }
        }
    }
</script>