<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!--Swiper CSS  -->
<link rel="stylesheet" href="css/common8.css">


<?php 

session_start();
date_default_timezone_set("Africa/Casablanca");

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
$contact_q= "SELECT * FROM `contact_details` WHERE sr_no=? ";
$settings_q= "SELECT * FROM `settings` WHERE sr_no=? ";

$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
$settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));


if ($settings_r['shutdown']) {
    echo <<<alertbar
    <div class='bg-danger text-center p-2 fw-bold'>
        <i class="bi bi-exclamation-triangle-fill"></i>
        Les réservations sont temporairement fermées !
    </div>
    alertbar;
}



?>