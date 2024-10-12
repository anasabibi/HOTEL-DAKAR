<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAANAN HOTEL - CONFIRM BOOKING</title>
    <?php require('inc/links.php'); ?>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
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

        .breadcrumb-item a {
            text-decoration: none;
            color: #007bff;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            background-color: #f9e8ce;
        }

        .card-body h4, .card-body h5, .card-body h6 {
            font-weight: bold;
            color: #f4511e;
        }

        .img-fluid {
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .img-fluid:hover {
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .btn.custom-bg {
            background: linear-gradient(45deg, #f4511e, #f4511e1f);
            border-radius: 50px;
            color: white;
            padding: 15px 30px;
            font-size: 1em;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn.custom-bg:hover {
            background: linear-gradient(45deg, #f4511e1f, #f4511e);
        }

        .spinner-border {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
    </style>
</head>
<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <?php

    if(!isset($_GET['id']) || $settings_r['shutdown']==true){
        redirect('rooms.php');
    }
    else if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
        redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?",[$data['id'],1,0],'iii');

    if(mysqli_num_rows($room_res)==0){
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
        "id" => $room_data['id'],
        "name" => $room_data['name'],
        "price" => $room_data['price'],
        "payment" => null,
        "available" => false,
    ];

    $user_res = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], "i");
    $user_data = mysqli_fetch_assoc($user_res);

    ?>

<div class="container">
    <div class="row">
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">CONFIRMER LA RÉSERVATION</h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none" style="color: #f4511e !important;">Accueil</a>
                <span class="text-secondary"> / </span>
                <a href="rooms.php" class="text-secondary text-decoration-none" style="color: #f4511e !important;">Chambres</a>
                <span class="text-secondary"> / </span>
                <a href="#" class="text-secondary text-decoration-none">Confirmer</a>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 px-4">
            <?php
            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
            $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

            if(mysqli_num_rows($thumb_q) > 0){
                $thumb_res = mysqli_fetch_assoc($thumb_q);  
                if($thumb_res !== null && isset($thumb_res['image'])) {
                    $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                }
            }

            echo<<<data
            <div class="card p-3 shadow-sm rounded">
                <img src="$room_thumb" class="img-fluid rounded mb-3">
                <h5>$room_data[name]</h5>
                <h6>$room_data[price] DH par nuit</h6>
            </div>
            data;
            ?>
        </div>

        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <form action="inc/paytm/index.php" method="POST" id="booking_form">
                        <h6 class="mb-3">DÉTAILS DE LA RÉSERVATION</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input name="name" type="text" value="<?php echo $user_data['name'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Numéro de téléphone</label>
                                <input name="phonenum" type="number" value="<?php echo $user_data['phonenum'] ?>" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label">Adresse</label>
                                <textarea name="address" class="form-control shadow-none" rows="2" required><?php echo $user_data['address'] ?></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Arrivée</label>
                                <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Départ</label>
                                <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12">
                                <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                                    <span class="visually-hidden">Chargement...</span>
                                </div>

                                <h6 class="mb-3 text-danger" id="pay_info">Veuillez fournir la date d'arrivée et de départ !</h6>

                                <button name="pay_now" class="btn custom-bg shadow-none w-100 mb-1" disabled>Payer maintenant</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>     
        </div>

    </div>
</div>

<?php require('inc/footer.php'); ?>

<script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');

    function check_availability() {
        let checkin_val = booking_form.elements['checkin'].value;
        let checkout_val = booking_form.elements['checkout'].value;

        booking_form.elements['pay_now'].setAttribute('disabled', true);

        if(checkin_val != '' && checkout_val != '') {
            pay_info.classList.add('d-none');
            pay_info.classList.replace('text-dark', 'text-danger');
            info_loader.classList.remove('d-none');

            let data = new FormData();
            data.append('check_availability', '');
            data.append('check_in', checkin_val);
            data.append('check_out', checkout_val);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/confirm_booking.php", true);

            xhr.onload = function() {
                let data = JSON.parse(this.responseText);

                if(data.status == 'check_in_out_equal'){
                    pay_info.innerText = "Vous ne pouvez pas partir le même jour !";
                } else if(data.status == 'check_out_earlier'){
                    pay_info.innerText = "La date de départ est antérieure à la date d'arrivée !";
                } else if(data.status == 'check_in_earlier'){
                    pay_info.innerText = "La date d'arrivée est antérieure à la date d'aujourd'hui !";
                } else if(data.status == 'unavailable'){
                    pay_info.innerText = "La chambre n'est pas disponible pour cette date d'arrivée !";
                } else {
                    pay_info.innerHTML = "Nombre de jours : " + data.days + "<br/>Montant total à payer : " + data.payment + " DH";
                    pay_info.classList.replace('text-danger', 'text-dark');
                    booking_form.elements['pay_now'].removeAttribute('disabled');
                }

                pay_info.classList.remove('d-none');
                info_loader.classList.add('d-none');
            };

            xhr.send(data);
        }
    }
</script>

<?php require('scroll.php'); ?>
<?php require('chatbot.php'); ?>
</body>
</html>
