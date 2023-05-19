<template>


 <!-- <div  class="message-container" >

  <div  class="message-chats" v-for="chat in  chats" >
    <img class="avatar"  :src="`${chat.avatar}`" >
    <b>{{chat.first_name +' '+chat.last_name +' '+chat.id}}</b>   
    <a :href="'/sendingMessage' + chat.id" class="nav-link px-2 text-black">чат</a>
    <a @click="indexChat(chat.id)" >чат2</a>
  </div>


   <h1 v-if="user" >Чат з {{ user.first_name +' '+ user.last_name +'  '+ user.id}}</h1>
    <img class="avatar"  :src="`${user.avatar}`" >
    <hr/>  
     <div class="message-chat">
        <div class="messages" v-scroll-bottom>
              <div v-for="message in messages" >
                 <img class="avatar"  :src="`${message.sender_user.avatar}`" >
                 <div  v-bind:class="{ 'username': message.sender_user.id == user.id, 'username2': message.sender_user.id != user.id }" >{{ message.sender_user.first_name +' '+ message.sender_user.last_name }}</div>   
                <div class="content">{{ message.text }}</div> 
            </div>  
        </div>
     </div>
     <br/>
     <input type="text" v-model="textInput"  v-on:keyup.enter="store" placeholder="Напишіть щось...">
      <button @click="store" >відправити</button>
</div>  -->
<div class="message-container">
  <div class="message-chats-container">
    <div class="message-chats">
      <h3>Чати</h3>
      <div class="message-chats-user" v-for="chat in chats">
        <img class="message-chat-avatar" :src="`${chat.avatar}`" />
        <b>{{ chat.first_name + ' ' + chat.last_name + ' ' + chat.id }}</b>
        <!-- <a :href="'/sendingMessage' + chat.id" class="nav-link px-2 text-black">чат</a> -->
      </div>
    </div>
  </div>

  <div class="message-chat-container">
    <div class="message-chat">
      <div class="message-chat-now">
        <img class="message-chat-avatar" :src="`${user.avatar}`" />
         <h3 v-if="user" >{{ user.first_name +' '+ user.last_name +'  '+ user.id}}</h3>
      </div>
      <div class="messages" v-scroll-bottom>
        <div  v-bind:class="{ 'messages-user': message.sender_user.id == user.id, 'messages-user-sender': message.sender_user.id != user.id }" v-for="message in messages">
          <img class="message-avatar" :src="`${message.sender_user.avatar}`" />
          <div v-bind:class="{ 'username': message.sender_user.id == user.id, 'username2': message.sender_user.id != user.id }">{{ message.sender_user.first_name + ' ' + message.sender_user.last_name }}</div>
          <div class="content">{{ message.text }}</div>
        </div>
      </div>
          <div  class="message-input">
            <input type="text" v-model="textInput" v-on:keyup.enter="store" placeholder="Напишіть щось..." />
            <button @click="store"></button>
          </div>
    </div>
  </div>

  

</div>



</template>

<script>
export default {

    data() {
        return {
        textInput: '',
        messages: '',
        chats: '',
        isTrue: false,
        isFalse: false,
        };
    },

    mounted(){
      this.index();
    },
    directives: {
    'scroll-bottom': {
      updated: function(el) {
        el.scrollTop = el.scrollHeight - el.clientHeight;
      }
    }
   },
    props: {
      user: {
        type: Object,
        required: true
      },
      auth: {
        type: Number,
        required: true  
      }
    },
    created() {//прослуховування отримака повідомлення 
      console.log('store_message'+this.auth);
        window.Echo.channel('store_message'+this.auth).listen('.store_message', (data) => {
          // console.log(data.message.original);
         if(data.message.original['sender_user']['id'] == this.user.id){
          this.messages.push(data.message.original);
         }
      });

         axios.get('/api/message/getChats').then(data=>{  
           console.log(data.data);
           this. chats=data.data ;
          });
        

     },
    methods: {
      
    store()
    {
        axios.post('/api/message/store',{ text: this.textInput , id: this.user.id }).then(data => {
        //console.log(data.data);
       this.textInput= null;
       this.messages.push(data.data);
        },).catch(error => {
            console.log(error.response.data);
        });
    },

    index()
    {
        axios.post('/api/message/index',{ id: this.user.id}).then(data => {
      //  console.log(data.data);
        this.messages=data.data;
        },).catch(error => {
            console.log(error.response.data);
        });
    },

    // indexChat(event)
    // {
    //     axios.post('/api/message/indexChat',{userChatId: event , id: this.user.id}).then(data => {
    //     console.log(data.data);
    //     this.user=data.data;
    
    //     //this.messages=data.data;
    //     },).catch(error => {
    //         console.log(error.response.data);
    //     });
    // },






}

}
</script>
