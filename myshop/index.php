<?php

session_start();
$product_ids = array();
//session_destroy();
$db = mysqli_connect('127.0.0.1', 'root', 'root', 'my_shop', 8889);
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin']='loggedin')
{
    {
        header('location: signin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<?php include 'includes/head.php'; ?>
 </head>
<!-- <header>
  <div class="main-logo">
  <a href="#index" class="logo"><img src="https://cdn.pixabay.com/photo/2015/07/09/19/32/dog-838281_960_720.jpg" alt="Logo"></a>
</header> -->
<body >
	<!--- Navigation -->
    <?php $page = 'index'; include 'includes/navbar.php'; ?>



	<!--- End Navigation -->

<!--         -->

	<!--- Image Slider -->
	<div class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active"><img src="https://cdn.pixabay.com/photo/2015/07/09/19/32/dog-838281_960_720.jpg"></div>
			<div class="carousel-item"><img src="https://cdn.pixabay.com/photo/2016/01/19/17/41/friends-1149841_960_720.jpg"></div>
			<div class="carousel-item"><img src="https://cdn.pixabay.com/photo/2019/08/19/07/45/dog-4415649_960_720.jpg"></div>
		</div>
	</div>
	<!--- End Image Slider -->

	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-10 py-5">
				<h2>Nouvelle édition de notre e-shop pour vos amis à quatres pattes</h2>
				<p class="lead">Magasin Toutou-Loulou vous propose un grand choix de croquettes et d'accessoires pour les animaux de toutes les tailles et tous les caractères.<br> Nos boutiques sont ouvertes du mardi au samedi, de 10 heures à 19 heures.</p><a class="btn btn-purple btn-lg" href="contact.php" target="_blank">Besoin d'un conseil ?</a>

			</div>
		</div>
	</div>


<section class="product-section">
    <div class="container">
    <div class="section-heading">
      <div class="row">
        <h2>Sélection du moment</h2>

        <?php include 'includes/panier.php'; ?>


</div>
</div>
</div>
</section>

	<!--- Start Footer -->
	<footer>
    <?php include 'includes/footer.php'; ?>

	</footer>
	<!--- End of Footer -->

<!--- Script Source Files -->

    <?php include 'includes/scripts.php'; ?>

<!--- End of Script Source Files -->

</body>
</html>

