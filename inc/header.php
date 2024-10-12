<style>
Color Variables
:root {
  --primary-color: #F0FFFF;
  --secondary-color: #555;
  --accent-color: #ff9900;
  --light-color: #f2f2f2;
}

/* Navigation Bar */


.navbar-brand {
  color: var(--accent-color);
  font-weight: bold;
}

.nav-item {
  display: flex;
  align-items: center;
  margin-right: 10px; 
  /* Adjust as needed */
  margin-right: 80px; 
}

.nav-link {
  color: var(--light-color);
  transition: color 0.3s ease;
}

.nav-link:hover {
  color: var(--accent-color);
}

.navbar-toggler {
  color: var(--light-color);
  border-color: var(--light-color);
}

.navbar-toggler-icon {
  background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='%23f2f2f2' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.navbar-nav {
  display: flex;
  justify-content: center;
  width: 100%;
}
.btn-custom {
  background-color: #f4511e;
  border-color: #f4511e;
  padding: 10px 20px;
  color: #ffffff; /* Add white text color for better contrast */
  transition: background-color 0.2s ease-in-out; /* Add a smooth transition effect */
}
.navbar-light .navbar-nav .nav-link {
    color: #000000;
}
.btn {
    border-radius: 5px;
}

.btn:hover {
    background: linear-gradient(45deg, #f4511e, #FFFFFF);
    color: #fff;
}


.btn-custom:hover {
  background: linear-gradient(45deg, #FF5722, #FFFFFF);
  border-color: #0069d9;
}
.h-font {
    font-family: 'Poppins', sans-serif;}
.bg-white {
    background-color: #f9e8ce !important;
}
.rounded {
    border-radius: 3.25rem !important;

}
.modal-header {
    color: #F44336;
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: calc(.3rem - 1px);
    border-top-right-radius: calc(.3rem - 1px);
     }
     .btn-dark {
    background-color: #f4511e;
    border-color: #f4511e;
    padding: 10px 20px;
    color: #ffffff;
    transition: background-color 0.2s ease-in-out;
     }

.dropdown-menu {
  position: absolute;
  z-index: 1000;
  display: none;
  min-width: 10rem;
  padding: .5rem 0;
  margin: 0;
  font-size: 1rem;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: #f9e8ce;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, .15);
  border-radius: .25rem;
}   
.dropdown-item.active, .dropdown-item:active {
    color: #f9e8ce;
    text-decoration: none;
    background-color: #f4511ee0;
}
.dropdown-item:focus, .dropdown-item:hover {
    color: #1e2125;
    background-color: #f4511e3b;
}
.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #f9e8ce;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, .2);
    border-radius: .3rem;
    outline: 0;
}
.btn-check:focus+.btn, .btn:focus {
    outline: 0;
    box-shadow: 0 0 0 .25rem #f4511e7a;
}    
</style>
<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand me-5 fw-bold fs-3 h-font d-flex align-items-center" href="index.php">
        <img src="images/term/camel.png" alt="Logo" style="height: 40px; margin-right: 10px;">
        <?php echo $settings_r['site_title'] ?>
      </a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php" title="Accueil">
            <i class="bi bi-house-door fs-4 me-2"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="rooms.php" title="Chambres">
            <i class="bi bi-building fs-4 me-2"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gallery.php" title="Galerie">
           <i class="bi bi-image-alt fs-4 me-2"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="facilities.php" title="Installations">
            <i class="bi bi-amd fs-4 me-2"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact.php" title="Contactez-nous">
            <i class="bi bi-envelope fs-4 me-2"></i>
          </a>
        </li>
        <li class="nav-item" style="margin-right: 15px;">
          <a class="nav-link" href="about.php" title="À propos">
            <i class="bi bi-info-circle fs-4 me-2"></i>
          </a>
        </li>
    </ul>
    <div class="d-flex">
        <?php
          if(isset($_SESSION['login']) && $_SESSION['login'] == true)
          {
            $path = USERS_IMG_PATH;
            echo<<<data
              <div class="btn-group">
                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="rounded-circle me-1">
                  $_SESSION[uName]
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                  <li><a class="dropdown-item" href="bookings.php">Réservations</a></li>
                  <li><a class="dropdown-item" href="logout.php">Déconnexion</a></li>
                </ul>
              </div>
            data;
          }
          else
          {
            echo<<<data
              <button type="button" class="btn btn-custom rounded-pill px-4 me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                Connexion
              </button>
              <button type="button" class="btn btn-custom rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#RegisterModal">
                Inscription
              </button>
            data;
          }
        ?>
    </div>
</div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i>Connexion utilisateur
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email/Téléphone</label>
            <input type="text" name="email_mob" required class="form-control shadow-none">
          </div>
          <div class="mb-4">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="pass" required class="form-control shadow-none">
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">CONNEXION</button>
            <button type="button" class="btn text-secondary btn-decoration-none shadow-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal">
              Mot de passe oublié ?
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-lines-fill fs-3 me-2"></i> Inscription utilisateur
          </h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Nom</label>
                <input name="name" type="text" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Numéro de téléphone</label>
                <input name="phonenum" type="number" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Photo</label>
                <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control shadow-none" required>
              </div>
              <div class="col-md-12 p-0 mb-3">
                <label class="form-label">Adresse</label>
                <textarea name="address" class="form-control shadow-none" rows="2" required></textarea>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Code postal</label>
                <input name="pincode" type="number" class="form-control shadow-none">
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Date de naissance</label>
                <input name="dob" type="date" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 ps-0 mb-3">
                <label class="form-label">Mot de passe</label>
                <input name="pass" type="password" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 p-0 mb-3">
                <label class="form-label">Confirmer le mot de passe</label>
                <input name="cpass" type="password" class="form-control shadow-none" required>
              </div>
            </div>
          </div>
          <div class="text-center my-1">
            <button type="submit" class="btn btn-dark shadow-none">INSCRIPTION</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="forgot-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center">
            <i class="bi bi-person-circle fs-3 me-2"></i>Mot de passe oublié
          </h5>
        </div>
        <div class="modal-body">
          <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
            Remarque : Un lien sera envoyé à votre email pour réinitialiser votre mot de passe !
          </span>
          <div class="mb-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" required class="form-control shadow-none">
          </div>
          <div class="mb-2 text-end">
            <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
              ANNULER
            </button>
            <button type="submit" class="btn btn-dark shadow-none">ENVOYER LE LIEN</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
