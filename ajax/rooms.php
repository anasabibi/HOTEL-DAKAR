<style>
  .card {
  border-radius: 15px;
  overflow: hidden;
}

.card img {
  border-radius: 15px 0 0 15px;
}

.card h5 {
  font-size: 1.25rem;
}

.card h6 {
    font-size: 1rem;
    color: #f4511e;
}

.card .features, .card .facilities, .card .guests {
  border-bottom: 1px solid #e0e0e0;
  padding-bottom: 10px;
  margin-bottom: 10px;
}

.card .features span, .card .facilities span, .card .guests span {
  display: inline-block;
  padding: 0.5em 0.75em;
  margin-right: 5px;
  font-size: 0.875rem;
  background-color: #f8f9fa;
  color: #343a40;
  border-radius: 10px;
}

.card .btn-outline-dark {
  margin-top: 10px;
  border-radius: 10px;
}

.font-weight-bold {
  font-weight: 600;
}

</style>
<?php
  require('../admin/inc/db_config.php');
  require('../admin/inc/essentials.php');
  date_default_timezone_set("Africa/Casablanca");

  session_start();

  if(isset($_GET['fetch_rooms']))
  {
    $chk_avail = json_decode($_GET['chk_avail'], true);

    if($chk_avail['checkin']!='' && $chk_avail['checkout']!='')
    {
      $today_date = new DateTime(date("Y-m-d"));
      $checkin_date = new DateTime($chk_avail['checkin']);
      $checkout_date = new DateTime($chk_avail['checkout']);
  
      if($checkin_date == $checkout_date){
        echo"<h3 class='text-center text-danger'>Dates invalides ! Vous ne pouvez pas effectuer le check-out le même jour que le check-in</h3>";
        exit;
      }
      else if($checkout_date < $checkin_date){
        echo"<h3 class='text-center text-danger'>Dates invalides !</h3>";
        exit;
      }
      else if($checkin_date < $today_date){
        echo"<h3 class='text-center text-danger'>Dates invalides !</h3>";
        exit;
      }
  
    }
    
    // Décoder les données des invités
    $guests = json_decode($_GET['guests'], true);
    $adults = ($guests['adults'] != '') ? $guests['adults'] : 0;
    $children = ($guests['children'] != '') ? $guests['children'] : 0;

    // Décoder la liste des installations
    $facility_list = json_decode($_GET['facility_list'], true);

    // Compter le nombre de chambres et générer la sortie pour les cartes de chambre
    $count_rooms = 0;
    $output = "";
  
    // Récupérer les paramètres pour vérifier si la fermeture est configurée ou non
    $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=1";
    $settings_r = mysqli_fetch_assoc(mysqli_query($con, $settings_q));    

    // Requête pour les cartes de chambre
    $room_res = select("SELECT * FROM `rooms` WHERE `adult` >= ? AND `children` >= ? AND `status` = ? AND `removed` = ?", [$adults, $children, 1, 0], 'iiii');
          
    while($room_data = mysqli_fetch_assoc($room_res))
    {

      if($chk_avail['checkin'] != '' && $chk_avail['checkout'] != '')
      {
        $tb_query = "SELECT COUNT(*) AS `total_booking` FROM `booking_order`
            WHERE booking_status = ? AND room_id = ?
            AND check_out > ? AND check_in < ?";

        $values = ['booked', $room_data['id'], $chk_avail['checkin'], $chk_avail['checkout']];
        $tb_fetch= mysqli_fetch_assoc(select($tb_query, $values, 'siss'));

        if(($room_data['quantity'] - $tb_fetch['total_booking']) == 0){
           continue;
        }
      }

       // Obtenir les installations de la chambre avec des filtres
       $fac_count = 0;

       $fac_q = mysqli_query($con, "SELECT f.name, f.id FROM `facilities` f
       INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
       WHERE rfac.room_id = '$room_data[id]'");

        $facilities_data = "";
        while($fac_row = mysqli_fetch_assoc($fac_q))
        {
          if(in_array($fac_row['id'], $facility_list['facilities'])){
            $fac_count++;
          }

          $facilities_data .= "<span class='badge bg-light text-dark'>
          $fac_row[name]
          </span>";

        }

        if(count($facility_list['facilities']) != $fac_count){
          continue;
        }

      // Obtenir les caractéristiques de la chambre
      $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f
        INNER JOIN `room_features` rfea ON f.id = rfea.features_id
        WHERE rfea.room_id = '$room_data[id]'");

      $features_data = "";
      while($fea_row = mysqli_fetch_assoc($fea_q)){
        $features_data .= "<span class='badge bg-light text-dark'>
        $fea_row[name]
        </span>";

      }

      // Obtenir la vignette de l'image
      $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
      $thumb_q = mysqli_query($con, "SELECT * FROM `room_images`
                WHERE `room_id`='$room_data[id]'
                AND `thumb`='1'");

      if(mysqli_num_rows($thumb_q) > 0){
        $thumb_res = mysqli_fetch_assoc($thumb_q);  
        if($thumb_res !== null && isset($thumb_res['image'])) {
          $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
        }
      }

      $book_btn = "";

      if(!$settings_r['shutdown']){
        $login = 0;
        if(isset($_SESSION['login']) && $_SESSION['login'] == true){
          $login = 1;
        }
        $book_btn = "<button onclick='checkLoginToBook($login, $room_data[id])' class='btn btn-sm w-100 text-white custom-bg shadow-none mb-2'>Réserver</button>";
      }

      // Imprimer la carte de la chambre

      $output .= "
          <div class='card mb-4 border-0 shadow'>
            <div class='row g-0 p-3 align-items-center'>
              <div class='col-md-5 mb-lg-0 mb-md-0 mb-3'>
                  <img src='$room_thumb' class='img-fluid rounded'>
              </div>
              <div class='col-md-5 px-lg-3 px-md-3 px-0'>
                  <h5 class='mb-3 font-weight-bold'>$room_data[name]</h5>
                  <div class='features mb-3'>
                    <h6 class='mb-1 font-weight-bold'>Caractéristiques</h6>
                    $features_data
                  </div>
                  <div class='facilities mb-3'>
                    <h6 class='mb-1 font-weight-bold'>Installations</h6>
                    $facilities_data
                  </div>
                  <div class='guests mb-3'>
                    <h6 class='mb-1 font-weight-bold'>Invités</h6>
                    <span class='badge bg-light text-dark'>$room_data[adult] Adultes</span>
                    <span class='badge bg-light text-dark'>$room_data[children] Enfants</span>
                  </div>
              </div>
              <div class='col-md-2 mt-lg-0 mt-md-0 mt-4 text-center'>
                <h6 class='mb-4 font-weight-bold' style='color: #6c757d !important;'>$room_data[price] DH par nuit</h6>
                $book_btn
                <a href='room_details.php?id=$room_data[id]' class='btn btn-sm w-100 btn-outline-dark shadow-none'>Plus de détails</a>
              </div>
            </div>
          </div>
        ";

      $count_rooms++;
    }

    if ($count_rooms > 0) {
      echo $output;
    } else {
      echo "<h3 class='text-center text-danger'>Aucune chambre à afficher !</h3>";
    }
  }

?>
