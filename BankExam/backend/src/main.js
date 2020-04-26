import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/en';
import VueRouter from 'vue-router';

import ListExam from './components/Exams/ListExam.vue';
import ListQuestion from './components/Questions/ListQuestion.vue';
import App from "./App";

Vue.config.productionTip = false;
Vue.use(ElementUI, {locale});
Vue.use(VueRouter);

const routes = [
    {
        path: '/exams', name:'exams', components: ListExam
    },
    {
        path: '/questions', name: 'questions', components: ListQuestion
    }
];

const router = new VueRouter({
    routes
})

new Vue({
    el: '#app',
    router,
    render: h => h(App),
}).$mount('#app');

