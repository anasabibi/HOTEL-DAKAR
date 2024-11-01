<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="device-width, initial-scale=1.0">
    <title>CAANAN HOTEL- BOOKING STATUS</title>
    <?php require('inc/links.php'); ?>
 </head>
  <body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container">
      <div class="row">

      <div class="col-12 my-5 mb-3 px-4">
        <h2 class="fw-bold">PAYMENT STATUS</h2>
      </div>    

      <?php

        $frm_data = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

        if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
            header('Location: index.php');
            exit();
        }

        echo <<<data
        <div class="col-12 px-4">
            <p class="fw-bold alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                Paiement effectué ! Réservation réussie
                <br><br>
                <a href='bookings.php'>Aller aux réservations</a>
            </p>
        </div>
        data;
        ?>



      </div>
    </div>


    <?php require('inc/footer.php'); ?>

  </body>
</html> 