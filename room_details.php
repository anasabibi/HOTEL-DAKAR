<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title']?> - ROOMS DETAILS</title>
    <style>
   body {
    font-family: 'Poppins', sans-serif;
    background: #f9e8ce57;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 15px;
}

.breadcrumb {
    background-color: transparent;
    padding: 10px 0;
    margin-bottom: 40px;
}

.breadcrumb-item a,
.breadcrumb-item.active {
    color: #f4511e;
    text-decoration: none;
}

.card {
    background-color: #f9e8ce;
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
}

.card-body h4 {
    font-weight: bold;
    color: #f4511e;
    margin-bottom: 20px;
}

.badge {
    background-color: #f4511e;
    color: white;
    font-size: 0.9em;
    padding: 8px 12px;
}

.carousel-inner img {
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.carousel-inner img:hover {
    transform: scale(1.05);
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: #f4511e;
    border-radius: 50%;
}

.rating i {
    color: #ffd700;
}

.custom-bg {
    background-color: #f4511e;
    border-color: #f4511e;
    padding: 10px 20px;
    color: #ffffff;
    transition: background-color 0.2s ease-in-out;
}

.custom-bg:hover {
    background: linear-gradient(45deg, #f4511e, #FFFFFF);
}

.description,
.reviews {
    background-color: #f9e8ce;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}

.review-item {
    margin-bottom: 20px;
}

.review-item img {
    border-radius: 50%;
}

.review-item h6 {
    margin-left: 10px;
    font-weight: bold;
}

.carousel-item img {
    width: 100%;
    height: auto;
}

h5 {
    font-size: 1.5em;
    margin-bottom: 20px;
    color: #f4511e;
}

p {
    font-size: 1em;
    line-height: 1.6em;
}

button {
    border: none;
    padding: 15px 30px;
    font-size: 1em;
    border-radius: 50px;
    transition: all 0.3s ease;
    cursor: pointer;
}


.price-overlay {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1.2em;
}
.btn-group-sm>.btn, .btn-sm {
    padding: .25rem .5rem;
    font-size: .875rem;
    border-radius: 5.2rem;
}
.review-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.review-container {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.carousel-control-next,
.carousel-control-prev {
    position: absolute;
    top: 0;
    bottom: 0;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: 0 0;
    opacity: 0.8; /* Réduire légèrement l'opacité */
    cursor: pointer;
}

.carousel-control-next-icon,
.carousel-control-prev-icon {
    background-color: #f4511e;
    border-radius: 50%;
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

    </style>
</head>

<body>

<?php require('inc/header.php');  ?> 

<?php
    if(!isset($_GET['id'])){
        redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'],1, 0], 'iii');
    
    if(mysqli_num_rows($room_res)==0){
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);
?>

<div class="container">
    <div class="row">
        <!-- Navigation des Breadcrumbs -->
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                    <li class="breadcrumb-item"><a href="rooms.php">Chambres</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: #000;">
                        <?php echo $room_data['name']; ?>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Carrousel de la Chambre -->
        <div class="col-lg-7 col-md-12 mb-4">
            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                        $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                        $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]'");

                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';
                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "<div class='carousel-item $active_class'>
                                        <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100'>
                                        <div class='price-overlay'>{$room_data['price']} DH par nuit</div>
                                      </div>";
                                $active_class = '';
                            }
                        } else {
                            echo "<div class='carousel-item active'>
                                    <img src='$room_img' class='d-block w-100'>
                                    <div class='price-overlay'>{$room_data['price']} DH par nuit</div>
                                  </div>";
                        }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Précédent</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Suivant</span>
                </button>
            </div>
        </div>

        <!-- Détails de la Chambre -->
        <div class="col-lg-5 col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4><?php echo $room_data['price']; ?> DH par nuit</h4>
                    <div class="mb-3">
                        <?php
                            $stars = 4; // Exemple de notation
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $stars) {
                                    echo '<i class="bi bi-star-fill"></i>';
                                } else {
                                    echo '<i class="bi bi-star"></i>';
                                }
                            }
                        ?>
                    </div>

                    <!-- Caractéristiques -->
                    <?php
                        $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                        INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                        WHERE rfea.room_id = '$room_data[id]'");

                        $features_data = "";
                        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                            $features_data .= "<span class='badge rounded-pill me-1 mb-1'>{$fea_row['name']}</span>";
                        }

                        echo "<div class='mb-3'><h6 class='mb-1'>Caractéristiques</h6>$features_data</div>";

                        $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                        WHERE rfac.room_id = '$room_data[id]'");

                        $facilities_data = '';
                        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                            $facilities_data .= "<span class='badge rounded-pill me-1 mb-1'>{$fac_row['name']}</span>";
                        }

                        echo "<div class='mb-3'><h6 class='mb-1'>Installations</h6>$facilities_data</div>";

                        echo "<div class='mb-3'>
                                <h6 class='mb-1'>Invités</h6>
                                <span class='badge rounded-pill me-1 mb-1'>{$room_data['adult']} Adultes</span>
                                <span class='badge rounded-pill me-1 mb-1'>{$room_data['children']} Enfants</span>
                              </div>";

                        echo "<div class='mb-3'>
                                <h6 class='mb-1'>Surface</h6>
                                <span class='badge rounded-pill me-1 mb-1'>{$room_data['area']} m²</span>
                              </div>";

                        if (!$settings_r['shutdown']) {
                            $login = isset($_SESSION['login']) && $_SESSION['login'] == true ? 1 : 0;
                            echo "<button onclick='checkLoginToBook($login, {$room_data['id']})' class='btn custom-bg text-white w-100 shadow-none mb-1'>Réserver maintenant</button>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <!-- Description de la Chambre et Avis -->
        <div class="col-12">
            <div class="description">
                <h5>Description</h5>
                <p><?php echo $room_data['description']; ?></p>
            </div>
            <div class="reviews">
                <h5>Avis & Notes</h5>
                <div class="review-item">
                    <div class="review-container">
                    <i class="bi bi-person-circle"></i>
                        <h6>kawtar </h6>
                    </div>
                    <p>Un des meilleurs hôtels où j'ai séjourné. Les chambres sont propres et spacieuses, et le service est excellent. Je le recommande vivement.</p>
                    <div class="rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>
                <!-- Répéter les avis si nécessaire -->
            </div>
        </div>
    </div>
</div>





<button onclick="topFunction()" id="scrollBtn" title="Go to top">
    <i class="bi bi-arrow-up-circle"></i>
</button>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // Fonction pour afficher ou masquer le bouton de retour en haut
    let mybutton = document.getElementById("scrollBtn");

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

    // Fonction pour remonter en haut de la page
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
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

<br>
<?php require('chatbot.php'); ?>
<!-- Footer -->
<?php require('inc/footer.php'); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>
