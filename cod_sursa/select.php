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
                <?php if (($_SESSION['isAdmin']) == 1) { ?>
                    <a href="index_admin.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                <?php } else {
                    ?>
                    <a href="index_user.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                <?php } ?>
                <a href="select.php"> REFRESH <img src="img/refresh_icon.png" width="20px" height="20px"></a> <p>
                <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >LOG OUT
                    <img src="img/logout.png" width="20px" height="20px"></a>
        </div>

        <div class="content">
            <h2> <?php if (isset($_SESSION['username'])) : ?>
                    Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                <?php endif ?> </h2>
            <h4>SIMPLE SELECTS</h4>
            <!--meniu de tip tab cu interogari-->
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, '1')" >Filtrare masini dupa tara</button>
                <button class="tablinks" onclick="openCity(event, '2')">Filtrare optionale </button>
                <button class="tablinks" onclick="openCity(event, '3')">Caracteristici masina dupa marca</button>
                <button class="tablinks" onclick="openCity(event, '4')">Combustibil si putere dupa model </button>
                <button class="tablinks" onclick="openCity(event, '5')">Caracteristici masina dupa model </button>
                <button class="tablinks" onclick="openCity(event, '6')">Caracteristici fizice masina </button>
            </div>

            <!--SELECT 1-->
            <div id="1" class="tabcontent">
                Selectarea masinilor care provin dintr-o anumita tara:
                <div class="input-group">
                    <form action="#select" method="POST">
                        <select name="Tara" style="margin-right: 0px; background-color: whitesmoke">
                            <option value="Japonia">Japonia</option>
                            <option value="Coreea de Sud">Coreea de Sud</option>
                            <option value="Germania">Germania</option>
                            <option value="Romania">Romania</option>
                        </select>
                        <input type="submit" name="select_1" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
                    </form>
                </div>
                    <?php
                    if(isset($_POST['select_1'])) {
                        $tara = $_POST['Tara'];
                        $select = "SELECT model.nume as Model, model.Marca, masina.Combustibil, masina.Putere
                                    FROM model INNER JOIN masina on masina.idModel = model.idModel
                                    WHERE model.Tara_Origine='$tara';";

                        if (mysqli_query($conn, $select)) {
                            $result = mysqli_query($conn, $select);
                            echo "<br><table>";

                            echo "<b> <tr> <th>Model </th>
                                 <th>Marca </th>
                                  <th>Combustibil </th>
                                 <th>Putere(kW) </th>
                                  </tr></b>";
                            while ($row = mysqli_fetch_array($result)) {
                                $model = $row['Model'];
                                $marca = $row['Marca'];
                                $comb = $row['Combustibil'];
                                $pow = $row['Putere'];

                                echo "<tr> <td>";
                                echo $model . "</td><td> " . $marca . "</td><td> " . $comb . "</td><td>".$pow."</td>";

                            }
                               echo "</tr>";
                                echo "</table>";
                        } else {
                            echo "Error: " . $select . "<br>" . mysqli_error($conn) . ". Please try again.";
                        }
                    }
                    ?>
            </div>

            <!--SELECT 2-->
            <div id="2" class="tabcontent">
             Selectarea optionalelor in functie de categorie:
              <div class="input-group">
                    <form action="#select" method="POST">
                        <select name="Categorie" style="margin-right: 0px; background-color: whitesmoke">
                            <option value="Interior">Interior</option>
                            <option value="Exterior">Exterior</option>
                            <option value="Siguranta">Siguranta</option>

                        </select>
                        <input type="submit" name="select_2" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
                    </form>
               <table>
                    <?php
                     if(isset($_POST['select_2'])) {
                      $cat = $_POST['Categorie'];
                    $select = "SELECT optionale.nume, optionale.descriere, categorie_optionale.Nume as categorie
                               FROM optionale LEFT JOIN categorie_optionale ON optionale.idCategorie = categorie_optionale.idCategorie
                               WHERE categorie_optionale.Nume = '$cat';";
                    $result = mysqli_query($conn, $select);

                     echo "<b><tr><th>Categorie </th>
                                    <th>Nume </th>
                                  <th>Descriere </th></tr></b>";
                         while ($row = mysqli_fetch_array($result)) {
                         $cat = $row['categorie'];
                        $nume = $row['nume'];
                        $desc = $row['descriere'];
                        echo "<tr> <td>";
                        echo $cat."</td><td> ".$nume."</td><td> ".$desc."</td>";
                        echo "</tr>";
                    }
                     }
                    ?>
                    </table>
              </div>
            </div>

            <!--SELECT 3-->
            <div id="3" class="tabcontent">
            Selectarea caracteristicilor masinilor in functie de marca:
             <div class="input-group">
            <form action="#select" method="POST">
                <select name="Marca" style="margin-right: 0px; background-color: whitesmoke">
                    <option value="Toyota">Toyota</option>
                    <option value="Renault">Renault</option>
                    <option value="Honda">Honda</option>
                </select>
                </select>
                <input type="submit" name="select_3" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
            </form>
             </div>
            <table>
            <?php
            if (isset($_POST['select_3'])) {
                $marca = $_POST['Marca'];
                $select = "SELECT  model.Nume as Model, caracteristici_masina.*
                            FROM caracteristici_masina INNER JOIN masina ON masina.idCaracteristici = caracteristici_masina.idCaracteristici
                            INNER JOIN model ON model.idModel = masina.idModel
                            WHERE model.Marca = '$marca'";
                $result = mysqli_query($conn, $select);
                echo "<b><tr><th>Model </th>
                     <th>Culoare </th>
                     <th>Inaltime </th>
                     <th>Latime </th>
                     <th>Lungime </th>
                     <th>Numar Locuri </th>
                     <th>Capacitate Portbagaj </th>
                     <th>Volum Incarcare </th></tr></b>";
                while ($row = mysqli_fetch_array($result)) {
                    $model = $row['Model'];
                    $color = $row['Culoare'];
                    $h = $row['Inaltime'];
                    $lat = $row['Latime'];
                    $lung = $row['Lungime'];
                    $nr = $row['NumarLocuri'];
                    $cap = $row['CapacitatePortbagaj'];
                    $vol = $row['VolumIncarcare'];
                    echo "<tr> <td>";
                     if($cap == ""){
                          echo $model."</td><td> ".$color."</td><td>".$h."</td><td>".
                              $lat."</td><td> ".$lung."</td><td>".$nr."</td><td>".
                             "Unavailable</td><td>Unavailable</td>";
                      echo "</tr>";
                      } else {
                    echo $model . "</td><td> " . $color . "</td><td>" . $h . "</td><td>" .
                    $lat . "</td><td> " . $lung . "</td><td>" . $nr . "</td><td>" .
                     $cap . "</td><td>" . $vol . "</td>";
                    echo "</tr>";
                      }
                }
            }
            ?>
            </table>
            </div>

            <!--SELECT 4-->
            <div id="4" class="tabcontent">
                Selectarea modelelor de masini cu tipul de combustibil si puterea motorului:
                <table>
             <?php
             $select = "SELECT model.nume as Model, masina.Combustibil, masina.Putere
                        FROM masina INNER JOIN model ON masina.idModel = model.idModel;";
             $result = mysqli_query($conn, $select);
              echo "<b><tr><th>Model </th>
                     <th>Combustibil </th>
                     <th>Putere (kW) </th></tr></b>";
             while ($row = mysqli_fetch_array($result)) {
                 $model = $row['Model'];
                 $comb = $row['Combustibil'];
                 $pow = $row['Putere'];
                 echo "<tr> <td>";
                 echo $model . "</td><td> " . $comb . "</td><td>" . $pow . "</td>";
                 echo "</tr>";
             }
             ?>
                </table>
            </div>

            <!--SELECT 5-->
            <div id="5" class="tabcontent">
                Selectarea caracteristicilor masinilor din baza de date, cu model:
                <table>
                    <?php
                     $select = "SELECT  model.Nume as Model, caracteristici_masina.*
                            FROM caracteristici_masina INNER JOIN masina ON masina.idCaracteristici = caracteristici_masina.idCaracteristici
                            INNER JOIN model ON model.idModel = masina.idModel
                        ;";
                    $result = mysqli_query($conn, $select);
                    echo "<b><tr><th>Model </th>
                     <th>Culoare </th>
                     <th>Inaltime </th>
                     <th>Latime </th>
                     <th>Lungime </th>
                     <th>Numar Locuri </th>
                     <th>Capacitate Portbagaj </th>
                     <th>Volum Incarcare </th></tr></b>";
                while ($row = mysqli_fetch_array($result)) {
                    $model = $row['Model'];
                    $color = $row['Culoare'];
                    $h = $row['Inaltime'];
                    $lat = $row['Latime'];
                    $lung = $row['Lungime'];
                    $nr = $row['NumarLocuri'];
                    $cap = $row['CapacitatePortbagaj'];
                    $vol = $row['VolumIncarcare'];
                    echo "<tr> <td>";
                     if($cap == ""){
                          echo $model."</td><td> ".$color."</td><td>".$h."</td><td>".
                              $lat."</td><td> ".$lung."</td><td>".$nr."</td><td>".
                             "Unavailable</td><td>Unavailable</td>";
                      echo "</tr>";
                      } else {
                    echo $model . "</td><td> " . $color . "</td><td>" . $h . "</td><td>" .
                    $lat . "</td><td> " . $lung . "</td><td>" . $nr . "</td><td>" .
                    $cap . "</td><td>" . $vol . "</td>";
                    echo "</tr>";
                      }
                }
                    ?>

                </table>
            </div>

            <!--SELECT 6-->
            <div id="6" class="tabcontent">
                Selectarea caracteristicilor fizice ale masinilor, ordonate dupa marca:
                <table>
                    <?php
                    $select = "SELECT model.Marca, caracteristici_masina.Inaltime, caracteristici_masina.Latime, caracteristici_masina.Lungime
                                FROM model LEFT JOIN masina ON model.idModel = masina.idModel
                                INNER JOIN caracteristici_masina ON caracteristici_masina.idCaracteristici = masina.idCaracteristici";
                    $result = mysqli_query($conn, $select);
                    echo "<b><tr><th>Marca </th>
                     <th>Inaltime </th>
                     <th>Latime </th>
                     <th>Lungime </th></tr></b>";
                while ($row = mysqli_fetch_array($result)) {
                    $marca = $row['Marca'];
                    $h = $row['Inaltime'];
                    $lat = $row['Latime'];
                    $lung = $row['Lungime'];
                    echo "<tr> <td>";
                    echo $marca . "</td><td> " . $h . "</td><td>" .
                    $lat . "</td><td> " . $lung ."</td>";
                    echo "</tr>";
                }
                    ?>
                </table>
            </div>

        </div>

        <!--script pentru meniul de tip tab-->
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
