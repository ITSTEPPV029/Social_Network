//require('./bootstrap');

//var dialog = document.querySelector('dialog');
///document.querySelector('#closeDialog').onclick = function() {
 //dialog.close();
//}


import { createApp } from 'vue'
import App from './components/App'

const app = createApp({})

app.component('welcome', App)

app.mount('#app')




//import Vue from 'vue'
//Vue.component('app',require('./components/App').defoult)
//const app = new Vue({el:'#app',})






