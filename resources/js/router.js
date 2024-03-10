import VueRouter from 'vue-router';

const routes = [
    { name: 'landing' , path: '/landing', component: require('./components/LandingComponent.vue').default },
    { name: 'login' , path: '/login', component: require('./components/LoginComponent.vue').default },
    { name: 'register' , path: '/register', component: require('./components/RegisterComponent.vue').default },
    { name: 'validate-phone-code' , path: '/validate-phone-code', component: require('./components/ValidatePhoneCodeComponent.vue').default },
    { name: 'send-phone-code' , path: '/send-phone-code', component: require('./components/SendPhoneCodeComponent.vue').default },
    { name: 'vehicle-information' , path: '/vehicle-information', component: require('./components/VehicleInfoComponent.vue').default },
];

const router = new VueRouter({

    mode: "history",
    routes: routes
});

export default router;
