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
                <h1 class="col-12">List of users <a href="addUser.php" class ="btn btn-success btn-lg">Add</a></h1>
                <table class="table table-striped table-bordered col-12">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>username</th>
                            <th>password</th>
                            <th>email</th>
                            <th>admin</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       $db = database::connect();
                       $statement = $db->query('SELECT id, username, password, email, admin FROM users');
                       while($user = $statement->fetch())
                       {
                            echo '<tr>';
                            echo '<td>' . $user['id'] . '</td>';
                            echo '<td>' . $user['username'] . '</td>';
                            echo '<td>' . $user['password'] . '</td>';
                            echo '<td>' . $user['email'] . '</td>';
                            echo '<td>' . $user['admin'] . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-primary" href="editUser.php?id=' . $user['id'] . '">Edit</a>';
                            echo '<a class="btn btn-danger" href="deleteUser.php?id=' . $user['id'] . '">Delete</a>';
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