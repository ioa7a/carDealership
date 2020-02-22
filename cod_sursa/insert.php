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
                    <a href="insert.php"> REFRESH<img src="img/refresh_icon.png" width="15px" height="15px"> </a> <p>
                    <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >LOG OUT <img src="img/logout.png" width="20px" height="20px"></a>
        </div>

        <div class="content">
            <h2> <?php if (isset($_SESSION['username'])) : ?>
                    Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                <?php endif ?> </h2>
            <?php
            //calculam urmatorul index al cheii primare pentru tabelul model, unde va fi inserata noua inregistrare
            $count_mod = "SELECT MAX(model.idModel) as MAX FROM model;";
            $results = mysqli_query($conn, $count_mod);
            $row = mysqli_fetch_assoc($results);
            $nr = $row['MAX'];
            $next = $nr + 1;
            //analog pentru tabelul optionale
            $count_op = "SELECT MAX(optionale.idOptional) as MAX FROM dealerauto.optionale;";
            $results2 = mysqli_query($conn, $count_op);
            $row2 = mysqli_fetch_assoc($results2);
            $nr2 = $row2['MAX'];
            $next2 = $nr2 + 1;
            ?>

            <!--insert pentru tabelul model-->
            <h4>   Insert a new car model:  </h4>
            <div class="input-group">
                <form action="#insert_model" method="POST">
                    <input type="text" name="Nume"  placeholder="NUME" autocomplete="off">
                    <input type="text" name="Marca"  placeholder="MARCA"autocomplete="off">
                    <input type="text" name="TaraOrigine" placeholder="TARA DE ORIGINE" autocomplete="off" style="margin-right: 0px">
                    <input type="submit" name="insert_model" value="INSERT!" placeholder="insert values" style="margin-left: 0px">
                </form>
            </div>

            <?php
            if(isset($_POST['insert_model'])){
                $nume = $_POST['Nume'];
                $marca = $_POST['Marca'];
                $tara = $_POST['TaraOrigine'];
                $model_query = "INSERT INTO model VALUES('$next','$nume','$marca','$tara')";
                if (mysqli_query($conn, $model_query)) {
                    echo "New entry inserted successfully in Model.";
                } else {
                    echo "Error: ".$model_query."<br>".mysqli_error($conn).". Please try again.";
                }
                mysqli_close($conn);
            }
            ?>
            <br>
            <!--insert pentru tabelul optionale-->
            <h4> Insert a new optional: </h4>
            <div class="input-group">
                <form action="#insert_optional" method="POST">
                    <select name="Categorie">
                        <option value="0">CATEGORIE</option>
                        <option value="1">Interior</option>
                        <option value="2">Exterior</option>
                        <option value="3">Siguranta</option>
                    </select>
                    <input type="text" name="Nume" placeholder="NUME" autocomplete="off">
                    <input type="text" name="Descriere" placeholder="DESCRIERE" autocomplete="off" style="margin-right: 0px">
                    <input type="submit" name="insert_optional" value="INSERT!" placeholder="insert values" style="margin-left: 0px">
                </form>
            </div>

            <?php
            if (isset($_POST['insert_optional'])) {
                $categorie = $_POST['Categorie'];
                $nume = $_POST['Nume'];
                $desc = $_POST['Descriere'];
                $model_query = "INSERT INTO optionale VALUES('$next2','$categorie','$nume','$desc')";
                if (mysqli_query($conn, $model_query)) {
                    echo "New entry inserted successfully in Optionale.";
                } else {
                    echo "Error: " . $model_query . "<br>" . mysqli_error($conn) . ". Please try again.";
                }
                mysqli_close($conn);
            }
            ?>

        </main>
    </body>
</html>
