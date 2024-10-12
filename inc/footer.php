<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
   /* Footer Section */
.footer-section {
  background: url('images/footer/footer.jpg') no-repeat center center;
  background-size: cover;
  position: relative;
  color: #040303;
  padding-top: 5rem;
  padding-bottom: 3rem;
}

.footer-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgb(249 232 206 / 54%);
    z-index: 1;
}

.footer-section .container-fluid {
  position: relative;
  z-index: 2;
}

.footer-section h3,
.footer-section h5 {
  color: #f4511e;
}

.footer-section a {
  color: #040303;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-section a:hover {
    color: #f4511e;
}

.social-links i {
  font-size: 24px;
  margin-right: 10px;
}

.social-links a {
  display: inline-block;
  margin-bottom: 10px;
  transition: color 0.3s ease;
}

.footer-bottom {
  background-color: #040303;
  color: #adb5bd;
  text-align: center;
  padding: 10px 0;
  margin-top: 20px;
}

  </style>
</head>
<body>
  <footer class="footer-section pt-5 pb-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 p-4">
          <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title']?></h3>
          <p>
            <?php echo $settings_r['site_about']?>
          </p>
        </div>
        <div class="col-lg-4 p-4">
      <h5 class="mb-3">Liens rapides</h5>
      <ul class="list-unstyled">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="rooms.php">Chambres</a></li>
        <li><a href="gallery.php">Galerie</a></li>
        <li><a href="facilities.php">Installations</a></li>
        <li><a href="contact.php">Contactez-nous</a></li>
        <li><a href="about.php">À propos</a></li>
      </ul>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Suivez-nous</h5>
      <ul class="list-unstyled social-links">
        <?php
          if($contact_r['tw'] != ''){
            echo <<<data
              <li><a href="$contact_r[tw]">
                <i class="fab fa-twitter"></i> Twitter
              </a></li>
            data;
          }
        ?>
        <li><a href="<?php echo $contact_r['fb']?>">
          <i class="fab fa-facebook-f"></i> Facebook
        </a></li>
        <li><a href="<?php echo $contact_r['insta']?>">
          <i class="fab fa-instagram"></i> Instagram
        </a></li>
      </ul>
    </div>
    </div>
    </div>
    <div class="footer-bottom">
      <p class="m-0">Conçu et développé par <span style="color: orange;">Youness</span> et <span style="color: orange;">Anas</span></p>
    </div>
    </footer>


  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    function alert(type, msg, position='body') {
      let bs_class = (type == 'success') ? 'alert-success': 'alert-danger';
      let element = document.createElement('div');
      element.innerHTML = `<div class="alert ${bs_class} alert-dismissible fade show" role="alert">
      <strong class="me-3">${msg}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
      if (position == 'body') {
        document.body.append(element);
        element.classList.add('custom-alert');
      } else {
        document.getElementById(position).appendChild(element);
      }
      setTimeout(remAlert, 3000);
    }

    function remAlert() {
      document.getElementsByClassName('alert')[0].remove();
    }

    function setActive() {
      let navbar = document.getElementById('navbar');
      let a_tags = navbar.getElementsByTagName('a');

      for (i = 0; i < a_tags.length; i++) {
        let file = a_tags[i].href.split('/').pop();
        let file_name = file.split('.')[0];

        if (document.location.href.indexOf(file_name) >= 0) {
          a_tags[i].classList.add('active');
        }
      }
    }

    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', (e) => {
      e.preventDefault();

      let data = new FormData();

      data.append('name', register_form.elements['name'].value);
      data.append('email', register_form.elements['email'].value);
      data.append('phonenum', register_form.elements['phonenum'].value);
      data.append('address', register_form.elements['address'].value);
      data.append('pincode', register_form.elements['pincode'].value);
      data.append('dob', register_form.elements['dob'].value);
      data.append('pass', register_form.elements['pass'].value);
      data.append('cpass', register_form.elements['cpass'].value);
      data.append('profile', register_form.elements['profile'].files[0]);
      data.append('register', '');

      var myModal = document.getElementById('RegisterModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);

      xhr.onload = function() {
        if (this.responseText == 'pass_mismatch') {
          alert('error', "Les mots de passe ne correspondent pas!");
        } else if (this.responseText == 'phone_already') {
          alert('error', "Téléphone déjà enregistré!");
        } else if (this.responseText == 'email_already') {
          alert('error', "Email déjà enregistré!");
        } else if (this.responseText == 'inv_img') {
          alert('error', "Seules les images jpeg, png, jpg et webp sont autorisées!");
        } else if (this.responseText == 'mail_failed') {
          alert('error', "Impossible d'envoyer l'email de confirmation! Serveur en panne!");
        } else if (this.responseText == 'upd_failed') {
          alert('error', "Échec du téléchargement de l'image!");
        } else if (this.responseText == 'ins_failed') {
          alert('error', "Inscription échouée! Serveur en panne!");
        } else {
          alert('success', "Inscription réussie. Lien de confirmation envoyé par email!");
          register_form.reset();
        }
      }

      xhr.send(data);
    });

    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit', (e) => {
      e.preventDefault();

      let data = new FormData();

      data.append('email_mob', login_form.elements['email_mob'].value);
      data.append('pass', login_form.elements['pass'].value);
      data.append('login', '');

      var myModal = document.getElementById('loginModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);

      xhr.onload = function() {
        if (this.responseText == 'inv_email_mob') {
          alert('error', "Email ou numéro de mobile invalide!");
        } else if (this.responseText == 'not_verified') {
          alert('error', "Email non vérifié!");
        } else if (this.responseText == 'inactive') {
          alert('error', "Compte suspendu! Veuillez contacter l'administrateur.");
        } else if (this.responseText == 'invalid_pass') {
          alert('error', "Mot de passe incorrect!");
        } else {
          let fileurl = window.location.href.split('/').pop().split('?').shift();
          if (fileurl == 'room_details.php') {
            window.location = window.location.href;
          } else {
            window.location = window.location.pathname;
          }
        }
      }

      xhr.send(data);
    });

    let forgot_form = document.getElementById('forgot-form');

    forgot_form.addEventListener('submit', (e) => {
      e.preventDefault();

      let data = new FormData();

      data.append('email', forgot_form.elements['email'].value);
      data.append('forgot_pass', '');

      var myModal = document.getElementById('forgotModal');
      var modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ajax/login_register.php", true);

      xhr.onload = function() {
        if (this.responseText == 'inv_email') {
          alert('error', "Email invalide!");
        } else if (this.responseText == 'not_verified') {
          alert('error', "Email non vérifié! Veuillez contacter l'administrateur");
        } else if (this.responseText == 'inactive') {
          alert('error', "Compte suspendu! Veuillez contacter l'administrateur.");
        } else if (this.responseText == 'mail_failed') {
          alert('error', "Impossible d'envoyer l'email. Serveur en panne!");
        } else if (this.responseText == 'upd_failed') {
          alert('error', "Échec de la récupération du compte. Serveur en panne!");
        } else {
          alert('success', "Lien de réinitialisation envoyé par email!");
          forgot_form.reset();
        }
      }

      xhr.send(data);
    });

    function checkLoginToBook(status, room_id) {
      if (status) {
        window.location.href = 'confirm_booking.php?id=' + room_id;
      } else {
        alert('error', 'Veuillez vous connecter pour réserver une chambre!');
      }
    }

    setActive();
  </script>
</body>
</html>
