require('./bootstrap');
require('./echo');

Vue.component('chat', require('./components/Chat.vue').default);
Vue.component('Postupdated', require('./components/PostUpdated.vue').default);

const app = new Vue({
    el: '#app'
});
