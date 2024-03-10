import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './components/App.vue';
import router from './router';
import store from './store';

Vue.config.productionTip = false;
Vue.use(VueRouter);

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});
