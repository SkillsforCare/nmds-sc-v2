<template>

    <div class="form-group">


        <fieldset>
            <fieldset>
                <legend>
        <span class="form-label-bold">
          {{ label }}
        </span>
                    <span v-if="help_text" class="form-hint">{{ help_text }}</span>
                </legend>
                <div class="form-date">
                    <div class="form-group form-group-day">
                        <label class="form-label" :for="field + '-d-day'">Day</label>
                        <input class="form-control" :id="field + '-d-day'" v-model="d_day" @input="input" :name="field + '-d-day'" type="number" pattern="[0-9]*">
                    </div>
                    <div class="form-group form-group-month">
                        <label class="form-label" :for="field + '-d-month'">Month</label>
                        <input class="form-control" :id="field + '-d-month'" v-model="d_month" @input="input" :name="field + '-d-month'" type="number" pattern="[0-9]*">
                    </div>
                    <div class="form-group form-group-year">
                        <label class="form-label" :for="field + '-d-year'">Year</label>
                        <input class="form-control" :id="field + '-d-year'" v-model="d_year" @input="input" :name="field + '-d-year'" type="number" pattern="[0-9]*">
                    </div>
                </div>
            </fieldset>
        </fieldset>
    </div>
</template>
<script>
    import moment from 'moment'
    export default {
        name: 'f-date',
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

            if(this.d_value) {
                let date = moment(this.d_value)
                this.d_day = date.format('DD')
                this.d_month = date.format('MM')
                this.d_year = date.format('YYYY')
            }
        },
        data() {
            return {
                d_value: null,
                d_year: null,
                d_month: null,
                d_day: null
            }
        },
        methods: {
            input(event) {
                let text = this.d_day + '/' + this.d_month + '/' + this.d_year
                let value = this.d_year + '-' + this.d_month + '-' + this.d_day

                this.$emit('change', {
                    text: text,
                    value: value
                })
            }
        }
    }
</script>