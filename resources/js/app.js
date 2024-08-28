import Vue from 'vue';
import Router from './router';
import App from './App.vue'; // Root component

new Vue({
  el: '#app',
  router: Router, // Add router instance here
  render: h => h(App)
});
