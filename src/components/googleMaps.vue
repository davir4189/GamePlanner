<!-- <template>
    <div class="container3" id="map"></div>
  </template>
  
  <script>
  export default {
    name: "googleMaps",
    mounted() {
      // Crea un elemento <script> para cargar la biblioteca de Google Maps API
      const script = document.createElement("script");
      script.type = "text/javascript";
      script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyD8SCbN9ajO1phNjE3rAMkwcY-psqVEVIM&callback=initMap`;
  
      // Agrega un listener para esperar a que se cargue la biblioteca
      script.addEventListener("load", () => {
        // Crea el mapa y el marcador
        const coord = { lat: 41.380896, lng: 2.1206311 };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: coord,
        });
        const marker = new google.maps.Marker({
          position: coord,
          map: map,
        });
      });
  
      // Agrega el elemento <script> al DOM
      document.head.appendChild(script);
    },
  };
  </script> -->