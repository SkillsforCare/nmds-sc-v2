<template>
    <div>
        <f-select v-show="type === 'select'" v-model="value" :field="field" :help_text="help_text" :label="label" :options="options" @change="updated"></f-select>
        <f-yes-no v-show="type === 'yes_no'" v-model="value" :field="field" :help_text="help_text" :label="label" :options="options" @change="updated"></f-yes-no>
        <f-date v-show="type === 'date'" v-model="value" :field="field" :help_text="help_text" :label="label" :options="options" @change="updated"></f-date>
        <f-text-area v-show="type === 'text'" v-model="value" :field="field" :help_text="help_text" :label="label" :options="options" @change="updated"></f-text-area>
    </div>
</template>
<script>
    import FSelect  from './form/FSelect'
    import FYesNo  from './form/FYesNo'
    import FDate  from './form/FDate'
    import FTextArea  from './form/FTextArea'
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
        components: { FSelect, FYesNo, FDate, FTextArea },
        methods: {
            updated(event) {
                this.$emit('updated', event)
            }
        }
    }
</script>