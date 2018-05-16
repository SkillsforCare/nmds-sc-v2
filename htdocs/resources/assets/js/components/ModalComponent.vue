<template>
    <div>
        <modal name="update-question" height="auto" @before-open="beforeOpen">
            <div class="modal">
                <div class="modal-content">
                <form-builder
                    :label="itemToShow.question"
                    v-model="itemToShow.question"
                    :field="itemToShow.field"
                    :type="itemToShow.field_type"
                    :help_text="itemToShow.help_text"
                    :options="itemToShow.options"
                    :error="itemToShow.error"
                    @updated="fieldUpdated(question, $event)"
                />
                </div>
                <hr>
                <div class="modal-actions">
                    <input type="submit" class="button" value="Save" />
                    <a href="" @click.prevent="$modal.hide('update-question');">Cancel</a>
                </div>
            </div>


        </modal>
    </div>
</template>

<script>
    export default {
        name: 'ModalComponent',

        data() {
            return {
                item: ''
            }
        },

        computed: {
            itemToShow () {
                return this.item
            }
        },

        methods: {
            beforeOpen (event) {
                console.log(event)
                this.item = event.params;
            }
        }
    }
</script>
