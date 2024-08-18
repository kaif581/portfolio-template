<?php
include 'config.php';
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
include 'header.php'; ?>
<div id="user_profile-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 formStyle">
                <?php
                $user = $_GET['user'];

                $db = new Database();
                $db->select('users','*',null,"id= '{$user}'",null,null);
                $result = $db->getResult();
                if(count($result) > 0) { ?>
                    <!-- Form -->
                    <form id="modify-user" method="POST">
                        <div class="signup_form">
                            <h2>Modify Profile</h2>
                            <?php foreach($result as $row){ ?>
                                <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Username"
                                       value="<?php echo $row['email']; ?>" disabled requried>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control f_name"
                                placeholder="First Name" value="<?php echo $row['name']; ?>" requried>
                            </div>
                           
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile"
                                       value="<?php echo $row['mobile']; ?>" requried>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control address" placeholder="Address"
                                       value="<?php echo $row['address']; ?>" requried>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control city" placeholder="City" value="<?php echo $row['city']; ?>" requried>
                            </div>
                            <input type="submit" name="signup" class="btn" value="Modify"/>
                        <?php  } ?>
                        </div>
                    </form>
                    <!-- /Form -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';
}
?>