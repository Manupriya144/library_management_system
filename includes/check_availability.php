<?php
require_once("config.php");

if (!empty($_POST["emailid"])) {

    $email = $_POST["emailid"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span style='color:red'>Invalid email format</span>";
        exit;
    }

    $sql = "SELECT EmailId FROM tblstudents WHERE EmailId = :email";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo "<span style='color:red'> Email already exists.</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    } else {
        echo "<span style='color:green'> Email available for registration.</span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}
?>
