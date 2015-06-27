<?php error_reporting(E_ERROR | E_WARNING | E_PARSE);?>
<?php include_once "_connection/db_base.php"; ?>
<?php require_once '_theme/util.inc.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Complex icons</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700|Open+Sans+Condensed:700,300,300italic|Open+Sans:400,300italic,400italic,600,600italic,700,700italic,800,800italic|PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'/>
    <link href="http://maps.marnoto.com/assets/css/bootstrap.css" rel="stylesheet">
    <link href="http://maps.marnoto.com/assets/css/bootstrap-responsive.css" rel="stylesheet">
	<!--[if lt IE 9]><link rel="stylesheet" type="text/css" media="screen" href="../../assets/css/slide-in.ie.css" /><![endif]-->
    <link href="http://maps.marnoto.com/assets/css/style.css" rel="stylesheet">
    <!-- Color Style Setting CSS file-->
    <link href="http://maps.marnoto.com/assets/css/color-theme/color-cgreen.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>

// The following example creates complex markers to indicate beaches near
// Sydney, NSW, Australia. Note that the anchor is set to
// (0,32) to correspond to the base of the flagpole.

function initialize() {
  var mapOptions = {
    zoom: 6,
    center: new google.maps.LatLng(13.03887,101.490104)
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'),
                                mapOptions);

  setMarkers(map, beaches);
}

/**
 * Data for the markers consisting of a name, a LatLng and a zIndex for
 * the order in which these markers should display on top of each
 * other.
 */
<?php
  $sql="select * from site_detail where lat<>''";
  $result=$mysqli->query($sql);
  
  while($row = $result->fetch_assoc()) {

    $sitename=$row['site_name'];
    $lat=$row['lat'];
    $lng=$row['lng'];
    
    $coordinate .= "['{$sitename}', {$lat}, {$lng}, 4],";
  }
  $coordinate=substr($coordinate,0,strlen($coordinate)-1);
  
?>
var beaches = [
  <?php echo $coordinate;?>
];

function setMarkers(map, locations) {
  // Add markers to the map

  // Marker sizes are expressed as a Size of X,Y
  // where the origin of the image (0,0) is located
  // in the top left of the image.

  // Origins, anchor positions and coordinates of the marker
  // increase in the X direction to the right and in
  // the Y direction down.
  var image = {
    url: 'images/beachflag.png',
    // This marker is 20 pixels wide by 32 pixels tall.
    size: new google.maps.Size(20, 32),
    // The origin for this image is 0,0.
    origin: new google.maps.Point(0,0),
    // The anchor for this image is the base of the flagpole at 0,32.
    anchor: new google.maps.Point(0, 32)
  };
  // Shapes define the clickable region of the icon.
  // The type defines an HTML &lt;area&gt; element 'poly' which
  // traces out a polygon as a series of X,Y points. The final
  // coordinate closes the poly by connecting to the first
  // coordinate.
  var shape = {
      coords: [1, 1, 1, 20, 18, 20, 18 , 1],
      type: 'poly'
  };
  for (var i = 0; i < locations.length; i++) {
    var beach = locations[i];
    var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
    var content = '<div id="iw-container">' +
                      '<div class="iw-title">Porcelain Factory of Vista Alegre</div>' +
                      '<div class="iw-content">' +
                        '<div class="iw-subTitle">History</div>' +
                        '<p>Founded in 1824, the Porcelain Factory of Vista Alegre was the first industrial unit dedicated to porcelain production in Portugal. For the foundation and success of this risky industrial development was crucial the spirit of persistence of its founder, José Ferreira Pinto Basto. Leading figure in Portuguese society of the nineteenth century farm owner, daring dealer, wisely incorporated the liberal ideas of the century, having become "the first example of free enterprise" in Portugal.</p>' +
                        '<div class="iw-subTitle">Contacts</div>' +
                        '<p>VISTA ALEGRE ATLANTIS, SA<br>3830-292 Ílhavo - Portugal<br>'+
                        '<br>Phone. +351 234 320 600<br>e-mail: geral@vaa.pt<br>www: www.myvistaalegre.com</p>'+
                      '</div>' +
                      '<div class="iw-bottom-gradient"></div>' +
                    '</div>';

    var myinfowindow = new google.maps.InfoWindow({
        content: beach[0]
    });
    
    var markers = new google.maps.Marker({
        position: myLatLng,
        map: map,
        shape: shape,
        title: beach[0],
        zIndex: beach[3],
        infowindow: myinfowindow
    });

    google.maps.event.addListener(markers, 'click', function() {
            this.infowindow.open(map, this);
    
    });

  }

}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>