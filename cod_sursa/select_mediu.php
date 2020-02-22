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

        <!--bara de navigatie-->
        <div class="sidebar">
            <center><img src="img/icon_car.png" width="60px" height="60px;"> </center><p>
                <?php if (($_SESSION['isAdmin']) == 1) { ?>
                    <a href="index_admin.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                <?php } else {
                    ?>
                    <a href="index_user.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                <?php } ?>
                <a href="select_mediu.php"> REFRESH <img src="img/refresh_icon.png" width="20px" height="20px"></a> <p>
                <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >LOG OUT
                    <img src="img/logout.png" width="20px" height="20px"></a>
        </div>

         <div class="content">
            <h2> <?php if (isset($_SESSION['username'])) : ?>
                    Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                <?php endif ?> </h2>
            <h3><i>Profile type: Administrator </h3> </i><br>
                    <h4>COMPLEX SELECTS</h4>
            <!--meniu tip tab-->
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, '1')" style="width: 260px">Optionale pentru masini intr-o anumita culoare</button>
                <button class="tablinks" onclick="openCity(event, '2')" style="width: 260px">Masini albe cu un anumit tip de optionale</button>
                <button class="tablinks" onclick="openCity(event, '3')"style="width: 260px">Selectare marca masina si categorie optionale</button>
                <button class="tablinks" onclick="openCity(event, '4')"style="width: 260px">Selectare marca si culoare</button>
            </div>

            <!--SELECT 1-->
            <div id="1" class="tabcontent">
                Selectarea optionalelor de interior pentru masini intr-o anumita culoarea:
                <div class="input-group">
                    <!--lista culori-->
                    <form action="#select" method="POST">
                        <select name="Culoare" style="margin-right: 0px; background-color: whitesmoke">
                            <option value="Alb " style="background-color: whitesmoke;">Alb</option>
                            <option value="Albastru" style="background-color: #7ab6de;">Albastru</option>
                            <option value="Argintiu" style="background-color: silver;">Argintiu</option>
                            <option value="Bej" style="background-color: beige;"> Bej</option>
                            <option value="Bronz" style="background-color: goldenrod;">Bronz</option>
                            <option value="Galben" style="background-color: yellow;">Galben</option>
                            <option value="Gri" style="background-color: gray;">Gri</option>
                            <option value="Magenta" style="background-color: magenta;">Gri</option>
                            <option value="Negru" style="background-color: black; color: whitesmoke">Negru</option>
                            <option value="Rosu" style="background-color: crimson;">Rosu</option>
                            <option value="Roz" style="background-color: pink;">Roz</option>
                            <option value="Verde" style="background-color: #318b61;">Verde</option>

                        </select>
                        <input type="submit" name="select_1" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
                    </form>
                    <?php

                    if(isset($_POST['select_1'])) {
                        $color = $_POST['Culoare'];
                        $select = "SELECT optionale.nume as Optional, model.Nume as Model, caracteristici_masina.Culoare
                               FROM masina INNER JOIN model ON masina.idModel = model.idModel
                                          INNER JOIN optionale_masina ON masina.idMasina = optionale_masina.idMasina
                                          INNER JOIN optionale ON optionale.idOptional = optionale_masina.idOptional
                                          INNER JOIN caracteristici_masina ON caracteristici_masina.idCaracteristici = masina.idCaracteristici
                               WHERE optionale.idCategorie = 1 AND caracteristici_masina.culoare LIKE '$color%';";

                        if (mysqli_query($conn, $select)) {
                            $result = mysqli_query($conn, $select);
                            echo "<br><table>";

                            echo "<b> <tr> <th>Optional </th>
                                 <th>Model </th>
                                 <th>Culoare </th>
                                 </tr></b>";
                            while ($row = mysqli_fetch_array($result)) {
                                $opt = $row['Optional'];
                                $model = $row['Model'];
                                $color = $row['Culoare'];
                                echo "<tr> <td>".$opt."</td><td> ".$model."</td><td> ".$color."</td>";
                            }
                             echo "</tr> </table>";
                        } else {
                            echo "Error: ".$select ."<br>". mysqli_error($conn).". Please try again.";
                        }
                    }
                    ?>
                </div>

            </div>

            <!--SELECT 2-->
            <div id="2" class="tabcontent">
          Selectarea unui tip de optionale pentru masini de culoarea alba:
          <div class="input-group">
              <!--lista categorii-->
              <form action="#select" method="POST">
                  <select name="Categorie" style="margin-right: 0px; background-color: whitesmoke">
                      <option value="1">Interior</option>
                      <option value="2">Exterior</option>
                      <option value="3">Siguranta</option>
                  </select>
                  <input type="submit" name="select_2" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
              </form>
          </div>
          <table>
              <?php
               if(isset($_POST['select_2'])) {
                        $cat = $_POST['Categorie'];
                        $select = "SELECT optionale.nume as Optional, model.Nume as Model, caracteristici_masina.Culoare
                               FROM masina INNER JOIN model ON masina.idModel = model.idModel
                                          INNER JOIN optionale_masina ON masina.idMasina = optionale_masina.idMasina
                                          INNER JOIN optionale ON optionale.idOptional = optionale_masina.idOptional
                                          INNER JOIN caracteristici_masina ON caracteristici_masina.idCaracteristici = masina.idCaracteristici
                               WHERE optionale.idCategorie = $cat AND caracteristici_masina.culoare LIKE 'Alb %';";

                        if (mysqli_query($conn, $select)) {
                            $result = mysqli_query($conn, $select);
                            echo "<br><table>";

                            echo "<b> <tr> <th>Optional </th>
                                 <th>Model </th>
                                  <th>Culoare </th>
                                  </tr></b>";
                            while ($row = mysqli_fetch_array($result)) {
                                $opt = $row['Optional'];
                                $model = $row['Model'];
                                $color = $row['Culoare'];
                                echo "<tr> <td>".$opt."</td><td> ".$model."</td><td> ".$color."</td>";
                             }
                             echo "</tr> </table>";
                        } else {
                            echo "Error: ".$select ."<br>". mysqli_error($conn).". Please try again.";
                        }
                    }
                    ?>
          </table>
            </div>

            <!--SELECT 3-->
            <div id="3" class="tabcontent">
                Selectarea unui anumit tip de optionale, pentru o anumita marca de masina:
                <div class="input-group">
                    <!--lista categorii-->
                    <form action="#select" method="POST">
                        <select name="Categorie" style="margin-right: 0px; background-color: whitesmoke">
                            <option value="1">Interior</option>
                            <option value="2">Exterior</option>
                            <option value="3">Siguranta</option>
                        </select>
                        <!--lista marci-->
                        <select name="Marca" style="margin-right: 0px; background-color: whitesmoke">
                            <option value="All">All brands</option>
                            <option value="Audi">Audi</option>
                            <option value="Baojun">Baojun</option>
                            <option value="Chevrolet">Chevrolet</option>
                            <option value="Citroen">Citroen</option>
                            <option value="Dacia">Dacia</option>
                            <option value="Ford">Ford</option>
                            <option value="Jeep">Jeep</option>
                            <option value="Kia">Kia</option>
                            <option value="Maruti Dzire">Maruti Dzire</option>
                            <option value="Mazda">Mazda</option>
                            <option value="Nissan">Nissan</option>
                            <option value="Opel">Opel</option>
                            <option value="Peugeot">Peugeot</option>
                            <option value="Roewe">Roewe</option>
                            <option value="Subaru">Subaru</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Volkswagen">Volkswagen</option>
                        </select>
                        <input type="submit" name="select_3" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
                    </form>
                </div>
                <table>
                    <?php
                    if (isset($_POST['select_3'])) {
                        $cat = $_POST['Categorie'];
                        $marca = $_POST['Marca'];
                        if ($marca == "All"){
                            $select = "SELECT optionale.nume as Optional, model.Nume as Model, caracteristici_masina.Culoare
                               FROM masina RIGHT JOIN model ON masina.idModel = model.idModel
                                          INNER JOIN optionale_masina ON masina.idMasina = optionale_masina.idMasina
                                          INNER JOIN optionale ON optionale.idOptional = optionale_masina.idOptional
                                          INNER JOIN caracteristici_masina ON caracteristici_masina.idCaracteristici = masina.idCaracteristici
                                          WHERE optionale.idCategorie = $cat";
                        } else{
                        $select = "SELECT optionale.nume as Optional, model.Nume as Model, caracteristici_masina.Culoare
                               FROM masina INNER JOIN model ON masina.idModel = model.idModel
                                          INNER JOIN optionale_masina ON masina.idMasina = optionale_masina.idMasina
                                          INNER JOIN optionale ON optionale.idOptional = optionale_masina.idOptional
                                          INNER JOIN caracteristici_masina ON caracteristici_masina.idCaracteristici = masina.idCaracteristici
                               WHERE optionale.idCategorie = $cat AND model.marca ='$marca'";
                        }
                        if (mysqli_query($conn, $select)) {
                            $result = mysqli_query($conn, $select);
                            echo "<br><table>";

                            echo "<b> <tr> <th>Optional </th>
                                 <th>Model </th>
                                  <th>Culoare </th>
                                  </tr></b>";
                            while ($row = mysqli_fetch_array($result)) {
                                $opt = $row['Optional'];
                                $model = $row['Model'];
                                $color = $row['Culoare'];
                                echo "<tr> <td>" . $opt . "</td><td> " . $model . "</td><td> " . $color . "</td>";
                            }
                            echo "</tr> </table>";
                        } else {
                            echo "Error: " . $select . "<br>" . mysqli_error($conn) . ". Please try again.";
                        }
                    }
                    ?>
                </table>
            </div>

            <!--SELECT 4-->
            <div id="4" class="tabcontent">
                Selectarea unui anumite marci de masina, de o anumita culoare:
                <div class="input-group">
                    <form action="#select" method="POST">
                    <!--lista marci-->
                        <select name="Marca" style="margin-right: 0px; background-color: whitesmoke">
                            <option value="All" style="background-color: whitesmoke;">All brands</option>
                            <option value="Audi">Audi</option>
                            <option value="Baojun">Baojun</option>
                            <option value="Chevrolet">Chevrolet</option>
                            <option value="Citroen">Citroen</option>
                            <option value="Dacia">Dacia</option>
                            <option value="Ford">Ford</option>
                            <option value="Jeep">Jeep</option>
                            <option value="Kia">Kia</option>
                            <option value="Maruti Dzire">Maruti Dzire</option>
                            <option value="Mazda">Mazda</option>
                            <option value="Nissan">Nissan</option>
                            <option value="Opel">Opel</option>
                            <option value="Peugeot">Peugeot</option>
                            <option value="Roewe">Roewe</option>
                            <option value="Subaru">Subaru</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Volkswagen">Volkswagen</option>
                        </select>
                    <!--lista culori-->
                    <select name="Culoare" style="margin-right: 0px; background-color: whitesmoke">
                        <option value="Alb " style="background-color: whitesmoke;">Alb</option>
                        <option value="Albastru" style="background-color: #7ab6de;">Albastru</option>
                        <option value="Argintiu" style="background-color: silver;">Argintiu</option>
                        <option value="Bej" style="background-color: beige;"> Bej</option>
                        <option value="Bronz" style="background-color: goldenrod;">Bronz</option>
                        <option value="Galben" style="background-color: yellow;">Galben</option>
                        <option value="Gri" style="background-color: gray;">Gri</option>
                        <option value="Magenta" style="background-color: magenta;">Gri</option>
                        <option value="Negru" style="background-color: black; color: whitesmoke">Negru</option>
                        <option value="Rosu" style="background-color: crimson;">Rosu</option>
                        <option value="Roz" style="background-color: pink;">Roz</option>
                        <option value="Verde" style="background-color: #318b61;">Verde</option>
                    </select>
                    <input type="submit" name="select_4" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
                    </form>
                    <table>
                        <?php
                        if (isset($_POST['select_4'])) {
                            $color = $_POST['Culoare'];
                            $marca = $_POST['Marca'];
                               if ($marca == "All"){
                            $select = "SELECT optionale.nume as Optional, model.Nume as Model, caracteristici_masina.Culoare
                               FROM masina RIGHT JOIN model ON masina.idModel = model.idModel
                                          INNER JOIN optionale_masina ON masina.idMasina = optionale_masina.idMasina
                                          INNER JOIN optionale ON optionale.idOptional = optionale_masina.idOptional
                                          INNER JOIN caracteristici_masina ON caracteristici_masina.idCaracteristici = masina.idCaracteristici
                               WHERE caracteristici_masina.culoare  LIKE '$color%'
                               ORDER BY Model;";
                        } else{
                            $select = "SELECT optionale.nume as Optional, model.Nume as Model, caracteristici_masina.Culoare
                               FROM masina INNER JOIN model ON masina.idModel = model.idModel
                                          INNER JOIN optionale_masina ON masina.idMasina = optionale_masina.idMasina
                                          INNER JOIN optionale ON optionale.idOptional = optionale_masina.idOptional
                                          INNER JOIN caracteristici_masina ON caracteristici_masina.idCaracteristici = masina.idCaracteristici
                               WHERE model.Marca = '$marca' AND caracteristici_masina.culoare LIKE '$color%';";
                        }
                            if (mysqli_query($conn, $select)) {
                                $result = mysqli_query($conn, $select);
                                echo "<br><table>";

                                echo "<b> <tr> <th>Optional </th>
                                 <th>Model </th>
                                  <th>Culoare </th>
                                  </tr></b>";
                                while ($row = mysqli_fetch_array($result)) {
                                    $opt = $row['Optional'];
                                    $model = $row['Model'];
                                    $color = $row['Culoare'];
                                    echo "<tr> <td>".$opt . "</td><td> " . $model . "</td><td> " . $color . "</td>";
                                }
                                echo "</tr> </table>";
                            } else {
                                echo "Error: " . $select . "<br>" . mysqli_error($conn) . ". Please try again.";
                            }
                        }
                        ?>
                    </table>
                </div>

            </div>

            <!-- functie javascript pentru meniul de tip tab -->
            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                }
            </script>
                </main>
                </body>
                </html>
