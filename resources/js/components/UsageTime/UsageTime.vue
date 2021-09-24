<template>
    <section class="dashboard-tile__item">
        <top-tmp :pipelines="data.pipelines.list" :total="data.pipelines.totalAmount"/>
		<chart-tmp :groups="data.pipelines.list"/>
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
            console.log( 'Component UsageTime mounted' );
        }
    }
</script>

<style>
    .dashboard-tile__item {
        padding: 14px 15px 13px;
        position: relative;
        height: 100%;
        width: 100%;
        box-shadow: 0 4px 4px rgb(0 0 0 / 35%);
        box-sizing: border-box;
        border-radius: 10px;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        background: rgba(12,37,61,.95);
        min-height: 400px;
    }
</style>