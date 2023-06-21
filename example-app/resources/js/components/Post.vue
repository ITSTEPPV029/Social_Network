<template>

 
<div class="post-add-container" v-show="isLoggedIn==true" >

  <div class="post-SavePost-modal" v-if="ModalSavePost" >
       <div class="post-SavePost-modal-content" >
        <div class="post-SavePost-height">
          <span @click="closeModalSavePost" >&#10006;</span>
          
          <h3>Зберегти в</h3> 
        </div>

          <div class="post-SavePost-categories">
            <p  v-if="Сategories==null"  > добавте категорію </p>
         
            <div class="post-SavePost-show-categories" v-for="category in Сategories" :key="category.id">
              <label :for="category.id"><b>{{ category.text }}</b></label><br>
              <input type="radio" :id="category.id" v-model="selectedCategory"  name="options" :value="category.id">  
            </div>

          </div> 

          <div class="post-SavePost-save-button">
              <button class="post-SavePost-save-button-orange"  @click="savePostToCategory">Зберегти</button>
          </div>

          <div class="post-SavePost-orange-line"></div> 

          <div class="post-SavePost-add-name-category">
            <b>Назва</b>
            <input type="text" v-model="Category"  placeholder="Додайте назву новій добірці..." />
          </div> 

          <div class="post-SavePost-button-container">
            <button @click="closeModalSavePost">Скасувати</button> 
            <button class="post-SavePost-button-range"  @click="addCategory">Створити</button>
          </div> 
        </div>
   </div>



  <button @click="showModalAdd">+Додати пост</button>
  <!-- вікно додавання поста  -->
  <div class="post-modal-add" v-if="showModalAddPost" >
            <div class="post-modal-add-content" >
              <span @click="closeModalAdd" >&#10006;</span>
              <div class="">
                <h3>Додати пост</h3>
              </div>

              <div class="post-modal-choose-file">
                <input type="file" ref="fileInput" style="display: none" @change="onFileSelected">
                  <img @click="openFileInput" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJODoz1fSZOpbbKokY2sMWoOkIojZDba9BprAO_dtzaslXlxCtKoFnbgS9JelQv7MCi0I&usqp=CAU" >
                  <b @click="openFileInput">вибрати фото</b>
                  <p v-if="selectedFileName"> {{ selectedFileName }}</p>
              </div>

              <div class="post-modal-textarea-content">
                <p>Текст посту</p>
                <textarea rows="7" v-model="textInput" ></textarea>
              </div>

             <div class="post-modal-button-content"> 
                 <button  class="post-modal-button"  @click="uploadFile">Додати пост</button>
             </div>         
           </div> 
    </div> 
</div>

<div class="post-container">
  <div @mouseover="showInnerElement(post.id)" @mouseleave="hideInnerElement" class="post" v-for="post in posts" >

      <div class="post-delete">
        <a  @click="openModal" > &nbsp <samp v-show="showInner==post.id" v-if="isLoggedIn==true">...</samp> </a>
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

