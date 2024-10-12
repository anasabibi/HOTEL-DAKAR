<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>
    
    <title><?php echo $settings_r['site_title']?> - FACILITIES</title>
    <style>
       :root {
    --primary-color: #4B6587; /* Deep blue */
    --secondary-color: #2D4059; /* Darker blue */
    --accent-color: #F7B731; /* Warm yellow */
    --text-color: #2E4057; /* Dark grey for text */
    --background-color: #f8f9fa; /* Light background color */
    --hover-scale: 1.05; /* Slightly increased hover scale */
    --hover-transition: 0.3s ease-in-out; /* Smoother transition */
}

body {
    background-color: var(--background-color);
    font-family: 'Arial', sans-serif;
}

.pop:hover {
    border-top-color: var(--accent-color) !important;
    transform: scale(var(--hover-scale));
    transition: all var(--hover-transition);
}

.contact-header {
    text-align: center;
    margin-bottom: 40px;
}

.contact-header h2 {
    font-weight: 700;
    font-size: 2.5rem;
    color: #212529;
}

.contact-header p {
    max-width: 600px;
    margin: 0 auto;
    color: #6c757d;
}

.h-line {
    width: 50px;
    height: 5px;
    background: #f4511e;
    margin: 10px auto;
}

.facility-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform var(--hover-transition), box-shadow var(--hover-transition);
    background-color: white;
}

.facility-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.2);
}

.facility-card img {
    border-radius: 15px 15px 0 0;
    transition: transform var(--hover-transition);
}

.facility-card:hover img {
    transform: scale(var(--hover-scale));
}

.facility-content {
    padding: 25px;
    text-align: center;
}

.facility-title {
    font-size: 1.6rem;
    color:#f4511e;
    margin: 15px 0;
}

.facility-description {
    font-size: 1.1rem;
    color: var(--text-color);
}

@media (max-width: 991.98px) {
    .facility-card {
        margin-bottom: 20px;
    }
}
  /* Vos styles personnalisés ici */
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

<body class="bg-light">
    <!-- Navbar -->
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4 contact-header">
  <h2 class="fw-bold">NOS INSTALLATIONS</h2>
  <div class="h-line"></div>
  <p>Découvrez nos installations modernes et confortables conçues pour rendre votre séjour agréable.</p>
</div>

    <div class="container">
        <div class="row">
            <?php
                $res = selectALL('facilities');
                $path = FACILITIES_IMG_PATH;

                while ($row = mysqli_fetch_assoc($res)) {
                    echo <<<data
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="facility-card bg-white shadow-sm">
                            <img src="$path$row[icon]" class="w-100" height="200" alt="$row[name]">
                            <div class="facility-content">
                                <h5 class="facility-title">$row[name]</h5>
                                <p class="facility-description">$row[description]</p>
                            </div>
                        </div>
                    </div>
                    data;
                }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <?php require('inc/footer.php'); ?>   
    <?php require('chatbot.php'); ?>
<!-- Scroll to Top Button -->
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

</body>

</html>
