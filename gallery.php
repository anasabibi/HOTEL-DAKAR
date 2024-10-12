<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Gallery</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
  <?php require('inc/links.php'); ?>
  <style>
    /* Custom styles for the hotel gallery */

    /* Style for the gallery section */
    /* Style for the gallery section */
.gallery-section {
  background-color: #f9e8ce57;
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
  color: #212529;
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

/* Style for the professional paragraph */
.mt-3 p {
  font-family: 'Roboto', sans-serif;
  font-size: 1.1rem;
  line-height: 1.6;
  color: #333;
  margin-bottom: 20px;
  text-align: justify;
  background-color: #f8f9fa;
  padding: 15px;
  border-left: 4px solid var(--primary);
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
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
<body>
  <?php require('inc/header.php'); ?>

  <div class="gallery-section text-center">
    <h2 class="gallery-title">GALERIE DE L'HÔTEL</h2>
    <div class="h-line"></div>
    <p class="mt-3">
    Découvrez la splendeur de notre hôtel à travers notre galerie photo, où chaque image raconte une histoire de luxe et de confort. Explorez nos chambres élégantes, nos installations de loisirs sophistiquées, et nos espaces gastronomiques raffinés. Laissez-vous séduire par la beauté de nos lieux de réception et l'excellence de notre service.
     Plongez dans une expérience visuelle qui capture l'essence même de notre hospitalité exceptionnelle. Bienvenue dans un univers où chaque détail est conçu pour émerveiller et inspirer.
        </p>
    <div class="container">
      <div class="gallery-grid">
        <?php
          // Database connection parameters
          $hname='localhost';
          $uname='root';
          $pass='';
          $db='pfc';

          $con=mysqli_connect($hname,$uname,$pass,$db);

          // Check connection
          if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
          }

          // Prepare and execute the SQL statement
          $sql = "SELECT `image` FROM gallery";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();

          // Output images
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $path = GALLERY_IMG_PATH;
              echo <<<data
              <div class="gallery-item">
                  <img src="$path$row[image]" alt="Hotel Image" class="img-fluid" />
              </div>
              data;
            }
          }

          // Close connections
          $stmt->close();
          $con->close();
        ?>
      </div>
    </div>
  </div>
  <?php require('chatbot.php'); ?>           
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
  <?php require('inc/footer.php'); ?>
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
