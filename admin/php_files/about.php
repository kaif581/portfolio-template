<?php

	include 'database.php';


	if(isset($_POST['createAbout'])){

		if(!isset($_POST['userId']) || empty($_POST['userId'])){
			echo json_encode(['error' => 'User Name Field is Empty!']);
		}
		else if(!isset($_POST['sort_desc']) || empty($_POST['sort_desc'])){
			echo json_encode(['error' => 'Sort Description Field is Empty!']);
		}
		else if(!isset($_POST['desc']) || empty($_POST['desc'])){
			echo json_encode(['error' => 'Description Field is Empty!']);
		}
		else if(!isset($_FILES['profile']) || empty($_FILES['profile'])){
			echo json_encode(['error' => 'Profile Field is Empty!']);
		}
		else{

		$errors = [];
        /* get details of the uploaded file */
        $file_name = $_FILES['profile']['name'];
        $file_size = $_FILES['profile']['size'];
        $file_tmp = $_FILES['profile']['tmp_name'];
        $file_type = $_FILES['profile']['type'];
        $file_name = str_replace(array(',',' '),'',$file_name);
        $file_ext = explode('.',$file_name);
        $file_ext = strtolower(end($file_ext));
        $extensions = array("jpeg","jpg","png");
        if(in_array($file_ext,$extensions)=== false){
            $errors[]='<div class="alert alert-danger"> extension not allowed, please choose a JPEG or PNG file.</div>';
        }
        if($file_size > 2097152){
            $errors[]='<div class="alert alert-danger">File size must be exactely 2 MB</div>';
        }
        // check image errors
        if(!empty($errors)){
        	echo json_encode($errors); exit;
        }else{
        	
				$file_name = time().str_replace(array(' ','_'), '-', $file_name);

				$db = new Database();

				$userId = $db->escapeString($_POST['userId']);
				$sortDesc = $db->escapeString($_POST['sort_desc']);
				$desc = $db->escapeString($_POST['desc']);
				$profile = $db->escapeString($file_name);
				$db->insert('about',['user_id'=>$userId,'sort_desc'=>$sortDesc,
				'long_desc'=>$desc,'profile'=>$profile]);
				$response = $db->getResult();
				if(!empty($response)){
					move_uploaded_file($file_tmp,"../../profile/".$file_name);
					echo json_encode(['success'=>'About Add New Successful']);
				}
			}

		}


	}

	if(isset($_POST['status'])){
		
		$db = new Database();
		$id = $db->escapeString($_POST['id']);
		$status = $db->escapeString($_POST['statusData']);
		
		if($status == 1){
			$db->update('about',['status'=>0],"id={$id}");
		}
		else{
			$db->update('about',['status'=>1],"id={$id}");
		}

		$result = $db->getResult();
		if(!empty($result)){
			echo json_encode(['success'=>$result]);			
		}
		
	}

	if(isset($_POST['aboutDelete'])){
		$db = new Database();
		$id = $db->escapeString($_POST['id']);

		$db->delete('about',"id={$id}");
		$result = $db->getResult();
		if(!empty($result)){
			echo json_encode(['success'=>$result]);
		}
	}

	if(isset($_POST['updateAbout'])){
		// print_r($_POST);die;
	if(!empty($_POST['old_profile'])  && empty($_FILES['new_profile'])){
		$file_name = $_POST['old_profile'];
	}
	else if(!empty($_POST['old_profile']) && !empty($_FILES['new_profile']['name'])){
		$errors= array();
			/* get details of the uploaded file */
		$file_name = $_FILES['new_profile']['name'];
		$file_size =$_FILES['new_profile']['size'];
		$file_tmp =$_FILES['new_profile']['tmp_name'];
		$file_type=$_FILES['new_profile']['type'];
		$file_name = str_replace(array(',',' '),'',$file_name);
		$file_ext=explode('.',$file_name);
		$file_ext=strtolower(end($file_ext));
		$extensions= array("jpeg","jpg","png");
		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 2097152){
			$errors[]='File size must be excately 2 MB';
		}
		if(file_exists('../../profile/'.$_POST['old_profile'])){
			unlink('../../profile/'.$_POST['old_profile']);
		}
		$file_name = time().str_replace(array(' ','_'), '-', $file_name);

	}else if(empty($_POST['old_profile']) && !empty($_FILES['new_profile']['name'])){
		$errors= array();
			/* get details of the uploaded file */
		$file_name = $_FILES['new_profile']['name'];
		$file_size =$_FILES['new_profile']['size'];
		$file_tmp =$_FILES['new_profile']['tmp_name'];
		$file_type=$_FILES['new_profile']['type'];
		$file_name = str_replace(array(',',' '),'',$file_name);
		$file_ext=explode('.',$file_name);
		$file_ext=strtolower(end($file_ext));
		$extensions= array("jpeg","jpg","png");
		if(in_array($file_ext,$extensions)=== false){
			$errors[]="extension not allowed, please choose a JPEG or PNG file.";
		}
		if($file_size > 2097152){
			$errors[]='File size must be excately 2 MB';
		}
		$file_name = time().str_replace(array(' ','_'), '-', $file_name);
	}

	if(!empty($errors)){
		echo json_encode($errors); exit;
	}
	else{
		$db = new Database();
		$params = [
			'user_id'   =>  $db->escapeString($_POST['aboutId']),
			'sort_desc' =>  $db->escapeString($_POST['sort_desc']),
			'long_desc' =>  $db->escapeString($_POST['desc']),
			'profile'   =>  $db->escapeString($file_name),
		];

		$db->update('about',$params,"id='{$_POST['aboutId']}'");
                
		$response = $db->getResult();
		if(!empty($response)){

			if(!empty($_FILES['new_profile']['name'])){
				/* directory in which the uploaded file will be moved */
				move_uploaded_file($file_tmp,"../../profile/".$file_name);
			}
			echo json_encode(array('success'=>'About Updated Successfully.!')); exit;
		}
	}
		
	}

?>