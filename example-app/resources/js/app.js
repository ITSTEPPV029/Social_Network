require('./bootstrap');

//var dialog = document.querySelector('dialog');
///document.querySelector('#closeDialog').onclick = function() {
 //dialog.close();
//}


import { createApp } from 'vue'

import Map from './components/MyMap'
import Message from './components/Message'
import Post from './components/Post'
import Chat from './components/Chat'


const app = createApp({})

app.component('Mymap', Map)
app.component('Message', Message)
app.component('Post', Post)
app.component('Chat', Chat)

app.mount('#appMyMap')
app.mount('#appPost')
app.mount('#appChat')
app.mount('#appMessage')

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