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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin : products</title>
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
                <h1 class="col-12">List of products <a href="addProduct.php" class ="btn btn-success btn-lg">Add</a></h1>
                <table class="table table-striped table-bordered col-12">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>description</th>
                            <th>price</th>
                            <th>category</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        $db = database::connect();
                        $statement = $db->query('SELECT products.id, products.name, products.description, products.price, categories.name AS category FROM products LEFT JOIN categories ON products.category_id = categories.id');
                        while($product = $statement->fetch())
                       {
                            echo '<tr>';
                            echo '<td>' . $product['id'] . '</td>';
                            echo '<td>' . $product['name'] . '</td>';
                            echo '<td>' . $product['description'] . '</td>';
                            echo '<td>' . $product['price'] . '</td>';
                            echo '<td>' . $product['category'] . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-primary" href="editProduct.php?id=' . $product['id'] . '">Edit</a>';
                            echo '<a class="btn btn-danger" href="deleteProduct.php?id=' . $product['id'] . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                       }
                       ?>
                    </tbody>
                </table>
                <div class="form-actions col-12">
                    <a class="btn btn-primary" href="admin.php">Previous<a>
                </div>
            </div>
        </div>
    </body>
</html>