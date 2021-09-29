<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=='connected' || $_SESSION['admin']==='notAdmin')
{
    {
        header('location: ./signin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
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
                <h1 class="col-12">Admin Page</h1>
                <form class="col-12" action ="users.php" method="post">
                    <input class="btn btn-secondary" type="submit" value="Access to users">
                </form>
                <form class="col-12" action ="products.php" method="post">
                    <input class="btn btn-warning" type="submit" value="Access to products">
                </form>
                <form class="col-12" action ="categories.php" method="post">
                    <input class="btn btn-primary" type="submit" value="Access to categories">
                </form>
            </div>
        </div>
    </body>
</html>
