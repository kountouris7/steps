<template>

</template>

<script>
    export default {
        name: "Show.vue",

        data() {
            return {
                group_id: '',
                user_id: ''
            }
        },

        methods: {
            book() {
                axios.post('/testing/' + this.group_id + this.user_id, {
                    group_id: this.group_id,
                    user_id: this.user_id
                });
            }
        }
    }
</script>

<style scoped>

</style>