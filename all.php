<?php 
require_once("controller.email.php");
include("header.php"); 
?>

<div class="panel panel-default">
	<div class="panel-heading"><h2>List of Emails</h2></div>
	<div class="panel-body">
	<a href='add.php' class='btn btn-success'><i class="fa fa-plus"></i> New</a>
	<br />
	<br />
		<table class="table table-bordered table-striped">
			<thead>
				<th>Email</th>
				<th>Quota</th>
				<th>Actions</th>
			</thead>
			<tbody>
				<?php print $cad; ?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		function message(){
			var action = "<?php print $_GET["action"]; ?>";
			var result = "<?php print $_GET["result"]; ?>";
			var msg = "";

			if(action){
				switch(action){
					case 'add':
						if(result =="success"){
							msg = "Email Agregado con Exito!!!";
						}else if (result == "error"){
							msg = "Error al Crear el Email!!";
						}
					break;
					case 'change_password':
						if(result =="success"){
							msg = "Cambio de Clave de forma Exitosa!!!";
						}else if (result == "error"){
							msg = "Error al intentar cambiar la Clave!!";
						}
					break;
					case 'delete':
						if(result =="success"){
							msg = "Email Eliminado con Exito!!!";
						}else if (result == "error"){
							msg = "Error al Eliminar el Email!!";
						}
					break;
					case 'setting':
						if(result =="success"){
							msg = "Configuracion Establecida con Exito!!!";
						}
					break;
				}

				alert(msg);
			}

		}

		$("a.delete_email").click(function(e){
			var email = $(this).attr("data-email");
			if(confirm("Estas seguro de eliminar este Email!!?")){
				window.location.href = "controller.email.php?txtoperation=delete&email="+email;
			}
		});

		message();
	});
</script>

<?php include("footer.php"); ?>