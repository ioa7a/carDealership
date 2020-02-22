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
      <!-- bara de navigatie -->
        <div class="sidebar">
            <center><img src="img/icon_car.png" width="60px" height="60px;"> </center><p>
                <?php if (($_SESSION['isAdmin'])==1){ ?>
                    <a href="index_admin.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
              <?php  }
                 else { ?>
                     <a href="index_user.php"> <img src="img/left_arrow.png" width="22px" height="18px"> HOME </a> <p>
                <?php } ?>
                <a href="view.php"> REFRESH <img src="img/refresh_icon.png" width="15px" height="15px"></a> <p>
                <a href="index_admin.php?logout='1'" style="background-color: #bd7879; color: #FFe8e8;" >LOG OUT
                    <img src="img/logout.png" width="20px" height="20px"></a>
        </div>


        <div class="content">
            <h2> <?php if (isset($_SESSION['username'])) : ?>
                    Welcome, <strong><?php echo $_SESSION['username']; ?>!</strong>
                <?php endif ?> </h2>
            <h4> VIEW TABLES </h4>
            <h5>Select one of the tables below to view its entries.</h5>
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'masina')" >Mașină</button>
                <button class="tablinks" onclick="openCity(event, 'model')">Model</button>
                <button class="tablinks" onclick="openCity(event, 'caracteristici_masina')">Caracteristici Mașină</button>
                <button class="tablinks" onclick="openCity(event, 'optionale')">Opționale</button>
                <button class="tablinks" onclick="openCity(event, 'categorie_optionale')">Categorii Opționale</button>
                <button class="tablinks" onclick="openCity(event, 'optionale_masina')">Opționale Mașină</button>
            </div>

            <div id="masina" class="tabcontent">
                    <?php
                $view = "SELECT model.Nume as Model, caracteristici_masina.*, masina.*
                             FROM masina inner join model on masina.idModel = model.idModel
                             left join caracteristici_masina on masina.idCaracteristici = caracteristici_masina.idCaracteristici
                             ORDER BY model.Nume;";
                $result = mysqli_query($conn, $view);
                echo "<table><b><tr><th>Model </th>
                                 <th>Color </th>
                                 <th>Height </th>
                                 <th>Width </th>
                                  <th>Lungime </th>
                                 <th>Numar Locuri </th>
                                 <th>Capacitate Portbagaj </th>
                                 <th>Volum Incarcare </th>
                                 <th>Combustibil </th>
                                 <th>Putere (CP)</th>
                                 <th>An Fabricatie</th>
                                 </tr>
                                 </b>";
                while ($row = mysqli_fetch_array($result)) {
                    $model = $row['Model'];
                    $color = $row['Culoare'];
                    $h = $row['Inaltime'];
                    $lat = $row['Latime'];
                    $lung = $row['Lungime'];
                    $nr = $row['NumarLocuri'];
                    $capacitate = $row['CapacitatePortbagaj'];
                    $vol = $row['VolumIncarcare'];
                    $fuel = $row['Combustibil'];
                    $pow = $row['Putere'];
                    $an = $row['AnFabricatie'];
                    echo "<tr> <td>";
                     if($capacitate == ""){
                          echo $model."</td><td> ".$color."</td><td>".$h."</td><td>".
                              $lat."</td><td> ".$lung."</td><td>".$nr."</td><td>".
                             "Unavailable</td><td>Unavailable</td><td>".$fuel."</td><td>".$pow."</td><td>".$an."</td></tr>";
                      echo "</tr>";
                      }  else
                      {
                    echo $model."</td><td>".$color."</td><td>".$h."</td><td>"
                    .$lat."</td><td>".$lung."</td><td>".$nr."</td><td>"
                    .$capacitate."</td><td>".$vol."</td><td>".$fuel."</td><td>".$pow."</td><td>".$an."</td></tr>";
                      }
                }
                ?>
            </table>
            </div>

            <div id="model" class="tabcontent">
                 <table>
                    <?php
                    $view = "SELECT * FROM model"
                            . " ORDER BY model.nume;";
                    $result = mysqli_query($conn, $view);

                     echo "<b><tr><th>Nume </th>
                                  <th>Marca </th>
                                  <th>Tara Origine </th></tr></b>";
                         while ($row = mysqli_fetch_array($result)) {
                        $nume = $row['Nume'];
                        $marca = $row['Marca'];
                        $tara = $row['Tara_Origine'];
                        echo "<tr> <td>";
                        echo $nume."</td><td> ".$marca."</td><td> ".$tara."</td>";
                        echo "</tr>";
                    }
                    ?>
                   </table>
            </div>

            <div id="caracteristici_masina" class="tabcontent">
            <table>
            <?php
            $view = "SELECT model.Nume as Model, caracteristici_masina.*
                    FROM caracteristici_masina INNER JOIN masina ON masina.idCaracteristici = caracteristici_masina.idCaracteristici
                    INNER JOIN model ON model.idModel = masina.idModel
                    ORDER BY Model;";
            $result = mysqli_query($conn, $view);
            echo "<b><tr><th>Model </th>
                     <th>Culoare </th>
                     <th>Inaltime </th>
                     <th>Latime </th>
                     <th>Lungime </th>
                     <th>Numar Locuri </th>
                     <th>Capacitate Portbagaj </th>
                     <th>Volum Incarcare </th>
                     <th> Kilometraj </tr></b>";
                      while ($row = mysqli_fetch_array($result)) {
                      $model = $row['Model'];
                      $color = $row['Culoare'];
                      $h = $row['Inaltime'];
                      $lat = $row['Latime'];
                      $lung = $row['Lungime'];
                      $nr = $row['NumarLocuri'];
                      $cap = $row['CapacitatePortbagaj'];
                      $vol = $row['VolumIncarcare'];
                      $kil = $row['Kilometraj'];
                      echo "<tr> <td>";
                      if($cap == ""){
                          echo $model."</td><td> ".$color."</td><td>".$h."</td><td>".
                              $lat."</td><td> ".$lung."</td><td>".$nr."</td><td>".
                             "Unavailable</td><td>Unavailable</td><td>".$kil."</td>";
                      echo "</tr>";
                      } else
                      if($kil == ""){
                          echo $model."</td><td> ".$color."</td><td>".$h."</td><td>".
                              $lat."</td><td> ".$lung."</td><td>".$nr."</td><td>".
                              $cap."</td><td>".$vol."</td><td>".$kil."</td>";
                      echo "</tr>";
                      } else
                      {
                      echo $model."</td><td> ".$color."</td><td>".$h."</td><td>".
                              $lat."</td><td> ".$lung."</td><td>".$nr."</td><td>".
                              $cap."</td><td>".$vol."</td><td>".$kil."</td>";
                      echo "</tr>";
                    }
                      }
                    ?>
                    </table>
                </p>
            </div>

            <div id="optionale" class="tabcontent">
                   <table>
                    <?php
                    $view = "SELECT optionale.nume, optionale.descriere, categorie_optionale.Nume as categorie
                            FROM optionale INNER JOIN categorie_optionale ON optionale.idCategorie = categorie_optionale.idCategorie
                            ORDER BY optionale.Nume;";
                    $result = mysqli_query($conn, $view);

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
                    ?>
                    </table>
            </div>

            <div id="categorie_optionale" class="tabcontent">
              <table>
                    <?php
                    $view = "SELECT * FROM categorie_optionale";
                    $result = mysqli_query($conn, $view);

                     echo "<b><tr><th>Nume </th>
                                  <th>Descriere </th> </tr></b>";
                         while ($row = mysqli_fetch_array($result)) {
                        $nume = $row['Nume'];
                        $descriere = $row['Descriere'];
                        echo "<tr> <td>";
                        echo $nume."</td><td> ".$descriere."</td>";
                        echo "</tr>";
                    }
                    ?>
                    </table>
            </div>

            <div id="optionale_masina" class="tabcontent">
             <table>
                 <b><tr>
                 <th> Model </th>
                 <th> Combustibil </th>
                 <th> Putere </th>
                 <th> Optional </th>
                 <th> Observatii </th> </tr> </b>
            <?php
            $view = "SELECT model.nume as Model, masina.Combustibil, masina.Putere, optionale.nume as Optional, optionale_masina.Observatii
                    FROM optionale_masina INNER JOIN optionale ON optionale_masina.idOptional = optionale.idOptional
                    INNER JOIN masina ON masina.idMasina = optionale_masina.idMasina
                    INNER JOIN model ON masina.idModel = model.idModel
                    ORDER BY optionale_masina.idMasina;";
            $result = mysqli_query($conn, $view);

            while ($row = mysqli_fetch_array($result)) {
                $model = $row['Model'];
                $comb = $row['Combustibil'];
                $pow = $row['Putere'];
                $opt = $row['Optional'];
                $obs = $row['Observatii'];
                echo "<tr> <td>";
                echo $model."</td><td> ".$comb."</td><td> ".$pow."</td><td> ".$opt."</td><td> ".$obs."</td>";
                echo "</tr>";
            }
        ?>
             </table>
            </div>

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
