<template>
    <div class="form-group" :class="{ 'form-group-error': error }">
        <label class="form-label" :for="field">{{ label }}</label>
        <span v-if="help_text" class="form-hint">
            {{ help_text }}
        </span>
        <span v-if="error" class="error-message">
            {{ error }}
        </span>
        <select class="form-control" v-model="d_value" :id="field" :name="field" @change="change">
            <option v-for="option in options" :value="option.value">{{ option.text }}</option>
        </select>
    </div>
</template>
<script>
    export default {
        name: 'f-select',
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
            this.d_value = this.value
        },
        data(){
            return {
                d_value: null,
            }
        },
        methods: {
            change(event) {
                let text = this.options.filter(x => x.value ===  this.d_value)[0]
                this.$emit('change', {
                    text: text.text,
                    value: event.target.value
                })
            }
        }
    }
</script>