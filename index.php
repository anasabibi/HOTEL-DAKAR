<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>

    <title>  <?php echo $settings_r['site_title']?> -HOME</title>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Custom Styles -->
    <style>
      .gallery-section {
  background-color: #f8f9fa;
  padding: 60px 0;
}

/* Horizontal line style */
.h-line {
  width: 50px;
  margin: 0 auto;
  height: 4px;
  background-color: #f4511e; /* Accent color */
}

/* Style for the gallery title */
.gallery-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 40px;
  color: #333;
}

/* Style for the gallery grid */
.gallery-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px; /* Adjust the gap between items */
}

/* Style for each gallery item */
.gallery-item {
  flex-basis: calc(33.33% - 20px); /* Adjusted width for 3 items in a row */
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  transition: transform 0.3s ease-in-out;
  box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
}

/* Hover effect for each gallery item */
.gallery-item:hover {
  transform: scale(1.05);
}
.card{
  background-color: #f9e8ce;
}

/* Style for gallery item images */
.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Ensure images maintain aspect ratio and cover container */
  border-radius: 10px 10px 0 0;
}

/* Media query for responsiveness - adjust as needed */
@media (max-width: 768px) {
  .gallery-item {
    flex-basis: calc(50% - 20px); /* Adjusted width for 2 items in a row */
  }
}

@media (max-width: 576px) {
  .gallery-item {
    flex-basis: calc(100% - 20px); /* Adjusted width for 1 item per row */
  }
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}
.mt-5 {
    margin-top: 1rem !important;
}
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 25px;
                padding: 0 35px;
            }
        }
        #scrollBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: #f4511e;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 10px;
        }

        #scrollBtn:hover {
            background-color: #d63c17;
        }
        
        .p-4 {
    padding: 3rem !important;
}

    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
  <?php require('inc/header.php'); ?>
    <!-- Carousel -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
              <?php
              $res =selectALL('carousel');
              while ($row = mysqli_fetch_assoc($res)) {
                $path = CAROUSEL_IMG_PATH;
                echo <<<data
                <div class="swiper-slide">
                    <img src="$path$row[image]" class="w-100 d-block" />
                </div>
                data;
            }
              ?>
            </div>
        </div>
    </div>

    <?php
// Votre logique PHP ici, par exemple :
$isTranslateYNeeded = true; // Vous pouvez définir cette variable en fonction de vos conditions

