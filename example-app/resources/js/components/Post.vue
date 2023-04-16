<template><!-- <label for="file">завантажити фото для посту</label> <br/>
  <input  id="file" name="file" v-on:change="file" type="file">
    <br/>
  <span class="text-danger">{{$message}}</span>
  <input id="text" type="text"  v-model="text" name="text"> -->

  <div>
    <input type="file" ref="fileInput" @change="onFileSelected">
    <input type="text" v-model="textInput">
    <button @click="uploadFile">завантажити</button>
  </div>

  <br/>

  <div  class="post" v-for="post in posts" >
    <a @click="deletePost(post)" >&#10006;</a>
    <img v-if="post.photo"  v-bind:style="{width: '50px;' , height: '50px;'}" :src="`${post.photo}`" >
      <div class="post-content">
        <a @click="like(post)" >&#9829; {{post.like}}</a>
        
      <p  class="post-text" v-if="post.text == null" > {{post.text}}</p>
      </div>
  </div>

  <welcome2/>
</template>
<script>


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

        //====================
        // addPost() {
        //     axios.post('/store', {text: this.text, file: this.file})
        // .then(response => {
        //     console.log(response);
        // })
        // .catch(error => {
        //     console.log(error);
        // });
        // }
 //   }
 
 //=====================  
 data() {
    return {
      selectedFile: null,
      textInput: null,
      posts: null,
    };
  },
  mounted(){
    this.getPosts();
   },
  methods: {
  
  like(event)
  {
      console.log(event);
      axios.post('/like', event).then(data => {
        this.posts=data.data;
      },).catch(error => {
        console.log(error.response.data);
      });
  },

  deletePost(event)
  {
      console.log(event);
      axios.post('/deletePost', event).then(data => {
         this.posts=data.data;
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
    // Створюємо об'єкт FormData та додаємо до нього файл і значення текстового поля
    const formData = new FormData();
    formData.append('file', this.selectedFile);
    formData.append('text', this.textInput);

      // Відправляємо POST-запит на сервер
    axios.post('/store', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(data => {
        this.posts=data.data,
        this.$refs.fileInput.value = null;
        this.textInput= null;

      },).catch(error => {
        console.log(error.response.data);
      });
    },

    getPosts() {
      axios.get('/index').
      then(data=>{ this. posts=data.data;})
    }

    
  }
     
    
}
  
</script>