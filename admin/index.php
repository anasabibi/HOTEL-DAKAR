<?php 
require('inc/essentials.php');
require('inc/db_config.php');

session_start();
if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin']==true)){
   redirect('dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php require('inc/links.php') ;?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9e8ce57;
        }
        
       .login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background-color: #f9e8ce;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
       .login-form h4 {
            background-color: #e96313;
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
            margin-top: 0;
        }
        
       .login-form .form-control {
            height: 50px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
       .login-form .btn {
            background-color: #e96313;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .login-form .btn:hover {
    background-color: #e96313;
}

    </style>
</head>
<body>
    <div class="login-form text-center">
        <form method="post">
            <h4>PANNEAU DE CONNEXION ADMINISTRATEUR</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control" placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control" placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn">SE CONNECTER</button>
            </div>
        </form>
    </div>

    <?php
    if(isset($_POST['login']))
    {
        $frm_data = filteration($_POST);
        
        $query = "SELECT * FROM admin_cred WHERE admin_name =? AND admin_pass =?";
        $values =[$frm_data['admin_name'],$frm_data['admin_pass']];
        
        $res = select($query,$values,'ss');
        if($res->num_rows==1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('dashboard.php');
        }
        else{
          alert('error','login failed - Invalid Credentials!');  
        }
    }


?>

<?php require('inc/scripts.php') ;?>

</body>
</html>
