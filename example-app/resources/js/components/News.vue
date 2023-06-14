<template>

    <!-- <div class="news-add-container" >
        <h1>news</h1>
      <button @click="showModalAdd">+Додати пост</button>
    
      <div class="news-modal-add" v-if="showModalAddPost" >
                <div class="news-modal-add-content" >
                  <span @click="closeModalAdd" >&#10006;</span>
                  <div class="">
                    <h3>Додати пост</h3>
                  </div>
    
                  <div class="news-modal-choose-file">
                    <input type="file" ref="fileInput" style="display: none" @change="onFileSelected">
                      <img @click="openFileInput" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJODoz1fSZOpbbKokY2sMWoOkIojZDba9BprAO_dtzaslXlxCtKoFnbgS9JelQv7MCi0I&usqp=CAU" >
                      <b @click="openFileInput">вибрати фото</b>
                      <p v-if="selectedFileName"> {{ selectedFileName }}</p>
                  </div>
    
                  <div class="news-modal-textarea-content">
                    <p>Текст посту</p>
                    <textarea rows="7" v-model="textInput" ></textarea>
                  </div>
    
                 <div class="news-modal-button-content"> 
                     <button  class="news-modal-button"  @click="uploadFile">Додати пост</button>
                 </div>
               
               </div> 
        </div>
        
    </div> -->
    
    <div class="news-container">
    <div class="news">
      <div class="news-new" @mouseover="showInnerElement(post.id)" @mouseleave="hideInnerElement" v-for="post in posts" >
    
          <!-- <div class="news-delete">
            <a  @click="openModal" > &nbsp <samp v-show="showInner==post.id" >&#10006;</samp> </a>
              <div class="news-modal" v-if="showModal" @click="closeModal">
                <div class="news-modal-content" >
                  <p>Ви дійсно бажаєте видалити пост?</p>
                  <div class="news-modal-buttons">
                    <button @click="deletePost(post)">Видалити</button>
                    <button @click="closeModal">Скасувати</button>
                  </div>
                </div>
              </div>
          </div> -->
          <div class="news-user">
            <img :src="`${post.user.avatar}`" >
            <b>{{ post.user.first_name + ' ' + post.user.last_name}}</b>     
          </div>
          <div class="news-full-screen">
              <div class="news-moda-full-screen" v-if="showFullScreen" @click="closeFullScreenModal">
                 <div class="news-modal-full-screen-content" >
                
                  <div class="news-modal-full-screen-photo">
                    <img :src="`${postModal.photo}`" >
                  </div>
    
                  <div  class="news-modal-full-screen-comments">
                    <a @click="closeFullScreenModal" > &#10006;</a>
    
                      <div v-if="postModal.text!=0" class="news-modal-text">{{  postModal.text }}</div>
    
                      <div v-if="postModal.comments.length>0" class="news-modal-comments">
                          <div class="">
                            <ul  v-for="comment in postModal.comments">
                              <li ><img style="  width: 50px; height: 50px; border-radius: 50%;" :src="`${comment.user.avatar}`" >{{ comment.user.first_name +' '+comment.user.last_name }}</li>
                              <li >{{ comment.text }}</li>
                            </ul>  
                          </div>
                      </div>
        
                  </div>
    
                </div>
              </div>
          </div>
    
        <div class="news-photo">
            <img v-if="post.photo" @click="openFullScreen(post)" :src="`${post.photo}`" >
        </div>
        
        <div class="news-like-container">
          <div class="news-like">
            <img @click="like(post)" src="https://w7.pngwing.com/pngs/90/304/png-transparent-cat-dog-paw-paw-patrol-animals-paw-claw-thumbnail.png" >
            <span  >{{post.like}}</span>
    
            <img @click="openFullScreen(post)" src="https://cdn.icon-icons.com/icons2/1518/PNG/512/commentmono_105952.png" >
            <span  >{{post.comments.length}}</span>
    
          </div>
          
        </div>
    
      <div v-if="post.text!=0" class="news-text">
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
        
      <div class="news-input-comment">
        <input type="text" v-model="newComments[post.id]"  placeholder="Прокоментувати..." />
        <button @click="addComment(post)"></button>
      </div>
        
      </div>
    </div>
</div>
    </template>
    
    <script>
    
    import { numberLiteralTypeAnnotation } from '@babel/types';
    
    
    export default {
    
      props: {
        // id:{
        //   type: Number,// String,
        //   required: true
        // },
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
        };
      },
      mounted(){
        this.getPosts();
       },
    
       created(){

        const eventHendler = ()=>{
           const scrollTop = document.documentElement.scrollTop;
           const viewportHeight = window.innerHeight;
           const totalHeight = document.documentElement.offsetHeight;
    
           const atTheBottom = parseInt(scrollTop) + viewportHeight == totalHeight

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
          this.showFullScreen = true;
        },
        closeFullScreenModal(){
          this.showFullScreen = false;
        },
        
        // deleteItem() {
        //   // Your delete logic here
        //   this.showModal = false; // Close the modal after deletion
        // },
    
        scrollGetPost() {
            console.log("скрол");
           axios.post('/api/getPosts',{ id: this.thisUser.id , page: this.posts.length }).
           then(data=>{  
            console.log(data.data);
            this.posts = this.posts.concat(data.data);
           });
        },
    
        addComment(post) {
        if (this.newComments[post.id]) {
          
          this.comment =this.newComments[post.id];
          this.commentCheck=post.id;
    
            let targetPost = this.posts.find(p => p.id === post.id);
           // console.log("комент ", this.newComments[post.id]);
    
            axios.post('/api/comment/store', { comment: this.newComments[post.id], idPost: post.id })
              .then(data => {
                console.log(data.data);
                targetPost.comments.push(data.data);
              //  console.log(targetPost.comments);
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
            // this.getPosts();
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
    
            axios.post('/api/getPosts',{ id: this.thisUser.id , page: page }).then(data=>{  
             console.log(data.data);
              this.posts=data.data
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