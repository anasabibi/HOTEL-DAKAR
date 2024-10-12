<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'Administration - Chambres</title>
    <?php require('inc/links.php'); ?>
</head>
<style>
    .custom-alert {
        position: fixed;
        top: 80px;
        right: 25px;
    }
</style>
<body class="bg-light">
    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Chambres</h3>
                <div class="card border shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i> Ajouter
                            </button>
                        </div>
                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Surface</th>
                                        <th scope="col">Invités</th>
                                        <th scope="col">Prix</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ajouter Chambre Modal -->
    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter Chambre</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nom</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Surface</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Prix</label>
                                <input type="number" min="1" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantité</label>
                                <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Adultes (Max.)</label>
                                <input type="number" min="1" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Enfants (Max.)</label>
                                <input type="number" min="1" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Caractéristiques</label>
                                <div class="row">
                                    <?php 
                                    $res = selectALL('features');
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='features' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                {$opt['name']}
                                            </label>
                                        </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Installations</label>
                                <div class="row">
                                    <?php 
                                    $res = selectALL('facilities');
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='facilities' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                {$opt['name']}
                                            </label>
                                        </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label fw-bold">Description</label>
                                <textarea id="description" name="desc" class="form-control shadow-none" rows="4" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">ANNULER</button>
                                <button type="submit" class="btn custom-bg text-white shadow-none">SOUMETTRE</button>
                            </div>
                        </div>
                    </div>                           
                </div>
            </form>
        </div>
    </div>

    <!-- Modifier Chambre Modal -->
    <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier Chambre</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nom</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Surface</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Prix</label>
                                <input type="number" min="1" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantité</label>
                                <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Adultes (Max.)</label>
                                <input type="number" min="1" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Enfants (Max.)</label>
                                <input type="number" min="1" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Caractéristiques</label>
                                <div class="row">
                                    <?php 
                                    $res = selectALL('features');
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='features' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                {$opt['name']}
                                            </label>
                                        </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Installations</label>
                                <div class="row">
                                    <?php 
                                    $res = selectALL('facilities');
                                    while($opt = mysqli_fetch_assoc($res)){
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='facilities' value='{$opt['id']}' class='form-check-input shadow-none'>
                                                {$opt['name']}
                                            </label>
                                        </div>";
                                    }
                                    ?>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label fw-bold">Description</label>
                                    <textarea id="description" name="desc" class="form-control shadow-none" rows="4" required></textarea>
                                </div>
                                <input type="hidden" name="room_id">
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">ANNULER</button>
                                <button type="submit" class="btn custom-bg text-white shadow-none">SOUMETTRE</button>
                            </div>
                        </div>                           
                    </div>
                </form>
            </div>
        </div>
    
        <!-- Modifier Images de la Chambre Modal -->
        <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nom de la Chambre</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="image-alert"></div>
                        <div class="border-bottom border-3 pb-3 mb-3">
                            <form id="add_image_form">
                                <label class="form-label fw-bold">Ajouter Image</label>
                                <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                                <button class="btn custom-bg text-white shadow-none">AJOUTER</button>
                                <input type="hidden" name="room_id">
                            </form>
                        </div>
                        <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light sticky-top">
                                        <th scope="col" width="60%">Image</th>
                                        <th scope="col">Miniature</th>
                                        <th scope="col">Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody id="room-image-data">
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
        <?php require('inc/scripts.php'); ?> 
        <script src="scripts/rooms1.js"></script>
    </body>
    </html>
    
