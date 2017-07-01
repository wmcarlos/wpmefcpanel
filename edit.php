<?php  
	if(!is_file("config.php")){
		header("location: setting.php");
	}else{
		include("config.php");
		$host_ex = explode(".", domain);
		$host_ex[3] = (isset($host_ex[3]) and !empty($host_ex[3])) ? ".".$host_ex[3] : "";
		$last_part_email ="@".$host_ex[1].".".$host_ex[2].$host_ex[3];
	}
	include("header.php");
?>

<div class="panel panel-default">
	<div class="panel-heading"><h2>Edit Email</h2></div>
	<div class="panel-body">
		<form name="femail" id="femail" method="post" action="controller.email.php">
			<div class="form-group">
				<label for="email">Name:</label>
				<div class="input-group">
					<input type="text" readonly="readonly" value="<?php print $_GET["email"]; ?>" class="form-control" name="email">
					<div class="input-group-btn">
				      <button class="btn btn-default" type="submit">
				        <?php print $last_part_email; ?>
				      </button>
			    </div>
			    </div>
			</div>
			<div class="form-group">
				<label for="password">New Password:</label>
				<input type="password" name="password" class="form-control">
			</div>
			<div class="form-group">
				<label for="repeat_password">Repeat Password:</label>
				<input type="password" name="repeat_password" class="form-control">
				<input type="hidden" name="txtoperation" value="change_password">
			</div>
			<button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Save</button>
			<a href="all.php" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</a>
		</form>
	</div>
</div>

<?php include("footer.php"); ?>