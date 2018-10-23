<template>
    <div id="app">
        <div v-if="loading" class="preloader-wrapper small active">
            <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
<div v-else>
        <button type="submit" :class="classes" class="waves-effect pink accent-3 btn-small" @click="toggle">
            <span v-text="getBookButtonText"></span>
        </button>
</div>
    </div>
</template>
<script>
    export default {
        props: ['group', 'auth',],

        data() {
            return {
                bookingsCount: this.group.bookingsCount,
                isBooked: this.group.isBooked,
                maxCapacity: this.group.max_capacity,
                loading: false
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
                this.loading = true;
                axios.post('/booking/' + this.group.id + '/' + this.auth)
                    .then(response => {
                        console.log(response);
                        //find out why error 222?
                        if (response.status === 222) {
                            this.loading = false;
                           // alert(response.data.message);
                            flash(response.data.message);
                        } else {
                            this.loading = false;
                            this.isBooked = true;
                            this.bookingsCount++;
                        }
                    })
                    .catch(error => {
                        this.loading = false;
                        //if error status code == 422
                        //show validation errors
                        alert('Woops!!!Please try to refresh the page');
                        console.log(error.data)
                    });
            },
        }
    }
</script>

<style scoped>

</style>