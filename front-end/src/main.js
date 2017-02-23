import Vue from 'vue';
import VueRouter from 'vue-router';

// import app from './component/app.vue';

Vue.use(VueRouter);

// 0. 如果使用模块化机制编程，導入Vue和VueRouter，要调用 Vue.use(VueRouter)

// 1. 定义（路由）组件。
// 可以从其他文件 import 进来
const Foo = {
	template: '<div>foo</div>'
}
const Bar = {
	template: '<div>bar</div>'
}

// 2. 定义路由
// 每个路由应该映射一个组件。 其中"component" 可以是
// 通过 Vue.extend() 创建的组件构造器，
// 或者，只是一个组件配置对象。
const routes = [{
	path: '/',
	component: Foo
}, {
	path: '/bar',
	component: Bar
}]

const router = new VueRouter({
	routes // （缩写）相当于 routes: routes
})

// const app = new Vue({
// 	router,
// 	render: function(createElement) {
// 		return createElement(
// 			'h2',
// 			'gg'
// 		)
// 	}
// }).$mount('#app');

const App = Vue.extend({
	template: '<p>{{name}}</p>',
	data: function() {
		return {
			name: 'zeattle'
		}
	}
});

new App().$mount('#app');



// 现在，应用已经启动了！