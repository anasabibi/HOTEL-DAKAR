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
      <title>Admin Panel - Refund Bookings</title>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <?php require('inc/links.php'); ?>
   </head>
   <body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">Réservations Remboursées</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="text-end mb-3"> 
                        <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-100 ms-auto" placeholder="Tapez pour chercher...">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover border">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">Détails de l'utilisateur</th>
                                    <th scope="col">Détails de la chambre</th>        
                                    <th scope="col">Montant du remboursement</th>          
                                    <th scope="col">Action</th>        
                                </tr>
                            </thead>
                            <tbody id="table-data">
                            </tbody>
                        </table>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>


      
    <?php require('inc/scripts.php'); ?>  

    <script src="scripts/refund_bookings1.js"></script>  

   </body>
</html>