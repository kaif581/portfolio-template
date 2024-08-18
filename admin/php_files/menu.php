<?php 
include 'database.php';

if(isset($_POST['createMenu']) && $_POST['createMenu']>0){
    $db = new Database();
    $menu_name = $db->escapeString($_POST['menu_name']);
    $menu_title = $db->escapeString($_POST['menu_title']);
    $db->select('menu','menu_name',"","menu_name='$menu_name'","","");
    $result = $db->getResult();
    if(count($result)>0){
        echo json_encode(['error'=>'Menu Name Already Exists']);
    }
    else{
        $db->insert('menu',['menu_title'=>$menu_title,'menu_name'=>$menu_name]);
        $result = $db->getResult();
        if($result>0){
            echo json_encode(['success'=>'Menu Create Succfull']);
        }
        else{
            echo json_encode(['error'=>'Menu Create Failed']);
        }
    }
    
}

if(isset($_POST['status']) && $_POST['status']>0){
    $db = new Database();
    $id = $db->escapeString($_POST['id']);
    $dataStatus = $db->escapeString($_POST['dataStatus']);

    if($dataStatus==1){
        $db->update('menu',['status'=>0],"id='$id'");
        $result = $db->getResult();
    }
    else{
        $db->update('menu',['status'=>1],"id='$id'");
        $result = $db->getResult();
    }
    echo json_encode(['success'=>$result]);
}

if(isset($_POST['deleteMenu']) && $_POST['deleteMenu']>0){
    $db = new Database();
    $id = $db->escapeString($_POST['id']);

    $db->delete('menu',"id=$id");
    $result = $db->getResult();
    if($result>0){
        echo json_encode(['success'=>$result]);
    }
}

if(isset($_POST['update']) && $_POST['update']>0){
    $db = new Database();
    $id = $db->escapeString($_POST['id']);
    $menuname = $db->escapeString($_POST['menuname']);
    $menutitle = $db->escapeString($_POST['menutitle']);

    $db->update('menu',['menu_name'=>$menuname,'menu_title'=>$menutitle],"id={$id}");
    $result = $db->getResult();
    if($result>0){
        echo json_encode(['success'=>'Menu Updated Successfull']);
    }
    else{
        echo json_encode(['error'=>'Menu Updated Failed']);
    }
}
?>