<?php
require_once '..\includes\config.php';

//admin details
$fullName = 'Manupriya Ranjika';
$adminEmail = 'manupriya@gmail.com';
$userName = 'admin';
 //bycrypt pwd
$Pass = '123456@pass';
$adminPass = password_hash($Pass,PASSWORD_DEFAULT);

$sql = "INSERT IGNORE INTO admin(FullName, AdminEmail, UserName, Password) VALUES (:fullname, :email, :username, :password)";
$stmt = $db->prepare($sql);

$stmt->bindParam(':fullname', $fullName);
$stmt->bindParam(':email', $adminEmail);
$stmt->bindParam(':username', $userName);
$stmt->bindParam(':password', $adminPass);

if ($stmt->execute()) {
// echo "Admin account created successfully!";
} else {
    echo "error: " . implode(" | ", $stmt->errorInfo());
}




/*
INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'STU001', 'Nimal Perera', 'nimal.perera@gmail.com', '0771234567', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-04-01 09:15:00', '2025-01-05 12:00:00'),
(2, 'STU002', 'Kumari Silva', 'kumari.silva@gmail.com', '0719876543', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-04-03 10:30:00', NULL),
(3, 'STU003', 'Tharindu Jayasinghe', 'tharindu.j@gmail.com', '0754567890', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-04-05 14:20:00', NULL);

*/


?>