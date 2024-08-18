<?php 
    include 'config.php';
    $db = new Database();
    $db->select('options','site_name,site_logo');
    $header = $db->getResult();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php if(isset($title)){ ?>
        <title><?php echo $title; ?></title>
    <?php }else{ ?>
        <title>Portfolio</title>
    <?php } ?>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900" rel="stylesheet">
   
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/style-font.css">

    <!--boxicons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--end boxicons-->
    <!--fontawsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!--swiper css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!--End swiper css-->
    
</head>
<body>
<!-- HEADER -->
<!---Header Design--->
<header class="header">
    <a href="#" class="logo">Create Portfolio</a>
    <nav class="navbar">
    <a href="#home" class="active">Home</a>

        <?php 
            $db = new Database();
            $db->select('menu','*','',"status=1",'','');
            $menu = $db->getResult();
            
            foreach($menu as $row){
                ?>
                    <a href="<?php echo $row['menu_title'] ?>"><?php echo $row['menu_name'] ?></a>
                <?php
            }
        ?>
        
        <div class="logo">
            <ul class="header-info">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if(isset($_SESSION["user_role"])){ ?>
                            Hello <?php echo $_SESSION["username"]; ?><i class="caret"></i>
                        <?php  }else{ ?>
                            <i class="fa fa-user"></i>
                        <?php  } ?>

                    </a>
                    <ul class="dropdown-menu">
                        <!-- Trigger the modal with a button -->
                        <?php
                            if(isset($_SESSION["user_role"])){ ?>
                                <li><a href="user-profile.php" class="" >My Profile</a></li>
                                <li><a href="javascript:void()" class="user_logout" >Logout</a></li>
                        <?php  }else{ ?>
                                <li><a data-toggle="modal" data-target="#userLogin_form" href="#">login</a></li>
                                <li><a href="register.php">Register</a></li>
                            <?php  } ?>

                    </ul>
                </li>
            </ul>
 
        </div>
        <div class="bx bx-moon" id="darkMode-icon"></div>
    </nav>
    <div class="bx bx-menu" id="menu-icon"></div>
</header>
<!---End Header Design--->

<!-- Modal -->
<div class="modal fade" id="userLogin_form" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-body">
                            <!-- Form -->
                            <form  id="loginUser" method ="POST">
                                <div class="customer_login"> 
                                    <h2>login here</h2>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="email" class="form-control username" placeholder="Username" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control password" placeholder="password" autocomplete="off" required>
                                    </div>
                                    <input type="submit" name="login" class="btn" value="login"/>
                                    <span>Don't Have an Account <a href="register.php">Register</a> &nbsp; &nbsp; <a href="forget-password.php">Forget Password</a></span>
                                </div>
                            </form>
                            <!-- /Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->