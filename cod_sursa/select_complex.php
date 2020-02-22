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
                <a href="select_complex.php"> REFRESH <img src="img/refresh_icon.png" width="20px" height="20px"></a> <p>
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
                <button class="tablinks" onclick="openCity(event, '1')" style="width: 260px">Masini cu cel putin doua optionale, cu o anumita putere</button>
                <button class="tablinks" onclick="openCity(event, '2')" style="width: 260px">Masini din Asia, de o anumita culoare</button>
                <button class="tablinks" onclick="openCity(event, '3')"style="width: 260px">Medie caracteristici in functie de marca</button>
                <button class="tablinks" onclick="openCity(event, '4')"style="width: 260px"></button>
            </div>

            <!--SELECT 1-->
            <div id="1" class="tabcontent">
                Selectarea marcilor si modelelor masinilor care au cel putin
                doua optionale, in functie de puterea lor.
                <div class="input-group">
                    <!--lista cu gama de puteri diponibila-->
                    <form action="#select" method="POST">
                        <select name="Putere" style="margin-right: 0px; background-color: whitesmoke">
                            <option value="ma.Putere<100" > <100 </option>
                            <option value="ma.Putere>=100 AND ma.Putere<130"> 100 - 130 </option>
                            <option value="ma.Putere>=130 AND ma.Putere<160"> 130 - 160 </option>
                            <option value="ma.Putere>=160 AND ma.Putere<190"> 160 - 190 </option>
                            <option value="ma.Putere>=190 AND ma.Putere<220"> 190 - 220 </option>
                            <option value="ma.Putere >=220"> >=220 </option>
                        </select>
                        <input type="submit" name="select_1" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
                    </form>
                    <?php

                    if (isset($_POST['select_1'])) {
                        $powCondition = $_POST['Putere'];
                        $select = "SELECT m.Nume as Model, m.Marca, ma.Combustibil, ma.Putere
                                    FROM model m, masina ma
                                    WHERE m.idModel = ma.idModel AND $powCondition and ma.idMasina
                                    IN (
                                            SELECT om.idMasina
                                        FROM masina ma, optionale_masina om, optionale o
                                        WHERE o.idOptional = om.idOptional AND om.idMasina = ma.idMasina
                                            GROUP BY o.idOptional
                                            HAVING COUNT(o.idOptional) >= 2
                                    )
                                    ORDER BY Model";

                        if (mysqli_query($conn, $select)) {
                            $result = mysqli_query($conn, $select);
                            echo "<br><table>";

                            echo "<b> <tr> <th>Model </th>
                                 <th>Marca </th>
                                 <th>Combustibil </th>
                                 <th>Putere </th>
                                 </tr></b>";
                            while ($row = mysqli_fetch_array($result)) {
                                $marca = $row['Marca'];
                                $model = $row['Model'];
                                $comb = $row['Combustibil'];
                                $pow = $row['Putere'];
                                echo "<tr> <td>".$model."</td><td> ".$marca."</td><td>".$comb."</td><td>".$pow."</td>";
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
          Masini de o anumita culoare, impreuna cu optionale lor, a caror tara de origine se afla in Asia.
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
                  <input type="submit" name="select_2" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
              </form>
          </div>
          <table>
              <?php
               if(isset($_POST['select_2'])) {
                        $color = $_POST['Culoare'];
                        $select = "SELECT m.Nume as Model, m.Marca ,cm.Culoare, o.Nume as Optional
                                FROM model m INNER JOIN masina ma ON ma.idModel = m.idModel
                                            INNER JOIN caracteristici_masina cm ON cm.idCaracteristici = ma.idCaracteristici
                                            INNER JOIN optionale_masina om ON om.idMasina = ma.idMasina
                                            INNER JOIN optionale o ON o.idOptional = om.idOptional
                                 WHERE cm.Culoare LIKE '$color%' AND m.idModel
                                 in (
                                 SELECT m2.idModel
                                 FROM model m2
                                 WHERE m2.Tara_Origine in ('Japonia', 'Coreea de Sud', 'India', 'China')
                                )";

                        if (mysqli_query($conn, $select)) {
                            $result = mysqli_query($conn, $select);
                            echo "<br><table>";

                            echo "<b>
                                <tr>
                                 <th>Model </th>
                                 <th>Marca </th>
                                  <th>Culoare </th>
                                  <th>Optional </th>
                                  </tr></b>";
                            while ($row = mysqli_fetch_array($result)) {
                                $opt = $row['Optional'];
                                $model = $row['Model'];
                                $marca = $row['Marca'];
                                $color = $row['Culoare'];
                                echo "<tr> <td>".$model."</td><td> ".$marca."</td><td>".$color."</td><td> ".$opt."</td>";
                             }
                             echo "</tr> </table>";
                        } else {
                            echo "Error: ".$select."<br>".mysqli_error($conn).". Please try again.";
                        }
                    }
                    ?>
          </table>
            </div>

            <!--SELECT 3-->
            <div id="3" class="tabcontent">
                Puterea, inaltimea, lungimea, si latimea medie a masinilor
                de la o marca, daca exista cel putin doua modele ale acelei marci.
                <table>
                    <?php
                    $select = "SELECT m.Marca, ROUND(AVG(ma.Putere)) as PutereMedie,
                                        ROUND(AVG(cm.Inaltime)) as InaltimeMedie,
                                        ROUND(AVG(cm.Latime)) as LatimeMedie,
                                        ROUND(AVG(cm.Lungime)) as LungimeMedie
                                        FROM model m, masina ma, caracteristici_masina cm
                                        WHERE m.idModel = ma.idModel AND ma.idCaracteristici = cm.idCaracteristici and m.idModel
                                        in (
                                                SELECT COUNT(*)
                                            FROM model m2
                                            GROUP BY m2.Marca
                                            HAVING COUNT(*) > 1
                                        )
                                        GROUP by m.Marca;";

                    if (mysqli_query($conn, $select)) {
                        $result = mysqli_query($conn, $select);
                        echo "<br><table>";

                        echo "<b> <tr> <th>Marca </th>
                                 <th>AVG Putere </th>
                                  <th>AVG Inaltime </th>
                                 <th>AVG Latime </th>
                                  <th>AVG Lungime </th>

                                  </tr></b>";
                            while ($row = mysqli_fetch_array($result)) {
                                $marca = $row['Marca'];
                                $pow = $row['PutereMedie'];
                                $h = $row['InaltimeMedie'];
                                $lat = $row['LatimeMedie'];
                                $lung = $row['LungimeMedie'];
                                echo "<tr> <td>".$marca."</td><td> ".$pow."</td><td> ".$h."</td><td>"
                                        .$lat."</td><td> ".$lung."</td>";
                            }
                            echo "</tr> </table>";
                        } else {
                            echo "Error: ".$select."<br>".mysqli_error($conn).". Please try again.";
                        }

                    ?>
                </table>
            </div>

            <!--SELECT 4-->
            <div id="4" class="tabcontent">
                Selectarea unui anumite marci de masina, de o anumita culoare:
                <div class="input-group">
                    <form action="#select" method="POST">
                    <!--lista categorii-->
                        <select name="Categorie" style="margin-right: 0px; background-color: whitesmoke">
                      <option value="1">Interior</option>
                      <option value="2">Exterior</option>
                      <option value="3">Siguranta</option>
                  </select>
                    <!--lista combustibili-->
                    <select name="Combustibil" style="margin-right: 0px; background-color: whitesmoke">
                      <option value="Benzina">Benzina</option>
                      <option value="Motorina">Motorina</option>
                    </select>
                    <input type="submit" name="select_4" value="SELECT!" placeholder="insert values" style="margin-left: 0px;">
                    </form>
                    <table>
                        <?php
                        if (isset($_POST['select_4'])) {
                            $cat = $_POST['Categorie'];
                            $comb = $_POST['Combustibil'];
                              $select = "SELECT m.Nume as Model, ma.Putere, o.Nume as Optional
                                        FROM model m, masina ma INNER JOIN optionale_masina om ON ma.idMasina = om.idMasina
                                                                INNER JOIN optionale o ON o.idOptional = om.idOptional
                                        WHERE m.idModel = ma.idModel AND o.idCategorie = $cat AND ma.idMasina
                                        IN (
                                            SELECT ma2.idMasina
                                            FROM masina ma2
                                            WHERE ma2.Combustibil = '$comb'
                                        )
                                        ORDER BY m.Nume";

                            if (mysqli_query($conn, $select)) {
                                $result = mysqli_query($conn, $select);
                                echo "<br><table>";

                                echo "<b> <tr>
                                 <th>Model </th>
                                  <th>Putere </th>
                                  <th>Optional </th>
                                  </tr></b>";
                                while ($row = mysqli_fetch_array($result)) {
                                    $opt = $row['Optional'];
                                    $model = $row['Model'];
                                    $pow = $row['Putere'];
                                    echo "<tr> <td>".$model."</td><td> " .$pow. "</td><td> ".$opt."</td>";
                                }
                                echo "</tr> </table>";
                            } else {
                                echo "Error: ".$select."<br>".mysqli_error($conn).". Please try again.";
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
