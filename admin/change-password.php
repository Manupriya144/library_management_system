<?php
session_start();
include('../includes/config.php');
error_reporting(0);

if(strlen($_SESSION['alogin']) == 0) {   
    header('location:../includes/index.php');
    exit;
}

if(isset($_POST['change'])) {

    $currentPassword = $_POST['password'];
    $newPassword     = $_POST['newpassword'];
    $username        = $_SESSION['alogin'];

    // Fetch stored password hash
    $sql = "SELECT Password FROM admin WHERE UserName = :username";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if($result) {

        // Verify current password
        if(password_verify($currentPassword, $result->Password)) {

            // Hash new password
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update password
            $update = "UPDATE admin SET Password = :newpassword WHERE UserName = :username";
            $stmt = $db->prepare($update);
            $stmt->bindParam(':newpassword', $newHash, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $msg = "Your password was successfully changed";

        } else {
            $error = "Your current password is incorrect";
        }

    } else {
        $error = "User not found";
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Online Library Management System | Change Password</title>

    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="../public/assests/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="../public/assests/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="../public/assests/css/style.css" rel="stylesheet" />
    <!-- FOOTER STYLE  -->
    <link href="../public/assests/css/footer.css" rel="stylesheet" />
    <!-- HEADER STYLE  -->
    <link href="../public/assests/css/header.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="../public/assests/js/datatables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
    </style>

    <script type="text/javascript">
    function valid() {
        if(document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
            alert("New Password and Confirm Password do not match!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
</head>

<body>
<?php include('includes/header.php'); ?>

<div class="content-wrapper">
<div class="container">

<div class="row pad-botm">
    <div class="col-md-12">
        <h4 class="header-line">User Change Password</h4>
    </div>
</div>

<?php if($error){ ?>
    <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div>
<?php } else if($msg){ ?>
    <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
<?php } ?>

<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">

<div class="panel-heading">
    Change Password
</div>

<div class="panel-body">
<form role="form" method="post" onSubmit="return valid();" name="chngpwd">

<div class="form-group">
    <label>Current Password</label>
    <input class="form-control" type="password" name="password" required />
</div>

<div class="form-group">
    <label>New Password</label>
    <input class="form-control" type="password" name="newpassword" required />
</div>

<div class="form-group">
    <label>Confirm Password</label>
    <input class="form-control" type="password" name="confirmpassword" required />
</div>

<button type="submit" name="change" class="btn btn-info">Change</button>

</form>
</div>

</div>
</div>
</div>

</div>
</div>

<?php include('includes/footer.php'); ?>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>
