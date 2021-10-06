<template>
    <div class="dashboard-tile__item-top dashboard-tile__item-top_double">
        <h4 class="dashboard-tile__item-title  short ">
            <span class="dashboard-tile__item-title-txt">Активные сделки без задач</span>
        </h4>

        <span class="dashboard-tile__item-actions ">
            <span class="dashboard-tile__item-settings js-tile-convert-icon">
                <svg class="svg-icon svg-common--gear-dims">
                    <use xlink:href="#common--gear"></use>
                </svg>
            </span>
        </span>

        <div class="dashboard-tile__item-top-big-count ">
            <div class="dashboard-tile__item-top-big-count-value js-resize-txt" data-font-size="45" data-font-size-min="20" data-font-proportion="45:200" style="font-size: 40px; height: 40px;">
                <span class="dash-title">{{ total }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props : {
            total : {
                type : Number,
                required : true
            }
        },
    
        mounted () {
            console.log( 'Component TopTmp mounted' );
        }
    }
</script>

<style>
    .dashboard-tile__item-top:after {
        content: "";
        position: absolute;
        bottom: 0;
        height: 1px;
        left: 0;
        right: 35%;
        max-width: 100px;
        border-radius: 1px;
    }

    .dashboard-skin__amo .dashboard-tile__item-top:after {
        background: #fff;
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

    .dashboard-tile__item-top {
        position: relative;
        min-height: 70px;
        flex-shrink: 0;
    }

    .dashboard-tile__item-title-txt {
        display: inline-block;
        vertical-align: top;
        font-size: 12px;
        line-height: 14px;
        letter-spacing: .03em;
        font-weight: 700;
        font-family: "PT Sans Caption";
        text-transform: uppercase;
        color: #fff;
    }

    .dashboard-tile__item-actions {
        display: -webkit-box;
        display: flex;
        position: absolute;
        right: -7px;
        top: -5px;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        flex-direction: row;
        -webkit-box-pack: justify;
        justify-content: space-between;
    }

    .dashboard-tile__item-settings {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        display: none;
        padding: 3px;
        z-index: 3;
    }

    .dashboard-tile__item-top-big-count {
        display: -webkit-box;
        display: flex;
        flex-wrap: nowrap;
        -webkit-box-flex: 1;
        flex-grow: 1;
        margin: 0 0 6px;
    }

    .dashboard-tile__item-top-big-count-value {
        -webkit-box-flex: 1;
        flex-grow: 1;
    }

    .dashboard-tile__item-top-big-count-value {
        font-family: "Open Sans";
        font-weight: 600;
        line-height: .9;
        text-decoration: none;
        white-space: nowrap;
    }

    .dashboard-tile__item-top-big-count-value > span {
        color: #8275ff;
    }

    .dashboard-tiles-wrapper a {
        text-decoration: none;
        color: inherit;
        font-family: inherit;
        font-style: inherit;
    }
</style>