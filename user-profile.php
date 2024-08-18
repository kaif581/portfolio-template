<?php
session_start();
if(!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 'user') {
    header("Location: " . $hostname);
}
include 'header.php'; ?>
    <div id="user_profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6 formStyle">
                    <h2 class="section-head">My Profile</h2>
                    <?php
                        $user_id = $_SESSION["user_id"];
                        $db = new Database();
                        $db->select('users','*',null,"id = '{$user_id}' AND status=1",null,null);
                        $result = $db->getResult();
                        if (count($result) > 0) {
                            $table = '<table>';
                            foreach($result as $row) { ?>
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <td><b>Name :</b></td>
                                        <td><?php echo $row["name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email :</b></td>
                                        <td><?php echo $row["email"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile :</b></td>
                                        <td><?php echo $row["mobile"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address :</b></td>
                                        <td><?php echo $row["address"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>City :</b></td>
                                        <td><?php echo $row["city"]; ?></td>
                                    </tr>
                                </table>
                            <?php }
                        }
                        ?>
                        <a class="modify-btn btn" href="edit-user.php?user=<?php echo $_SESSION['user_id']; ?>">Modify Details</a>
                        <a class="modify-btn btn" href="change_password.php">Change Password</a>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';
?>
  