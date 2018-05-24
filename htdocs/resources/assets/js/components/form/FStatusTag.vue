<template>
    <span class="status-tag" v-if="message">
        <a v-if="url" :href="url">{{ message }}</a>
        <span v-else>{{ message }}</span>
    </span>
</template>
<script>
    export default {
        name: 'f-status-tag',
        props: {
            url: {
                type: String,
                required: false,
                default: ''
            },
            message: {
                type: String,
                required: false,
                default: ''
            }
        }
    }
</script>