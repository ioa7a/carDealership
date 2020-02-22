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

//daca utilizatorul nu are drepturi de administrator, este trimis la pagina
//principala
 if (($_SESSION['isAdmin'])!=1){
     header('location: index_user.php');
 }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>BAZE DE DATE</title>
        <link rel="stylesheet" type="text/css" href="css/indexCSS.css?version=51">
    </head>
    <body>

        <div class="sidebar">
                <center><img src="img/icon_car.png" width="60px" height="60px;"> </center><p>
                  <?php if (($_SESSION['isAdmin'])==1){ ?>
                    <a href="index_admin.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
              <?php  }
                 else { ?>
                     <a href="index_user.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                <?php } ?>
                    <a href="view.php"> VIEW <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="update.php"> REFRESH<img src="img/refresh_icon.png" width="15px" height="15px"> </a> <p>
                    <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >LOG OUT <img src="img/logout.png" width="20px" height="20px"></a>
                    </div>

              <div class="content">
            <h2> <?php if (isset($_SESSION['username'])) : ?>
                    Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                <?php endif ?> </h2>
            <?php
            ?>

            <!--update pentru model-->
            <h4>   Update a car model by name:  </h4>
            <div class="input-group">
                <form action="#insert_model" method="POST">
                    <input type="text" name="NumeVechi"  placeholder="NUME INITIAL" autocomplete="off">
                    <input type="text" name="Nume"  placeholder="NUME NOU" autocomplete="off">
                    <input type="text" name="Marca"  placeholder="MARCA"autocomplete="off">
                    <input type="text" name="TaraOrigine" placeholder="TARA DE ORIGINE" autocomplete="off" style="margin-right: 0px">
                    <input type="submit" name="insert_model" value="UPDATE!" placeholder="insert values" style="margin-left: 0px">
                </form>
            </div>

            <?php

            if(isset($_POST['insert_model'])) {
                $old = strval($_POST['NumeVechi']);
                $check = "SELECT * FROM model"
                        . "WHERE model.Nume = $old";
                if (is_bool(@mysqli_num_rows($check))) {
                    echo "The chosen entry does not exist in the database. Please try again.";
                } else {
                    $nume = $_POST['Nume'];
                    $marca = $_POST['Marca'];
                    $tara = $_POST['TaraOrigine'];
                    $model_query = "UPDATE model "
                        . "SET model.Nume = '$nume', model.Marca = '$marca', model.Tara_Origine = '$tara'"
                        . "WHERE model.Nume ='$old';";
                if (mysqli_query($conn,  $model_query)) {
                    echo "Entry with name ".$old." from Model successfully updated.";
                } else {
                    echo "Error: ".$model_query."<br>".mysqli_error($conn).". Please try again.";
                }

                mysqli_close($conn);
            }
            }
            ?>

            <!--update pentru optionale-->
            <br><h4> Update an optional by name: </h4>
            <div class="input-group">
                <form action="#insert_optional" method="POST">
                    <input type="text" name="NumeVechiOpt" placeholder="NUME INITIAL" autocomplete="off">
                    <select name="Categorie">
                        <option value="0">CATEGORIE</option>
                        <option value="1">Interior</option>
                        <option value="2">Exterior</option>
                        <option value="3">Siguranta</option>
                    </select>
                    <input type="text" name="NumeOpt" placeholder="NUME NOU" autocomplete="off">
                    <input type="text" name="Descriere" placeholder="DESCRIERE" autocomplete="off" style="margin-right: 0px">
                    <input type="submit" name="insert_optional" value="UPDATE!" placeholder="insert values" style="margin-left: 0px">
                </form>
            </div>

                        <?php
               if(isset($_POST['insert_optional'])){

                $old = $_POST['NumeVechiOpt'];
                $check = "SELECT * FROM optionale"
                        ."WHERE optionale.Nume = $old";
                $checkquerry = mysqli_query($log_in_conn,$check);
                if (is_bool(@mysqli_num_rows($checkquerry))) {
                    echo "The chosen entry does not exist in the database. Please try again.";
                } else {
                $categorie = $_POST['Categorie'];
                $nume = $_POST['NumeOpt'];
                $desc = $_POST['Descriere'];
                $model_query = "UPDATE optionale "
                        . "SET optionale.idCategorie = $categorie, optionale.Nume = '$nume', optionale.Descriere = '$desc'"
                        . " WHERE optionale.nume='$old';";
                if (mysqli_query($conn,  $model_query)) {
                    echo "Entry with ID ".$old." from Optionale successfully updated.";
                } else {
                    echo "Error: ".$model_query."<br>".mysqli_error($conn).". Please try again.";
                }

                mysqli_close($conn); }
            }
            ?>

        </main>
        </body>
        </html>
