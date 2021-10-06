<template>
    <router-view v-if="amo_data" :data="amo_data"></router-view>
</template>

<script>
    export default {
        data () {
            return {
                amo_data : null,
                baseApiUrl : null,
                intervalApp : null
            }
        },

        mounted () {
            console.log( 'Component App mounted' );

            this.baseApiUrl = window.baseApiUrl;

            let path = this.$route.path;

            path = path.split( '/' );
            path = path[ path.length - 1 ]

            this.getData( this.baseApiUrl + '/' + path );
        },

        methods : {
            getData : function ( url = null ) {
                if ( !url ) return;

                console.log( 'api route' );
                console.log( url );

                this.intervalApp = setInterval( () => {
                    console.log( 'send ajax' );

                    axios
                        .get( url )
                        .then(
                            response => {
                                console.log( 'success' );

                                this.amo_data = response.data;
                            }
                        );
                }, 15000);
            }
        }
    }
</script>

<style>
    * {
        padding: 0;
        margin: 0;
        font: 15px 'PT Sans',Arial,sans-serif;
        color: white;
    }
</style>