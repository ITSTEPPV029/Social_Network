<template>

<div class="search-modal-map" v-bind:class="{ 'search-modal-map2': showModalMap }">
          <div class="search-modal-map-content">
            <span class="search-modal-map-span" @click="closeModal"> &#10006;</span>  
      <h3>Пошук по карті</h3>
            <div   v-if="this.checkUserID>0" class="search-user-check-container">
                <div class="search-img">
                      <a :href="`/profile/${this.user.id}`"> <img :src="`${user.avatar}`" ></a> 
                    </div>
                  <div class="search-user-info">
                        <strong>{{  this.user.first_name }} </strong>&nbsp;
                        <strong> {{  this.user.last_name}}</strong> 
                        <div class="search-user-actions">
                        <span>{{  this.user.nick_name}} </span><br/>
                        <span> {{  this.user.date_of_birth}}</span> <br/>
                        <span> {{  this.user.gender}}</span><br/>
                        <span> {{  this.user.city}}</span><br/>
                        </div>
                </div>
              </div>
              
           <div class="search-myMapContainer">
                <div class="search-myMap" id="searchMap"></div>
            </div>    
          </div>
  </div>
 

<div class="search-container">
  <div class="search-users">           
  <h3>Результати пошуку</h3>
  <hr/>
  <div v-if="JSON.stringify(this.localUsers) === '{}'" class="">Співпадінь не знайдено</div>

  <!-- <div   v-if="this.checkUserID>0" class="search-user-check-container">
    <div class="search-img">
          <a :href="`/profile/${this.user.id}`"> <img :src="`${user.avatar}`" ></a> 
        </div>
      <div class="search-user-info">
            <strong>{{  this.user.first_name }} </strong>&nbsp;
            <strong> {{  this.user.last_name}}</strong> 
            <div class="search-user-actions">
            <span>{{  this.user.nick_name}} </span><br/>
            <span> {{  this.user.date_of_birth}}</span> <br/>
            <span> {{  this.user.gender}}</span><br/>
            <span> {{  this.user.city}}</span><br/>
            </div>
    </div>
  </div> -->

    <div  v-for="user in localUsers" class="search-user">
        <div class="search-img">
          <a :href="`/profile/${user.id}`"> <img :src="`${user.avatar}`" ></a> 
        </div>
      
        <div class="search-user-info">
            <strong>{{ user.first_name }} </strong>&nbsp;
            <strong> {{ user.last_name}}</strong> 
            <div class="search-user-actions">
            <span>{{ user.nick_name}} </span><br/>
            <span> {{ user.date_of_birth}}</span> <br/>
            <span> {{ user.gender}}</span><br/>
            <span> {{ user.city}}</span><br/>
              <!-- <a href="{{route('friendRequest.friendRequest',$user) }}">добавити в друзі</a> -->
            </div>
        </div>  
    </div>
  </div>
  <div class="search-filter-container"> 
<h4>Фільтрація пошуку</h4>

<hr/>
<input class="search-map-button" @click="showModal" value="Пошук по карті">
     <div class="search-filter">
        <label>Ім'я та Прізвище</label><br/>
        <input  v-model="name" type="text"> 
     </div>

     <div class="search-filter">
        <label>Нікнейм</label><br/>
        <input  v-model="nick_name" type="text">  
    </div>

    <div class="search-filter">
      <label>Дата народження</label><br/>
      <input type="date" v-model="date_of_birth">
    </div>

    <div class="search-filter">
      <label>стать</label><br/>
     
        <select  v-model="gender" name="options">
          <option value=""> </option>
          <option value="Жінка">Жінка </option>
          <option value="Чоловік">Чоловік</option>
          <option value="Нон-бінарний">Нон-бінарний</option>
          <option value="Чоловік">Поза гендером</option>
          <option value="Бігендер">Бігендер</option>
        </select>
    </div>

      <div class="search-filter">
        <label>Місто</label><br/>
        <input  v-model="city" type="text"> 
      </div>
