<template>
   


<div class="profile-container">

<div class="profile-image">
 <img :src="`${originalUser.avatar}`" >
  <div class="profile-image-bottom-div">
       
       <div  class="profile-bottom-button">
          <img @click="showModalAdd" src="https://avatars.mds.yandex.net/i?id=caba12d0db357404b21a92a69c98b5fc856f1b1e-8191562-images-thumbs&n=13" > 
       </div>

       <div class="profile-modal-add" v-if="showModalAddPet" >  
              <div class="profile-modal-add-content">  
                     <div class="profile-modal-choose-file">
                     <input type="file" ref="fileInput" style="display: none" @change="onFileSelected">
                            <img @click="openFileInput" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJODoz1fSZOpbbKokY2sMWoOkIojZDba9BprAO_dtzaslXlxCtKoFnbgS9JelQv7MCi0I&usqp=CAU" >
                            <b @click="openFileInput">вибрати фото</b>
                            <p v-if="selectedFileName"> {{ selectedFileName }}</p>
                     </div>
                     <div class="profile-modal-text-content">
                     <p>імя тварини</p>
                     <input type="text" v-model="textInput"  placeholder="імя тварини..." />
                     </div>
                     
                     <div class="profile-modal-button-content"> 
                     <button  class="profile-modal-button"  @click="uploadFile">Додати тварину</button>
                     </div> 

              </div>  
      </div>
     
      <p>123</p>
      <div class="" v-for="pet in originalUser.pets">
          <p>123{{  pet.name }}</p>
       </div>
       <!--  -->
<!--    
    <div></div>
    <div></div> -->

  </div>
</div>

<div class="profile-info-container">
  <div class="profile-user-name-button">
    <div class="profile-user-name">
         <h3><strong>{{originalUser.first_name}}</strong> 
          <strong>{{originalUser.last_name}}</strong>  </h3>
    </div>
     <!-- <div class="profile-user-button">
        @if (Auth::user()->id!=$user->id)
          @if (Auth::user()->checkIfFriend($user))
            <a href="{{route('deleteFriend',$user)}}" class="nav-link px-2 text-black">видалити з друзів</a>
          @elseif (Auth::user()->checkFriendsRequest($user))
            <p>запит на дружбу відправлений</p>
            @else
            <a class="profile-button" href="{{route('friendRequest.friendRequest',$user) }}">добавити в друзі</a>
          @endif
            <a class="profile-button2" href="{{route('sendingMessage',$user)}}" >відправити повідомлення</a>
        @endif
    </div>  -->
  </div>
  <div class="profile-user-info-container">
    <div class="profile-user-info">
    
       <div v-if="originalUser.nick_name" class="profile-info-field"><b>Нікнейм: </b> {{originalUser.nick_name}}</div>
     
      <div v-if="originalUser.gender" class="profile-info-field"><b>Стать: </b> {{originalUser.gender}}</div>
    
      <div v-if="originalUser.city" class="profile-info-field"><b>Місто: </b> {{originalUser.city}}</div>
   
      <div v-if="originalUser.date_of_birth" class="profile-info-field"><b>Дата народження: </b> {{originalUser.date_of_birth}}</div>
 
    </div>
    <div class="profile-user-description">
      <div v-if="originalUser.about_me" class="profile-info-field">
         <b>Про себе: </b>{{originalUser.about_me}}
     </div>
  </div>
</div>
</div>
</div>

 <div class="profile-post-container">
     <Post :id="id" :originalUser="originalUser" />
 </div>

</template>

<script>
import Post from './Post'
export default {

components: {
    Post,
},

data() {
    return {
      selectedFile: null,
      textInput: null,
      showModalAddPet: false,
      selectedFileName: '',
      originalUser: null,
    };
  },


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

  created() {
      this.originalUser = JSON.parse(JSON.stringify(this.thisUser));
      console.log(this.originalUser);
    },

  methods: {

    openFileInput() {
       this.$refs.fileInput.click();
    },

    onFileSelected(event)
    {
      this.selectedFile = event.target.files[0];
      this.selectedFileName = this.selectedFile.name;  
    },

//вікно добавлення тварини
    showModalAdd(){
      this.showModalAddPet = true;
    },
    closeModalAdd(){
      this.showModalAddPet = false;
    },

    uploadFile(){

       if (!this.selectedFile) {
         alert('Please select a file');
       return;}

       // Створюємо об'єкт FormData та додаємо до нього файл і значення текстового поля
       const formData = new FormData();
       formData.append('file', this.selectedFile);
       formData.append('name', this.textInput);

       axios.post('/api/PetStore', formData, {
          headers: {
         'Content-Type': 'multipart/form-data'
        }
       }).then(data => {
        console.log(data.data);
         this.originalUser=data.data;

       },).catch(error => {
           console.log(error);
       });

              this.showModalAddPet = false;
              this.$refs.fileInput.value = null;
              this.selectedFile= null;
              this.textInput= null;
              this.selectedFileName= '';
       },



  }




}
</script>
