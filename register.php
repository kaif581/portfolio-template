<?php 
include 'header.php'; 
// include 'function.php';
// echo randStr();
?>
<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6 formStyle">
           
            <!-- Form -->
            <form id="register_sign_up" class="signup_form " method ="POST" autocomplete="off">
                <h2>register here</h2>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control name" placeholder="First Name" requried />
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="username" class="form-control user_name" placeholder="Email Address" requried />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control pass_word" placeholder="Password" requried />
                </div>

                <div class="form-group">
                    <label>Mobile</label>
                    <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile" requried />
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control address" placeholder="Address" requried>
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control city" placeholder="City" requried>
                </div>
                
                <input type="submit" name="signup" class="btn signUp" value="sign up"/>
                <div class="form-msg" id="form-msg"></div>

            </form>
            <!-- /Form -->
        </div>
    </div>
</div>
<?php include 'footer.php';?>