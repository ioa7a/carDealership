<?php
session_start();

$dbServername = "localhost:8090";
$dbUsername = "root";
$dbPassword = "";
//baza de date propriu-zisa
$dbName = "dealerauto";
//baza de date cu utilizatori
$userDB = "user_information";
$errors = array();

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
$log_in_conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $userDB);

//daca uilizatorul a apasat pe login
if (isset($_POST['login_user'])) {
    
    $username = mysqli_real_escape_string($log_in_conn, $_POST['username']);
    $password = mysqli_real_escape_string($log_in_conn, $_POST['password']);

    if (empty($username)) {
    array_push($errors, "Username is required.");
		}
    if (empty($password)) {
        array_push($errors, "Password is required.");
		}

    if (count($errors) == 0) {
        //cautam numele utilizatorului si parola lui in baza de date
	$query = "SELECT * FROM login_info WHERE username='$username' AND password='$password'";
	$results = mysqli_query($log_in_conn, $query);
        if(mysqli_num_rows($results) == 1){
            //daca utilizatorul exista n baza de date, este logat si trimis la pagina principala
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            while ($row = mysqli_fetch_assoc($results)) {
                $isAdmin = $row['isAdmin'];
                $_SESSION['isAdmin'] = $isAdmin;
                if($isAdmin == 1){  header('location: index_admin.php'); } 
                else {  header('location: index_user.php'); }
           }
           
    } //daca nu, va fi afisata o eroare
    else {
            array_push($errors, "Wrong username/password combination. Please try again.");
        }
      }
    }

?>