<hr/>
      <div class="search-filter">
        <label>Вид улюблинця</label><br/>
        <select v-model="kindPet" name="options">
                  <option value=""> </option>
                  <option value="собака">собака </option>
                  <option value="кіт">кіт</option>
                  <option value="рибки">рибка</option>
                  <option value="птах">птах</option>
                  <option value="хом'як">хом'як</option>
                  <option value="кролик">кролик</option>
        </select>      
      </div>

      <div class="search-filter">
        <label>Стать улюблинця</label><br/>
        <!-- <input  v-model="genderPet" type="text">  -->
        <select v-model="genderPet" name="options">
                  <option value=""> </option>
                  <option value="Жінка">Жінка </option>
                  <option value="Чоловік">Чоловік</option>
                  <option value="Нон-бінарний">Нон-бінарний</option>
                  <option value="Поза гендером">Поза гендером</option>
                  <option value="Бігендер">Бігендер</option>
                </select>
      </div>

      <div class="search-filter">
        <label>Вік улюбленця</label><br/>
        <input v-model="agePet"  type="number" min="1" max="100"> 
      </div>
    
      <br/>
    <div class="search-button">
        <input @click="applyFilter"  type="submit"  value="Фільтрувати"> <br/> <br/>
        <input @click="clearFilter"  type="submit"  value="Очистити фільтр">
    </div>
     


    <!-- <p>місця вигулу користувачів</p>
    <div class="search-myMapContainer">
        <div class="search-myMap" id="searchMap"></div>
    </div> -->

  </div>
</div>

</template>

<script>

import L from 'leaflet';

export default {

    data(){
        return{
          name:'',
          nick_name:'',
          date_of_birth:'',
          gender:'',
          city:'',
          checkUserID:0,
          localUsers: null,
          user:null,
          map: null,
          showModalMap: false,
          agePet:'',
          genderPet:'',
          kindPet:'',
          usersMap:null,
        } 
    },
    props: {
      users: {
        type:  Object,
        required: true,
      },
      userthis: {
        type: Object,
        required: true,
      },
    },
   mounted(){
    // this.localUsers = { ...this.users }; 

    // // Створення карти
    // this.map = L.map('searchMap').setView([50.745580217132755, 25.329238253994962], 13);
      
    //   // Додавання плитки карти
    //   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    //     maxZoom: 18,
    //   }).addTo(this.map);

    //   this.map.doubleClickZoom.disable();

     // this.aadMarkerk(this.users);
     this.applyFilter();
   },

    methods: {

      initializeMap() {


        this.map = L.map('searchMap').setView([this.userthis.latitude, this.userthis.longitude], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
          maxZoom: 18,
        }).addTo(this.map);
       
        
        this.map.doubleClickZoom.disable();
        // this.addMarkers(this.users);

      //Додавання маркера кормстувача 
        // L.marker([this.userthis.latitude, this.userthis.longitude]).addTo(this.map)
        //         .bindPopup('Ваше місце Вигулу')
        //         .openPopup();
        this.getUsersMap(); 
    },

    //вікно map
  showModal() {
   
      this.showModalMap = true;
      setTimeout(() => {
       
        this.initializeMap();
      }, 0);
      

    },
    closeModal() {
      this.showModalMap = false;
    },

      applyFilter() {
        const formData = new FormData();

        formData.append('name', this.name);
        formData.append('nick_name', this.nick_name);

         formData.append('date_of_birth', this.date_of_birth);
         formData.append('gender', this.gender);
         formData.append('city', this.city);
       
         formData.append('agePet', this. agePet);
         formData.append('genderPet', this.genderPet);
         formData.append('kindPet', this.kindPet);
 
        axios.post('/api/filter', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
        }).then(response => {
          this.localUsers = { ...response.data };
         // this.aadMarkerk(response.data);

          }).catch(error => {
                console.log(error);
          });

        //  this.citySearch( this.city)  
      },

//додавання користувачів на карту 
      aadMarkerk(users){
        // Видалення попередніх маркерів
        this.map.eachLayer((layer) => {
          if (layer instanceof L.Marker) {
            this.map.removeLayer(layer);
          }
        });

        users.forEach(user => {
              const userIcon = L.icon({
                iconUrl: user.avatar, // URL зображення користувача
                iconSize: [40, 40], // розмір іконки
                iconAnchor: [20, 40], // якорна точка іконки
                popupAnchor: [0, -40], // якорна точка спливаючого вікна
                className: 'user-marker-icon' // CSS-клас для стилізації
              });
              
              const marker = L.marker([user.latitude, user.longitude], { icon: userIcon }).addTo(this.map)
                .bindPopup(user.first_name + " " + user.last_name).on('mousemove', () => {
                  marker.openPopup();
                }).on('click', () => { this.MarkerClick(user); });
            });

      },

      MarkerClick(user){
     
        this.checkUserID=user.id;
        this.user=user;
      },

      clearFilter(){
        this.name='';
        this.nick_name='';
        this.date_of_birth='';
        this.gender='';   
        this.checkUserID=0;
        this.city='Луцьк'; 
        this.applyFilter();   
      },

      citySearch(city){

        // Отримання координат міста за його назвою
        const cityName = city;
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


      getUsersMap() {

        axios.post('/api/getUsersMap').then(data=>{  
         // console.log(data.data);
         this.usersMap=data.data;
        
          this.aadMarkerk(data.data);
       });



      }






    }

}
</script>
