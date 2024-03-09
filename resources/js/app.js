import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';

Vue.use(VueRouter);

const routes = [
    { path: '/home', component: require('./App.vue').default },
];

const router = new VueRouter({
    mode: 'history',
    routes // forma corta para `routes: routes`
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

