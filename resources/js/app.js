/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap'
window.Vue = require('vue');
import Vue from 'vue'
import vuetify from './plugins/vuetify'
//import App from './App.vue'
require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import DisableAutocomplete from 'vue-disable-autocomplete';

Vue.use(DisableAutocomplete);

import Vuelidate from "vuelidate";
Vue.use(Vuelidate);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//componente para crud de usuario o empleados
Vue.component('usuario-vico', require('./components/UsuarioComponent.vue').default);

//componente para crud de politica division
Vue.component('poldiv-vico', require('./components/PoldivComponent.vue').default);

//componente para crud de perfil
Vue.component('perfil-vico', require('./components/PerfilComponent.vue').default);

//componente para crud de mi perfil
Vue.component('miperfil-vico', require('./components/MiperfilComponent.vue').default);



const app = new Vue({
  vuetify,
  el: '#app'
});
