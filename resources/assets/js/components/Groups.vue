<template>
    <button type="submit" :class="classes" class="waves-effect pink accent-3 btn-small" @click="submit">
        <span v-text="bookingsCount"></span>
    </button>
</template>

<script>

    export default {

        props: ['group'],



        data(){
            return{
                bookingsCount: 1,
                user: 1
            }
        },

        computed:{ //this for later use to count
            classes(){

            }

        },

        methods: {
            submit() {
                axios.post('/booking/' + this.group.id + '/1')
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error.response)
                    });
            },



        }

    }
</script>

<style scoped>

</style>