<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include 'includes/head.php'; ?>
 </head>
<!-- <header>
  <div class="main-logo">
  <a href="#index" class="logo"><img src="https://cdn.pixabay.com/photo/2015/07/09/19/32/dog-838281_960_720.jpg" alt="Logo"></a>
</header> -->
<body >
  <!--- Navigation -->
    <?php $page = 'contact'; include 'includes/navbar.php'; ?>



  <!--- End Navigation -->
<div class="container text-center text-wrap" id="contacts" >
<h2>Retrouver notre boutique </h2>
  <h4><ul>
    <li> <strong>Paris</strong> Trocadéro <br>
   </li>
    <script>
      // Initialize and add the map
      function initMap() {
        // The location of Uluru
        const paris = { lat: 48.865668, lng: 2.283275 };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 13,
          center: paris,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: paris,
          map: map,
        });
      }
    </script>

    <!--The div element for the map -->
    <div id="map"></div>

<!--


    <li> <strong>Lyon</strong> Les Brotteux <br>
</li>



    <li> <strong>Marseille</strong> Le Vieux Port <br>
 </li>
 -->
  </ul></h4>
  <h2> Livraison gratuite à partir de 79€ d'achat ou retraite au magasin </h2>

  <h3> Besoin d'aide ? Appelez-nous ! </h3>
  <h4> 01 42 71 05 29 </h4>
<img src="https://images.assetsdelivery.com/compings_v2/nd3000/nd30001904/nd3000190400840.jpg">
</div>

  <!--- Start Footer -->
  <footer>
    <?php include 'includes/footer.php'; ?>

  </footer>
  <!--- End of Footer -->

<!--- Script Source Files -->
    <?php include 'includes/scripts.php'; ?>

<!--- End of Script Source Files -->

</body>
</html>
