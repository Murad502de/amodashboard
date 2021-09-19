<template>
    <router-view v-if="amo_data" :data="amo_data"></router-view>
</template>

<script>
    export default {
        data () {
            return {
                amo_data : null
            }
        },

        mounted () {
            console.log( 'Component App mounted' );

            axios
                .get( 'https://www.hub.integrat.pro/Murad/amodashboard/api' + this.$route.path )
                .then(
                    response => ( this.amo_data = response.data )
                );

                //http://amodashboard/

            console.log( 'route' );
            console.log( this.$route );
        }
    }
</script>

<style>
    * {
        padding: 0;
        margin: 0;
        color: white;
    }
</style>