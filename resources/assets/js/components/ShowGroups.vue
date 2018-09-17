<template>

</template>

<script>
    export default {
        name: "ShowGroups.vue",

        data() {
            return {
                group_id: '',
                user_id: ''
            }
        },

        methods: {
            bookGroup() {
                axios.post('/testing/' + this.group.id + this.user.id, {
                    group_id: this.group.id,
                    user_id: this.user.id
                });
            }
        }
    }
</script>

<style scoped>

</style>