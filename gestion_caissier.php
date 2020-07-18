<?php
session_start();
$_SESSION['message'] = '';
include_once("ext/_select_calls.php");
if(isset($_SESSION['username']) && $_SESSION['username'] == "Admin"){
  header("location:ext/logout.php");
  $_SESSION['message'] = 'You have to be a cashier to access the gestion_caissier webpage';
}
if(isset($_POST['_vente'])){
  $produit_code = $_GET['produit_code'];
  $sale_quantity = htmlspecialchars($_POST['sale_quantity']);
  $preTotal = htmlspecialchars($_POST['prix']);
  $total = $preTotal*$sale_quantity;
  //Logics
  if(!empty($produit_code)AND !empty($sale_quantity) AND is_numeric($total)){
    $stmtVente = $db->prepare("INSERT INTO vente(produit_code,quantite,total)
    VALUES(:produit_code,:sale_quantity,:total)");
    $stmtVente->execute(
      array(
        ':produit_code'=>$produit_code,':sale_quantity'=>$sale_quantity,
        ':total'=>$total
      ));
    $_SESSION['message'] = '<div class="alert alert-success">Succes!</div>';
    header("location:../ventes_produit.php?produit_code=$produit_code&sale_quantity=$sale_quantity");
}else{
  $_SESSION['message'] = 'Remplissez de maniere logique les champs';
}
}else{
$_SESSION['message'] = 'Fill all the text fields properly';
}
?>

<div class="container-fluid">
<div class="rows">
  <div class="col-sm-6 col-md-4">
  <?php while($produit = $return->fetch()): ?>
    <div class="caption">
      <blockquote>
        <span>Produit Code: <?= $produit["produit_code"];?></span> <br>
        <span>Nom du Produit: <?= $produit["produit_name"];?></span> <br>
        <span>Type de Produit: <?= $produit["produit_type"];?></span> <br>
        <span>Quantite disponible en stock: <?= $produit["quantite"];?></span> <br>
      <form method='post' 
      action='../gestion_caissier.php?produit_code=<?=$produit['produit_code']?>'>
        <span>Prix du Produit: <input type="number" name="prix" id="prix" value=<?=$produit["prix"];?>> gourdes</span> <br>
        <span style='color:#2e6da4;'>Quantite a vendre</span>
        <input type="number" name="sale_quantity" id="sale_quantity" required><br>
        <button name='_vente' class='btn btn-default' role='button'>Vendre &raquo;</button>
      </form>
      </blockquote>
    </div>
  <?php $db = null; endwhile;?>
  </div>
</div>
</div>

<script type="text/javascript">
  function isPageActive()
  {
    $('.home_nav li').removeClass('active');
    $('.add_nav li').removeClass('active');
    $('.gestion_stock_nav li').addClass('active');
    $('.login_nav li').removeClass('active');
  }

  setInterval(isPageActive,100);
  clearInterval(isPageActive,200);

</script>
<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/ie10-viewport-bug-workaround.css">

<?php include_once('ext/footer.php'); ?>