<template>
    <div class="alert alert-success alert-flash" role="alert" v-show="show">
        <strong>Success!</strong> {{ body }}
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
                }, 3000); //** 3 seconds
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>