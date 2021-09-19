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

            let path = this.$route.path;

            path = path.split( '/' );
            path = path[ path.length - 1 ]

            axios
                .get( 'https://www.hub.integrat.pro/Murad/amodashboard/public/api/' + path )
                .then(
                    response => ( this.amo_data = response.data )
                );

                //http://amodashboard/

            console.log( 'route' );
            console.log( 'https://www.hub.integrat.pro/Murad/amodashboard/public/api/' + path );
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