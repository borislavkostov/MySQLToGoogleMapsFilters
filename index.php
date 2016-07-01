<html>
  <head>

<?php wp_head(); ?> 
    <title>Concerts</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
<style>
html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
select {
    width:200px;
}
</style>
  </head>
  <body>
<?php include 'readingfromDB.php';?>

    <div id="map"></div>
<script>
var map;
	var myLatLng ={lat: latitude, lng:longitude};
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center:new google.maps.LatLng(36.05178307933835,42.49737373046878),
          zoom: 3
        });
var latitude=new Array();
var longitude=new Array();
var start_date=new Array();
var title=new Array();
var title=<?php echo json_encode($title); ?>;
var start_date=<?php echo json_encode($start_time); ?>;
var latitude =<?php echo json_encode($latitude); ?>;
var longitude = <?php echo json_encode($longitude); ?>;
for(i=0;i<latitude.length;i++)
{
var content="Date:"+start_date[i]+"</br>Title:"+title[i];
var infowindow = new google.maps.InfoWindow({});
var marker = new google.maps.Marker({
    position: {lat:parseFloat(latitude[i]),lng:parseFloat(longitude[i])},
    map: map,
  });
google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
    return function() {
        infowindow.setContent(content);
        infowindow.open(map,marker);
    };
})(marker,content,infowindow));
}
      }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAymgz0AXCj6ipuLijePEpi72_QcUga23Q&callback=initMap"
    async defer> </script>


		<?php wp_footer();?>

	</body>
</html>
