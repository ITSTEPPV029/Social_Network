<template>
 <div class="settings-overlay-test"></div>

<div class="settings-container-main">
  <h3>Налаштування профілю</h3>
  <br/>
  <div class="settings-container">

      <div class="settings-item item_1">
        <label>Імя</label> 
      </div>
      <div class="settings-item item_2">
        <input type="text" v-model="user.first_name">
        <p v-if="errors && errors.first_name">{{ errors.first_name[0] }}</p>
      </div>

      <div class="settings-item item_3">
        <label>Прізвище</label>
      </div>
      <div class="settings-item item_4">
        <input type="text" v-model="user.last_name">
        <p v-if="errors && errors.last_name">{{ errors.last_name[0] }}</p>
      </div>

      <div class="settings-item item_5">
        <label>Нікнейм</label>
      </div>
      <div class="settings-item item_6">
        <input type="text" v-model="user.nick_name">
        <p v-if="errors && errors.nick_name">{{ errors.nick_name[0] }}</p> 
      </div>

      <div class="settings-item item_7">
        <label>Ел. пошта</label>
      </div>
      <div class="settings-item item_8">
        <input type="email" name="email" v-model="user.email">
          <p v-if="errors && errors.email">{{ errors.email[0] }}</p> 
      </div>

      <div class="settings-item item_10">
        <label>Стать</label>
      </div>
      <div class="settings-item item_11">
        <select  v-model="user.gender" name="options">
          <option value=""> </option>
          <option value="Жінка">Жінка </option>
          <option value="Чоловік">Чоловік</option>
          <option value="Нон-бінарний">Нон-бінарний</option>
          <option value="Поза гендером">Поза гендером</option>
          <option value="Бігендер">Бігендер</option>
        </select>
      </div>

      <div class="settings-item item_12">
        <label>День народження </label>
      </div>
      <div class="settings-item item_13">
        <input type="date" v-model="user.date_of_birth">
        <p v-if="errors && errors.date_of_birth">{{ errors.date_of_birth[0] }}</p>
      </div>

      <div class="settings-item item_14">
        <label>Місто</label>
      </div>
      <div class="settings-item item_15">
        <input type="text" name="city" v-model="user.city">
      </div>

      <div class="settings-item item_16">
        <label>Про себе</label>
      </div>
      <div class="settings-item item_17">
        <textarea v-model="user.about_me" rows="3"></textarea>
      </div>
     
      <div class="settings-item item_9">
            <div class="settings-avatarWrapper">
              <img class="settings-avatarSettings" :src="`${user.avatar}`" @click="openFileInput">
              <div class="settings-avatarText" @click="openFileInput" >Змінити</div>
            </div>
            <input  style="display: none" type="file" ref="fileInput" @change="onFileSelected">
      </div>

    </div>
    <p v-if="displayTextSave"> {{ displayTextSave }}</p> 
    <div class="settings-button-save-container">
      <h5 class="settings-button-save" @click="saveChanges" >Зберегти</h5>
    </div>
     
    <hr/>
  
    <p>Виберіть місце вигулу, щоб брати участь у пошуку </p> 
    <b v-if="displayText"> {{ displayText }}</b>
      <div class="settings-map-search">
            <input  v-model="city" type="text"  placeholder="Назва міста"> 
            <p @click="citySearch">пошук</p>
      </div>
    <div class="settings-map-сontainer">
          <div class="settings-map" id="map">
            
          </div>
    </div>


