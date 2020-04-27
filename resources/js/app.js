require('./bootstrap')
window.Vue = require('vue')
import store from './store/index'
import App from './App.vue'
export const bus = new Vue()

const app = new Vue({
    el: '#app',
    components: { App },
    store
})
