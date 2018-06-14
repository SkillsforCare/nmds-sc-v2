<template>
    <div class="form-group" :class="{ 'form-group-error': error }">
        <fieldset :class="{ inline: options.length < 3 }">
            <legend>
                <span class="form-label-bold">
                {{ label }}
                </span>
            </legend>

            <span v-if="help_text" class="form-hint">
            {{ help_text }}
        </span>
            <span v-if="error" class="error-message">
            {{ error }}
        </span>

            <div v-for="option in options" class="multiple-choice">
                <input
                        :id="field + '-' + option.value"
                        type="radio"
                        :name="field + '-group'"
                        :value="option.value"
                        v-model="d_value"
                        :checked="d_value === option.value"
                        @change="change"
                >
                <label :for="field + '-' + option.value">{{ option.text }}</label>
            </div>
        </fieldset>

    </div>
</template>
<script>
    export default {
        name: 'f-radio-list',
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
                    value: this.d_value
                })
            }
        }
    }
</script>