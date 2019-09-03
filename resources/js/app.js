import BootstrapVue from 'bootstrap-vue';
import Store from './store';
import Vuex from 'vuex';

require('./bootstrap');
window.Vue = require('vue');

var Lang = require('vue-lang');
var locales = {
    "en": require("./locale/en.json"),
    "pt-br": require("./locale/pt-br.json")
};

Vue.use(Vuex);
Vue.use(Lang, {lang: 'pt-br', locales: locales});
Vue.use(BootstrapVue);

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('products', require('./components/Products.vue').default);
Vue.component('resume-tax', require('./components/Resume-tax.vue').default);

const store = new Vuex.Store(Store);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
});
