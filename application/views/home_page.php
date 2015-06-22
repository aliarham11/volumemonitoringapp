<style type="text/css">
	#map 
	{ 
		height: 720px; 

	}
</style>

<section id="main-content">
	<div id="map">
	</div>
<section id="wrapper">
	 <div style="width:500px;position:fixed;bottom:0px">
		<h4 style="float:left;margin-left:10px;color:black">Search : </h4>
	  	 <div class="col-sm-6" >
		    <select class="form-control" name="vid" id="vid">
		       
			</select>

		</div>
	</div>
</section>
</section>
</section>


</body>
<script>

var map = L.map('map').setView([-7.2804277, 112.7963764], 15);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


$( document ).ready(function() {
	var markers = [];
	var marker=null;
	(function showStatus(){
		
		$.each(markers, function(key, val){
			map.removeLayer(markers[key]);
		});


		markers.length = 0;
		addListVehicle();
		$.getJSON( "<?php echo base_url();?>index.php/monitoringcontroller/getvehiclestatus", 
    		function( data ) {
    			console.log(data);
    			$.each( data, function( key, val ) {
    				var status = data[key].vehicle_name + " : " + data[key][2]+ "% Fuel.";
    				if(data[key][2] < 95)
    					status += "<br /><font color=\'red\''>Carefull, " + data[key].vehicle_name + "'s tank is probably leaking..!</font><br /><font color=\'red\''> Contact : "+data[key].driver_contact+"</font>";

    				if(data[key].latitude == 0 || data[key].longitude == 0)
    				{
    					status += "<br /><font color=\'blue\''>\"Unkown Location\"</font>";
    					marker = L.marker([-7.2796025, 112.7953905]).addTo(map)
						.bindPopup(status);
					}	
    				else 	
    				{	
    					marker = L.marker([data[key].latitude, data[key].longitude]).addTo(map)
						.bindPopup(status)
					}
					markers.push(marker);
					
  				});
 				setTimeout(showStatus, 5000);
 				
 			}
 		);
	}());

	$('#vid').change(function() {
    	for(var i=0;i< markers.length;i++)
        {
        	if(markers[i]._popup._content.indexOf($('#vid').val()) > -1)
        	{
        		map.setView([markers[i]._latlng.lat, markers[i]._latlng.lng], 15);
        		markers[i].openPopup();
        	}
        		
        }
        $('#vid').val('---');
        
	});

	function addListVehicle() {
		$.getJSON( "<?php echo base_url();?>index.php/monitoringcontroller/getlistvehicle", 
			function (data) {
				var str = '<option> --- </option>';
				$('#vid').empty();
				$.each( data, function( key, val )
				{
					str += '<option value="' + data[key].vehicle_name + '">' + data[key].vehicle_name + "</option>";
				});
				$('#vid').append(str);
				
			}
		)
	};
});


</script>
</html>