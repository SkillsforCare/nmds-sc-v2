<template>
    <div class="form-group" :class="{ 'form-group-error': error }">
        <label class="form-label" for="field">
            {{ label }}
        </label>
        <span v-if="help_text" class="form-hint">
            {{ help_text }}
        </span>
        <span v-if="error" class="error-message">
            {{ error }}
        </span>
        <input type="text" class="form-control" v-model="d_value" :id="field" :name="field" @input="input"  rows="5" />
    </div>
</template>
<script>
    export default {
        name: 'f-text',
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
        mounted() {
            this.d_value = this.value
        },
        data(){
            return {
                d_value: null,
            }
        },
        methods: {
            input() {

                let text = this.d_value

                if (this.d_value.length > 15)
                    text = this.d_value.substring(0,15)+'...';

                this.$emit('change', {
                    text: text,
                    value: this.d_value
                })
            }
        }
    }
</script>