<!-- показ картинки на весь екран  -->
      <div class="post-full-screen">
          <div class="post-moda-full-screen" v-if="showFullScreen" >
             <div class="post-modal-full-screen-content" >

              <div class="post-modal-full-screen-photo-content">
                <div class="post-modal-full-screen-photo-head">
                  <img  :src="'/img/minus.png'">
                  <img  :src="'/img/plus.png'">
                  <img  :src="'/img/expansion_arrows.png'">
                  <img @click="closeFullScreenModal" :src="'/img/closing_cross.png'">
                </div>

                <div class="post-modal-full-screen-photo-center-content">
                  <div class="post-modal-full-screen-photo-center-left">
                    <img  :src="'/img/arrow_right.png'">
                  </div>
                  <div class="post-modal-full-screen-photo">
                        <img :src="`${postModal.photo}`" >
                   </div>
                    <div class="post-modal-full-screen-photo-center-right">
                      <img  :src="'/img/arrow_right.png'">
                    </div>
                </div>
                
              
              </div>

              <div  class="post-modal-full-screen-comments">
                <a v-if="isLoggedIn==true" @click="closeFullScreenModal" > &#10006;</a>

                <div class="post-modal-full-screen-user">
                  <img :src="`${userPost.avatar}`" >
                  <b>{{userPost.first_name + ' ' + userPost.last_name}}</b>     
                </div> 

                  <div v-if="postModal.text!=0" class="post-modal-text">{{ postModal.text }}</div>

                  <div class="post-modal-like-container">
                    <div class="post-modal-like">
                      <!-- =================================/public для сервера ============================== -->
                      <img class="post-like-img-like" @click="like(post)" :src="'/img/like.png'" > 
                      <span  >{{post.like}}</span>
                      <img  :src="'/img/comment.png'" >
                      <img  :src="'/img/share.png'">
                      <img  :src="'/img/save.png'">
                    </div>
                  </div>

                  <div v-if="postModal.comments.length>0" class="post-modal-comments">
                      <div class="post-modal-comment" v-for="comment in postModal.comments">  
                         <img style="  width: 50px; height: 50px; border-radius: 50%;" :src="`${comment.user.avatar}`" >
                        <div class="post-modal-comment-info">
                          <b>{{ comment.user.first_name +' '+comment.user.last_name }}</b> 
                          <span>{{ comment.text }}</span> 
                        </div>
                       
                      </div>
                   
                  </div>
              </div>

            </div>
          </div>
      </div>

    <div class="post-photo">
        <img v-if="post.photo" @click="openFullScreen(post)" :src="`${post.photo}`" >
    </div>
    
    <div class="post-like-container">
      <div class="post-like">
        <!-- =================================/public для сервера ============================== -->
        <img class="post-like-img-like" @click="like(post)" :src="'/img/like.png'" > 
        <span  >{{post.like}}</span>
        <img class="post-like-img-comment" @click="openFullScreen(post)" :src="'/img/comment.png'" >
        <span  >{{post.comments.length}}</span>
        <img class="post-like-img-share" @click="showModalSavePost(post)" :src="'/img/share.png'">
        <img class="post-like-img-save" @click="showModalSavePost(post)" :src="'/img/save.png'">
      </div>
    </div>

  <div v-if="post.text!=0" class="post-text">
      <div v-if="expanded==post.id">{{ post.text }}</div>
      <div v-else>{{ truncatedText(post.text) }}</div>
      <b @click="toggleExpanded(post.id)">
        {{ expanded==post.id ? 'Згорнути' : 'Розгорнути' }} </b>
  </div>

  <div v-if="commentCheck==post.id" class="post-first-comment">
    <img  :src="`${thisUser.avatar}`" /> 
    <div><b>{{thisUser.first_name + ' ' + thisUser.last_name }}</b>
        <p>{{ comment }}</p>
    </div>  
  </div>
    
  <div class="post-input-comment">
    <input type="text" v-model="newComments[post.id]"  placeholder="Прокоментувати..." />
    <!-- <button ></button> -->
    <img @click="addComment(post)" :src="'/img/sendArrow.png'" >
  </div>
    
  </div>
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
      expanded: false,
      maxCharacters: 25,
      comment:'',
      commentCheck:0,
      showFullScreen: false,
      postModal:[],
      showInner: 0,
      showModalAddPost: false,
      selectedFileName: '',
      ModalSavePost: '',
      Category: '',
      Сategories: [],
      selectedCategory: '',
      userPost: null,
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

       const atTheBottom = parseInt(scrollTop+1) + viewportHeight==totalHeight;

       if (atTheBottom) {
          this.scrollGetPost();
       }
    }
    document.addEventListener('scroll',eventHendler)
   },


   computed: {
    truncatedText(text) {
      return (text) => {
       text = text.toString(); // Перетворення на рядок, якщо не є рядком
          if (text.length <= this.maxCharacters) {
            return text;
          }
         return text.slice(0, this.maxCharacters) + "...";
        };  
    }
  },


  methods: {

    openFileInput() {
      this.$refs.fileInput.click();
    },

  //вікно збереження поста поста
    showModalSavePost(post){ 
      this.postModal=post;

      axios.post('/api/getCategories').then(data=>{  
        console.log(data.data)
        this.Сategories = data.data;
       });

      this.ModalSavePost = true;
    },
    closeModalSavePost(){
      this.ModalSavePost = false;
      this.postModal=null;
      this.Category='';
    },

     //вікно добавлення поста
    showModalAdd(){
      this.showModalAddPost = true;
    },
    closeModalAdd(){
      this.showModalAddPost = false;
    },

    //показ хреста видалення 
    showInnerElement(id) {
      this.showInner = id;      
    },
    hideInnerElement() {
      this.showInner = 0;
    },

    //вікно видалення поста
    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.showInner = 0;
    },

   // відкрити фото 
    openFullScreen(post){
      this.postModal=post;

      axios.post('/api/getUserPost',{ id: post.user_id }).then(data=>{  
         this.userPost=data.data;
         this.showFullScreen = true;
         });
     
    },
    closeFullScreenModal(){
      this.showFullScreen = false;
    },
    
    // deleteItem() {
    //   // Your delete logic here
    //   this.showModal = false; // Close the modal after deletion
    // },

    scrollGetPost() {
 
       axios.post('/api/index',{ id: this.id , page: this.posts.length }).then(data=>{  
        this.posts = this.posts.concat(data.data);
       });
    },

    //збереження поста в категорії 
    savePostToCategory(){ 
      if(this.selectedCategory!="")
      {
        axios.post('/api/savePostToCategory',{ category: this.selectedCategory ,postId :this.postModal.id }).then(data=>{  
        //  console.log(data.data)
         this.closeModalSavePost();
       });
      }
    },
    
    //добавлення категорії 
    addCategory(){
     
      axios.post('/api/addCategory',{ category: this.Category }).then(data=>{  
        console.log(data.data)
        this.Сategories = data.data;
       });

      this.Category='';
    },

    addComment(post) {
    if (this.newComments[post.id]) {
      
      this.comment =this.newComments[post.id];
      this.commentCheck=post.id;

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

  // Отримуємо файл з інпуту
    onFileSelected(event)
    {
      this.selectedFile = event.target.files[0];
      this.selectedFileName = this.selectedFile.name;  
    },


    uploadFile(){

      if (!this.selectedFile) {
        alert('Please select a file');
      return;}

      this.showModalAddPost = false;
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
          console.log(data.data);
          this.posts=data.data;
     
        },).catch(error => {
           console.log(error);
        });

          this.$refs.fileInput.value = null;
          this.selectedFile= null;
          this.textInput= null;
          this.selectedFileName= '';
    },


    getPosts() {
      let page = 0; 
      if (this.posts) {
        page = this.posts.length;
      }

        axios.post('/api/index',{ id: this.id , page: page }).then(data=>{  
        // console.log(data.data);
          this.posts=data.data
         });
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

    toggleExpanded(id) {
      if(this.expanded==id)
      this.expanded=0;
      else
        this.expanded = id//!this.expanded;

    },
   
  
  }
     
    
}
  
</script>
<style>


</style>