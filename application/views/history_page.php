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
	<h4 style="float:left;margin-left:10px">Select Vehicle ID : </h4>
  	 <div class="col-sm-6">
	        <select class="form-control" name="vid" id="vehicle_id">
	        <option> --- </option>
				<?php 
				foreach ($list_tracked_vid as $key): 
				 	echo "<option>".$key['vehicle_id']."</option>";
				 	endforeach;
				?>
			</select>
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
	var marker= null;

	 $('#vehicle_id').change(function(){

		$.each(markers, function(key, val){
		map.removeLayer(markers[key]);
		});

		markers.length = 0;

	 	var url = "<?php echo base_url();?>index.php/monitoringcontroller/showHistory?";
    	var val = $(this).val();
    	url += "vid=" + val;
    	console.log(url);
		$.getJSON( url, 
    		function( data ) {
    			$.each( data, function( key, val ) {
    				var status = data[key].vehicle_name + " : " + data[key][2]+ "% Fuel.";
    				if(data[key][2] < 95)
    					status += "<br /><font color=\'red\''>Carefull, " + data[key].vehicle_name + "'s tank is probably leaking..!</font>";
    					status += "<br /><font color=\'green\''>"+ data[key].timestamp +" </font>";

    				if(data[key].latitude == 0 || data[key].longitude == 0)
    				{
    					status += "<br /><font color=\'blue\''>\"Unkown Location\"</font>";
    					marker = L.marker([-7.2796025, 112.7953905]).addTo(map)
						.bindPopup(status)
						.openPopup();
    				}	
    				else 	
    				{	
    					marker = L.marker([data[key].latitude, data[key].longitude]).addTo(map)
						.bindPopup(status)
						.openPopup();
					}

					markers.push(marker);

  				});
 				
 			}
 		);
        
	});
});


</script>
</html>