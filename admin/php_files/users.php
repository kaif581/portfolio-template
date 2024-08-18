<?php 
include 'database.php';

if(isset($_POST['status'])){
    $db = new Database();
    $id = $db->escapeString($_POST['id']);
    $status = $db->escapeString($_POST['statusData']);
    
    if($status == 1){
        $db->update('users',['status'=>0],"id={$id}");
    }
    else{
        $db->update('users',['status'=>1],"id={$id}");
    }

    $result = $db->getResult();
    if(!empty($result)){
        echo json_encode(['success'=>$result]);			
    }    
}

if(isset($_POST['delete'])){
    $db = new Database();
    $id = $db->escapeString($_POST['id']);
    $db->delete('users',"id='{$id}'");
    $result = $db->getResult();
    if(!$result){
        echo json_encode(['error' => 'User Not Delete']);
    }
    else{
        echo json_encode(['success' => 'User Delete']);
    }
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

?>