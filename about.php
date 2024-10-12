<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <?php require('inc/Links.php'); ?>
    
    <title>  <?php echo $settings_r['site_title']?> -ABOUT</title>
    <style>
        :root {
            --primary: #4B6587;
            --secondary: #2D4059;
            --accent: #f4511e;
            --text-color: #2E4057;
            --hover-scale: 1;
            --hover-transition: 0.25s ease-in-out;
        }

        .pop:hover {
            border-top-color: var(--accent) !important;
            transform: scale(var(--hover-scale));
            transition: transform var(--hover-transition);
        }

        .h-font {
            font-family: 'Playfair Display', serif;
        }
        .bg-dark {
    background-color: #f4511e !important;
}

        .h-line {
            width: 50px;
            height: 4px;
            background-color: #f4511e;
            margin: 10px auto;
        }
        .row {
            --hover-scale: 1.08;
        }

        .container p {
            color: var(--text-color);
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .shadow {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .border-primary {
            border-color: var(--primary) !important;
        }

        .swiper-container {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
            border: 2px solid #dee2e6;
            border-radius: 15px;
            transition: border-color var(--hover-transition);
        }

        .swiper-slide:hover {
            border-color: var(--accent);
        }

        .swiper-slide img {
            border-radius: 50%;
            margin-bottom: 15px;
            transition: transform var(--hover-transition);
        }

        .swiper-slide img:hover {
            transform: scale(1.1);
        }

        .text-center h5 {
            font-weight: 600;
            color: var(--text-color);
            margin-top: 10px;
            font-size: 1.1rem;
        }

        @media (max-width: 991.98px) {
            .container p {
             font-size: 16px;
            }
        }

        .feature-card {
            background-color: #fff;
            border-top: 5px solid #000000;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .feature-card img {
            margin-bottom: 10px;
        }

        .about-section {
            padding: 40px 0;
        }

        .about-section h2,
        .about-section p {
            color: var(--text-color);
        }

        .management-team h3 {
            margin-bottom: 40px;
        }
        .justified-text {
            text-align: justify;
        }
        .rounded {
            border-radius: 15px; /* Adjust the value to make it more or less rounded */
        }



    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php'); ?>
    
    <!-- About Us Section -->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">À PROPOS DE NOUS</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <!-- Information Section -->
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-2 order-2">
                <h3 class="mb-3">HÔTEL DAKAR</h3>
                <p class="justified-text">
                L'Hôtel Dakar, situé à Merzouga, est réputé pour ses caractéristiques exceptionnelles et ses nombreuses réalisations. Avec une capacité d'accueil remarquable, l'hôtel est très prisé des visiteurs et jouit d'une solide réputation.

                Nos chambres élégantes, nos installations modernes et nos services haut de gamme garantissent une expérience inoubliable. L'équipe de gestion, grâce à son expertise et sa direction stratégique, assure un service irréprochable et une satisfaction client élevée.

                Toujours innovant, l'hôtel améliore constamment ses infrastructures et propose des activités culturelles pour répondre aux besoins des voyageurs modernes, consolidant ainsi sa position de leader à Merzouga.
                </p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-1 order-1 pop">
                <img src="images/about/about2.jpg" class="w-100 rounded">
            </div>

        </div>
    </div>

    <!-- Features Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark pop">
                    <img src="images/about/hotel.svg" width="70px">
                    <h4 class="mt-3">20+ CHAMBRES</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark pop">
                    <img src="images/about/rating.svg" width="70px">
                    <h4 class="mt-3">100+ AVIS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark pop">
                    <img src="images/about/customers.svg" width="70px">
                    <h4 class="mt-3">120+ CLIENTS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center border-dark pop">
                    <img src="images/about/staff.svg" width="70px">
                    <h4 class="mt-3">50+ PERSONNEL</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Team Section -->
    <h3 class="my-5 fw-bold h-font text-center">ÉQUIPE DE GESTION</h3>   

    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <?php
                    $about_r = selectAll('team_details');
                    $path=ABOUT_IMG_PATH;
                    while($row = mysqli_fetch_assoc($about_r)) {
                        echo<<<data
                            <div class="swiper-slide bg-white text-center overflow-hidden rounded pop">
                                <img src="$path{$row['picture']}" class="w-100">
                                <h5 class="mt-2">{$row['name']}</h5>
                            </div>
                        data;
                    }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


    <?php require('inc/footer.php'); ?>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 40,
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
    <?php require('scroll.php'); ?>
    <?php require('chatbot.php'); ?>
</body>
</html>
