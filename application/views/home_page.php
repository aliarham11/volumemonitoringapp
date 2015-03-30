<style type="text/css">
	#map 
	{ 
		height: 720px; 

	}
</style>

<body>

<div id="container">
	<h1>Tank Volume Monitoring System</h1>

	<div id="map">
	</div>

</div>

</body>
<script>
// create a map in the "map" div, set the view to a given place and zoom
var map = L.map('map').setView([-7.2804277, 112.7963764], 13);

// add an OpenStreetMap tile layer
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


$( document ).ready(function() {
    console.log( "ready!" );
    	$.getJSON( "<?php echo base_url();?>index.php/monitoringcontroller/getvehiclestatus", 
    	function( data ) {
    		console.log(data);
    		$.each( data, function( key, val ) {
    			var status = data[key].vehicle_name + " : " + data[key][2]+ "% Fuel.";
    			if(data[key][2] < 95)
    				status += "<br /><font color=\'red\''>Carefull, " + data[key].vehicle_name + "'s tank is probably leaking..!</font>"

    			L.marker([data[key].latitude, data[key].longitude]).addTo(map)
				.bindPopup(status)
				.openPopup();

  			});
 		
 		}
 	);

});








// add a marker in the given location, attach some popup content to it and open the popup

</script>
</html>