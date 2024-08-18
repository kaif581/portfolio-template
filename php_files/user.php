<?php
	include '../config.php';
	// echo '1'; exit;
	include '../function.php';
	include '../smtp/PHPMailerAutoload.php';
	session_start();

	if(isset($_POST['create'])){
		if(!isset($_POST['name']) || empty($_POST['name'])){
			echo json_encode(array('error'=>'First Name Field Empty.')); exit;
		}else if(!isset($_POST['username']) || empty($_POST['username'])){
			echo json_encode(array('error'=>'Username Field Empty.')); exit;
		}else if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
		  	echo json_encode(array('error'=>'Please Enter Correct Email Address.')); exit;
		}else if(!isset($_POST['password']) || empty($_POST['password'])){
			echo json_encode(array('error'=>'Password Field Empty.')); exit;
		}else if(!isset($_POST['mobile']) || empty($_POST['mobile'])){
			echo json_encode(array('error'=>'Mobile Number Field Empty.')); exit;
		}else if(!isset($_POST['address']) || empty($_POST['address'])){
			echo json_encode(array('error'=>'Address Field Empty.')); exit;
		}else if(!isset($_POST['city']) || empty($_POST['city'])){
			echo json_encode(array('error'=>'City Field Empty.')); exit;
		}else{
			$db = new Database();
			$rand_str = randStr();
			$params = [
				'name' => $db->escapeString($_POST['name']),
				'email' => $db->escapeString($_POST['username']),
				'password' => md5($db->escapeString($_POST['password'])),
				'mobile' => $db->escapeString($_POST['mobile']),
				'address' => $db->escapeString($_POST['address']),
				'city' => $db->escapeString($_POST['city']),
				'otp'  => $rand_str,
			];

			$db->select('users','email',null,"email = '{$params["email"]}'",null,null);
			$exist = $db->getResult();
			if(!empty($exist)){
				echo json_encode(array('error'=>'Email Already Exists.'));
			}else{
				$db->insert('users',$params);
				$response = $db->getResult();
				$userId = $rand_str;
				$userEmail = $params['email'];
				$html = $hostname."/verify.php?id={$userId}";
				sendEmail($userEmail, $html,'Verify Email');

				if(is_numeric($response[0])){
					$_SESSION["user_id"] = $response[0]; /* userid of the user */
	            	$_SESSION["username"] = $params['name'];
	            	$_SESSION["status"] = 'user'; /* for user */
					echo json_encode(array('success'=>'Thank you for register. Please check your email id, to verify your account'));
				}
				else{
					echo json_encode(array('error'=>$response));
				}
			}
		}
	}
	

	if(isset($_POST['login'])){
		if(!isset($_POST['username']) || empty($_POST['username'])){
			echo json_encode(array('error'=>'Username Foeld is Empty.')); exit;
		}elseif(!isset($_POST['password']) || empty($_POST['password'])){
			echo json_encode(array('error'=>'Passowrd Foeld is Empty.')); exit;
		}else{
			$db = new Database();

			$username = $db->escapeString($_POST['username']);
			$password = md5($db->escapeString($_POST['password']));
			$db->select('users','*',null,"email = '{$username}' AND password = '{$password}'",null,null);
			$response = $db->getResult();
			if(!empty($response)){
				if($response > 1){
		            foreach($response as $row){
						$status = $row['status'];
						$emailVerify = $row['email_verify'];
						if($emailVerify==1){
							if($status == 1){
								$_SESSION["user_id"] = $row['id']; /* userid of the user */
								$_SESSION["username"] = $row['name'];
								$_SESSION["user_role"] = 'user'; /* for user */
								echo json_encode(array('success'=>'Logged In Successfully.')); exit;
							}
							else{
								echo json_encode(['error' => 'Your account has been blocked.']);
							}
						}
						else{
							echo json_encode(['error' => 'Please verify your email id']);
						}
		            }
		            
				}else{
					echo json_encode(array('error'=>'Username and Password not matched.')); exit;
				}
			}else{
				echo json_encode(array('error'=>'Username and Password not matched.')); exit;
			}
		}
	}


	if(isset($_POST['user_logout'])){
	    session_unset();
	    /* destroy the session */
	    session_destroy();

	    echo 'true'; exit;
	}

	if(isset($_POST['update'])){
		if(!isset($_POST['name']) || empty($_POST['name'])){
			echo json_encode(array('error'=>'First Name Field Empty.')); exit;
		}else if(!isset($_POST['mobile']) || empty($_POST['mobile'])){
			echo json_encode(array('error'=>'Mobile Number Field Empty.')); exit;
		}else if(!isset($_POST['address']) || empty($_POST['address'])){
			echo json_encode(array('error'=>'Address Field Empty.')); exit;
		}else if(!isset($_POST['city']) || empty($_POST['city'])){
			echo json_encode(array('error'=>'City Field Empty.')); exit;
		}else{
			$db = new Database();

			$params = [
				'name' => $db->escapeString($_POST['name']),
				'mobile' => $db->escapeString($_POST['mobile']),
				'address' => $db->escapeString($_POST['address']),
				'city' => $db->escapeString($_POST['city'])
			];


			if(!session_id()){
				session_start();
			}
			$user_id = $_SESSION['user_id'];
			$db->update('users',$params,"id = '{$user_id}'");
			$response = $db->getResult();
			if(!empty($response)){
				echo json_encode(array('success'=>$response)); exit;
			}
			
		}
	}

	if(isset($_POST['modifyPass'])){
		// echo '1'; exit;
		if(!isset($_POST['old_pass']) || empty($_POST['old_pass'])){
			echo json_encode(array('error'=>'Old Passowrd field Empty')); exit;
		}elseif(!isset($_POST['new_pass']) || empty($_POST['new_pass'])){
			echo json_encode(array('error'=>'New Passowrd field Empty')); exit;
		}else{
			$db = new Database();

			$old = md5($db->escapeString($_POST['old_pass']));
			$new = md5($db->escapeString($_POST['new_pass']));

			if(!session_id()){ session_start(); }

			$user_id = $_SESSION['user_id'];

			$db->select('user','user_id',null,"user_id = '{$user_id}' AND password = '{$old}'",null,null);
			$exist = $db->getResult();

			if(!empty($exist)){
				$response = $db->update('user',array('password'=>$new),"user_id = '{$user_id}' AND password = '{$old}'");
				if(!empty($response)){
					echo json_encode(array('success'=>'success')); exit;
				}else{
					echo json_encode(array('error'=>'Password not changed.')); exit;
				}

			}else{
				echo json_encode(array('error'=>'Old Password is not matched.')); exit;
			}
		}
	}

	if(isset($_POST['mail'])){
		$db = new Database();

		$email = $db->escapeString($_POST['email']);
		$db->select('users','*',null,"email='{$email}'",null,'');
		$result = $db->getResult();

		foreach($result as $row){
			$sendEmail = $row['email'];
			$page = $hostname."/password-verify.php";
		}
		if($sendEmail){
			sendEmail($sendEmail,$page,'Set Password');
			echo json_encode(['success'=>'Please check your email'.' '.$sendEmail]);
		}
		
		else{
			echo json_encode(['error'=>'Your EMail not register in your account']);
		}
		
	}

	if(isset($_POST['verifypass'])){
		$db = new Database();
		$password = md5($db->escapeString($_POST['password']));
		$db->update('users',['password'=>$password],null);
		$result = $db->getResult();
		if(empty($result)){
			echo json_encode(['error' => 'Your Password not Set']);
		}
		else{
			echo json_encode(['success' => 'Your Password has been update']);
			
		}
	}


?>