<template>
    <div v-if="d_open" class="f-alert">
        <span>{{ message }}</span>
        <a href="#" @click.prevent="d_open = false">Close</a>
    </div>
</template>
<script>
    export default {
        name: 'f-alert',
        props: {
            message: {
                required: false
            },
            open: {
                required: false,
                default: true
            },
        },
        data(){
            return {
                d_open: this.open,
                d_message: this.message
            }
        }
    }
</script>