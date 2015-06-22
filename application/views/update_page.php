<section id="main-content">
	<section class="wrapper">
		<h3><i class="fa fa-angle-right"></i> Update Vehicle</h3>
		<div class="form-panel">
			<!-- <form class="form-horizontal style-form" method="post"> -->
			<div class="form-horizontal style-form">
			<?php echo form_open('registercontroller/formupdatevehicle'); ?>
				<div class="form-group">
	              	<div class="col-sm-10">
	                	<h4 style="float:left;margin-left:10px;color:black">Select ID : </h4>
					  	 <div class="col-sm-6" >
						    <select class="form-control" name="vid" id="vid">
						       <option> --- </option>
								<?php 
								foreach ($list_vid_update as $key): 
								 	echo "<option value='".$key['vehicle_id']."''>".$key['vehicle_id']."</option>";
								 endforeach;
								?>
							</select>
						</div>
	            	</div>
	          	</div>
	          	<div class="form-group">
	              <label class="col-sm-2 col-sm-2 control-label">Vehicle Name</label>
	              <div class="col-sm-10">
	                  <input type="text" class="form-control" name="vehicle_name" value="<?php echo set_value('vehicle_name'); ?>">
	                  <label class="control-label"><font color="red"><?php echo form_error('vehicle_name'); ?></font></label>
	              </div>
	          	</div>
	          	<div class="form-group">
	              <label class="col-sm-2 col-sm-2 control-label">Driver Contact</label>
	              <div class="col-sm-10">
	                  <input type="text" class="form-control" name="driver_contact" value="<?php echo set_value('driver_contact'); ?>" >
	                  <label class="control-label"><font color="red"><?php echo form_error('driver_contact'); ?></font></label>
	              </div>
	             </div>
	          	<div class="form-group">
	              <label class="col-sm-2 col-sm-2 control-label">Tank Type</label>
	              <div class="col-sm-10">
	                  <select class="form-controll" name="tank_type">
	                  	<option>Tube</option>
	                  	<option>Rectangular</option>
	                  </select>
	              </div>
	          	</div>
	          	<div class="form-group">
	              <label class="col-sm-2 col-sm-2 control-label">Diameter</label>
	              <div class="col-sm-10">
	                  <input type="text" class="form-control" name="diameter" value="<?php echo set_value('diameter'); ?>" placeholder="in centimeter (if tank type is Rectangular, diameter is replaced by tank's widesize)">
	                  <label class="control-label"><font color="red"><?php echo form_error('diameter'); ?></font></label>
	              </div>
	          	</div>
	          	<div class="form-group">
	              <label class="col-sm-2 col-sm-2 control-label">Longsize</label>
	              <div class="col-sm-10">
	                  <input type="text" class="form-control" name="longsize" value="<?php echo set_value('longsize'); ?>" placeholder="in centimeter">
	                  <label class="control-label"><font color="red"><?php echo form_error('longsize'); ?></font></label>
	              </div>
	          	</div>
	          	<div class="form-group">
	              <label class="col-sm-2 col-sm-2 control-label">Tank Height</label>
	              <div class="col-sm-10">
	                  <input type="text" class="form-control" name="tank_height" value="<?php echo set_value('tank_height'); ?>" placeholder="in centimeter">
	                  <label class="control-label"><font color="red"><?php echo form_error('tank_height'); ?></font></label>
	              </div>
	          	</div>
	          	<div class="form-group">
	              <label class="col-sm-2 col-sm-2 control-label">Initial Volume</label>
	              <div class="col-sm-10">
	                  <input type="text" class="form-control" name="initial_volume" value="<?php echo set_value('initial_volume'); ?>" placeholder="in centimeter cubic">
	                  <label class="control-label"><font color="red"><?php echo form_error('initial_volume'); ?></font></label>
	              </div>
	          	</div>
	          	<br />
	          	<button name="submit_btn" type="submit" class="btn btn-theme" >Register</button>
	          	</form>
				
			</div>
		</div>
	</section>
</section>
</section>
</body>
<script type="text/javascript">
	
	$(document).ready(function(){
		$('[name="submit_btn"]').prop( "disabled", true );
		$('#vid').change(function() {
			var url = "<?php echo base_url();?>index.php/registercontroller/retrievevehicledata/";
			
			if($('#vid').val() != "---")
			{
				$('[name="submit_btn"]').prop( "disabled", false );
				url += $('#vid').val();
				$.getJSON(url,function(data){
					console.log(data[0]);
					$('[name="vehicle_name"]').val(data[0].vehicle_name);
					$('[name="driver_contact"]').val(data[0].driver_contact);
					$('[name="tank_type"]').val(data[0].tank_type);
					$('[name="diameter"]').val(data[0].diameter);
					$('[name="longsize"]').val(data[0].longsize);
					$('[name="tank_height"]').val(data[0].tank_height);
					$('[name="initial_volume"]').val(data[0].initial_volume);

				});

			}
			else
			{
				$('[name="vehicle_name"]').val('');
				$('[name="driver_contact"]').val('');
				$('[name="tank_type"]').val('Tube');
				$('[name="diameter"]').val('');
				$('[name="longsize"]').val('');
				$('[name="tank_height"]').val('');
				$('[name="initial_volume"]').val('');
				$('[name="submit_btn"]').prop( "disabled", true );
			}
		});

	});



</script>
</html>