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

$nameError = $name = $parentCategory = "";
$isSuccess = true;

if(!empty($_POST))
{
    $name = $_POST['name'];
    $parentCategory = $_POST['parentCategory'];
    $isSuccess = true;

    if(empty($name))
    {
        $nameError = 'Empty name';
        $isSuccess = false;
    }
    else
    {
        $db = database::connect();
        $testQuery = "SELECT name FROM categories WHERE name = '" . $name . "'AND id <>'" . $id . "'";
        $testData = $db->query($testQuery);
        $testRes = $testData->fetchAll();
        if ($testRes)
        {
            $name = 'Name already taken';
            $isSuccess = false;
        }
        $db = null;
    }
    
    if($isSuccess === true)
    {
        $db = database::connect();
        $statement = $db->prepare("UPDATE categories set name = ?, parent_id = ? WHERE id = ?");
        $statement->execute(array($name,$parentCategory,$id));
        $db = null;
        header('location: categories.php');
    }
}
else
{
    $db = database::connect();
    $statement = $db->prepare("SELECT * FROM categories WHERE id = ?");
    $statement->execute(array($id));
    $category = $statement->fetch();
    $name = $category['name'];
    $parentCategory = $category['parent_id'];
    $db = null;
}
function categoryTree($parent_id = 0, $sub_mark = '')
{
    $db = database::connect();
    $query = $db->query("SELECT id,name FROM categories WHERE parent_id = $parent_id ORDER BY name ASC");
    while($row = $query->fetch())
    {
        echo '<option value="'.$row['id'].'">'.$sub_mark.$row['name'].'</option>';
        categoryTree($row['id'], $sub_mark.'--');
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
            <h1 class="col-12">Edit category</h1>
                <form class="form col-12" role="form" action="<?php echo 'editCategory.php?id=' . $id;?>" method="post">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>">
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                    <div class="form-group">
                        <?php
                            $db = database::connect();
                            $query = "SELECT a.name,b.name as parent FROM categories a, categories b WHERE a.parent_id=b.id AND a.id = '" . $id . "'";
                            $data = $db->query($query);
                            $res = $data->fetch();
                            echo '<label>Parent category: <br>' . $res['parent'] . '</label>';
                        ?>
                        <select class="form-control" id="parentCategory" name="parentCategory">
                            <?php
                                categoryTree();
                            ?>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-secondary">Edit</button>
                        <a class="btn btn-primary" href="categories.php">Previous<a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>