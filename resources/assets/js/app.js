require('./bootstrap');
window.Vue = require('vue');
Vue.component('post-component',require('./components/PostComponent.vue').default);
const app = new Vue({
    el:'#app',
});