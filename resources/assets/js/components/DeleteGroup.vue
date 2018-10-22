<template>
    <ul class="collection">
        <li class="collection-item avatar center-align">
            <strong> You have booked:</strong><br>
            {{lesson}} <br>
            On {{moment(day_time).format("dddd")}} at {{moment(day_time).format("hh:mm")}}
            <hr>
            <button type="submit" class="waves-effect pink accent-3 btn-small" @click="toggle">Delete Booking</button>
        </li>
    </ul>


</template>

<script>
    var moment = require('moment');
    //moment().format();

    export default {
        props: ['group'],

        data() {
            return {
                //deleted: true,
                moment:moment,
                day_time: this.group.day_time,
                lesson:this.group.lesson.name
            }
        },

        methods: {
            toggle() {
                axios.delete('/booking/' + this.group.id)
                    .then(response => {

                        console.log(response);
                    });

                $(this.$el).fadeOut(300, () => {
                    flash('Your reply has been deleted.');
                });
            },
        }
    }
</script>

<style scoped>

</style>