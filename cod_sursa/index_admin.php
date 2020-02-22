<?php
include_once 'includes/dbh.inc.php';
if (session_status() != 2) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BAZE DE DATE</title>
        <link rel="stylesheet" type="text/css" href="css/indexCSS.css?version=51" >
    </head>
    <body>
        <!--bara de navigatie--> 
        <div class="sidebar">
                <center><img src="img/icon_car.png" width="60px" height="60px;"> </center><p>
                    <a href="index_admin.php"> HOME <img src="img/refresh_icon.png" width="15px" height="15px"></a> <p>
                    <a href="view.php"> VIEW <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="insert.php"> INSERT<img src="img/right_arrow.png" width="22px" height="18px"> </a> <p>
                    <a href="update.php"> UPDATE <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="delete.php"> DELETE <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="select.php"> SIMPLE SELECT <img src="img/right_arrow.png" width="20px" height="18px"></a> <p>
                     <a href="select_mediu.php"> MEDIUM SELECT <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="select_complex.php"> COMPLEX SELECT <img src="img/right_arrow.png" width="20px" height="18px"></a> <p>
                    <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >
                        LOG OUT <img src="img/logout.png" width="20px" height="20px"></a>
        </div>
        
        <div class="content">      
            <h2> <?php if (isset($_SESSION['username'])) : ?>
                    Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                <?php endif ?> </h2>
            <h3><i>Profile type: Administrator </h3> </i><br>
        <h4> Please select one of the sidebar buttons to view and/or modify the database.</h4>
    </div>
    <?php
    ?>

</body>
</html>
