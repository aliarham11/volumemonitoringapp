<style type="text/css">
	#map 
	{ 
		height: 720px; 

	}
</style>

<body>


<section id="container">
	<header class="header black-bg">
		<div class="sidebar-toggle-box">
			<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
					
			</div>
		</div>

		<a href="<?php echo base_url();?>" class="logo">
			<b><font color="blue">Tank Volume Monitoring System</font></b>
		</a>
		
	</header>
	<aside>
          <div id="sidebar" class="nav-collapse " tabindex="5000" style="overflow: hidden; outline: none;">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered">
              	  	<a href="profile.html">
              	  		<img src="assets/img/pp.jpg" class="img-circle" width="60">	
              	  	</a>
              	  </p>
              	  <h5 class="centered">Yoga Pratama Aliarham</h5>
              	  <h5 class="centered">5111100018</h5>
              	  	
                  <li class="mt">
                      <a href="<?php echo base_url();?>">
                          <i class="fa fa-desktop"></i>
                          <span>Home Page</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="<?php echo base_url();?>">
                          <i class="fa fa-book"></i>
                          <span>Register Vehicle</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="<?php echo base_url();?>">
                          <i class="fa fa-bar-chart-o"></i>
                          <span>Show History</span>
                      </a>
                  </li>

                  


              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>

<section id="main-content">
	<div id="map">
	</div>
</section>
<!-- 
	<div id="map">
	</div>
 -->
</section>


</body>
<script>

var map = L.map('map').setView([-7.2804277, 112.7963764], 13);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


$( document ).ready(function() {
	var markers = [];
	var marker= null;
	(function showStatus(){
		
		$.each(markers, function(key, val){
			map.removeLayer(markers[key]);
		});

		markers.length = 0;

		$.getJSON( "<?php echo base_url();?>index.php/monitoringcontroller/getvehiclestatus", 
    		function( data ) {
    			$.each( data, function( key, val ) {
    				var status = data[key].vehicle_name + " : " + data[key][2]+ "% Fuel.";
    				if(data[key][2] < 95)
    					status += "<br /><font color=\'red\''>Carefull, " + data[key].vehicle_name + "'s tank is probably leaking..!</font>";

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
 				setTimeout(showStatus, 5000);
 				
 			}
 		);
	}());
});








// add a marker in the given location, attach some popup content to it and open the popup

</script>
</html>