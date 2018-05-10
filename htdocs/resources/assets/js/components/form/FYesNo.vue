<template>

    <div class="form-group">
        <fieldset class="inline">
            <legend>
                <span class="form-label-bold">
                {{ label }}
                </span>
            </legend>

            <span v-if="" class="form-hint">
                {{ help_text }}
            </span>

            <div v-for="option in options" class="multiple-choice" v-model="d_value" @change="change">
                <input
                    :id="field + '-' + option.value"
                    type="radio"
                    :name="field + '-group'"
                    :value="option.value"
                    :checked="d_value === option.value"
                >
                <label :for="field + '-' + option.value">{{ option.text }}</label>
            </div>
        </fieldset>
    </div>
</template>
<script>
    export default {
        name: 'f-yes-no',
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
            change(event) {
                let text = this.options.filter(x => x.value ===  event.target.value)[0]

                this.$emit('change', {
                    text: text.text,
                    value: event.target.value
                })
            }
        }
    }
</script>