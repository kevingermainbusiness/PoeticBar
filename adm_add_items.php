<?php
session_start();
include_once("ext/auth.php");
$_SESSION['message'] = '';
if(isset($_SESSION['username']) && $_SESSION['username'] != "Admin"){
  header("location:ext/logout.php");
  $_SESSION['message'] = 'You have to be an admin to access the adm_add_items webpage';
}

if(isset($_POST['add_produit'])){
  $productName = htmlspecialchars($_POST['name']);
  $productType = htmlspecialchars($_POST['type']);
  $productQt = htmlspecialchars($_POST['quantite']);
  $productPrix = htmlspecialchars($_POST['prix']);

  //Logics
  if(!empty($productName)AND !empty($productType)AND !empty($productQt) AND !empty($productPrix)){
        $stmtProduit = $db->prepare("INSERT INTO produit(produit_name,produit_type)
        VALUES(:productName,:productType)");
        $stmtProduit->execute(array(':productName'=>$productName,':productType'=>$productType));

        $stmtTypeProduit = $db->prepare("INSERT INTO 
        type_produit(type_produit,type_name)VALUES(:productType,:productName)");
        $stmtTypeProduit->execute(array(':productType'=>$productType,':productName'=>$productName));

        $stmtPrix = $db->prepare("INSERT INTO prix(prix)VALUES(:productPrix)");
        $stmtPrix->execute(array(':productPrix'=>$productPrix));

        $stmtStock = $db->prepare("INSERT INTO stock(quantite)VALUES(:productQt)");
        $stmtStock->execute(array(':productQt'=>$productQt));

        $_SESSION['message'] = '<div class="alert alert-success">Succes!</div>';
    }else{
      $_SESSION['message'] = 'Remplissez de maniere logique les champs';
    }
  }else{
    $_SESSION['message'] = 'Fill all the text fields properly';
  }
?>
<?php include_once('ext/auth.php');  ?>

<body class="text-center">
    <form class="form-signin" action="<?=$_SERVER["PHP_SELF"];?>" method="post">
    <div>
    <?php
          if(!isset($_SESSION['message'])){echo "";}
          else{echo $_SESSION['message'];}
      ?>
    </div>
      <h1 class="h3 mb-3 font-weight-normal">Enregistrement des produits</h1>
      <label for="inputEmail" class="sr-only">Name</label>
      <input type="text" id="inputText" name="name" class="form-control" placeholder="Nom du produit" required autofocus>
      <label for="inputText" class="sr-only">Type de produit</label>
      <input type="text" id="inputText" name="type" class="form-control" placeholder="Type de produit" required>
      <label for="inputNumber" class="sr-only">Quantite</label>
      <input type="number" id="inputNumber" name="quantite" class="form-control" placeholder="Quantite disponible en stock" required>
      <label for="inputNumber" class="sr-only">Prix du produit</label>
      <input type="number" id="inputNumber" name="prix" class="form-control" placeholder="Prix du produit" required>
      <button class="btn btn-lg btn-primary btn-block" name="add_produit" type="submit">Enregistrer</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
    </form>
  </body>

<script type="text/javascript">
  //(function(){});
    function password() {
    //var x = document.getElementById("myPassword");
    var x = document.getElementsByClassName('password');
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
  function isPageActive()
  {
    $('.home_nav li').removeClass('active');
    $('.add_nav li').addClass('active');
    $('.gestion_stock_nav li').removeClass('active');
    $('.login_nav li').removeClass('active');
  }

  setInterval(isPageActive,100);
  clearInterval(isPageActive,200);

</script>
<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/ie10-viewport-bug-workaround.css">

<?php include_once('ext/footer.php'); ?>