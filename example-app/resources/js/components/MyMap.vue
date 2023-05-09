<template>
    <div class="myMap" id="map"></div>
  </template>
  
  <script>
  import L from 'leaflet';
  
  export default {
    mounted() {
      // Створення карти
      this.map = L.map('map').setView([51.505, -0.09], 13);
  
      // Додавання плитки карти
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
        maxZoom: 18,
      }).addTo(this.map);
  
      //Додавання маркера на карту
      L.marker([51.5, -0.09]).addTo(this.map)
        .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        .openPopup();
    },
  };
  </script>
  
  <style>
  .myMap {
    
  width: 40%;
  height: 400px;

  }
  </style>
