<template>
    <div class="form-group">
        <button class="button" @click="click">
            <slot />
        </button>
    </div>
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