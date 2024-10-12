<?php
   require('inc/essentials.php');
   require('inc/db_config.php');

   adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Admin Panel - Dashboard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <?php require('inc/links.php'); ?>
    <style>
      body {
  font-family: 'Inter', sans-serif;
  background-color: #f7f7f7;
}

.card {
  background-color: #fff3cd;
  border: none;
  border-radius: 15px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 25px;
  margin-bottom: 25px;
  transition: all 0.3s ease;
}

.card:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  transform: translateY(-5px);
}

.card.card-body {
  padding: 25px;
}

.card.card-body h6 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 10px;
  color: #333;
}

.card.card-body h1 {
  font-size: 36px;
  font-weight: 700;
  margin-bottom: 10px;
  color: #333;
}

.card.card-body h4 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 10px;
  color: #333;
}





.d-flex.align-items-center.justify-content-between h6.badge {
  font-size: 16px;
  font-weight: 600;
  padding: 5px 10px;
  border-radius: 10px;
  background-color: #337ab7;
  color: #fff;
}

.d-flex.align-items-center.justify-content-between h6.badge.bg-danger {
  background-color: #ff69b4;
  color: #fff;
}

.row.mb-4 {
  margin-bottom: 30px;
}

.col-md-3.mb-4 {
  margin-bottom: 30px;
}

.form-select.shadow-none.bg-light.w-auto {
  padding: 10px;
  border: none;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-select.shadow-none.bg-light.w-auto:focus {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

h5 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 20px;
  color: #333;
}

.bg-primary {
  background-color: #337ab7!important;
}

.bg-success {
  background-color: #8bc34a!important;
}

.bg-info {
  background-color: #66d9ef!important;
}

.bg-warning {
  background-color: #ffc107!important;
}

.bg-danger {
  background-color: #ff69b4!important;
}

/* Custom styles */

.dashboard-header {
  background-color: #337ab7;
  padding: 20px;
  border-radius: 15px 15px 0 0;
  color: #fff;
}

.dashboard-header h3 {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 10px;
}

.dashboard-header p {
  font-size: 16px;
  margin-bottom: 20px;
}

.dashboard-content {
  padding: 20px;
}

.dashboard-content.card {
  margin-bottom: 20px;
}


.dashboard-content.card:last-child {
  margin-bottom: 0;
}

.dashboard-footer {
  background-color: #f7f7f7;
  padding: 20px;
  border-radius: 0 0 15px 15px;
  text-align: center;
}

.dashboard-footer p {
  font-size: 16px;
  margin-bottom: 20px;
}

    </style>
</head>
<body class="bg-light">


  <?php
    require('inc/header.php');
   
      $is_shutdown = mysqli_fetch_assoc(mysqli_query($con,"SELECT `shutdown` FROM `settings`"));

      $current_bookings = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
         COUNT(CASE WHEN booking_status='booked' AND arrival=0 THEN 1 END) AS `new_bookings`,
         COUNT(CASE WHEN booking_status='cancelled' AND refund=0 THEN 1 END) AS `refund_bookings`
         FROM `booking_order`"));

      $unread_queries = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count`
       FROM `user_queries` WHERE `seen`=0"));

      $unread_reviews = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(sr_no) AS `count`
       FROM `rating_review` WHERE `seen`=0"));
 
      $current_users = mysqli_fetch_assoc(mysqli_query($con,"SELECT 
         COUNT(id) AS `total`,
         COUNT(CASE WHEN `status`=1 THEN 1 END) AS `active`,
         COUNT(CASE WHEN `status`=0 THEN 1 END) AS `inactive`,
         COUNT(CASE WHEN `is_verified`=0 THEN 1 END) AS `unverified`
         FROM `user_cred`"));
   

   
   ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3>TABLEAU DE BORD</h3>
                <?php
                if ($is_shutdown['shutdown']) {
                    echo <<<data
                    <h6 class="badge bg-danger py-2 px-3 rounded">Mode d'arrêt est actif</h6>
                    data;
                }
                ?>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-4">
                    <a href="new_bookings.php" class="text-decoration-none">
                        <div class="card text-center text-success p-3">
                            <h6>Nouvelles Réservations</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings'] ?></h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="refund_bookings.php" class="text-decoration-none">
                        <div class="card text-center text-warning p-3">
                            <h6>Remboursements</h6>
                            <h1 class="mt-2 mb-0"><?php echo $current_bookings['refund_bookings'] ?></h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="user_queries.php" class="text-decoration-none">
                        <div class="card text-center text-info p-3">
                            <h6>Requêtes Utilisateurs</h6>
                            <h1 class="mt-2 mb-0"><?php echo $unread_queries['count'] ?></h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="rate_review.php" class="text-decoration-none">
                        <div class="card text-center text-info p-3">
                            <h6>Évaluations & Avis</h6>
                            <h1 class="mt-2 mb-0"><?php echo $unread_reviews['count'] ?></h1>
                        </div>
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5>Analyse des Réservations</h5>
                <select class="form-select shadow-none bg-light w-auto" onchange="booking_analysis(this.value)">
                    <option value="1">Dernier Mois</option>
                    <option value="2">Derniers 3 Mois</option>
                    <option value="3">Dernière Année</option>
                    <option value="4">Depuis Toujours</option>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-primary p-3">
                        <h6>Total des Réservations</h6>
                        <h1 class="mt-2 mb-0" id="total_bookings"></h1>
                        <h4 class="mt-2 mb-0" id="total_amt">0:DH</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-success p-3">
                        <h6>Réservations Actives</h6>
                        <h1 class="mt-2 mb-0" id="active_bookings"></h1>
                        <h4 class="mt-2 mb-0" id="active_amt">0:DH</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-danger p-3">
                        <h6>Réservations Annulées</h6>
                        <h1 class="mt-2 mb-0" id="cancelled_bookings"></h1>
                        <h4 class="mt-2 mb-0" id="cancelled_amt">0:DH</h4>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Analyse des Utilisateurs, Requêtes, Avis</h5>
                <select class="form-select shadow-none bg-light w-auto" onchange="user_analysis(this.value)">
                    <option value="1">Dernier Mois</option>
                    <option value="2">Derniers 3 Mois</option>
                    <option value="3">Dernière Année</option>
                    <option value="4">Depuis Toujours</option>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-success p-3">
                        <h6>Nouvelles Inscriptions</h6>
                        <h1 class="mt-2 mb-0" id="total_new_reg">0</h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-primary p-3">
                        <h6>Requêtes</h6>
                        <h1 class="mt-2 mb-0" id="total_queries">0</h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-primary p-3">
                        <h6>Avis</h6>
                        <h1 class="mt-2 mb-0" id="total_reviews">0</h1>
                    </div>
                </div>
            </div>

            <h5>Utilisateurs</h5>
            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-info p-3">
                        <h6>Total</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-success p-3">
                        <h6>Active</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['active'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-warning p-3">
                        <h6>Inactive</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['inactive'] ?></h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-danger p-3">
                        <h6>Non Vérifié</h6>
                        <h1 class="mt-2 mb-0"><?php echo $current_users['unverified'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


   <?php require('inc/scripts.php'); ?> 
 <script src="scripts/dashboard1.js"></script>
</body>
</html>