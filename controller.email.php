<?php 
	require_once("class.cpmm.php");

	if(is_file("config.php")){
		include("config.php");

		$host = domain;
		$user = user;
		$pass = password;

		$host_ex = explode(".", $host);
		$host_ex[3] = (isset($host_ex[3]) and !empty($host_ex[3])) ? ".".$host_ex[3] : "";
		$last_part_email ="@".$host_ex[1].".".$host_ex[2].$host_ex[3];


		$cpmm = new cPanelMailManager($user, $pass, $host);
	}else{
		header("location: setting.php");
	}

	//Server Data
	$txtdomain = $_POST["txtdomain"];
	$txtuser = $_POST["txtuser"];
	$txtpassword = $_POST["txtpassword"];

	//Email Data

	$email = $_REQUEST["email"].$last_part_email;
	$password = $_POST["password"];
	$quota = $_POST["quota"];

	$txtoperation = $_REQUEST["txtoperation"];

	switch ($txtoperation) {

		case 'save_setting':
			$myfile = fopen("config.php","w");

			$text = "<?php\n";
				$text.= "\tdefine('domain','".$txtdomain."');\n";
				$text.= "\tdefine('user','".$txtuser."');\n";
				$text.= "\tdefine('password','".$txtpassword."');\n";
			$text.= "?>";

			fwrite($myfile, $text);

			fclose($myfile);

			header("location: all.php?action=setting&result=success");
		break;
		case 'add':

			$status = "";
			if($cpmm->createEmail($email,$password,$quota)){
				header("location: all.php?action=add&result=success");
			}else{
				header("location: all.php?action=add&result=error");
			}

		break;
		case 'delete':
			if($cpmm->deleteEmail($email)){
				header("location: all.php?action=delete&result=success");
			}else{
				header("location: all.php?action=delete&result=error");
			}
		break;
		case 'change_password':
			if($cpmm->changePW($email, $password)){
				header("location: all.php?action=change_password&result=success");
			}else{
				header("location: all.php?action=change_password&result=error");
			}
		break;
		default:

			$data = $cpmm->listEmails();
			$cad = "";
			for($i=0; $i < count($data); $i++){
				if(verify($data[$i]['email'], $last_part_email)){

					$e_separe = explode("@", $data[$i]['email']);

					$cad.="<tr>";
						$cad.="<td>".$data[$i]['email']."</td>";
						$cad.="<td>".$data[$i]['diskquota']."</td>";
						$cad.="<td><a href='edit.php?email=".$e_separe[0]."' class='btn btn-info'><i class='fa fa-pencil'></i> Change Password</a>
						<a href='#' class='btn btn-danger delete_email' data-email='".$e_separe[0]."'><i class='fa fa-times'></i> Delete</a></td>";
					$cad.="</tr>";
				}
			}

		break;
	}

	function verify($e, $e2){
		$part_email = explode("@", $e);
		if("@".$part_email[1] == $e2){
			return true;
		}else{
			return false;
		}
	}

?>