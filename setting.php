<?php 
include("header.php"); 

$domain = "";
$user = "";
$password = "";

if(is_file("config.php")){
	include("config.php");

	$domain = domain;
	$user = user;
	$password = password;
}
?>

<div class="panel panel-default">
	<div class="panel-heading"><h2>Setting</h2></div>
	<div class="panel-body">
		<form name="fsetting" id="fsetting" method="post" action="controller.email.php">
			<div class="form-group">
				<label for="txtdomain">Domain:</label>
				<input type="text" class="form-control" value="<?php print $domain; ?>" name="txtdomain" id="txtdomain">
			</div>
			<div class="form-group">
				<label for="txtuser">User:</label>
				<input type="text" class="form-control" value="<?php print $user; ?>" name="txtuser" id="txtuser">
			</div>
			<div class="form-group">
				<label for="txtpassword">Password:</label>
				<input type="password" class="form-control" value="<?php print $password; ?>" name="txtpassword" id="txtpassword">
				<input type="hidden" name="txtoperation" value="save_setting">
			</div>
			<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save</button>
		</form>
	</div>
</div>

<?php include("footer.php"); ?>
