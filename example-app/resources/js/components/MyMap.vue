<template>
  <div class="myContainer">
    <div class="myMap" id="map"></div>
  </div>
    
</template>
  
  <script>
  import L from 'leaflet';
  
  export default {

 
    mounted() {
      // Створення карти
      this.map = L.map('map').setView([50.745580217132755, 25.329238253994962], 13);
  
      // Додавання плитки карти
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(this.map);
  
      //Додавання маркера на карту
      L.marker([50.745580217132755, 25.333211744319975]).addTo(this.map)
        .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        .openPopup();

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
    handleMapClick(latlng) {
     // Додавання маркера на карту з обробниками подій
    const marker = L.marker(latlng).addTo(this.map)
      .bindPopup('Це мій маркер!')
      .on('mousemove', () => {
        marker.openPopup();
      })
      .on('click', () => {
        this.map.removeLayer(marker);
      });
      
      console.log(`Клік на карті з координатами: ${latlng.lat}, ${latlng.lng}`);

      axios.post('/api/map/store',{ lat: latlng.lat , lng: latlng.lng }).then(data => {
        console.log(data.data);
        },).catch(error => {
            console.log(error.response.data);
        });


    },

    




  },  
};
  </script>
  
  <style>
  .myContainer{
    margin: auto;
    width: 40%;
  }
  .myMap {
    
  height: 400px;

  }
  </style>
