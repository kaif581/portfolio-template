<?php
include 'config.php'; 
include 'header.php';
 ?>
<div id="user_profile-content">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 formStyle">
                <!-- Form -->
                <form id="checkMail" method="POST">
                    <div class="signup_form">
                        <h2>Forget Password</h2>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control email" placeholder="Username"
                             requried>
                            
                        </div>
                        <input type="submit" name="signup" class="btn sendEmail" value="Send"/>
                        <div class="email-msg"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>