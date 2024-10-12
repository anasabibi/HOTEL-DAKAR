<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name ="viewport" content="device-width, initial-scale=1.0">
    <title>HOTEL-BOOKINGS</title>
    <?php require('inc/links.php'); ?>
 </head>
  <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9e8ce57;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin: -10px;
}

.col-12, .col-md-4 {
    padding: 10px;
}

.my-5 {
    margin-top: 3rem !important;
    margin-bottom: 3rem !important;
}

.px-4 {
    padding-left: 1.5rem !important;
    padding-right: 1.5rem !important;
}

h2 {
    font-size: 2rem;
    font-weight: bold;
    color: #f4511e;
    margin-bottom: 0.5rem;
}

.bg-light {
    background-color: #f9e8ce57 !important;
}

.bg-white {
    background-color: #fff !important;
}

.p-3 {
    padding: 1rem !important;
}

.rounded {
    border-radius: 0.25rem !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.text-secondary {
    color: #6c757d !important;
}

.text-decoration-none {
    text-decoration: none !important;
}

.fw-bold {
    font-weight: 700 !important;
}

.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-dark {
    color: #fff;
    background-color: #343a40;
    border-color: #343a40;
}

.btn-dark:hover {
    color: #fff;
    background-color: #23272b;
    border-color: #1d2124;
}

.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-danger:hover {
    background: linear-gradient(45deg, #dc3545, #FFFFFF);
    color: #fff;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0056b3;
    border-color: #004085;
}

.badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
}

.bg-success {
    background-color: #28a745 !important;
}

.bg-danger {
    background-color: #dc3545 !important;
}

.bg-warning {
    background-color: #ffc107 !important;
}

.bg-primary {
    background-color: #007bff !important;
}

.text-end {
    text-align: right !important;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1050;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0;
}

.modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
}

.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 0.3rem;
    outline: 0;
}

.modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: 0.3rem;
    border-top-right-radius: 0.3rem;
}

.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    font-size: 1.25rem;
}

.modal-body {
    position: relative;
    flex: 1 1 auto;
    padding: 1rem;
}

.form-label {
    display: inline-block;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.form-select {
    display: block;
    width: 100%;
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    appearance: none;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.custom-bg {
    background-color: #f4511e;
    border-color: #f4511e;
}

.custom-bg:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.shadow-none {
    box-shadow: none !important;
}

@media (max-width: 767.98px) {
    .col-md-4 {
        width: 100%;
    }

    .modal-dialog {
        margin: 1.75rem 1rem;
    }
}

  </style>
  <body class="bg-light">

    <?php
     require('inc/header.php');
      if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
      redirect('index.php');
     }

    ?>

<div class="container">
    <div class="row">
        <div class="col-12 my-5 px-4">
            <h2 class="fw-bold">RÉSERVATIONS</h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none" style="color: #f4511e !important;">Accueil</a>
                <span class="text-secondary"> / </span>
                <a href="#" class="text-secondary text-decoration-none">Réservation</a>
            </div>
        </div>
    </div>
</div>

<?php

$query = "SELECT bo.*, bd.* FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE ((bo.booking_status='booked') 
    OR (bo.booking_status='cancelled') 
    OR (bo.booking_status='payment failed'))
    AND (bo.user_id=?)
    ORDER BY bo.booking_id DESC";

$result = select($query,[$_SESSION['uId']],'i');

