<template>
    <div>
        <f-select v-show="type === 'select'" v-model="value" :field="field" :help_text="help_text" :label="label" :options="options" @change="updated"></f-select>
    </div>
</template>
<script>
    import FSelect  from './form/FSelect'
    export default {
        props: {
            label: {
                type: String,
                required: true
            },
            type: {
                type: String,
                required: true
            },
            field: {
                type: String,
                required: true
            },
            value: {
                required: true
            },
            options: {
                type: Array,
                required: false
            },
            help_text: {
                type: String,
                required: false
            }
        },
        components: { FSelect },
        methods: {
            updated(event) {
                this.$emit('updated', event)
            }
        }
    }
</script>