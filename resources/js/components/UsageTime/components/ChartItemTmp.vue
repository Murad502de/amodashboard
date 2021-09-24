<template>
    <div class="pipeline-block-users" :data-id_pipeline-users="group">
        <div v-for="user in users" :key="user.name" style="display: grid; grid-template-columns: 10% 90%;">
            <div class="dashboard-tile-online__avatar" style="background-image: url(/v3/users/b262af3e-a67d-11eb-860b-00163ef260f3/avatar/?1626943666), url(https://integrat2.amocrm.ru/frontend/images/userpic.png)" title="Мурад"></div>

            <div class="dashboard-tile__item-chart-item">
                <div class="dashboard-tile__item-chart-item-title">
                    <span class="dashboard-tile__item-chart-item-link js-navigate-link">{{user.name}}:</span>
                </div>
                <div class="dashboard-tile__item-chart-item-count">
                    <span class="dashboard-tile__item-chart-item-link js-navigate-link">&nbsp;<strong>{{user.count}}</strong></span>
                </div>
                <div class="dashboard-tile__item-chart-item-period-count ">&nbsp;</div>
                <div class="dashboard-tile__item-chart-item-progress" v-bind:style="{ width : user.percent + '%' }"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : {
            users : {
                type : Array,
                required : true
            },

            group : {
                type : String,
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

    .dashboard-tile__item-chart-item-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        border-radius: 10px;
        background-color: #ffd66d;
        z-index: 1;
    }

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

    .dashboard-tile-online__avatar {
        flex-shrink: 0;
        width: 35px;
        margin-right: 10px;
        min-width: 35px;
        height: 35px;
        overflow: hidden;
        border-radius: 50%;
        display: inline-block;
        flex-basis: 35px;
        background-size: cover;
    }
</style>
