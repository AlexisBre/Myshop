<?php
require 'dbConnection.php';

if (isset($_SESSION))
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']=== 'connected')
    {
        if ($_SESSION['admin']==='admin')
        {
            header('location: admin.php');
            exit;
        }
        else
        {
            header('location: index.php');
            exit;
        }
    }
}

$emailError = $passwordError = $email = $password = "";
$isSuccess = true;

if(!empty($_POST))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isSuccess = true;

    if (empty($_POST['email']))
    {
        $emailError = "Please enter your e-mail.";
        $isSuccess = false;
    }
    if (empty($_POST['password']))
    {
        $passwordError = "Please enter your password.";
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
    $query = "SELECT password FROM users WHERE email = '" . $_POST['email'] . "'";
    $data = $db->query($query);
    $result = $data->fetch();
    $query2 = "SELECT username FROM users WHERE email = '" . $_POST['email'] . "'";
    $data2 = $db->query($query2);
    $result2 = $data2->fetch();
    $query3 = "SELECT admin FROM users WHERE email = '" . $_POST['email'] . "'";
    $data3 = $db->query($query3);
    $result3 = $data3->fetch();
    if ($result)
    {
        $dbPassword = $result['password'];
        $dbUsername = $result2['username'];
        $admin = $result3['admin'];
        if(password_verify($password,$dbPassword) === true)
        {
            if($admin == 1)
            {
                session_start();
                $_SESSION['loggedin']='connected';
                $_SESSION['admin']='admin';
                $_SESSION['username']=$dbUsername;
                $db = null;
                header('location: admin.php');
                exit;
            }
            else
            {
                session_start();
                $_SESSION['loggedin']='connected';
                $_SESSION['admin']='notAdmin';
                $_SESSION['username']=$dbUsername;
                $db = null;
                header('location: index.php');
                exit;
            }
        }
        else
        {
            $passwordError = "Wrong password.\n";
            $isSuccess = false;
        }
    }
    else
    {
        $emailError = "No account for this e-mail.\n";
        $isSuccess = false;
    }
}



function my_password_verify($enterdPassword,$dbPassword)
{
    if ($dbPassword == crypt($enterdPassword,$dbPassword))
    {
        return true;
    }
}

?>

<html>
    <head>
        <title>sign_in</title>
        <meta charset="utf-8"/>  
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id='signin' class="container">
            <div class="row">
                <h1 class="col-12">Sign in</h1>
                <form class="form col-12" role="form" action='signin.php' method='POST'>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>">
                        <span class="help-inline"><?php echo $emailError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
                        <span class="help-inline"><?php echo $passwordError; ?></span>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Sign in</button>
                    </div>
                </form>
                <form class="col-12" action='signup/signup.php' method='POST'>
                    <label>Don't have an account?</label>
                    <input class="btn btn-primary" type='submit' value="Sign up">
                </form>
            </div>
        </div>
    </body>
</html>
