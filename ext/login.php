<?php
session_start();
$_SESSION['message'] = "";
include_once('auth.php');
include_once('functions.php');

if (isset($_POST['_login'])) {
  // receive all input values from the form
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  // This class is accessible from the functions class located in ext/functions.php
  $programLogic = new programLogic;

  if (!empty($username) && !empty($password) && $programLogic->isPassValid($password)) {
      // $password = $programLogic->encrypt_decrypt('encrypt', $password);
      $sql = "SELECT id,username,password FROM employee";  
      $result = $db->query($sql);
      foreach ($result as $row) {
        if($row['username'] === $username && $row['password']=== $password){
          $_SESSION['id'] = $row['id'];
          $_SESSION['username'] = $row['username'];
          header('location:../index.php');
        }
        // else{
        //   $_SESSION['message'] = '<label>Could not find email in db.</label>';
        //   header('location:../v/register.view.php');  
        // }
      }
      $db = null;
    }
    elseif (empty($username)) {
      $_SESSION['message'] = '<label class="alert alert-danger">Username is not valid...</label>';
    }
    elseif (empty($password)) {
      $_SESSION['message'] = '<label class="alert alert-danger">Please put the suited password...</label>';
    }
    elseif(!$programLogic->isPassValid($password)){
      $_SESSION['message'] = '<label class="alert alert-danger">Password is not valid...</label>'; 
    }
    else
    {  
      $_SESSION['message'] = '<label>Wrong Data</label>';
      header('location:../adm_add_items.php');  
    }
}
?>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="form.css" type="text/css">
<body class="text-center">
    <form class="form-signin" action="<?=$_SERVER["PHP_SELF"];?>" method="post">
    <div><?= $_SESSION['message'];?></div>
      <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>
      <h4>Please Sign in to manage the database</h4>
      <label for="inputText" class="sr-only">Username</label>
      <input type="text" id="inputText" name="username" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" name="_login" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
      <p>
      Note au prof: Nous avons cree par defaut deux comptes dans la table employee:
      Un compte Admin pour acceder et effectuer les taches administratives,
      Un compte Caissier pour les taches Caissier.
      <br> Le compte Admin a pour credentiel: <br>
      Username = Admin <br> 
      Password = admin <br>
      Celui du Caissier est:
      Username = Caissier <br>
      Password = caisse
      </p>
    </form>
  </body>

  <script>
  function isPageActive()
  {
    $('.home_nav li').removeClass('active');
    $('.add_nav li').removeClass('active');
    $('.gestion_stock_nav li').removeClass('active');
    $('.login_nav li').addClass('active');
  }

  setInterval(isPageActive,100);
  clearInterval(isPageActive,200);

</script>
<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/ie10-viewport-bug-workaround.css">
  </script>


<?php include_once('footer.php'); ?>