while($data = mysqli_fetch_assoc($result))
{
    $date = date("d-m-Y", strtotime($data['datentime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));

    $status_bg = "";
    $btn = "";

    if($data['booking_status']=='booked'){
        $status_bg = 'bg-success';
        if($data['arrival']==1)
        {
            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Télécharger PDF</a>";
            if($data['rate_review']==0){
                $btn.="<button type='button' onclick='review_room($data[booking_id],$data[room_id])' data-bs-toggle='modal' data-bs-target='#reviewModal' class='btn btn-dark btn-sm shadow-none ms-2'>Noter & Commenter</button>";
            }
        }
        else{
            $btn="<button type='button' onclick='cancel_booking($data[booking_id])' class='btn btn-danger btn-sm shadow-none'>Annuler</button>";         
        }
    }
    else if($data['booking_status']=='cancelled'){
        $status_bg = 'bg-danger';
        if($data['refund']==0){
            $btn="<span class='badge bg-primary'>Remboursement en cours!</span>";
        }
        else{
            $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Télécharger PDF</a>";
        }
    }
    else
    {
        $status_bg = 'bg-warning';
        $btn = "<a href='generate_pdf.php?gen_pdf&id=$data[booking_id]' class='btn btn-dark btn-sm shadow-none'>Télécharger PDF</a>";
    }

    echo <<<bookings
    <div class='col-md-4 px-4 mb-4' style='display:inline-block;'>
        <div class='bg-white p-3 rounded shadow-sm'>
            <h5 class='fw-bold'>$data[room_name]</h5>
            <p>$data[price] DH par nuit</p>
            <p>
                <b>Arrivée: </b> $checkin <br>
                <b>Départ: </b> $checkout
            </p>
            <p>
                <b>Montant: </b> $data[total_pay] <br>
                <b>ID de commande: </b> $data[order_id] <br>
                <b>Date: </b> $date
            </p>
            <p>
                <span class='badge $status_bg'>$data[booking_status]</span> 
            </p>
            $btn
        </div>
    </div>
    bookings;

}

?>

<div class="modal fade" id="reviewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="review-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-chat-square-heart-fill fs-3 me-2"></i>Noter & Commenter
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <select name="rating" id="rating" class="form-select shadow-none">
                            <option value="5">Excellent</option>
                            <option value="4">Bien</option>
                            <option value="3">OK</option>
                            <option value="2">Mauvais</option>
                            <option value="1">Très mauvais</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Commentaire</label>
                        <textarea type="password" name="review" rows="3" required class="form-control shadow-none"></textarea>
                    </div>

                    <input type="hidden" name="booking_id">
                    <input type="hidden" name="room_id">

                    <div class="text-end">
                        <button type="submit" class="btn custom-bg text-white shadow-none">SOUMETTRE</button>
                    </div>
                </div>
            </form> 
        </div>
    </div>
</div>

<?php

if(isset($_GET['cancel_status'])){
    alert('success','Réservation annulée');
}
else if(isset($_GET['review_status'])){
    alert('success','Merci pour votre notation et votre commentaire');
}
?>
<?php require('scroll.php'); ?>
<?php require('inc/footer.php'); ?>

<script>
function cancel_booking(id)
{
    if(confirm('Êtes-vous sûr de vouloir annuler cette réservation ?'))
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/cancel_booking.php",true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            if(this.responseText == 1){
                window.location.href="bookings.php?cancel_status=true";
            }
            else{
                alert('error','Échec de l\'annulation !');
            }
        }
        xhr.send('cancel_booking&id='+id);
    }
}

let review_form = document.getElementById('review-form');

function review_room(bid,rid){
    review_form.elements['booking_id'].value = bid;
    review_form.elements['room_id'].value = rid;
}

review_form.addEventListener('submit',function(e){
    e.preventDefault();

    let data = new FormData();

    data.append('review_form','');
    data.append('rating',review_form.elements['rating'].value);
    data.append('review',review_form.elements['review'].value);
    data.append('booking_id',review_form.elements['booking_id'].value);
    data.append('room_id',review_form.elements['room_id'].value);


    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/review_room.php",true);

    xhr.onload = function(){
        if(this.responseText == 1)
        {
            window.location.href = 'bookings.php?review_status=true';
        }
        else{
            var myModal = document.getElementById('reviewModal');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();
            alert('error',"Échec de la notation et du commentaire !");
        }

    }
    xhr.send(data);
})
</script>
</body>
</html>
