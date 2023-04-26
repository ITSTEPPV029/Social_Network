<template>

  <div  class="chat" >
    <h1>загальний чат</h1>
    <hr/>

      <div class="chat-container">
      <div class="messages" v-scroll-bottom>
        <div v-for="message in messages" class="message">
          <img class="avatar"  :src="`${message.user.avatar}`" >
          <div class="username">{{ message.user.first_name +' '+ message.user.last_name }}</div>  
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
//import Chat from '@/models/Chat';

export default {
 data() {
    return {
      textInput: '',
      messages: '',
    };
  },
  directives: {
    'scroll-bottom': {
      updated: function(el) {
        el.scrollTop = el.scrollHeight - el.clientHeight;
      }
    }
  },

  mounted(){
   this.index();
 },
  created() {
    
       window.Echo.channel('store_chat')
          .listen('.store_chat', (data) => {
             console.log(data.chat.original);
              this.messages.push(data.chat.original);
              });
        },
  methods: {
    store()
    {
        axios.post('/api/chat',{ text:  this.textInput }).then(data => {
       // console.log(data.data);
        this.textInput= null;
        this.messages.push(data.data);
        },).catch(error => {
            console.log(error.response.data);
        });
       
    },
    index()
    {
        axios.get('/api/chat').then(data => {
        //console.log(data.data);
        this.messages=data.data;
        },).catch(error => {
            console.log(error.response.data);
        });
    },
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