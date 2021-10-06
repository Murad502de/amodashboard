<template>
    <div class="pipeline-block-users">
        <div v-for="(user, index) in users" :key="index" class="dashboard-tile__item-chart-item">
            <div class="dashboard-tile__item-chart-item-title">
                <span class="dashboard-tile__item-chart-item-link js-navigate-link">{{user.name}}:</span>
            </div>
            <div class="dashboard-tile__item-chart-item-count">
                <span class="dashboard-tile__item-chart-item-link js-navigate-link">&nbsp;<strong class="user-count">{{user.count}}</strong></span>
            </div>
            <div class="dashboard-tile__item-chart-item-period-count ">&nbsp;</div>
            <div
                class="dashboard-tile__item-chart-item-stage-progress"
                v-bind:style="{ width : user.percent + '%' }"
                :data-id-color="index"
                :data-id-stage="user.stage"
            ></div>
        </div>
    </div>
</template>

<script>
    export default {
        props : {
            users : {
                type : Array,
                required : true
            }
        },

        mounted () {
            console.log( 'Component ChartItemTmp mounted' );
        }
    }
</script>

<style>
    .dashboard-tile__item-chart-item:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        border-radius: 10px;
    }

    .dashboard-tile__item-chart-item:after {
        background-color: #041c30;
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

    .dashboard-tile__item-chart-item {
        display: -webkit-box;
        display: flex;
        -webkit-box-align: baseline;
        align-items: baseline;
        position: relative;
        padding-bottom: 8px;
        margin-bottom: 12px;
    }

    .dashboard-tile__item-chart-item-stage-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        border-radius: 10px;
        z-index: 1;
    }

    div[data-id-color] {
        background-color: #ffd66d;
    }

    /*div[data-id-color="0"] {
        background-color: #99CCFF;
    }

    div[data-id-stage="142"] {
        background-color: #00D669;
    }

    div[data-id-stage="143"] {
        background-color: #A5B0B9;
    }*/

    .dashboard-tile__item-chart-item-period-count {
        color: #00d669;
        margin-left: auto;
    }

    .dashboard-tile__item-chart-item-count {
        font-weight: 700;
        margin-left: 5px;
    }

    .dashboard-tile__item-chart-item-link {
        color: white;
    }

    .pipeline-user-list-hidden {
        display: none;
    }
</style>
