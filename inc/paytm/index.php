<?php
// Define the absolute path to the db_config.php file
define('DB_CONFIG_PATH', __DIR__ . '/../../admin/inc/db_config.php');
define('ESSENTIALS_PATH', __DIR__ . '/../../admin/inc/essentials.php');

// Require the db_config.php file
require_once DB_CONFIG_PATH;
require_once ESSENTIALS_PATH;

date_default_timezone_set("Africa/Casablanca");

session_start();

if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
    redirect('index.php');
}

$ORDER_ID = $_SESSION['uId'] . random_int(11111, 99999999);
$CUST_ID = $_SESSION['uId'];
$TXN_AMOUNT = $_SESSION['room']['payment'];
$TXNID = $_SESSION['uId'] . '_' . uniqid();
$RESPMSG = "Your Transaction has been confirmed";
$STATUS = "TNX_SUCCESS";
$booked = "booked";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Paiment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="assets/style3.css">
</head>
<body>

<div class="container">
    <div class="card">
        <img src="assets/paypal.png" class="paypal-logo" />
        <p class="heading">Paiment Details</p>
        <form id="payment-form">
            <div class="form-group">
                <label for="order-id">ID de commande</label>
                <input type="text" id="order-id" name="order-id" value="<?php echo $ORDER_ID ?>" readonly>
            </div>
            <div class="form-group">
                <label for="amount">Montant</label>
                <input type="text" id="amount" name="amount" value="<?php echo $TXN_AMOUNT ?>" readonly>
            </div>
            <button type="button" name="get_receipt" value="1" id="get-receipt-btn" class="pay-button">
                <a href="../../pay_status.php?order=<?php echo $ORDER_ID ?>" style="color: white; text-decoration: none;">PAY NOW</a>
            </button>
        </form>
        <div id="feedback"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
   $(() => {
        $("#pay").on('click', async (e) => {
            e.preventDefault()

            $("#pay").text('Please wait...').attr('disabled', true)
            const form = $('#form').serializeArray()

            var indexed_array = {};
            $.map(form, function(n, i) {
                indexed_array[n['name']] = n['value'];
            });

            const _response = await fetch('./mpesa.php', {
                method: 'post',
                body: JSON.stringify(indexed_array),
                mode: 'no-cors',
            })

            const response = await _response.json()
            $("#pay").text('Pay').attr('disabled', false)
            $("#pay").html(`Pay <i class="fas fa-arrow-right px-3 py-2"></i>`).attr('disabled', false)

            if (response && response.ResponseCode == 0) {
                $('#feedback').html(`
                <p class='alert alert-success'>${response.CustomerMessage}</br>
                 Enter M-PESA Pin Prompted on your phone 
                </p>
                `)
            } 
            else {
                $('#feedback').html(`<p class='alert alert-danger'>Error! ${response.errorMessage}</p>`)
            }
        })
    })
</script>
<?php

$frm_data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`booking_status`, `order_id`,`trans_id`,`trans_amt`,`trans_status`,`trans_msg` ) VALUES (?,?,?,?,?,?,?,?,?,?)";

insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],
 $frm_data['checkout'],$booked,$ORDER_ID,$TXNID,$TXN_AMOUNT,$STATUS,$RESPMSG],'isssssssss');

$query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,
 `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

insert($query2,['booking_id',$_SESSION['room']['name'],$_SESSION['room']['price'],
 $TXN_AMOUNT,$frm_data['name'],$frm_data['phonenum'],$frm_data['address']],'issssss');

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
