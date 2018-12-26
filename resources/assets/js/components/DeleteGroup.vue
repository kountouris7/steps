<template>
    <div id="app">
        <ul class="collection">
                    <li class="collection-item avatar center-align">
                        <strong> You have booked:</strong><br>
                        {{lesson}} <br>
                        On {{moment(day_time).format("dddd MMMM D")}} at {{moment(day_time).format("HH:mm")}}
                        <hr>

                        <div v-if="loading" class="preloader-wrapper small active">
                            <div class="spinner-layer spinner-green-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <button type="submit" class="waves-effect pink accent-3 btn-small" onclick="return confirm('Are you sure?')" @click="toggle">Cancel
                                Booking
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
</template>

<script>
    var moment = require('moment');

    export default {
        props: ['group'],

        data() {
            return {
                loading: false,
                moment: moment,
                day_time: this.group.day_time,
                lesson: this.group.lesson.name
            }
        },

        methods: {
            toggle() {
                this.loading = true;
                axios.delete('/booking/' + this.group.id)
                    .then(response => {
                        console.log(response);
                    });
                $(this.$el).fadeOut(300, () => {
                    flash('Your booking has been deleted.');
                })
                    .catch(error => {
                        this.loading = false;
                        //if error status code == 422
                        //show validation errors
                        alert('Woops!!!Please try to refresh the page');
                        console.log(error.data)
                    });
            }
        }
    }
</script>

<style scoped>

</style>