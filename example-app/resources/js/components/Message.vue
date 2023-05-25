<template>

<div class="message-container">
  <h2 v-if="this.user==null">У вас ще немає повідомлень</h2>
  <div class="message-chats-container">
    <div class="message-chats">
      <h3 v-if="user != null">Чати</h3>
      <div class="message-chats-user" v-for="chat in chats" @click="openChat(chat)">
        <img class="message-chat-avatar" :src="`${chat.avatar}`"  />
        <b>{{ chat.first_name + ' ' + chat.last_name}}</b>
        <b v-if="checkingNewmMssages(chat.id)">{{ NewMssagesCount(chat.id) }}</b>
      </div>
      
    </div>
  </div>

  <div class="message-chat-container">
    <div class="message-chat">
      <div class="message-chat-now">
        <img v-bind:class="{ 'message-chat-avatar': this.user != null, 'message-chat-avatar-none': this.user == null }" :src="`${this.UserAvatar}`" />
         <h3 >{{  this.UserFirstName +' '+ this.UserLastName }}</h3>
      </div>
      <div class="messages" v-scroll-bottom>
        <div  v-for="message in messages" v-bind:class="{ 'messages-user': message.sender_user.id ==  this.UserId, 'messages-user-sender': message.sender_user.id != this.UserId }" >
          <div>
              <img class="message-avatar" :src="`${message.sender_user.avatar}`" />
              <div v-bind:class="{ 'username': message.sender_user.id == this.UserId, 'username2': message.sender_user.id != this.UserId }">{{ message.sender_user.first_name + ' ' + message.sender_user.last_name }}</div>
              <div class="content"><div>{{ message.text }}</div></div>
              <div ><div>{{formatDate(message.created_at) }}</div></div>
              <!-- <div ><div>{{message.read }}</div></div> можна доробити на чи переглятуте повідомлення -->
          </div>
        </div>
      </div>
          <div v-if="this.user!=null" class="message-input">
            <input type="text" v-model="textInput" v-on:keyup.enter="store" placeholder="Текст повідомлення..." />
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
        UserLastName: '',
        UserFirstName: '',
        UserAvatar: '',
        UserId: '',

        numbers: [],
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
//прослуховування отримака повідомлення 
    created() {
     
      if(this.user!=null)
      { 
            this.UserLastName=this.user.last_name;
            this.UserFirstName=this.user.first_name;
            this.UserAvatar=this.user.avatar;
            this.UserId=this.user.id;
      }

      axios.get('/api/message/getChats').then(data=>{  
          this.chats=data.data;
      });
          
      window.Echo.channel('store_message'+this.auth).listen('.store_message', (data) => {
          // console.log(data.message.original);
         if (data.message.original['sender_user']['id'] == this.UserId)
         {
           this.messages.push(data.message.original);
           this.readMessageTrue(this.UserId);
         }
         else
         {
           this.numbers.push(data.message.original['sender_user']['id']);
           console.log('нове повідомлення з іншого чату');
           console.log(this.numbers);
         }
      });
      //присвоєння іншого значення в полі меню 
      const element = document.getElementById('messageCount');
      if (element) {
        element.innerText = 'повідомлення';
      }

     },
    methods: {
//вивід дати в потрібному вигляді
    formatDate(date) {

      let dateObj = new Date(date);
      return `${dateObj.getFullYear()}-${(dateObj.getMonth() + 1).toString().padStart(2, '0')}-${dateObj.getDate().toString().padStart(2, '0')} ${dateObj.getHours().toString().padStart(2, '0')}:${dateObj.getMinutes().toString().padStart(2, '0')}`;
  
    },
//коли відкриваємо чат з користувачем
    openChat(openChat){

      axios.post('/api/message/index',{ id: openChat.id}).then(data => {
      // console.log(data.data);
        this.messages=data.data;
  
        this.UserLastName=openChat.last_name;
        this.UserFirstName=openChat.first_name;
        this.UserAvatar=openChat.avatar;
        this.UserId=openChat.id;

        if(this.numbers.length>0){
          this.numbers = this.numbers.filter(item => item !== openChat.id);
          console.log("видалено");
          console.log( this.numbers);
        }
      },).catch(error => {
            console.log(error.response.data);
        }); 
    },
    //збереження повідомлення
    store()
    {
      axios.post('/api/message/store',{ text: this.textInput , id: this.UserId }).then(data => {
       this.textInput= null;
       this.messages.push(data.data);
        },).catch(error => {
            console.log(error.response.data);
        });
    },
//отримуємо повідомлення для відкритого чату 
    index()
    {
      if(this.user!=null)
      {
        axios.post('/api/message/index',{ id: this.UserId}).then(data => {
        //console.log(data.data);
        this.messages=data.data;
        },).catch(error => {
            console.log(error.response.data);
        });
      }
      this.getNotReadMessage(this.UserId);
    },

    //відправляємо на сервер що повідомлення прочитано 
    readMessageTrue(UserId)
    {
      if(this.user!=null)
      {
        axios.post('/api/message/readMessageTrue',{ id: UserId}).then(data => {
   
        },).catch(error => {
            console.log(error.response.data);
        });
      }
    },
//чи є повідомлення в списку чатів
    checkingNewmMssages(UserId)
    {
      if (this.numbers.length>0) {
        
        if (this.numbers.includes(UserId)) {
           // console.log("UserId міститься у чаті");
            return true;
          } else {
          //  console.log("UserId не міститься у чаті");
            return false;
          }
      }
    },
//кількість повідомлень в списку чатів
    NewMssagesCount(UserId){

      let count = 0;
        for (let i = 0; i < this.numbers.length; i++) {
          if (this.numbers[i] === UserId) {
            count++;
          }
        }
      return " ("+count+")";
    },

    //отримуємо масив з ід хто відправив повідомлення 
    getNotReadMessage(UserId)
    {
      if(this.user!=null)
      {
        axios.post('/api/message/getNotReadMessage',{ id: UserId}).then(data => {
          //console.log('отримка чату');
          this.numbers=data.data;
        },).catch(error => {
            console.log(error.response.data);
        });
      }
    },




}


}
</script>
