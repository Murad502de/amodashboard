<template>
    <div class="dashboard-tile__item-chart">
        <div class="pipeline-block">
            <chart-item-tmp :users="users"/>
        </div>
    </div>
</template>

<script>
    import ChartItemTmp from './ChartItemTmp';

    export default {
        data() {
            return {
                show : true
            }
        },
        props : {
            users : {
                type : Array,
                required : true
            }
        },

        components : {
            ChartItemTmp
        },

        methods : {
            pipeline_visibility : function ( pipelineId ) {
                console.log( 'pipeline_visibility' );

                let userList = document.querySelector( `div[data-id_pipeline-users="${pipelineId}"]` );

                //userList.classList.toggle( "pipeline-user-list-hidden" );
                this.pipelines[ pipelineId ].show = !this.pipelines[ pipelineId ].show;
                //console.log( userList );
            }
        },

        mounted () {
            console.log( 'Component ChartTmp mounted' );
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
    }

    .dashboard-tile__item-chart-item-progress-pipeline {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        border-radius: 10px;
        background-color: #ff9c00;
        z-index: 1;
    }

    .dashboard_tile__item_chart_item_pipeline:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        border-radius: 10px;
        background-color: #041c30;
    }

    .dashboard_tile__item_chart_item_pipeline {
        padding-top: 5px;
    }

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
    }

    .dashboard-tile__item-chart {
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        -webkit-box-flex: 1;
        flex-grow: 1;
        padding-top: 9px;
        min-height: 0;
        overflow: hidden;
    }

    .pipeline-name {
        color: white;
        margin-bottom: 10px;
    }

    .pipeline-block {
        margin-bottom: 20px;
    }

    .pipeline-amount {
        color: #8275ff;
    }

    .pipeline-block-title {
        cursor : pointer;
        position : relative;
    }
</style>