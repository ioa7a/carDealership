<?php
include_once 'includes/dbh.inc.php';
if (isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You are already logged in";
    if($_SESSION['isAdmin'] ==1){
         header('location: index_admin.php');
    }
    else {
        header('location: index_user.php');
        }
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/loginCSS.css?version=51">
    </head>
    <body>
    <center><img src="img/header_car.png" width="350", height="200"></center>
    <center><b>Please log in to view the database.</b></center>
        <form method="post" action="login.php" >

            <div class="input-group">
                <label> Username: </label>
                <input type="text" autocomplete="off" name="username" >
            </div>
            <div class ="input-group">
                <label> Password: </label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" name="login_user"> Login </button>
            </div>

        </form>
<!-- afisarea erorilor la logare -->
<?php  if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<?php echo $error ?>
		<?php endforeach ?>
	</div>
<?php  endif ?>

    </body>
</html>
