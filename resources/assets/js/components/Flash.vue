<template>
    <div class="alert alert-warning" role="alert" v-show="show">
       <strong>{{ body }}</strong>
    </div>
</template>

<script>
    export default {
        props: ['message'], //the properties are set in the html (master blade)

        data() {
            return {
                body: '',
                show: false //show message is false by default
            }
        },

        created() { //when a group is stored it calls the flash template in view and when that message changes then it flashes the message
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on(
                'flash', message => this.flash(message)
            );
        },

        methods: {
            flash(message) {
                this.body = message;
                this.show = true;

                this.hide(); // hides alert after **
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 4000); //** 4 seconds
            }
        }
    };
</script>

<style>
    .alert-warning {
        position: fixed;
        right: 7%;
        bottom: 7%;
        background: lightgreen;
    }
</style>