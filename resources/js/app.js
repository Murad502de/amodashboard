require('./bootstrap');

window.Vue = require( 'vue' );

import VueRouter from 'vue-router';
import router from './router';
import App from './components/App';
import Vue from 'vue';

Vue.use( VueRouter );

const app = new Vue(
    {
        el : '#app',
        render : h => h( App ),
        router
    }
);