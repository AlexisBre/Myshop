<?php
require 'dbConnection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=='connected' || $_SESSION['admin']==='notAdmin')
{
    {
        header('location: signin.php');
        exit;
    }
}

if(!empty($_GET['id']))
{
    $id = $_GET['id'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];
    $db = database::connect();
    $statement = $db->prepare("DELETE FROM users WHERE id = ?");
    $statement->execute(array($id));
    $db = null;
    header("location: users.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin : Users</title>
        <meta charset="utf-8"/>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar container">
                <ul class="nav">
                    <div class="col-8">
                        <a class="btn btn-warning" href="index.php" value="To the website">Website<a>
                    </div>
                </ul>
                <ul class="nav navbar-right">
                    <div class="col-3">
                        <a class="btn btn-warning" href="logout.php" value="LOGOUT">LOGOUT<a>
                    </div>
                </ul>
            </nav>
        </header>
        <div class="container">
            <div class="row">
                <h1 class="col-12">Delete an account</h1>
                <form class="form col-12" role="form" action="deleteUser.php" method="post">
                   <input type="hidden" name="id" value="<?php echo $id;?>"/>
                   <p class="alert alert-warning">Are you sure you want to delete this account?</p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Yes</button>
                        <a class="btn btn-primary" href="users.php">No<a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>