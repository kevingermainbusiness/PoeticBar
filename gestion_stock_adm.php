<?php
session_start();
$_SESSION['message'] = '';
include_once("ext/_select_calls.php");
if(isset($_SESSION['username']) && $_SESSION['username'] != "Admin"){
  header("location:ext/logout.php");
  $_SESSION['message'] = 'You have to be an admin to access the gestion_stock_adm webpage';
}
?>

<div class="container-fluid">
<div class="rows">
  <div class="col-sm-6 col-md-4">
  <h4>Les differents produits</h4> <br>
  <?php while($produit = $return->fetch()): ?>
    <div class="caption">
      <blockquote>
        <span>Produit Code: <?= $produit["produit_code"];?></span> <br>
        <span>Nom du Produit: <?= $produit["produit_name"];?></span> <br>
        <span>Type de Produit: <?= $produit["produit_type"];?></span> <br>
        <span>Prix du Produit: <?= $produit["prix"];?> gourdes</span> <br>
        <span>Quantite: <?= $produit["quantite"];?></span>
      </blockquote>
    </div>
  <?php $db = null; endwhile;?>
  </div>
</div>
</div>

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
    $('.add_nav li').removeClass('active');
    $('.gestion_stock_nav li').addClass('active');
    $('.login_nav li').removeClass('active');
  }

  setInterval(isPageActive,100);
  clearInterval(isPageActive,200);

</script>
<link rel="stylesheet" type="text/css" href="../libs/bootstrap/css/ie10-viewport-bug-workaround.css">

<?php include_once('ext/footer.php'); ?>