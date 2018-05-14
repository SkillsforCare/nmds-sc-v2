<template>
    <button class="button" @click="click">
        <slot />
    </button>
</template>
<script>
    export default {
        name: 'f-button',
        methods: {
            click() {
                this.$emit('click')
            }
        }
    }
</script>