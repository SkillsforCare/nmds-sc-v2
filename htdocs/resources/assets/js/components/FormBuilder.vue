<template>
    <div>
        <f-select v-if="type === 'select'" v-model="value" :field="field" :help_text="help_text" :error="error" :label="label" :options="options" @change="updated"></f-select>
        <f-select-search v-if="type === 'select-search'" v-model="value" :field="field" :help_text="help_text" :error="error" :label="label" :options="options" @change="updated"></f-select-search>
        <f-radio-list v-if="type === 'radio-list'" v-model="value" :field="field" :help_text="help_text" :error="error" :label="label" :options="options" @change="updated"></f-radio-list>
        <f-yes-no v-if="type === 'yes_no'" v-model="value" :field="field" :help_text="help_text" :error="error"  :label="label" :options="options" @change="updated"></f-yes-no>
        <f-date v-if="type === 'date'" v-model="value" :field="field" :help_text="help_text" :error="error"  :label="label" :options="options" @change="updated"></f-date>
        <f-text-area v-if="type === 'text-area'" v-model="value" :field="field" :help_text="help_text" :error="error"  :label="label" :options="options" @change="updated"></f-text-area>
        <f-text v-if="type === 'text'" v-model="value" :field="field" :help_text="help_text" :error="error"  :label="label" :options="options" @change="updated"></f-text>
    </div>
</template>
<script>
    import FSelect  from './form/FSelect'
    import FSelectSearch from './form/FSelectSearch'
    import FRadioList  from './form/FRadioList'
    import FYesNo  from './form/FYesNo'
    import FDate  from './form/FDate'
    import FTextArea  from './form/FTextArea'
    import FText  from './form/FText'
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
            },
            error: {
                type: String,
                required: false
            }
        },
        components: { FSelect, FSelectSearch, FRadioList, FYesNo, FDate, FTextArea, FText },
        methods: {
            updated(event) {
                this.$emit('updated', event)
            }
        }
    }
</script>