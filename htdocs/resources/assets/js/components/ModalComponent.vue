<template>
    <modal name="update-question" height="auto" @before-open="beforeOpen">
        <div class="modal">
            <div class="modal-content">
            <form-builder
                :label="itemToShow.question"
                v-model="itemToShow.answer.answer"
                :field="itemToShow.field"
                :type="itemToShow.field_type"
                :help_text="itemToShow.help_text"
                :options="itemToShow.options"
                :error="error"
                @updated="fieldUpdated($event)"
            />
            </div>
            <hr>
            <div class="modal-actions">
                <input type="submit" @click="submitAnswer" class="button" value="Save" />
                <a href="" @click.prevent="$modal.hide('update-question')">Cancel</a>
            </div>
        </div>
    </modal>
</template>

<script>
    export default {
        name: 'ModalComponent',

        data() {
            return {
                item: {
                    answer: {
                        answer: ''
                    }
                },
                error: ''
            }
        },

        computed: {
            itemToShow () {
                return this.item
            }
        },

        methods: {
            beforeOpen (event) {
                this.item = JSON.parse(JSON.stringify(event.params));
                this.error = ''
            },
            submitAnswer() {

                let params = {
                    id: this.item.id,
                    entity_id: this.item.entity_id,
                    entity_type: this.item.entity_type,
                    text: this.item.answer.text || null,
                    answer: this.item.answer.answer || null,
                }

                axios
                    .post('/api/question_answers', params)
                    .then((data) => {
                        this.item = {
                            answer: data.data.data.answer,
                            id: params.id
                        }
                        this.$modal.hide('update-question')
                        this.$emit('modal-submitted', this.item)
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors.answer[0])

                        this.error = error.response.data.errors.answer[0]
                    });
            },
            fieldUpdated(event) {
                this.item.answer.answer = event.value
                this.item.answer.text = event.text
            }
        }
    }
</script>