</div>


  </template>
  
  <script>
  import L from 'leaflet';
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
        marker: null,
        displayText: "", 
        displayTextSave: "", 
        city: "",
        errors: {
            first_name: [],
            last_name: [],
            nick_name: [],
            email: [],
            password: [],
            date_of_birth: [],
         }
      };
    },
  
    created() {
      this.originalUser = JSON.parse(JSON.stringify(this.user));
    },

    mounted() {
      // Створення карти
      //якщо мітка вже є то виставляємо її інакше просто переміщаємо карту на задану позицію
     if (this.user.longitude!=null){

      this.map = L.map('map').setView([this.user.latitude, this.user.longitude], 13);

      this.marker = L.marker([this.user.latitude, this.user.longitude]).addTo(this.map)
        .bindPopup('Ваше місце вигулу')
        .on('mousemove', () => {
          this.marker.openPopup();
        })
        .on('click', () => {
          this.map.removeLayer( this.marker);
        //  console.log("видалення");

        });
     }
      else{
        this.map = L.map('map').setView([50.745580217132755, 25.329238253994962], 13);
      }
     
      // Додавання плитки карти
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(this.map);
  
      //Додавання маркера на карту
      // L.marker([50.745580217132755, 25.333211744319975]).addTo(this.map)
      //   .bindPopup('Виберіть місце виголу тварини,<br>щоб брати участь у пошуку')
      //   .openPopup();

        this.map.doubleClickZoom.disable();
      // Додавання слухача подій на карту
        this.map.on('click', (event) => {
      // Отримання координат з події
        const latlng = event.latlng;
       // Виклик методу з передачею координат
        this.handleMapClick(latlng);
      });   
  },

methods: {

      saveChanges() {
        let dataChanged = false;
        const formData = new FormData();

      for (const key in this.user) {
        if (this.user[key] !== this.originalUser[key]) {
          dataChanged = true;
          formData.append(key, this.user[key]);
        }
      }
  
      if (dataChanged) {
        // const formData = new FormData();
        // formData.append('first_name', this.user.first_name);
        // formData.append('last_name', this.user.last_name);
         formData.append('email', this.user.email);
         //formData.append('nick_name', this.user.nick_name);

        // formData.append('date_of_birth', this.user.date_of_birth);

        // formData.append('gender', this.user.gender);
        // formData.append('city', this.user.city);
        // formData.append('about_me', this.user.about_me);

       
      axios.post('/api/settings', formData, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(response => {
               // console.log( response.data);
                this.errors = {};

                this.displayTextSave = "Дані збережено!";
                setTimeout(() => {
                  this.displayTextSave = "";
                }, 2000); // Час затримки в мілісекундах
            })
            .catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    console.log(error);
                }
            });
        }

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
    //  console.log("дані змінено");
      this.$refs.fileInput.click();
    },

    handleMapClick(latlng) {
     // Додавання маркера на карту з обробниками подій
     if (this.marker != null) {
        this.marker.setLatLng(latlng);
     } else {
      this.marker = L.marker(latlng).addTo(this.map)
        .bindPopup('Ваше місце вигулу')
        .on('mousemove', () => {
          this.marker.openPopup();
        })
        .on('click', () => {
          this.map.removeLayer(this.marker);
         // console.log("видалення");
        });
     }
     
      //console.log(`Клік на карті з координатами: ${latlng.lat}, ${latlng.lng}`);
      
      axios.post('/api/map/store',{ latitude: latlng.lat , longitude: latlng.lng }).catch(error => {
            console.log(error.response.data);
        });

        this.displayText = "Координати збережено!";
        setTimeout(() => {
          this.displayText = "";
        }, 3000); // Час затримки в мілісекундах
    },
    citySearch(){

        // Отримання координат міста за його назвою
        const cityName = this.city;
        const geocodeUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(cityName)}`;

        fetch(geocodeUrl)
          .then(response => response.json())
          .then(data => {
            if (data.length > 0) {
              const lat = parseFloat(data[0].lat);
              const lon = parseFloat(data[0].lon);

              // Переміщення карти на координати міста
              this.map.setView([lat, lon], 13);
            } else {
              console.log('Місто не знайдено');
            }
          })
          .catch(error => {
            console.log('Помилка при отриманні координат міста:', error);
          });

    },




  
  },

  };
  </script>
  
<style>

  
</style>

  