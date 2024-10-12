<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>
    <?php require('inc/links.php');?>
    <style>
        /* Custom styles */
        body {
            font-family: 'Open Sans', sans-serif;
        }

       .custom-alert.success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3e8e41;
        }
       .custom-alert.error {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
        #main-content {
            padding-top: 0px;
        }
       .card {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       .card-body {
            padding: 20px;
        }
       .table-responsive {
            overflow-x: auto;
        }
       .table {
            font-size: 14px;
        }
       .table th,.table td {
            vertical-align: middle;
        }
       .table th {
            background-color: #f7f7f7;
            border-bottom: 1px solid #ddd;
        }
       .table td {
            border-bottom: 1px solid #ddd;
        }
       .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
       .search-input {
            width: 250px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       .search-input:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-light">
    <?php require('inc/header.php');?>

    <div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">Utilisateurs</h3>
            <div class="card border shadow-sm mb-4">
                <div class="card-body">
                    <div class="text-end mb-4">
                        <input type="text" oninput="search_user(this.value)" class="form-control search-input shadow-none" placeholder="Tapez pour chercher...">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover border text-center" style="min-width: 1300px;">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Numéro de téléphone</th>
                                    <th scope="col">Emplacement</th>
                                    <th scope="col">Date de naissance</th>
                                    <th scope="col">Vérifié</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="users-data"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php require('inc/scripts.php');?> 
    <script src="scripts/users1.js"></script>
</body>
</html>