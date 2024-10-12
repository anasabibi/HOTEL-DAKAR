<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title><?php echo $settings_r['site_title']?> - Profile</title>
    <style>
        body {
            background-color: #f9e8ce57;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
        }
        .card-body {
            padding: 2rem;
        }
        .form-label {
            font-weight: 500;
            color: #6c757d;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #f4511e;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #f4511e, #FFFFFF);
        }
        .breadcrumb {
            background-color: #fcf7ee;
            border-radius: 5px;
        }
        .breadcrumb-item a {
            color: #f4511e;
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            text-decoration: underline;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }
        .profile-section {
            background-color: #f9e8ce;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .profile-section h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .alert {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1050;
            padding: 1rem 1.5rem;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .btn-check:active+.btn-primary, .btn-check:checked+.btn-primary, .btn-primary.active, .btn-primary:active, .show>.btn-primary.dropdown-toggle {
            color: #fff;
            background-color: #f4511e;
            border-color: #f4511e;
        }
        .btn-check:focus+.btn-primary, .btn-primary:focus {
    color: #fff;
    background-color: #f4511e;
    border-color: #f4511e;
    box-shadow: 0 0 0 .25rem #f4511e6b;
}
.btn-check:active+.btn-primary:focus, .btn-check:checked+.btn-primary:focus, .btn-primary.active:focus, .btn-primary:active:focus, .show>.btn-primary.dropdown-toggle:focus {
    box-shadow: 0 0 0 .25rem #f4511e6e;
}
    </style>
</head>
<body>
    <?php require('inc/header.php'); ?>

    <?php
        if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
            redirect('index.php');
        }

        $u_exist = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');

        if (mysqli_num_rows($u_exist) == 0) {
            redirect('index.php');
        }

        $u_fetch = mysqli_fetch_assoc($u_exist);
    ?>

<div class="container my-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="fw-bold">Profil</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-8 mb-5">
            <div class="profile-section">
                <form id="info-form">
                    <h5>Informations de base</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Numéro de téléphone</label>
                            <input name="phonenum" type="text" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date de naissance</label>
                            <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Code postal</label>
                            <input name="pincode" type="text" value="<?php echo $u_fetch['pincode'] ?>" class="form-control shadow-none" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Adresse</label>
                            <textarea name="address" class="form-control shadow-none" rows="2" required><?php echo $u_fetch['address'] ?></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Enregistrer les modifications</button>
                </form>
            </div>
        </div>

        <div class="col-lg-4 mb-5">
            <div class="profile-section text-center">
                <form id="profile-form">
                    <h5>Photo de profil</h5>
                    <img src="<?php echo USERS_IMG_PATH . $u_fetch['profile'] ?>" class="profile-picture mb-3" alt="Photo de profil">
                    <input name="profile" type="file" accept=".jpg, .jpeg, .png, .webp" class="form-control mb-4" required>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>

        <div class="col-12">
            <div class="profile-section">
                <form id="pass-form">
                    <h5>Changer le mot de passe</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input name="new_pass" id="new_pass" type="password" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <input name="confirm_pass" id="confirm_pass" type="password" class="form-control shadow-none" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="alert alert-success" id="alert-success">Modifications enregistrées avec succès !</div>
<div class="alert alert-error" id="alert-error">Une erreur est survenue !</div>
    <?php require('scroll.php'); ?>
    <?php require('inc/footer.php'); ?>

    <script>
    function showAlert(type, message) {
        let alertBox = document.getElementById(`alert-${type}`);
        alertBox.textContent = message;
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000);
    }

    document.getElementById('info-form').addEventListener('submit', function (e) {
        e.preventDefault();
        let data = new FormData(this);
        data.append('info_form', '');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);
        xhr.onload = function () {
            if (this.responseText === 'phone_already') {
                showAlert('error', "Le numéro de téléphone est déjà enregistré");
            } else if (this.responseText == 0) {
                showAlert('error', "Aucun changement n'a été effectué !");
            } else {
                showAlert('success', "Modifications enregistrées");
            }
        };
        xhr.send(data);
    });

    document.getElementById('profile-form').addEventListener('submit', function (e) {
        e.preventDefault();
        let data = new FormData(this);
        data.append('profile_form', '');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);
        xhr.onload = function () {
            if (this.responseText === 'inv_img') {
                showAlert('error', "Seules les images jpeg, png, jpg et webp sont autorisées !");
            } else if (this.responseText === 'upd_failed') {
                showAlert('error', "Échec du téléchargement de l'image ! Serveur en panne !");
            } else if (this.responseText == 0) {
                showAlert('error', "Échec de la mise à jour !");
            } else {
                window.location.href = window.location.pathname;
            }
        };
        xhr.send(data);
    });

    document.getElementById('pass-form').addEventListener('submit', function (e) {
        e.preventDefault();
        let new_pass = document.getElementById('new_pass').value;
        let confirm_pass = document.getElementById('confirm_pass').value;

        if (new_pass !== confirm_pass) {
            showAlert('error', 'Le mot de passe ne correspond pas');
            return false;
        }

        let data = new FormData(this);
        data.append('pass_form', '');
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/profile.php", true);
        xhr.onload = function () {
            if (this.responseText === 'mismatch') {
                showAlert('error', "Le mot de passe ne correspond pas !");
            } else if (this.responseText == 0) {
                showAlert('error', "Échec de la mise à jour !");
            } else {
                showAlert('success', "Modifications enregistrées !");
            }
        };
        xhr.send(data);
    });
</script>

</body>
</html>
