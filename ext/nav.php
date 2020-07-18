<div class="header-skrt"></div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
      <?php
          if(!isset($_SESSION['username'])){echo WEBSITE_NAME;}
          else{echo $_SESSION['username'];}
      ?>
      </a>
    </div>
    <ul class="nav navbar-nav home_nav">
      <li class="active" id='home_page'>
        <a href="../index.php">Acceuil</a>
      </li>
    </ul>
    <?php
          if(isset($_SESSION['username']) && $_SESSION['username'] == "Admin"){
            echo("<ul class='nav navbar-nav add_nav'>
            <li>
            <a href=\"../adm_add_items.php\">Enregistrement Produits</a>
            </li>
          </ul>
          <ul class='nav navbar-nav gestion_stock_nav'>
            <li>
            <a href=\"../gestion_stock_adm.php\">Gestion Stock</a>
            </li>
          </ul>");
          }
          elseif (isset($_SESSION['username']) && $_SESSION['username'] != "Admin") {
            echo("<ul class='nav navbar-nav gestion_stock_nav'>
            <li>
            <a href=\"../gestion_caissier.php\">Gestion ventes</a>
            </li>
          </ul>");
          }
      ?>
    <ul class="nav navbar-nav navbar-right login_nav">
      <li class="register">
        <a href="\ext/logout.php"><span></span>
          <?php
          if(!isset($_SESSION['username'])){echo "Login";}
          else{echo "Se deconnecter";}
          ?>
        </a>
      </li>
    </ul>
  </div>
</nav>
<body>