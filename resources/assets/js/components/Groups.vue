<template>
    <button type="submit" :class="classes" class="waves-effect pink accent-3 btn-small" @click="toggle">
        <span v-text="bookingsCount"></span>
    </button>
</template>

<script>

    export default {

        props: ['group'],

        data() {
            return {
                bookingsCount: this.group.bookingsCount,
                isBooked: this.group.isBooked,
                //clients: this.group.clients
            }
        },

        computed: {
            classes() {
                return [this.isBooked ? 'disabled' : ''];
            }

        },

        methods: {
            toggle() {
                axios.post('/booking/' + this.group.id)
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        console.log(error.response)
                    });

                this.isBooked = true;
                this.bookingsCount++;

            },


        }

    }
</script>

<style scoped>

</style>