<template>
    <section class="dashboard-tile__item">
        <top-tmp :total="data.totalAmount"/>
		<chart-tmp :users="data.leads"/>
	</section>
</template>

<script>
    import TopTmp from './components/TopTmp';
    import ChartTmp from './components/ChartTmp';

    export default {
        props : {
            data : {
                type : Object,
                required : true
            }
        },

        components : {
            TopTmp, ChartTmp
        },

        mounted () {
            console.log( 'Component ActiveLeads mounted' );
        }
    }
</script>

<style>
</style>