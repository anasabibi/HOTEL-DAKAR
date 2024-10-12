<?php

require('inc/db_config.php');
require('inc/essentials.php');

require __DIR__.'/inc/vendor/autoload.php';



adminLogin();

if(isset($_GET['gen_pdf']) && isset($_GET['id']))
{
  $frm_data = filteration($_GET);

  $query = "SELECT bo.*, bd.*,uc.email FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    INNER JOIN `user_cred` uc ON bo.user_id = uc.id
    WHERE ((bo.booking_status='booked' AND bo.arrival=1) 
    OR (bo.booking_status='cancelled' AND bo.refund=1) 
    OR (bo.booking_status='payment failed'))
    AND bo.booking_id ='$frm_data[id]'";

  $res = mysqli_query($con,$query);
  $total_rows = mysqli_num_rows($res);

  if($total_rows==0){
      header('location: dashboard.php');
    exit;
  }

  $data = mysqli_fetch_assoc($res);

  $date = date("h:ia | d-m-Y",strtotime($data['datentime']));
  $checkin = date("d-m-Y",strtotime($data['check_in']));
  $checkout = date("d-m-Y",strtotime($data['check_out']));

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
  <h2>REÇU DE RÉSERVATION</h2>
<table border='1'>
  <tr>
    <td>ID de Commande : $data[order_id] </td>
    <td>Date de Réservation : $date </td> 
  </tr>
  <tr>
    <td colspan='2'>Statut : $data[booking_status]</td> 
  </tr>
  <tr>
    <td>Nom : $data[user_name] </td>
    <td>Email : $data[email] </td> 
  </tr>
  <tr>
    <td>Numéro de Téléphone : $data[phonenum] </td>
    <td>Adresse : $data[address] </td> 
  </tr>
  <tr>
    <td>Nom de la Chambre : $data[room_name] </td>
    <td>Coût : $data[price] DH par nuit </td> 
  </tr>
  <tr>
    <td>Arrivée : $checkin</td>
    <td>Départ : $checkout</td> 
  </tr>";

if($data['booking_status']=='cancelled')
{
    $refund = ($data['refund']) ? "Montant Remboursé" : "Pas Encore Remboursé";

    $table_data.="<tr>
        <td>Montant Payé : $data[trans_amt]</td>
        <td>Remboursement : $refund</td> 
    </tr>
    </table>";
}
else if($data['booking_status']=='payment failed')
{
    $table_data.="<tr>
        <td>Montant de la Transaction : $data[trans_amt]</td>
        <td>Réponse d'Échec : $data[trans_msg]</td> 
    </tr>
    </table>";
}
else{
    $table_data.="<tr>
        <td>Numéro de Chambre : $data[room_no]</td>
        <td>Montant Payé : $data[trans_amt]</td> 
    </tr>
    </table>";
}




  $html2pdf = new \Spipu\Html2Pdf\Html2Pdf();
  $html2pdf->writeHTML($table_data);
  $html2pdf->output();


  
}
else{
    header('location: dashboard.php');
}
?>
