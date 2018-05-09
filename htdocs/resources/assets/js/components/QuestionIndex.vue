<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            question_type: {
                type: Object,
                required: true
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.index()
        },
        data(){
            return {
                questions: []
            }
        },
        methods: {
            index() {
                axios.get('/api/questions').then(this.refresh);
            },
            refresh({ data }) {
                this.questions = data;
            }
        }
    }
</script>
