<template>
    <div class="form-group" :class="{ 'form-group-error': error }">
        <label class="form-label-bold" :for="field">{{ label }}</label>
        <span v-if="help_text" class="form-hint">
            {{ help_text }}
        </span>
        <span v-if="error" class="error-message">
            {{ error }}
        </span>
        <multiselect
            class="f-select-search form-control"
            v-model="d_value"
            value="d_value"
            placeholder="Please select"
            label="text"
            :options="options"
            @input="change"
        >
        </multiselect>
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect'
    export default {
        name: 'f-select-search',
        components: { Multiselect },
        props: {
            label: {
                type: String,
                required: true
            },
            field: {
                type: String,
                required: true
            },
            options: {
                type: Array,
                required: false
            },
            help_text: {
                type: String,
                required: false
            },
            error: {
                type: String,
                required: false
            },
            value: {
                required: true
            }
        },
        created() {
            if(this.value) {
                this.d_value = parseInt(this.value)
            }
        },
        data(){
            return {
                d_value: {
                    value: null,
                    text: 'Please select'
                },
            }
        },
        methods: {
            change(event) {
                this.$emit('change', {
                    text: event.text,
                    value: event.value
                })
            }
        }
    }
</script>