// Génération dynamique de la classe CSS en fonction de la variable PHP
$headerClass = "header";
if ($isTranslateYNeeded) {
    $headerClass .= " translateY";
}
?>
    <!--check room availability-->

    <div class="container availability-form">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="mb-4">Vérifiez la disponibilité des réservations</h5>
            <form action="rooms.php">
                <div class="row align-items-end">
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Date d'arrivée</label>
                        <input type="date" class="form-control shadow-none" name="checkin" required>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Date de départ</label>
                        <input type="date" class="form-control shadow-none" name="checkout" required>
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Adultes</label>
                        <select class="form-select shadow-none" name="adult">
                            <?php
                            $guests_q = mysqli_query($con, "SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children` FROM `rooms` WHERE `status`=1 AND `removed`='0'");
                            $guests_res = mysqli_fetch_assoc($guests_q);

                            for ($i = 1; $i <= $guests_res['max_adult']; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label class="form-label" style="font-weight: 500;">Enfants</label>
                        <select class="form-select shadow-none" name="children">
                            <?php
                            for ($i = 1; $i <= $guests_res['max_children']; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="check_availability">
                    <div class="col-lg-1 mb-lg-3 mt-2">
                        <button type="submit" class="btn text-white shadow-none custom-bg">Soumettre</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Chambres -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">NOS CHAMBRES</h2>

<div class="container">
  <div class="row justify-content-center">
    <?php
    $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');
    $index = 0;

    while ($room_data = mysqli_fetch_assoc($room_res)) {

        // Obtenir les caractéristiques de la chambre
        $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
        INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
        WHERE rfea.room_id = '$room_data[id]'");
        $features_data = "";
        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fea_row['name']}</span>";
        }

        // Obtenir les installations de la chambre
        $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
        WHERE rfac.room_id = '$room_data[id]'");

        $facilities_data = '';
        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fac_row['name']}</span>";
        }

        // Obtenir la vignette de l'image
        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumb` = '1'");

        if (mysqli_num_rows($thumb_q) > 0) {
            $thumb_res = mysqli_fetch_assoc($thumb_q);
            $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        }

        $book_btn = "";

        if (!$settings_r['shutdown']) {
            $login = 0;
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $login = 1;
            }

            $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white custom-bg shadow-none'>Réserver</button>";
        }

        echo <<<data
        <div class="col-lg-4 col-md-6 my-3 room-card" style="max-width: 350px;">
          <div class="card border-0 shadow">
            <img src="$room_thumb" class="card-img-top" alt="Aperçu de la chambre">
            <div class="card-body">
              <h5 class="card-title">$room_data[name]</h5>
              <h6 class="card-subtitle mb-2 text-muted">$room_data[price] DH par nuit</h6>
              <div class="features mb-4">
                <h6 class="mb-1">Caractéristiques</h6>
                $features_data
              </div>
              <div class="facilities mb-4">
                <h6 class="mb-1">Installations</h6>
                $facilities_data
              </div>
              <div class="guests mb-4">
                <h6 class="mb-1">Invités</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap me-1 mb-1">$room_data[adult] Adultes</span>
                <span class="badge rounded-pill bg-light text-dark text-wrap me-1 mb-1">$room_data[children] Enfants</span>
              </div>
              <div class="rating mb-4">
                <h6 class="mb-1">Évaluation</h6>
                <span class="badge rounded-pill bg-light">
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                  <i class="bi bi-star-fill text-warning"></i>
                </span>
              </div>
              <div class="d-flex justify-content-between">
                $book_btn
                <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none">Plus de détails</a>
              </div>
            </div>
          </div>
        </div>
        data;

        $index++;
    }
    ?>

    <div class="col-lg-12 text-center mt-5">
      <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Plus de chambres >></a>
    </div>
  </div>
</div>

<!-- Gallery -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">NOS Galerie</h2>
      <div class="container">
        <div class="gallery-grid">
          <?php
          // Database connection parameters
          $hname='localhost';
          $uname='root';
          $pass='';
          $db='pfc';
          
          $conn=mysqli_connect($hname,$uname,$pass,$db);

          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Prepare and execute the SQL statement
          $sql = "SELECT image FROM gallery LIMIT 4"; // Only select the first three images
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();

          // Output images
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $path = GALLERY_IMG_PATH;
              echo <<<data
              <div class="gallery-item">
                  <img src="$path$row[image]" alt="Hotel Image" class="w-100 d-block" />
              </div>
              data;
          }
        }

          // Close connections
          $stmt->close();
          $conn->close();
          ?>
        </div>
      </div>
      
      <!-- "Show More" button -->
      <div class="text-center show-more-button">
        <a href="gallery.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Voir Plus >>>></a>
      </div>
</div>


    <!-- Facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Nos Installations</h2>

    <div class="container">
      <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
        <?php
              $res = mysqli_query($con, "SELECT * FROM `facilities` ORDER BY `id` DESC LIMIT 5");
              $path = FACILITIES_IMG_PATH;

              while ($row = mysqli_fetch_assoc($res)) {
                  echo <<<data
                    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                      <img src="$path$row[icon]" width="60px">
                      <h5 class="mt-3">$row[name]</h5>
                    </div>                   
                  data;
              }
          ?>
        <div class="col-lg-12 text-center mt-5 ">
          <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Voit Plus>>>></a>
        </div>
      </div>
    </div>
   <!-- Témoignages -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">TÉMOIGNAGES</h2>

<div class="container mt-5">
  <div class="swiper swiper-testmonials">
    <div class="swiper-wrapper mb-5">
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-items-center mb-3">
          <i class="bi bi-person-circle fs-3 me-2"></i>
          <h6 class="m-0 ms-2">Rachid</h6>
        </div>
        <p>J'ai passé un excellent séjour à l'hôtel. Le service était impeccable et les chambres étaient très confortables. Je le recommande vivement !</p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-items-center mb-3">
          <!-- <img src="images/term/star.svg" width="30px"> -->
          <i class="bi bi-person-circle fs-3 me-2"></i>
          <h6 class="m-0 ms-2">Anas</h6>
        </div>
        <p>Mon séjour a été merveilleux. Le personnel était très accueillant et les installations étaient top. Je reviendrai certainement !</p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-items-center mb-3">
          <i class="bi bi-person-circle fs-3 me-2"></i>
          <h6 class="m-0 ms-2">Youness</h6>
        </div>
        <p>Un des meilleurs hôtels où j'ai séjourné. Les chambres sont propres et spacieuses, et le service est excellent. Je le recommande vivement.</p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <div class="col-lg-12 text-center mt-5">
    <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">En savoir plus >></a>
  </div>
</div>

    <!-- reach us -->        
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">CONTACTEZ-NOUS</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <iframe class="w-100 rounded" height="420px" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4" style="margin-top: 40px;">
                    <h5>Appelez-nous</h5>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    <?php 
                      if($contact_r['pn2']!=''){
                        echo<<<data
                          <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark">
                           <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                         </a>
                        data; 
                      }                   
                    ?>
                </div>
                <div class="bg-white p-4 rounded mb-4">
                  <h5>Suivez-nous</h5>
                  <?php 
                    if($contact_r['tw']!=''){
                      echo<<<data
                        <a href="$contact_r[tw]" class="d-inline-block mb-3">
                          <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-twitter me-1"></i> Twitter
                          </span>
                        </a>
                        <br>
                      data;
                    
                    } 
                  ?>
                  
                  <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
                    <span class="badge bg-light text-dark fs-6 p-2">
                      <i class="bi bi-facebook me-1"></i> Facebook
                    </span>
                  </a>
                  <br>
                  <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block">
                    <span class="badge bg-light text-dark fs-6 p-2">
                      <i class="bi bi-instagram me-1"></i> Instagram
                    </span>
                  </a>
                </div>
              </div>
            </div>
        </div>
    </div>
    <!--Reset Password modal -->
    
    <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form id="recovery-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center">
                <i class="bi bi-shield-lock fs-3 me-2"></i>Configurer un nouveau mot de passe
              </h5>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" name="pass" required class="form-control shadow-none">
                <input type="hidden" name="email">
                <input type="hidden" name="token">
              </div>
              <div class="mb-2 text-end">
                <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">ANNULER</button>
                <button type="submit" class="btn btn-dark shadow-none">SOUMETTRE</button>
              </div>
            </div>
          </form> 
        </div>
      </div>
    </div>



    <!-- Scroll to Top Button -->
    <button onclick="topFunction()" id="scrollBtn" title="Go to top">
      <i class="bi bi-arrow-up-circle"></i>
    </button>
<br>
<br>
    <!-- Footer -->

    <?php require('chatbot.php'); ?>                 
   <?php require('inc/footer.php');  ?>


   <?php

      if (isset($_GET['account_recovery'])) {
          $data = filteration($_GET);

          $t_date = date("Y-m-d");

          $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1", [$data['email'], $data['token'], $t_date], 'sss');

          if (mysqli_num_rows($query) == 1) {
              echo <<<showModal
              <script>
                  document.addEventListener('DOMContentLoaded', function () {
                      var myModal = document.getElementById('recoveryModal');
                      if (myModal) {
                          myModal.querySelector("input[name='email']").value = '{$data['email']}';
                          myModal.querySelector("input[name='token']").value = '{$data['token']}';
                          var modal = new bootstrap.Modal(myModal);
                          modal.show();
                      } else {
                          console.error('Élément modal non trouvé.');
                      }
                  });
              </script>
              showModal;
          } else {
              alert("error", "Lien invalide ou expiré !");
          }
      }

    ?>

    
    <!-- Bootstrap Bundle with Popper -->
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Custom Script -->
    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });

        var swiper = new Swiper(".swiper-testmonials", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          slidesPerView:"3",
          loop:true,
          coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
          },
          pagination: {
            el: ".swiper-pagination",
          },
          breakpoints:{
            320: {
              slidesPerView: 1,           
            },
            640: {
              slidesPerView:1,
            },
            768: {
              slidesPerView: 1,
            },
            1024: {
              slidesPerView:3,
            },
          }
        });

        // recover account

        let recovery_form = document.getElementById('recovery-form');

        recovery_form.addEventListener('submit',(e)=>{
          e.preventDefault();

          let data = new FormData();

          data.append('email',recovery_form.elements['email'].value);
          data.append('token',recovery_form.elements['token'].value);
          data.append('pass',recovery_form.elements['pass'].value);
          data.append('recover_user','');

          var myModal = document.getElementById('recoveryModal');
          var modal = bootstrap.Modal.getInstance(myModal);
          modal.hide();

          let xhr = new XMLHttpRequest();
          xhr.open("POST","ajax/login_register.php",true);

          xhr.onload = function(){
            if(this.responseText == 'failed'){
              alert('error',"La réinitialisation du compte a échoué !");
            }
            else{
                alert('success',"Réinitialisation du compte réussie !");
                recovery_form.reset();
            }
          }

          xhr.send(data);
        });

        // Get the button
              let mybutton = document.getElementById("scrollBtn");

          // When the user scrolls down 20px from the top of the document, show the button
          window.onscroll = function() {
              scrollFunction();
          };

          function scrollFunction() {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                  mybutton.style.display = "block";
              } else {
                  mybutton.style.display = "none";
              }
          }

          // When the user clicks on the button, scroll to the top of the document
          function topFunction() {
              document.body.scrollTop = 0;
              document.documentElement.scrollTop = 0;
          }
          document.addEventListener("DOMContentLoaded", function() {
    const roomCards = document.querySelectorAll('.room-card');

    roomCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('visible');
        }, index * 300); // Ajustez le délai au besoin
    });

    roomCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.classList.add('hovered');
        });

        card.addEventListener('mouseleave', () => {
            card.classList.remove('hovered');
        });

        const cardBtn = card.querySelector('.btn');
        cardBtn.addEventListener('mouseenter', () => {
            cardBtn.classList.add('hovered');
        });

        cardBtn.addEventListener('mouseleave', () => {
            cardBtn.classList.remove('hovered');
        });
    });
});



    </script>
</body>

</html>