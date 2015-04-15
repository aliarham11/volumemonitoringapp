<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tracking Data</title>

	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">

	<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/leaflet/leaflet.css" />
	<script src="<?php echo base_url(); ?>assets/leaflet/leaflet.js"></script>
	<script src="<?php echo base_url(); ?>assets/leaflet/leaflet-src.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/js2/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js2/jquery.dcjqaccordion.2.7.js"></script>
	<script src="<?php echo base_url(); ?>assets/js2/jquery.dcjqaccordion.2.7.js"></script>
	<script src="<?php echo base_url(); ?>assets/js2/jquery.dcjqaccordion.2.7.js"></script>
	<script src="<?php echo base_url(); ?>assets/js2/jquery.scrollTo.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js2/jquery.nicescroll.js"></script>
	<script src="<?php echo base_url(); ?>assets/js2/jquery.sparkline.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/common-scripts.js"></script>

</head>
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
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered">
              	  	<a href="profile.html">
              	  		<img src="<?php echo base_url(); ?>assets/img/gasologo.png" class="img-circle" width="60">	
              	  	</a>
              	  </p>
              	  <h5 class="centered">Monitoring your gas tank from station</h5>
              	  	
                  <li class="mt">
                      <a href="<?php echo base_url();?>">
                          <i class="fa fa-desktop"></i>
                          <span>Monitor</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="<?php echo base_url();?>index.php/registercontroller">
                          <i class="fa fa-book"></i>
                          <span>Register Vehicle</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="" data-toggle="modal" data-target="#arrival">
                          <i class="fa fa-book"></i>
                          <span>Arrival</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="<?php echo base_url();?>index.php/monitoringcontroller/historypage">
                          <i class="fa fa-bar-chart-o"></i>
                          <span>Show History</span>
                      </a>
                  </li>
              </ul>
          </div>
      </aside>
      <div class="modal fade" id="arrival" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		        <h4 class="modal-title" id="myModalLabel">Arrival</h4>
		      </div>
		      <div class="modal-body">
					<h3><i class="fa fa-angle-right"></i> Vehicle Arrival </h3>
					<div class="form-panel">
						<form class="form-horizontal style-form" action="<?php echo base_url(); ?>index.php/registercontroller/arrival" method="post">
							<div class="form-group">
								<div class="col-sm-12">
									<select class="form-control" name="vid">
									<?php 
									if(!$list_vid) 
									{ 
									 	echo "<option>No active vehicle</option>";
									  
									} 
									else 
									{ 
										foreach ($list_vid as $key): 
									 	echo "<option>".$key['vehicle_id']."</option>";
									 	endforeach;
									} 
									?>
									</select>
								</div>
							</div>
					        <button type="submit" class="btn btn-theme">Check</button>
						
						</form>
					</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

