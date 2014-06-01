<?php

include_once('../config/base.config.php');
include_once('../config/definitions.config.php');
include_once('../config/smarty.config.php');
include_once('../objects/MySqlDatabase.php');
include_once('../objects/Admin.php');

$admin = new Admin();
if ($admin->_authenticate('login')) {
    header ("location: index.php");
}

if(isset($_POST['submit'])){
    login_action();
}

function login_action() {
 
    //insufficient data provided
    if(!isset($_POST['username']) || $_POST['username'] == '' || !isset($_POST['password']) || $_POST['password'] == '') {
        header ("location: login.php");
    }
 
    //get the username and password
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
     
    $admin = new Admin();
    
    //check the database for username
    if($admin->_check_db($username, $password)) {
        //ready to login
        $_SESSION['admin_login'] = md5($username);
            setcookie('neuro_cms_admin', md5($username), time() + 30*24*60*60); 
            header("location: index.php");
    }
    else {
        header ("location: login.php");
    }
 
    die();
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Login form</title>
        <meta name="description" content="login" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script src="js/modernizr.custom.63321.js"></script>
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
        <style>
            @import url(http://fonts.googleapis.com/css?family=Ubuntu:400,700);
            body {
                background: #563c55 url(img/blurred.jpg) no-repeat center top;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
            }
            .container > header h1,
            .container > header h2 {
                color: #fff;
                text-shadow: 0 1px 1px rgba(0,0,0,0.7);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <div class="support-note">
                    <span class="note-ie" style="display:none">Sorry, only modern browsers.</span>
                </div>
            </header>

            <section class="main">
                <form class="form-3" action="login.php" method="post">
                    <p class="clearfix">
                        <label for="login">Username</label>
                        <input type="text" name="username" id="login" placeholder="Username">
                    </p>
                    <p class="clearfix">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"> 
                    </p>
                    <p class="clearfix">
                        <input type="submit" name="submit">
                    </p>       
                </form> 
            </section>

        </div>
    </body>
</html>