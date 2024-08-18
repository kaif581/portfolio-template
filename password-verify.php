<?php
include 'config.php'; 
include 'header.php';
 ?>
<div id="user_profile-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 formStyle">
                <!-- Form -->
                <form id="verifyPassword" method="POST">
                    <div class="signup_form">
                        <h2>Set Password</h2>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" id="password" placeholder="New Password"
                             requried>
                            
                        </div>
                        <div class="form-group">
                            <label>Conform Password</label>
                            <input type="password" class="form-control password" id="confpassword" placeholder="Conform Password"
                             requried>
                            <i class="fa fa-eye togglePassword" id="togglePassword"></i>
                        </div>
                        <input type="submit" name="signup" class="btn sendEmail" value="Update"/>
                        <div class="email-msg"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>