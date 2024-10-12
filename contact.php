<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title']?> - CONTACT</title>
    <style>
        /* Styles CSS ici */
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }

        .contact-section {
            padding: 60px 0;
            background-color: #f9e8ce57;
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
            height: 4px;
            background-color: #f4511e;
            margin: 10px auto;
        }

        .contact-box {
            background-color: #f9e8ce;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            transition: transform 0.3s ease;
        }

        .contact-box:hover {
            transform: translateY(-10px);
        }

        .contact-box h5 {
            font-weight: 600;
            margin-bottom: 20px;
            color: #6c757d;
        }

        .contact-box a {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-box a:hover {
            color: #495057;
        }

        .contact-box i {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #6c757d;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }


        .btn-custom:hover {
            background-color: #f4511e;
        }

        .social-links a:hover {
            color: #6c757d;
        }

        .map-iframe {
            border: none;
            border-radius: 10px;
            width: 100%;
            height: 300px;
        }

        .contact-img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
    <!-- Lien vers le fichier CSS externe -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
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
    <?php require('inc/header.php'); ?>
    <div class="contact-section">
    <div class="my-5 px-4 contact-header">
        <h2 class="fw-bold">CONTACTEZ-NOUS</h2>
        <div class="h-line"></div>
        <p>Nous sommes ici pour vous aider. Contactez-nous pour toute question ou assistance, et nous vous répondrons rapidement.</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="contact-box">
                    <iframe class="w-100 map-iframe mb-4" src="<?php echo $contact_r['iframe'] ?>" loading="lazy"></iframe>
                    <h5>Adresse</h5>
                    <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none">
                        <i class="fas fa-map-marker-alt"></i> <?php echo $contact_r['address'] ?>
                    </a>
                    <h5 class="mt-4">Appelez-nous</h5>
                    <a href="tel:+<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none">
                        <i class="fas fa-phone-alt"></i> +<?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    <?php if ($contact_r['pn2'] != '') { ?>
                        <a href="tel:+<?php echo $contact_r['pn2'] ?>" class="d-inline-block mb-2 text-decoration-none">
                            <i class="fas fa-phone-alt"></i> +<?php echo $contact_r['pn2'] ?>
                        </a>
                    <?php } ?>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto:<?php echo $contact_r['email'] ?>" class="d-inline-block mb-2 text-decoration-none">
                        <i class="fas fa-envelope"></i> <?php echo $contact_r['email'] ?>
                    </a>
                    <h5 class="mt-4">Suivez-nous</h5>
                    <div class="social-links">
                        <?php if ($contact_r['tw'] != '') { ?>
                            <a href="<?php echo $contact_r['tw'] ?>" class="text-dark">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php } ?>
                        <a href="<?php echo $contact_r['fb'] ?>" class="text-dark">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="<?php echo $contact_r['insta'] ?>" class="text-dark">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 px-4">
                <div class="contact-box">
                    <form method="post">
                        <h5>Envoyer un message</h5>
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" required type="email" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sujet</label>
                            <input name="subject" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn btn-custom mt-3">ENVOYER</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Scroll to Top Button -->
    <button onclick="topFunction()" id="scrollBtn" title="Go to top">
        <i class="bi bi-arrow-up-circle"></i>
    </button>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Script JavaScript pour le bouton de retour en haut -->
    <script>
       
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

    <?php
        if (isset($_POST['send'])) {
            $frm_data = filteration($_POST);
            $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
            $res = insert($q, $values, 'ssss');
            if ($res == 1) {
                alert('success', 'Courriel envoyé !');
            } else {
                alert('error', 'Serveur en panne ! Réessayez plus tard.');
            }
        }
    ?>
    <!-- Footer -->
    <?php require('chatbot.php'); ?>
    <?php require('inc/footer.php');  ?>

</body>

</html>

