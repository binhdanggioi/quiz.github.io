import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/en';
import axios from 'axios'
import ListExam from './components/Exams/ListExam'
import ExamForm from './components/Exams/ExamForm'
import ListQuestion from './components/Questions/ListQuestion'
import QuestionForm from './components/Questions/QuestionForm'
import ListUser from './components/Users/ListUser'
import Login from './components/Auth/Login.vue'

Vue.config.productionTip = false
Vue.use(ElementUI, {locale});
Vue.use(VueRouter);
Vue.prototype.$axios = axios
Vue.use(axios);

axios.defaults.baseURL = 'http://127.0.0.1:8000/';
console.log(localStorage.getItem('access_token'));
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('access_token')}`;
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

const routes = [
    {path: '/exams',name: 'exams',component:ListExam},
    {path: '/exams/:id/detail',name: 'exams.detail',component:ExamForm},
    {path: '/questions',name: 'questions',component: ListQuestion},
    {path:'/questions/create',name:'questions.create',component:QuestionForm},
    {path:'/questions/:id/edit',name:'questions.edit',component:QuestionForm},
    {path: '/users',name: 'users',component: ListUser},
    {path: '/login',name: 'login',component: Login},
];

const router = new VueRouter({
    routes
})
new Vue({
    router,
    render: h => h(App),
}).$mount('#app')
