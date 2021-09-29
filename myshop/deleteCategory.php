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


$deleteError = "";
$isSuccess = true;
if(!empty($_GET['id']))
{
    $id = $_GET['id'];
}
    
$db = database::connect();
$query = "SELECT a.name,b.name as child FROM categories a, categories b WHERE a.id=b.parent_id AND a.id = '" . $id . "'";
$data = $db->query($query);
$res = $data->fetch();
if ($res)
{
    $deleteError = "Please, delete subcategories before deleting this parent category.";
    $isSuccess = false;
}

if(!empty($_POST))
{
    if($isSuccess === true)
    {
        $id = $_POST['id'];
        $db = database::connect();
        $statement = $db->prepare("DELETE FROM categories WHERE id = ?");
        $statement->execute(array($id));
        $db = null;
        header("location: categories.php");
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
                <h1 class="col-12">Delete a category</h1>
                <form class="form col-12" role="form" action="deleteCategory.php" method="post">
                   <input type="hidden" name="id" value="<?php echo $id;?>"/>
                   <p class="alert alert-warning">Are you sure you want to delete this category?</p>
                   <span class="help-inline"><?php echo $deleteError; ?></span>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Yes</button>
                        <a class="btn btn-primary" href="categories.php">No<a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>