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

$nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $price = $description = $category = $image = "";
$isSuccess = true;

if(!empty($_POST))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];
    $imagePath = 'images/' . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;
    $isUploadSuccess = false;

    if(empty($name))
    {
        $nameError = 'Empty name';
        $isSuccess = false;
    }
    if(empty($description))
    {
        $descriptionError = 'Empty description';
        $isSuccess = false;
    }
    if(empty($price))
    {
        $priceError = 'Empty price';
        $isSuccess = false;
    }
    if(empty($category))
    {
        $categoryError = 'Empty category';
        $isSuccess = false;
    }
    if(empty($image))
    {
        $imageError = 'Empty image';
        $isSuccess = false;
    }
    else
    {
        $isUploadSuccess = true;
        if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
        {
            $imageError = "Alowed files are: .jpg, .jpeg, .png, .gif";
            $isUploadSuccess = false;
        }
        if($_FILES["image"]["size"] > 500000)
        {
            $imageError = "The file should not exceed 500KB";
            $isUploadSuccess = false;
        }
        if ($isUploadSuccess)
        {
            if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
            {
                $imageError = "There has been an error during the upload of the image";
                $isUploadSuccess = false;
            }
        }
    }
}
else
{
    $isSuccess = false;
}
if($isSuccess === true && $isUploadSuccess === true)
{
    $db = database::connect();
    $statement = $db->prepare("INSERT INTO products (name,description,price,category_id,image) values(?,?,?,?,?)");
    $statement->execute(array($name,$description,$price,$category,$image));
    $db = null;
    header("location: products.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin : Products</title>
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
                <h1 class="col-12">Add new product</h1>
                <form class="form col-12" role="form" action="addProduct.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $name; ?>">
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php echo $description; ?>">
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Price in €:</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Price" value="<?php echo $price; ?>">
                        <span class="help-inline"><?php echo $priceError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Category:</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                                $db = database::connect();
                                foreach($db->query('SELECT id, name FROM categories') as $row)
                                {
                                    echo '<option value="'. $row['id'] . '">' . $row['name'] . '</option>';
                                }
                                $db = null;
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Select an image:</label>
                        <input type="file" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a class="btn btn-primary" href="products.php">Previous<a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>