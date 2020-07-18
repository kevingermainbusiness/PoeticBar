<?php
session_start();
$_SESSION['message'] = '';
$host = "localhost";
$db_user = "root";
$db_pass = "";
$dbname = "car-rent";

$dsn = "mysql:host=".$host.";dbname=".$dbname.";charset=utf8mb4";
$options = [
	PDO::ATTR_EMULATE_PREPARES => false, //turn off emulation mode for 'real' prepared stmts
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // make the default fetch be an associative array
];

try {
    $db = new PDO($dsn,$db_user,$db_pass,$options);
} catch (Exception $e) {
	error_log($db->getMessage());
	exit("Something weird happenned");
}

if(isset($_POST['_client'])){
  $plaque = $_GET['plaque_id'];
  $delay = $_GET['delay'];
  $nif = strtolower($_POST['nif']);
  $nom = strtolower($_POST['nom']);
  $prenom = strtolower($_POST['prenom']);
  $sexe = strtolower($_POST['sexe']);
  $telephone = $_POST['telephone'];
  $adresse = strtolower($_POST['adresse']);

  //Logics
  if(isset($plaque) AND !empty($plaque) AND !empty($nif) AND !empty($nom) AND !empty($prenom) 
    AND !empty($sexe) AND !empty($telephone) AND !empty($adresse) ){
    if(is_string($nif) ){
        $_SESSION['nif'] = $nif;
        $stmt = $db->prepare("INSERT INTO 
        client(nif,nom,prenom,sexe,telephone,adresse) 
        VALUES(:nif,:nom,:prenom,:sexe,:telephone,:adresse)");
        $stmt->execute(array(':nif'=>$nif,':nom'=>$nom,
        ':prenom'=>$prenom,':sexe'=>$sexe,
        ':telephone'=>$telephone,':adresse'=>$adresse));
        $_SESSION['message'] = '<div class="alert alert-success">Succes!</div>';
        header("location:\carjungle/controller/_allocation.php?plaque_id=$plaque&delay=$delay");
    }else{
      $_SESSION['message'] = 'Make sure every textarea is corresponds to its type';
      header("location: ../v/index.php");
    }
  }else{
    $_SESSION['message'] = 'Fill all the text fields properly';
    header("location: ../v/index.php");
  }
}
?>