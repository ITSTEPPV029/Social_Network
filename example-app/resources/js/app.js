require('./bootstrap');

import { createApp } from 'vue'

import Map from './components/MyMap'
import Message from './components/Message'
import Post from './components/Post'
import Chat from './components/Chat'
import Settings from './components/Settings'
import Search from './components/Search'
import Userpage from './components/UserPage'
import News from './components/News'
import SavedPosts from './components/SavedPosts'
import Menus from './components/SideMenu'

const app = createApp({})

app.component('Mymap', Map)
app.component('Message', Message)
app.component('Post', Post)
app.component('Chat', Chat)
app.component('Settings', Settings)
app.component('Search', Search)
app.component('Userpage', Userpage)
app.component('News', News)
app.component('SavedPosts', SavedPosts)
app.component('Menus', Menus)

app.mount('#appMyMap')
app.mount('#appPost')
app.mount('#appChat')
app.mount('#appMessage')
app.mount('#appSettings')
app.mount('#appSearch')
app.mount('#appUserpage')
app.mount('#appNews')
app.mount('#appSavedPosts')
app.mount('#appMenus')