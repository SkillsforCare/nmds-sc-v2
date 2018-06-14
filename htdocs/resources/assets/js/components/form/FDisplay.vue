<template>
    <div>
        <span v-if="!d_value.answer.answer">
            Not answered
        </span>
        <span v-else>
            <span v-if="d_value.field_type === 'text'">{{ d_value.answer.answer }}</span>
            <span v-if="d_value.field_type === 'date'">{{ d_value.answer.text }}</span>
            <span v-if="d_value.field_type === 'select'">{{ d_value.answer.text }}</span>
            <span v-if="d_value.field_type === 'radio-list'">{{ d_value.answer.text }}</span>
        </span>
    </div>
</template>
<script>
    export default {
        name: 'f-display',
        props: {
            data: {
                type: Object,
                required: true
            }
        },
        mounted() {
            this.d_value = this.data
        },
        data(){
            return {
                d_value: {
                    answer: {
                        answer: ''
                    }
                },
            }
        },
        methods: {
            input() {

                let text = this.d_value

                if (this.d_value.length > 15)
                    text = this.d_value.substring(0,15)+'...';

                this.$emit('change', {
                    text: this.d_value,
                    value: this.d_value
                })
            }
        }
    }
</script>