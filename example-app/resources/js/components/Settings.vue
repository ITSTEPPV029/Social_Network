<template>

<h2>{{ user.id }}</h2>
<div class="settingsContainerMain">
  <h3>Налаштування</h3>
  <br/>
  <div class="settingsContainer">

      <div class="item item_1">
        <label>Імя</label> 
      </div>

      <div class="item item_2">
        <input tyle="border-radius: 20px; padding-left: 10px;" type="text" v-model="user.first_name">
      </div>
      <div class="item item_3">
        <label>Прізвище</label>
      </div>

      <div class="item item_4">
        <input type="text" v-model="user.last_name">
      </div>

      <div class="item item_5">
        <label>Нікнейм</label>
      </div>

      <div class="item item_6">
        <input type="text" v-model="user.nick_name">
      </div>

      <div class="item item_7">
        <label>Ел. пошта</label>
      </div>

      <div class="item item_8">
        <input type="email" name="email" v-model="user.email">
          <p v-if="errors && errors.email">{{ errors.email[0] }}</p>
          
      </div>
      <div class="item item_9">
            <div class="avatarWrapper">
              <img class="avatarSettings" :src="`${user.avatar}`" @click="openFileInput">
              <div class="avatarText" @click="openFileInput" >Змінити</div>
            </div>
            <input  style="display: none" type="file" ref="fileInput" @change="onFileSelected">
      </div>

      <!-- <div>
        <label>Birthday:</label>
        <input type="date" v-model="user.birthday">
      </div> -->
    </div>
    
      <!-- <button @click="saveChanges">Save Changes</button> -->
      <br/>
  <h3 @click="saveChanges" >Зберегти</h3>

</div>


  </template>
  
  <script>
  export default {
    props: {
      user: {
        type: Object,
        required: true,
      },
    },
  
    data() {
      return {
        selectedFile: null,
        originalUser: null,
        errors: {
            first_name: [],
            last_name: [],
            nick_name: [],
            email: [],
            password: []
         }
      };
    },
  
    created() {
      this.originalUser = JSON.parse(JSON.stringify(this.user));
    },
  
methods: {
      saveChanges() {
        let dataChanged = false;
        for (const key in this.user) {
          if (this.user[key] !== this.originalUser[key]) {
            dataChanged = true;
            break;
          }
        }
  
        if (dataChanged) {
        console.log("дані змінено");

        const formData = new FormData();
    //formData.append('file', this.selectedFile);
    formData.append('first_name', this.user.first_name);
    formData.append('last_name', this.user.last_name);
    formData.append('email', this.user.email);
    formData.append('nick_name', this.user.nick_name);
    
      axios.post('/api/settings', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(response => {
                console.log( response.data);
                this.errors = {};
            })
            .catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    console.log(error);
                }
            });
        }

        //this.originalUser = JSON.parse(JSON.stringify(this.user));
      },

  onFileSelected(event) {
   
     const file = event.target.files[0];
     const formData = new FormData();
     formData.append('avatar', file);

      axios.post('/api/upload-avatar', formData,{
        headers: {
          'Content-Type': 'multipart/form-data'
        }}).then(response => {
        // Оновлюємо зображення користувача
       // console.log(response.data);
         this.user.avatar = response.data;
         this.$forceUpdate();
      });
    },
   
    openFileInput() {
      console.log("дані змінено");
      this.$refs.fileInput.click();
    },


  },



  };
  </script>
  
<style>
.settingsContainerMain
{
   padding-right: 50px;
   padding-left: 50px;

   padding-top: 50px;
   padding-bottom: 50px;


   background-color: rgb(222, 222, 222);
   border-radius: 50px;
}

.settingsContainerMain h3 {
  text-align: center;
}
.settingsContainer
{
  background-color: rgb(222, 222, 222);
  grid-template-columns: 1fr 1fr 1fr; /* встановлюємо 3 колонки, 3 колонка має більшу ширину */
  /* grid-template-rows: auto; встановлюємо автоматичну висоту рядків */
  grid-row-gap: 10px;
  display: grid;
}
.item.item_1 {
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}

.item.item_2 {
  grid-column: 2 / 3;
  grid-row: 1 / 2;
}

.item.item_3 {
  grid-column: 1 / 2;
  grid-row: 2 /span  3;
}

.item.item_4 {
  grid-column: 2 / 3;
  grid-row: 2 /span  3;
}
.item.item_5 {
  grid-column: 1 / 2;
  grid-row: 3 / 4;
}
.item.item_6 {
  grid-column: 2 / 3;
  grid-row: 3 / 4;
}
.item.item_7 {
  grid-column: 1 / 2;
  grid-row: 4 / 5;
}
.item.item_8 {
  grid-column: 2 / 3;
  grid-row: 4 / 5;
}
 .item.item_9 {
 justify-self: center;
 grid-row: 1 / 3;
} 



.item input {
      border-radius: 20px;
      padding-left: 10px;
      border-color: red;
}


.avatarWrapper {
  position: relative;
  display: inline-block;
  
}

.avatarWrapper .avatarSettings {
  cursor: pointer;
  display: block;
  width: 150px;
  height: 150px;
  border-radius: 50%;
}

.avatarWrapper .avatarText {
  display: none;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.7);
  color: #fff;
  text-align: center;
  padding: 5px;
}

.avatarWrapper:hover .avatarText {
  cursor: pointer;
  display: block;
}


  
</style>

  