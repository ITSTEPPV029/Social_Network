require('./bootstrap');

//var dialog = document.querySelector('dialog');
///document.querySelector('#closeDialog').onclick = function() {
 //dialog.close();
//}


import { createApp } from 'vue'
import App from './components/App'
import AppWel from './components/AppTest'
import Post from './components/Post'
import Chat from './components/Chat'

const app = createApp({})

app.component('welcome', App)
app.component('welcome2', AppWel)
app.component('Post', Post)
app.component('Chat', Chat)

app.mount('#app')
app.mount('#appPost')
app.mount('#appChat')

//===============


// const app = new createApp({
//     el:'#app',
//     components:{
//         App,
//     }
// })

// import { createApp2 } from 'vue'
// import App2 from './components/App2'
// const app2 = createApp2({})
// app2.component('welcome2', App2)
// app2.mount('#app')