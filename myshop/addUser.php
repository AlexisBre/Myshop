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

$usernameError = $passwordError = $emailError = $adminError = $username = $password = $email = $admin = "";
$isSuccess = true;

if(!empty($_POST))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];
    $isSuccess = true;

    if(empty($username))
    {
        $usernameError = 'Empty username';
        $isSuccess = false;
    }
    else
    {
        $db = database::connect();
        $testQuery = "SELECT username FROM users WHERE username = '" . $username . "'";
        $testData = $db->query($testQuery);
        $testRes = $testData->fetchAll();
        if ($testRes)
        {
            $usernameError = 'Username already taken';
            $isSuccess = false;
        }
        $db = null;
    }
    if(empty($password))
    {
        $passwordError = 'Empty password';
        $isSuccess = false;
    }
    if(empty($email))
    {
        $emailError = 'Empty e-mail';
        $isSuccess = false;
    }
    else
    {
        if (filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $db = database::connect();
            $testQuery = "SELECT email FROM users WHERE email = '" . $email . "'";
            $testData = $db->query($testQuery);
            $testRes = $testData->fetchAll();
            if ($testRes)
            {
                $emailError = 'E-mail already used';
                $isSuccess = false;
            }
            $db = null;
        }
        else
        {
            $emailError = 'invalid e-mail';
            $isSuccess = false;
        }
    }
    if(empty($admin))
    {
        $adminError = 'Empty admin';
        $isSuccess = false;
    }
}
else
{
    $isSuccess = false;
}

if($isSuccess === true)
{
    $db = database::connect();
    $statement = $db->prepare("INSERT INTO users (username,password,email,admin) values(?,?,?,?)");
    $statement->execute(array($username,crypt($password),$email,$admin));
    $db = null;
    header('location: users.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin : User</title>
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
                <h1 class="col-12">Add new user</h1>
                <form class="form col-12" role="form" action="addUser.php" method="post">
                    <div class="form-group">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>">
                        <span class="help-inline"><?php echo $usernameError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                        <span class="help-inline"><?php echo $passwordError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>">
                        <span class="help-inline"><?php echo $emailError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Admin:</label>
                        <select class="form-control" id="admin" name="admin">
                            <?php
                                    echo '<option>false</option>';
                                    echo '<option value="1">true</option>';
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $adminError; ?></span>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a class="btn btn-primary" href="users.php">Previous<a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>