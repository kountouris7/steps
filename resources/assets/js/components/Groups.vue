<template>
    <button type="submit" :class="classes" class="waves-effect pink accent-3 btn-small" @click="toggle">
        <span v-text="getBookButtonText"></span>
    </button>
</template>

<script>
    export default {

        props: ['group'],

        data() {
            return {
                bookingsCount: this.group.bookingsCount,
                isBooked: this.group.isBooked,
                maxCapacity: this.group.max_capacity,
            }
        },

        computed: {
            classes() {
                return [this.isBooked ? 'disabled' : ''];
            },
            getBookButtonText() {
                return this.maxCapacity - this.bookingsCount + ' of ' + this.maxCapacity + ' available';
            }
        },

        methods: {
            toggle() {
                axios.post('/booking/' + this.group.id)
                    .then(response => {
                        this.isBooked = true;
                        this.bookingsCount++;

                        console.log(response)
                    })
                    .catch(error => {
                        //if error status code == 422
                        //show validation errors

                        alert('kolos')
                        console.log(error.response)
                    });


            },
        }
    }
</script>

<style scoped>

</style>