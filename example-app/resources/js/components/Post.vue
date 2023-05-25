<template>

  <h3>{{ id }}</h3>
  <div v-show="isLoggedIn==true">
    <input type="file" ref="fileInput" @change="onFileSelected">
    <input type="text" v-model="textInput">
    <button @click="uploadFile">завантажити</button>
  </div>
  
  <br/>

  <div  class="post" v-for="post in posts" >
    <div class="post-delete">
      <a v-if="isLoggedIn==true" @click="openModal" > &#10006;</a>
        <div class="post-modal" v-if="showModal" @click="closeModal">
          <div class="post-modal-content" >
            <p>Ви дійсно бажаєте видалити пост?</p>
            <div class="post-modal-buttons">
              <button @click="deletePost(post)">Видалити</button>
              <button @click="closeModal">Скасувати</button>
            </div>
          </div>
        </div>
    </div>

   <div class="post-photo-text-container">
      <div class="post-photo">
        <img v-if="post.photo"  :src="`${post.photo}`" >
      </div>
      <div class="post-text">
          <p v-if="post.text!=0" > {{post.text}}</p>
      </div>
    </div>
  
  <div class="post-like-comment-container">
    <div class="post-like">
      <img @click="like(post)" src="https://w7.pngwing.com/pngs/90/304/png-transparent-cat-dog-paw-paw-patrol-animals-paw-claw-thumbnail.png" >
      <a  >{{post.like}}</a>
    </div>
    <div class="post-input-comment">
         <input type="text" v-model="textInput"  placeholder="Текст повідомлення..." />
         <button @click="store"></button>
    </div>
  </div>
        <!-- <div  class="comment-box">
          <textarea v-model="newComments[post.id]" placeholder="Написати коментар"></textarea>
          <button @click="addComment(post)">Додати коментар</button>
          
          <ul  v-for="comment in post.comments">
            <li ><img style="  width: 50px; height: 50px; border-radius: 50%;" :src="`${comment.user.avatar}`" >{{ comment.user.first_name +' '+comment.user.last_name }}</li>
            <li >{{ comment.text }}</li>
          </ul>   
        </div>
    -->
  </div>

</template>

<script>

import { numberLiteralTypeAnnotation } from '@babel/types';

export default {

  props: {
    id:{
      type: Number,// String,
      required: true
    },
    thisUser:{
        type: Object,
        required: true
    },

  },

 data() {
    return {
      selectedFile: null,
      textInput: null,
      posts: null,
      isLoggedIn: null,
      showModal: false,
      showCommentBox: false,
      newComment: '',
      newComments: {},

    };
  },
  mounted(){
    this.getIsLoggedIn();
    this.getPosts();
   },
   created(){

    const eventHendler = ()=>{
       const scrollTop = document.documentElement.scrollTop;
       const viewportHeight = window.innerHeight;
       const totalHeight = document.documentElement.offsetHeight;

       const atTheBottom = scrollTop + viewportHeight==totalHeight;

      //console.log(atTheBottom)
       if (atTheBottom) {
          this.scrollGetPost();
       }
    }

    document.addEventListener('scroll',eventHendler)
   },

  methods: {
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    deleteItem() {
      // Your delete logic here
      this.showModal = false; // Close the modal after deletion
    },
    scrollGetPost() {
  
       axios.post('/api/index',{ id: this.id , page: this.posts.length }).then(data=>{  
       // console.log(data.data);
        this.posts = this.posts.concat(data.data);
        // this.posts=;
       });
    },

    addComment(post) {

    if (this.newComments[post.id]) {
      
        let targetPost = this.posts.find(p => p.id === post.id);
        console.log("комент ", this.newComments[post.id]);

        axios.post('/api/comment/store', { comment: this.newComments[post.id], idPost: post.id })
          .then(data => {
            console.log(data.data);
            targetPost.comments.push(data.data);
            console.log(targetPost.comments);
            this.newComments[post.id] = '';
          })
          .catch(error => {
            console.log(error.response.data);
          });
      }
    },

  like(post)
  {
    let isLiked=0;
    axios.post('/api/isLiked', post).then(data => {
       isLiked=data.data;
       post.like += isLiked ? -1 : 1;
      },).catch(error => {
        console.log(error.response.data);
      });
      
    axios.post('/api/like', post).then(data => {
       // this.posts=data.data;
       //this.getPosts();
      },).catch(error => {
        console.log(error.response.data);
      });
  },

  deletePost(event)
  {
      axios.post('/api/deletePost', event).then(data => {
         this.posts=data.data;
       //  this.getPosts();
      },).catch(error => {
        console.log(error.response.data);
      });
  },

    onFileSelected(event)
    {
      // Отримуємо файл з інпуту
      this.selectedFile = event.target.files[0];
    },

    uploadFile()
    {
    if (!this.selectedFile) {
       alert('Please select a file');
    return;}
    // if (!this.textInput) {
    //   alert('Please select a file');
    // }
    // Створюємо об'єкт FormData та додаємо до нього файл і значення текстового поля
    const formData = new FormData();
    formData.append('file', this.selectedFile);
    formData.append('text', this.textInput);

     
  axios.post('/api/store', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(data => {
        this.posts=data.data;
        this.$refs.fileInput.value = null;
        this.selectedFile= null;
        this.textInput= null;
       // this.getPosts();

      },).catch(error => {
        console.log(error.response.data);
      });
    },

    getPosts() {
      
     let page = 0; 
     if (this.posts) {
      page = this.posts.length;
     }


      axios.post('/api/index',{ id: this.id , page: page }).then(data=>{  
       // console.log(data.data);
         this.posts=data.data });
    },

    getIsLoggedIn() {

    //  axios.post('/api/test',{ id: this.id }).then(response => {
    //     console.log(response.data) });
  
    axios.post('/api/isLoggedIn',{ id: this.id })
    .then(response => {
      const isLoggedIn = response.data;
      if (isLoggedIn === 1) {
        this.isLoggedIn = true;
      } else {
        this.isLoggedIn = false;
      }
    })
    .catch(error => {
      console.log(error);
    });

    },
  
  }
     
    
}
  
</script>
<style>

/* .avatarComent {
  width: 50px;
  height: 50px;
}

.comment-box {
  width: 500px;
  position:relative;
  top: 0;
  left: 0;
  background-color: #fff;
  padding: 10px;
  border: 1px solid #ccc;
}

.slide-enter-active {
  transition: all 0.5s;
}

.slide-leave-active {
  transition: all 0.5s;
}

.slide-enter, .slide-leave-to {
  transform: translateX(-100%);
} */


</style>