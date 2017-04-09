import Vue from 'vue/dist/vue.js';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

import './style/base.scss';

Vue.use(VueRouter);
Vue.use(VueResource);

import Container from './component/container.vue';
import Index from './component/index.vue';
import Login from './component/login.vue';

// 创建 router 实例，然后传 `routes` 配置
const router = new VueRouter({
	routes: [{
		path: '/',
		component: Container,
		children: [{
			path: '',
			component: Index
		}, {
			path: 'login',
			component: Login
		}]
	}]
});

// 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
const app = new Vue({
	router
}).$mount('#app');