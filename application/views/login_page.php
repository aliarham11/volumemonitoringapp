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
	<!-- <form class="form-login" action="index.html"> -->
    <?php echo form_open('logincontroller'); ?>
    <div class="form-login">
        <h2 class="form-login-heading">Gasoline Tank Volume Monitoring App</h2>
        <div class="login-wrap">
            <input class="form-control" placeholder="User ID" autofocus="" type="text" name="uid" id="uid">
            <label class="control-label"><font color="red"><?php echo form_error('uid'); ?></font></label>
            <br>
            <input class="form-control" placeholder="Password" type="password" name="pwd" id="pwd">
            <label class="control-label"><font color="red"><?php echo form_error('pwd'); ?></font></label>
            <br>
            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> LOGIN</button>
            <label class="control-label"><font color="red"><?php if($status == false) echo 'invalid account'; ?></font></label>
            <hr>
            
        </div>
    </div>
    </form>
</body>
</html>