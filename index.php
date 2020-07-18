<?php
session_start();
include_once('ext/auth.php');
include_once('ext/functions.php');
?>
<link rel="stylesheet" type="text/css" href="../res/bootstrap/css/w3.css">
<link rel="stylesheet" href="form.css">
<div><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];}?></div>

<main role="main" class="container">

      <div class="starter-template">
      <h1 class="cover-heading"><?=WEBSITE_NAME?> <span>(Petite description)</span></h1>
      <p class="lead">
      <?=WEBSITE_NAME?> est un mini market qui vou offre la meilleure experience individuelle dans un market,
      et les produits les plus essentiels de votre vie. 
      Passer nous voir a la 2e Ruelle Nazon #29. Notre tel c'est +509 4848 2323.
      </p>
      </div>

</main>

<script>
function isPageActive(){
  $('.home_nav li').addClass('active');
    $('.add_nav li').removeClass('active');
    $('.gestion_stock_nav li').removeClass('active');
    $('.login_nav li').removeClass('active');
  }
  setInterval(isPageActive,100);
  clearInterval(isPageActive,200);
</script>

<?php include_once('ext/footer.php'); ?>