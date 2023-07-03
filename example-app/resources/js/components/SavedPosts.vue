<template>
    
<div class="savedPosts-container"> 
    <div class="savedPosts-Posts">
        <div v-if="showPosts" class="savedPosts-Post"  v-for="(сategory, index) in CategoryPosts" >
            <img @click="showPost(сategory, index)" class="" :src="`${getLastPhoto(сategory.save_post)}`" />
            <h3  >{{ сategory.text }}</h3>
        </div>

      <div v-else class="">
            <h3  class="savedPosts-back" @click="closPost">назад </h3>
            <b>{{ сategoryText }}</b>
        <div class="savedPosts-Post"  v-for="post in сategory" >
                            <img  class="" :src="`${post.my_post.photo}`" />
                <!-- <h3>{{ post.my_post.text }}</h3>  -->
        </div>
      </div>
    
    </div>
</div>

</template>

<script>

export default {

    data(){
        return{
            CategoryPosts: null,
            showPosts: true,
            сategory: [],
            сategoryText: "",
        } 
    },

   mounted(){

    this.savePostGetCategory();
    
   },
   
    methods: {

    //вікно 
    showPost(сategory, index){

      console.log(сategory.save_post)
       this.сategoryText=сategory.text;
      this.сategory = сategory.save_post;

      this.showPosts = false;
    },
    closPost(){
        this.сategory=[];
      this.showPosts = true;
    },


        //
        savePostGetCategory(){   
            axios.post('/api/savePostGetCategory').
            then(data=>{  
                console.log(data.data) 
                this.CategoryPosts=data.data
            });
            
        },

        getLastPhoto(savePosts) {
            
            if (savePosts.length > 0) {
                const lastSavePost = savePosts[savePosts.length - 1];
                return lastSavePost.my_post.photo;
            }
            return ''; // якщо масив save_post порожній
        }
    }

}
</script>
