require('./bootstrap');

window.Vue = require('vue');


// Vue.component('course-chat', require('./components/CourseChat.vue').default);
Vue.component('course-chat', require('./components/Chat.vue').default);
Vue.component('course-calendar', require('./components/CourseCalendar.vue').default);

const app = new Vue({
    el: '#app-root',
});