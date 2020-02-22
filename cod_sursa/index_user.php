<?php
include_once 'includes/dbh.inc.php';
if (session_status() != 2) {
    session_start();
}

// daca utilizatorul nu este logat, este trimis la pagina de login
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}

//in momentul in care utilizatorul se delogheaza, se incheie sesiunea si
//utilizatorul este trimis la pagina de login
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
        </style>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/indexCSS.css?version=51">
    </head>
    <body>

        <!--bara de navigatie-->
        <div class="sidebar">
            <form action="#submit" method="POST">
                <center><img src="img/icon_car.png" width="60px" height="60px;"> </center><p>
                    <a href="index_user.php"> HOME <img src="img/refresh_icon.png" width="15px" height="15px"></a> <p>
                    <a href="view.php"> VIEW <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="insert.php"> INSERT<img src="img/right_arrow.png" width="22px" height="18px"> </a> <p>
                    <a href="select.php"> SELECT <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="select_mediu.php"> MEDIUM SELECT <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="select_complex.php"> COMPLEX SELECT <img src="img/right_arrow.png" width="20px" height="18px"></a> <p>
                    <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >
                       LOG OUT <img src="img/logout.png" width="20px" height="20px"></a>
                    </div>
            </form>
            <?php
            ?>

            <div class="content">
                <h2> <?php if (isset($_SESSION['username'])) : ?>
                        Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                    <?php endif ?> </h2>
                <h3><i>Profile type: Normal User </h3> </i><br>
                <h4> Please select one of the sidebar buttons to view and/or modify the database.
                    <p>  Due to your profile type, you are not allowed to delete or update database entries.</h4>
            </content>
    </body>
</html>
