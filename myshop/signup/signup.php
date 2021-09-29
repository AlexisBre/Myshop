<?php include('serveur.php') ?>
<html>
<head>
  <title>Registration system</title>
     <meta charset="utf-8"/>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container-fluid">
 <div class="row">

  <h1 class="col-12">Register</h1>

  <form  class="form col-12" role="form" method="post" action="signup.php">
    <?php include('errors.php'); ?>

    <div class="input-group">
      <label>Votre nom </label>
      <input type="text"name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
      <label>Votre e-mail </label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <label>Mot de passe </label>
      <input type="password" name="password_1">
    </div>
    <div class="input-group">
      <label>Confirmation du mot de passe </label>
      <input type="password" name="password_2">
    </div>
    <div class="input-group">
      <button type="submit" class="btn btn-primary" name="reg_user">S'inscrire</button>
    </div>
    <p>
      Déjà inscrit ?
     <button type="submit" class="btn btn-success" ><a style="color:white;" href="../signin.php">Connectez-vous !</a></button>

    </p>
  </form>
</div>
  </div>
</body>
</html>
