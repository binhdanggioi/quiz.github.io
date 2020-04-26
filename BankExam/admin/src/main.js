import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/en';

import ListExam from './components/Exams/ListExam'

Vue.config.productionTip = false
Vue.use(ElementUI, {locale});
Vue.use(VueRouter);

const routes = [
    {path: '/exams',name: 'exams',components:ListExam}
];

const router = new VueRouter({
    routes
})
new Vue({
    router,
    render: h => h(App),
}).$mount('#app')
