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
      <title>Admin Panel - New Bookings</title>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <?php require('inc/links.php'); ?>
      
   </head>
   <body class="bg-light">

    <?php require('inc/header.php'); ?>

      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                  <h3 class="mb-4">Nouvelles Réservations</h3>

                  <div class="card border-0 shadow-sm mb-4">
                     <div class="card-body">
                        <div class="text-end mb-3"> 
                              <input type="text" oninput="get_bookings(this.value)" class="form-control shadow-none w-100 ms-auto" placeholder="Tapez pour chercher">
                        </div>
                        <div class="table-responsive">
                              <table class="table table-hover border">
                                 <thead>
                                    <tr class="bg-dark text-light">
                                          <th scope="col">#</th>
                                          <th scope="col">Détails de l'utilisateur</th>
                                          <th scope="col">Détails de la chambre</th>        
                                          <th scope="col">Détails de la réservation</th>          
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

      <!-- Modal d'Attribution de Numéro de Chambre -->

      <div class="modal fade" id="assign-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <form id="assign_room_form">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Attribuer une Chambre</h5>
                     </div>
                     <div class="modal-body">
                        <div class="mb-3">
                              <label class="form-label fw-bold">Numéro de Chambre</label>
                              <input type="text" name="room_no" class="form-control shadow-none" required>
                        </div>
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                              Remarque : Attribuez le numéro de chambre uniquement lorsque l'utilisateur est arrivé!
                        </span>
                        <input type="hidden" name="booking_id">
                     </div>
                     <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">ANNULER</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">ATTRIBUER</button>
                     </div>
                  </div>
            </form>
         </div>
      </div>


    <?php require('inc/scripts.php'); ?>  

    <script src="scripts/new_bookings1.js"></script>  

   </body>
</html>