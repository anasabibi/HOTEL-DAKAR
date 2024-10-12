<?php

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('admin/inc/vendor/autoload.php');

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_GET['gen_pdf']) && isset($_GET['id'])) {
    $frm_data = filteration($_GET);

    $query = "SELECT bo.*, bd.*,uc.email FROM `booking_order` bo
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
        INNER JOIN `user_cred` uc ON bo.user_id = uc.id
        WHERE ((bo.booking_status='booked' AND bo.arrival=1) 
        OR (bo.booking_status='cancelled' AND bo.refund=1) 
        OR (bo.booking_status='payment failed'))
        AND bo.booking_id ='$frm_data[id]'";

    $res = mysqli_query($con, $query);
    $total_rows = mysqli_num_rows($res);

    if ($total_rows == 0) {
        header('location: index.php');
        exit;
    }

    $data = mysqli_fetch_assoc($res);

    $date = date("h:ia | d-m-Y", strtotime($data['datentime']));
    $checkin = date("d-m-Y", strtotime($data['check_in']));
    $checkout = date("d-m-Y", strtotime($data['check_out']));

    $logo_path = 'path/to/your/logo.png'; // Update with the path to your logo

    $table_data = "
    <style>
        .container {
            width: 100%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .logo {
            width: 150px;
            margin-bottom: 10px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
<h1>Hotel Dakar</h1>
<div class='container'>
    <table>
        <tr>
            <td>Numéro de commande : $data[order_id]</td>
            <td>Date de réservation : $date</td> 
        </tr>
        <tr>
            <td colspan='2'>Statut : $data[booking_status]</td> 
        </tr>
        <tr>
            <td>Nom : $data[user_name]</td>
            <td>Email : $data[email]</td> 
        </tr>
        <tr>
            <td>Numéro de téléphone : $data[phonenum]</td>
            <td>Adresse : $data[address]</td> 
        </tr>
        <tr>
            <td>Nom de la chambre : $data[room_name]</td>
            <td>Coût : $data[price] DH par nuit</td> 
        </tr>
        <tr>
            <td>Arrivée : $checkin</td>
            <td>Départ : $checkout</td> 
        </tr>";

    if ($data['booking_status'] == 'cancelled') {
        $refund = ($data['refund']) ? "Montant remboursé" : "Pas encore remboursé";

        $table_data .= "<tr>
                <td>Montant payé : $data[trans_amt]</td>
                <td>Remboursement : $refund</td> 
            </tr>";
    } elseif ($data['booking_status'] == 'payment failed') {
        $table_data .= "<tr>
                <td>Montant de la transaction : $data[trans_amt]</td>
                <td>Échec de la transaction : $data[trans_msg]</td> 
            </tr>";
    } else {
        $table_data .= "<tr>
                <td>Numéro de chambre : $data[room_no]</td>
                <td>Montant payé : $data[trans_amt]</td> 
            </tr>";
    }

    $table_data .= "</table>
    <div class='footer'>
        Merci d'avoir choisi notre hôtel. Nous sommes impatients de vous accueillir.
    </div>
</div>";


    $html2pdf = new \Spipu\Html2Pdf\Html2Pdf();
    $html2pdf->writeHTML($table_data);
    $html2pdf->output();
} else {
    header('location: index.php');
}
?>
