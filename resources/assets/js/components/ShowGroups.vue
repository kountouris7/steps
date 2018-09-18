<template>

</template>

<script>
    import {AxiosInstance as axios} from "axios";

    export default {
       // name: "ShowGroups.vue",

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
                })
                    .then(response => 'ssssssss')
                    .catch(e => {
                        this.errors.push(e)
                    });
            },

            destroy() {
                axios.delete('/booking/' + this.group.id);
                $(this.$el).fadeOut(300, () => {
                    flash('Your reply has been deleted.');
                });
            }
        }
    }
</script>

<style scoped>

</style>