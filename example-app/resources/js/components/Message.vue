<template>


 <div  class="chat" >

  <div v-for="chat in  chats" >
    <img class="avatar"  :src="`${chat.avatar}`" >
    <b>{{chat.first_name +' '+chat.last_name }}</b>   
    <a :href="'/sendingMessage' + chat.id" class="nav-link px-2 text-black">чат</a>
    <!-- <a @click="indexChat(chat.id)" >чат2</a> -->
   
  </div>
   <h1>Чат з {{ user.first_name +' '+ user.last_name }}</h1>
    <img class="avatar"  :src="`${user.avatar}`" >
    <hr/> 
       <div class="chat-container">
        <div class="messages" v-scroll-bottom>
              <div v-for="message in messages" class="message">
                 <img class="avatar"  :src="`${message.sender_user.avatar}`" >
                 <div  v-bind:class="{ 'username': message.sender_user.id == user.id, 'username2': message.sender_user.id != user.id }" >{{ message.sender_user.first_name +' '+ message.sender_user.last_name }}</div>   
                <div class="content">{{ message.text }}</div> 
            </div>  
        </div>
     </div>
     <br/>
     <input type="text" v-model="textInput"  v-on:keyup.enter="store" placeholder="Напишіть щось...">
      <button @click="store" >відправити</button>
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
    created() {
      console.log('store_message'+this.auth);
        window.Echo.channel('store_message'+this.auth).listen('.store_message', (data) => {
          console.log(data.message.original);
           this.messages.push(data.message.original);
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
<style>
.chat{
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* align-items: center; */
    width: 1000px;
    margin: auto;
}

.messages {
  flex: 1;
  max-height: 500px;
  overflow-y: scroll;
  word-wrap: break-word;
  word-break: break-all;
  padding: 10px;
}

.message {
  margin-bottom: 10px;
  display: flex;
  flex-direction: column;
  font-weight: bold;
}

.username {
  font-weight: bold;
  margin-bottom: 5px;
  display: inline-block;
}
.username2 {
  /* font-weight: bold; */
  color: blue;
  margin-bottom: 5px;
  display: inline-block;
}

.content {
  background-color: #f0f0f0;
  padding: 5px;
  border-radius: 5px;
 
}
.avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}


button {
    float: left;
  }

</style>