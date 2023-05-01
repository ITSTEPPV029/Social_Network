<template><!-- <label for="file">завантажити фото для посту</label> <br/>
  <input  id="file" name="file" v-on:change="file" type="file">
    <br/>
  <span class="text-danger">{{$message}}</span>
  <input id="text" type="text"  v-model="text" name="text"> -->
  <h3>{{ id }}</h3>
  <div v-show="isLoggedIn==true">
    <input type="file" ref="fileInput" @change="onFileSelected">
    <input type="text" v-model="textInput">
    <button @click="uploadFile">завантажити</button>
  </div>
  
  <br/>

  <div  class="post" v-for="post in posts" >
    <a v-if="isLoggedIn==true" @click="deletePost(post)" > &#10006;</a>
    <img v-if="post.photo"  :src="`${post.photo}`" >
      <div class="post-content">
        <a @click="like(post)" >&#9829; {{post.like}}</a>
        <p class="post-text" v-if="post.text!=0" > {{post.text}}</p>
       
      </div>
  </div>

</template>

<script>

import { numberLiteralTypeAnnotation } from '@babel/types';

export default {

        // addPost() {
        //     const token = document.head.querySelector('meta[name="csrf-token"]');
        //         axios.post('/store', {text:this.text
        //       }, {
        //     headers: {
        //        'X-CSRF-TOKEN': token.content,
        //        'Content-Type': 'application/json'
        //      }
        //    }).then(response => {
        //     console.log(response);
        //     });
 //=====================  
 props: {
    id: {
      type: Number,// String,
      required: true
    },
  },

 data() {
    return {
      selectedFile: null,
      textInput: null,
      posts: null,
      isLoggedIn: null
    };
  },
  mounted(){
    this.getIsLoggedIn();
    this.getPosts();
   },
  methods: {
  
  like(event)
  {
      console.log(event);
      axios.post('/api/like', event).then(data => {
       // this.posts=data.data;
       this.getPosts();
      },).catch(error => {
        console.log(error.response.data);
      });
  },

  deletePost(event)
  {
      axios.post('/api/deletePost', event).then(data => {
         //this.posts=data.data;
         this.getPosts();
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
        //this.posts=data.data;
        this.$refs.fileInput.value = null;
        this.selectedFile= null;
        this.textInput= null;
        this.getPosts();

      },).catch(error => {
        console.log(error.response.data);
      });
    },

    getPosts() {
      axios.post('/api/index',{ id: this.id }).then(data=>{  
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