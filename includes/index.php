<?php
session_start();
include('config.php'); // contains $db = new PDO(...);

if (isset($_POST['login'])) {
    // CAPTCHA check (optional)
    if ($_POST["vercode"] != $_SESSION["vercode"] || $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {
        $email    = $_POST['emailid'];
        $password = $_POST['password'];

        // Fetch stored hash by email
        $sql = "SELECT StudentId, EmailId, Password, Status FROM tblstudents WHERE EmailId=:email";
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        if ($result) {
            // Verify entered password against stored hash
            if (password_verify($password, $result->Password)) {
                if ($result->Status == 1) {
                    $_SESSION['stdid'] = $result->StudentId;
                    $_SESSION['login'] = $result->EmailId;
                    echo "<script type='text/javascript'> document.location = '../public/dashboard.php'; </script>";
                } else {
                    echo "<script>alert('Your Account Has been blocked. Please contact admin');</script>";
                }
            } else {
                echo "<script>alert('Invalid Password');</script>";
            }
        } else {
            echo "<script>alert('Invalid Email');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="..\public\assests\css\bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="..\public\assests\css\font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="..\public\assests\css\style.css" rel="stylesheet" />
    <!-- FOOTER STYLE  -->
    <link href="..\public\assests\css\footer.css" rel="stylesheet" />
    <!-- HEADER STYLE  -->
    <link href="..\public\assests\css\header.css" rel="stylesheet" />
    
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <!------MENU SECTION START-->
<?php include('header.php');?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
<div class="container">
<div class="row pad-botm">
<div class="col-md-12">
<h4 class="header-line">USER LOGIN FORM</h4>
</div>
</div>
             
<!--LOGIN PANEL START-->           
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 LOGIN FORM
</div>
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter Email id</label>
<input class="form-control" type="text" name="emailid" required autocomplete="off" />
</div>
<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required autocomplete="off"  />
<p class="help-block"><a href="user-forgot-password.php">Forgot Password</a></p>
</div>

 <div class="form-group">
<label>Verification code : </label>
<input type="text" class="form-control1"  name="vercode" maxlength="5" autocomplete="off" required  style="height:25px;" />&nbsp;<img src="captcha.php">
</div> 

 <button type="submit" name="login" class="btn btn-info">LOGIN </button> | <a href="signup.php">Not Register Yet</a>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PANEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="..\public\assests\js\jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="..\public\assests\js\bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="..\public\assests\js\custom.js"></script>

</body>
</html>
