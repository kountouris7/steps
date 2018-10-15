<template>
    <button type="submit" :class="classes" class="waves-effect pink accent-3 btn-small" @click="toggle">
        <span v-text="getBookButtonText"></span>
    </button>

</template>

<script>
    export default {

        props: ['group', 'auth',],

        data() {
            return {
                bookingsCount: this.group.bookingsCount,
                isBooked: this.group.isBooked,
                maxCapacity: this.group.max_capacity,
            }
        },

        computed: {
            classes() {
                return [this.isBooked ? 'disabled' : '']; //if status 222 then dont disable?
            },
            getBookButtonText() {
                return this.maxCapacity - this.bookingsCount + ' of ' + this.maxCapacity + ' available';
            }
        },

        methods: {
            toggle() {
                axios.post('/booking/' + this.group.id + '/' + this.auth)
                    .then(response => {
                        //console.log(response);
                        if (response.status === 222) { //find out why error 222?
                            alert(response.data.message);
                        }else{
                            this.isBooked = true;
                            this.bookingsCount++;
                        }
                    })
                    .catch(error => {
                        //if error status code == 422
                        //show validation errors
                        alert('Woops!! Something went wrong');
                        console.log(error.data)
                    });


            },
        }
    }
</script>

<style scoped>

</style>