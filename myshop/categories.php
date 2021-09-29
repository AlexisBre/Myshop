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
        <title>Admin : Categories</title>
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
                <h1 class="col-12">List of categories <a href="addCategory.php" class ="btn btn-success btn-lg">Add</a></h1>
                <table class="table table-striped table-bordered col-12">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Parent category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       function parent_category_name($parent_id)
                       {
                            $db = database::connect();
                            $statement = $db->query("SELECT * FROM categories WHERE id = '" . $parent_id . "'");
                            $nameParentCategory = $statement->fetch();
                            return $nameParentCategory['name'];
                       }
                       $db = database::connect();
                       $statement = $db->query('SELECT a.id,a.name,b.name as parent FROM categories a, categories b WHERE a.parent_id=b.id');
                       while($category = $statement->fetch())
                       {
                            echo '<tr>';
                            echo '<td>' . $category['id'] . '</td>';
                            echo '<td>' . $category['name'] . '</td>';
                            echo '<td>' . $category['parent'] . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-primary" href="editCategory.php?id=' . $category['id'] . '">Edit</a>';
                            echo '<a class="btn btn-danger" href="deleteCategory.php?id=' . $category['id'] . '">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                       }
                       $db=null;
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