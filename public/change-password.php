<?php
session_start();
include('../includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login'])==0) {   
    header('location:index.php');
} else { 
    if(isset($_POST['change'])) {
        $currentPassword = $_POST['password'];
        $newPassword = $_POST['newpassword'];
        $email = $_SESSION['login'];

        // 1. Fetch stored hash for this user
        $sql = "SELECT Password FROM tblstudents WHERE EmailId=:email";
        $query = $db->prepare($sql); // 
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        if($result) {
            // 2. Verify current password
            if(password_verify($currentPassword, $result->Password)) {
                // 3. Hash new password securely
                $newHash = password_hash($newPassword, PASSWORD_DEFAULT);

                // 4. Update database
                $con = "UPDATE tblstudents SET Password=:newpassword WHERE EmailId=:email";
                $chngpwd1 = $db->prepare($con);
                $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
                $chngpwd1->bindParam(':newpassword', $newHash, PDO::PARAM_STR);
                $chngpwd1->execute();

                $msg = "Your password was successfully changed";
            } else {
                $error = "Your current password is wrong";  
            }
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
    <link href="assests/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assests/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assests/css/style.css" rel="stylesheet" />
    <!-- FOOTER STYLE  -->
    <link href="assests/css/footer.css" rel="stylesheet" />
    <!-- HEADER STYLE  -->
    <link href="assests/css/header.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assests/js/datatables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
        body {
        background: none !important;
    }
    body::before,
    body::after {
        display: none !important;
    }
  h4 {
        color: #000 !important;
    }

    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);

}
    </style>

</head>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form[name='chngpwd']");
    const newPassword = form.querySelector("input[name='newpassword']");
    const confirmPassword = form.querySelector("input[name='confirmpassword']");

    form.addEventListener("submit", function(e) {
        if (newPassword.value !== confirmPassword.value) {
            e.preventDefault(); //
            alert("New Password and Confirm Password fields do not match!");
            confirmPassword.focus();
        }
    });
});
</script>

<body>
    <!------MENU SECTION START-->
    <?php include('../includes/header.php');?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">User Change Password</h4>
                </div>
            </div>
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>            
            <!--LOGIN PANEL START-->           
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Change Password
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" name="chngpwd">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input class="form-control" type="password" name="password" autocomplete="off" required  />
                                </div>

                                <div class="form-group">
                                    <label>Enter Password</label>
                                    <input class="form-control" type="password" name="newpassword" autocomplete="off" required  />
                                </div>

                                <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                                </div>

                                <button type="submit" name="change" class="btn btn-info">Change</button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
            <!---LOGIN PANEL END-->            
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('../includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/datatables/jquery.dataTables.js"></script>
    <script src="assets/js/datatables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
