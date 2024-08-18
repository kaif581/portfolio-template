<?php
include 'config.php';
include 'header.php';

if(isset($_GET['id']) && $_GET['id']!=""){
    $db = new Database();
    $id = $db->escapeString($_GET['id']);
    $db->update('users',['status'=>1,'email_verify'=>1],"otp='{$id}'");
    $result = $db->getResult();
    if($result){
        echo "Email Verify";
    }
    else{
        echo "Not Verified Email";
    }
}
else{
    
    header('location','index.php');
}

?>
<div class="single-product-container">
<h2 class="section-head">Verify Email</h2>
</div>
<?php include 'footer.php'; ?>