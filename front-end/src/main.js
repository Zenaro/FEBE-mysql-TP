import Vue from 'vue/dist/vue.js';
import VueRouter from 'vue-router';

import './style/base.scss';

Vue.use(VueRouter);

import Container from './component/container.vue';
import Login from './component/login.vue';
// import About from './component/about.vue';

// const Foo = {
// 	template: '<div>foo</div>'
// };
// const Bar = {
// 	template: '<div>bar</div>'
// };
// const User = {
// 	template: '<div>User{{$route.params.id}}</div>'
// };

// 2. 定义路由
// 每个路由应该映射一个组件。 其中"component" 可以是
// 通过 Vue.extend() 创建的组件构造器，
// 或者，只是一个组件配置对象。
// const routes = [{
// 	path: '/foo',
// 	component: Foo
// }, {
// 	path: '/bar',
// 	component: Bar
// }];

// 3. 创建 router 实例，然后传 `routes` 配置
// 你还可以传别的配置参数, 不过先这么简单着吧。
const router = new VueRouter({
	routes: [{
		path: '/',
		component: Container,
		children: [{
			path: 'login',
			component: Login
		}]
	}]
});

// 4. 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
const app = new Vue({
	router
}).$mount('#app');