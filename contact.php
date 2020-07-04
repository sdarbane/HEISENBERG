<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<div class="jumbotron">
  <h1 class="display-4">DEBSTER </h1>
  <p class="lead">Nous pensons que la meilleure façon de faire les comptes, c'est ensemble. En un clic le compte est bon ! </p>
  <hr class="my-4">
  <h2>Pour toutes questions n'hésitez pas à contacter notre équipe:</h2>
  <ul>
    <li>Contact du Scrum Master : melfaiz@enseirb-matmeca.fr  </li>
    <li>Contact de l'equipe des devellopeurs:</li>
    <li>ldayet@enseirb-matmeca.fr</li>
    <li>lbader@enseirb-matmeca.fr</li>
    <li>sdarbane@enseirb-matmeca.fr</li>
  </ul>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="index.php" role="button">Retour à l'accueil</a>
  </p>
  <p>Venez à notre visite</p>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyD5r5wWuTOK5pqfXa6arrUGhFUjWxslGDg" type="text/javascript"></script>
  <script async type="text/javascript">
    // On initialise la latitude et la longitude de l'enseirb (centre de la carte)
    var lat = 44.8062718;
    var lon = -0.6075598;
    var map = null;
    // Fonction d'initialisation de la carte
    function initMap() {
      // Créer l'objet "map" et l'insèrer dans l'élément HTML qui a l'ID "map"
      map = new google.maps.Map(document.getElementById("map"), {
        // Nous plaçons le centre de la carte avec les coordonnées ci-dessus
        center: new google.maps.LatLng(lat, lon),
        // Nous définissons le zoom par défaut
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: true,
        scrollwheel: false,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR
        },
        navigationControl: true,
        navigationControlOptions: {
          style: google.maps.NavigationControlStyle.ZOOM_PAN
        }
      });
      var marker = new google.maps.Marker({
	position: {lat: lat, lng: lon},
	map: map
});
    }
    window.onload = function(){
      // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
      initMap();
    };
  </script>
  <style type="text/css">
    #map{ /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
      height:500px;
    }
  </style>
  <title>Carte</title>
</head>
<body>
  <div id="map">
    <!-- Ici s'affichera la carte -->
  </div>
</body>

</div>


<?php include("includes/footer.php"); ?>
