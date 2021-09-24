<template>
    <div class="dashboard-tile__item-chart">
        <div class="group-block"  v-for="(group, index) in groups" :key="index">
            <div class="group-block-title" v-on:click="group_visibility(index)" :data-id_group-title="index">
                <h3 class="group-name">
                    {{ group.name }}:&nbsp;<span class="group-amount">{{ group.amount }}</span>
                </h3>
                <transition name="fade">
                    <div v-bind:class="{ dashboard_tile__item_chart_item_group: !group.show }">
                        <div v-if="!group.show" class="dashboard-tile__item-chart-item-progress-group" v-bind:style="{ width : group.amount + '%' }"></div>
                    </div>
                </transition>
            </div>
            <transition name="fade">
                <chart-item-tmp v-if="group.show" :users="group.users" :group="index"/>
            </transition>
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
            groups : {
                type : Object,
                required : true
            }
        },

        components : {
            ChartItemTmp
        },

        methods : {
            group_visibility : function ( groupId ) {
                console.log( 'group_visibility' );

                let userList = document.querySelector( `div[data-id_group-users="${groupId}"]` );

                //userList.classList.toggle( "group-user-list-hidden" );
                this.groups[ groupId ].show = !this.groups[ groupId ].show;
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

    .dashboard-tile__item-chart-item-progress-group {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        border-radius: 10px;
        background-color: #ff9c00;
        z-index: 1;
    }

    .dashboard_tile__item_chart_item_group:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        border-radius: 10px;
        background-color: #041c30;
    }

    .dashboard_tile__item_chart_item_group {
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

    .group-name {
        color: white;
        margin-bottom: 10px;
    }

    .group-block {
        margin-bottom: 20px;
    }

    .group-amount {
        color: #8275ff;
    }

    .group-block-title {
        cursor : pointer;
        position : relative;
    }
</style>