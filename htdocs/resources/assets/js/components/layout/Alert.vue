<template>
    <div class="" :class="status +'-summary'" role="alert" :aria-labelledby="status + '-summary-heading'" tabindex="-1">
        <h2 :class="'heading-medium' + status + '-summary-heading'" :id="status + '-summary-heading'">
            <slot></slot>
        </h2>
    </div>
</template>
<script>
    export default {
        name: 'alert',
        props: {
            status: {
                type: String,
                required: true
            },
            show: {
                type: Boolean,
                required: true
            }
        }
    }
</script>