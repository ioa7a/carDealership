<?php
include_once 'includes/dbh.inc.php';
if (session_status() != 2) {
    session_start();
}

//daca utilizatorul nu este logat
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

//daca utilizatorul se delogheaza
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
//daca utilizatorul nu este administrator, va fi redirectionat la pagina principala
if (($_SESSION['isAdmin']) != 1) {
    header('location: index_user.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/indexCSS.css?version=51">
    </head>
    <body>

        <div class="sidebar">

                <center><img src="img/icon_car.png" width="60px" height="60px;"> </center><p>
                    <?php if (($_SESSION['isAdmin']) == 1) { ?>
                        <a href="index_admin.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                    <?php } else {
                        ?>
                        <a href="index_user.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                    <?php } ?>
                    <a href="view.php"> VIEW <img src="img/right_arrow.png" width="22px" height="18px"></a> <p>
                    <a href="delete.php"> REFRESH<img src="img/refresh_icon.png" width="15px" height="15px"> </a> <p>
                    <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >LOG OUT <img src="img/logout.png" width="20px" height="20px"></a>
                    </div>


            <div class="content">
                <h2> <?php if (isset($_SESSION['username'])) : ?>
                        Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                    <?php endif ?> </h2>

                    <!--  delete pentru tabelul model-->
                <h4>   Delete a car model by name. Complete other fields if necessary.  </h4>
                <div class="input-group">
                    <form action="#insert_model" method="POST">
                        <input type="text" name="Nume"  placeholder="MODEL" autocomplete="off">
                        <input type="text" name="Marca"  placeholder="MARCA"autocomplete="off">
                        <input type="text" name="TaraOrigine" placeholder="TARA DE ORIGINE" autocomplete="off" style="margin-right: 0px">
                        <input type="submit" name="insert_model" value="DELETE!" placeholder="insert values" style="margin-left: 0px">
                    </form>
                </div>

                <?php
                if (isset($_POST['insert_model'])) {
                    $nume = $_POST['Nume'];
                    $marca = $_POST['Marca'];
                    $tara = $_POST['TaraOrigine'];
                    //cautarea se face dupa numele modelului, si apoi dupa ceilalti
                    //parametri, daca sunt completate campurile respective
                    if ($nume == "") {
                        echo "Please insert the name of the model to delete it.";
                    } else {
                        $model_query = "DELETE FROM model
                                        WHERE model.Nume = '$nume'";

                        if ($marca != "") {
                            $model_query = $model_query."AND model.Marca = '$marca'";
                        }
                        if ($tara != "") {
                            $model_query = $model_query."AND model.Tara_Origine = '$tara'";
                        }

                        if (mysqli_query($conn, $model_query)) {
                            echo "Entry with name ".$nume." from Model successfully deleted.";
                        } else {
                            echo "Error: ".$model_query."<br>".mysqli_error($conn).". Please try again.";
                        }

                        //inchidere conexiune cu baza de date
                        mysqli_close($conn);
                    }
                }
                ?>
                <br>
                  <!--delete pentru tableul optional-->
                <h4> Delete an optional by name. Complete other fields if necessary: </h4>
                <div class="input-group">
                    <form action="#insert_optional" method="POST">
                        <input type="text" name="Nume" placeholder="NUME" autocomplete="off">
                        <select name="Categorie">
                            <option value="0">CATEGORIE</option>
                            <option value="1">Interior</option>
                            <option value="2">Exterior</option>
                            <option value="3">Siguranta</option>
                        </select>
                        <input type="text" name="Descriere" placeholder="DESCRIERE" autocomplete="off" style="margin-right: 0px">
                        <input type="submit" name="insert_optional" value="DELETE!" placeholder="insert values" style="margin-left: 0px">
                    </form>
                </div>

                <?php
                if (isset($_POST['insert_optional'])) {
                    $categorie = $_POST['Categorie'];
                    $nume = $_POST['Nume'];
                    $desc = $_POST['Descriere'];
                    //cautarea se face dupa numele modelului, si apoi dupa ceilalti
                    //parametri, daca sunt completate campurile respective
                    if ($nume == "") {
                        echo "Please insert the name of the optional to delete it.";
                    } else {
                        $model_query = "DELETE FROM optionale "
                                . "WHERE optionale.nume = '$nume'";
                        if ($categorie != 0) {
                            $model_query = $model_query." AND optionale.idCategorie = $categorie";
                        }
                        if ($desc != "") {
                            $model_query = $model_query." AND optionale.Descriere = '$desc'";
                        }
                        if (mysqli_query($conn, $model_query)) {
                            echo "Entry with name ".$nume." from Optionale successfully deleted.";
                        } else {
                            echo "Error: ".$model_query."<br>".mysqli_error($conn).". Please try again.";
                        }
                        //inchidere conexiune cu baza de date
                        mysqli_close($conn);
                    }
                }
                ?>
            </main>
    </body>
 </html>
