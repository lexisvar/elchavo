import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Multiselect from 'vue-multiselect'
import VueLodash from 'vue-lodash'
import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'

// register globally


import Dashboard from '../components/dashboard.vue'
import Vecindad from '../components/vecindad.vue'
import Habitante from '../components/habitante.vue'

const routes = [
	{ path: '/', component: Dashboard },
	{ path: '/vecindad', component: Vecindad },
	{ path: '/habitante/:id', component: Habitante },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
	routes // short for `routes: routes`
})

Vue.use(VueLodash) // options is optional
Vue.use(VueRouter)
Vue.use(VueGoodTablePlugin);
Vue.use(VueAxios, axios)

Vue.component('multiselect', Multiselect)


const app = new Vue({
	router,
  data : {
    hello : 'hello',
  },
  components: {
  },
  methods : {

  }
}).$mount('#appElChavo')
