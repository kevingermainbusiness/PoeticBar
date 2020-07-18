<?php
session_start();
$_SESSION['message'] = '';
include_once("ext/_select_calls.php");
if(isset($_SESSION['username']) && $_SESSION['username'] == "Admin"){
  header("location:ext/logout.php");
  $_SESSION['message'] = 'You have to be a cashier to access the gestion_caissier webpage';
}
?>

<div class="container-fluid">
<div class="rows">
  <div class="col-sm-6 col-md-4">
  <h1>Differents produits vendues</h1>
  <?php while($vente = $returnVente->fetch()): ?>
    <div class="caption">
      <blockquote>
      <span>Code de Vente: <?= $vente["code_vente"];?></span> <br>
        <span>Produit Code: <?= $vente["produit_code"];?></span> <br>
        <span>Quantite vendues: <?= $vente["quantite"];?></span> <br>
        <span>Total: <?= $vente["total"];?> gourdes</span> <br>
        <span>Date vendue: <?= $vente["date"];?></span> <br>
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
    $('.gestion_stock_nav li').removeClass('active');
    $('.login_nav li').removeClass('active');
  }

  setInterval(isPageActive,100);
  clearInterval(isPageActive,200);

</script>
<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/ie10-viewport-bug-workaround.css">
<?php include_once('ext/footer.php'); ?>