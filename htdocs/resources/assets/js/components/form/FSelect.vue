<template>
    <div class="form-group">
        <label class="form-label" :for="field">{{ label }}</label>
        <span v-if="" class="form-hint">
            {{ help_text }}
        </span>
        <select class="form-control" v-model="d_value" :id="field" :name="field" @change="change">
            <option>GOV.UK elements option 1</option>
            <option>GOV.UK elements option 2</option>
            <option>GOV.UK elements option 3</option>
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
                this.$emit('change', event.target.value)
            }
        }
    }
</script>