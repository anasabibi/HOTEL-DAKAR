<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .modal-backdrop {
            position: relative;}
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        * {
            font-family: "Poppins", sans-serif;
        }
        .h-font {
            font-family: 'Poppins', sans-serif;
            font-size: 2rem; 
        }

        .navbar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-link i {
            font-size: 1.2rem;
        }

        .navbar-nav .nav-link:hover {
            background-color: #fd8c0dfc;
            color: #fff;
        }

        .navbar-toggler {
            border: none;
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: var(--bs-nav-pills-link-active-color);
            background-color: #fd8c0dfc;
        }

        .btn {
            border-radius: 0.25rem;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-outline-light:hover {
            background-color: #fff;
            color: #000;
        }

        .btn:focus, .nav-link:focus {
            box-shadow: none;
        }

        .custom-bg {
            background-color: #FD730D;
            border: 1px solid #FD730D;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .custom-bg:hover {
            background-color: #FD730D;
            border-color: #FD730D;
        }

        .sidebar {
            min-height: 100vh;
            width: 250px;
            border-right: 1px solid #dee2e6;
        }

        .bg-primary {
            --bs-bg-opacity: 1;
            background-color: rgb(253 115 13) !important;
        }

        .sidebar .navbar-nav {
            width: 100%;
        }

        .sidebar .nav-item + .nav-item {
            margin-top: 0.5rem;
        }

        .sidebar .btn {
            padding: 0.75rem 1.25rem;
            text-align: left;
        }

        .sidebar .btn i {
            font-size: 1rem;
        }

        .sidebar .collapse.show {
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 992px) {
            .sidebar {
                min-height: auto;
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #dee2e6;
            }

            .sidebar .navbar-nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .sidebar .nav-item {
            }

            .sidebar .btn {
                flex: 1 1 100%;
                text-align: center;
            }
        }

        .text-white {
            --bs-text-opacity: 1;
            color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
        }

        .bg-dark {
            --bs-bg-opacity: 1;
            background-color: rgb(245 124 9) !important;
        }

        .form-check-input:checked {
            background-color: #fd6e0d;
            border-color: #fd6e0d;
        }

        :root {
            --bs-body-color: #333; /* Dark gray for text */
            --bs-primary: #ffa500; /* Orange for primary elements */
            --bs-secondary: #555; /* Dark gray for secondary elements */
            --bs-light: #f8f9fa; /* Light gray for backgrounds */
            --bs-dark: #212529; /* Dark gray for backgrounds */
            --bs-border-color: #ddd; /* Light gray for borders */
            --bs-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Box shadow */
        }

        .table {
            --bs-table-color-type: initial;
            --bs-table-bg-type: initial;
            --bs-table-color-state: initial;
            --bs-table-bg-state: initial;
            --bs-table-color: var(--bs-body-color);
            --bs-table-bg: #ffc10700;
            --bs-table-border-color: var(--bs-border-color);
            --bs-table-accent-bg: #ff9c072e;
            --bs-table-striped-color: var(--bs-body-color);
            --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
            --bs-table-active-color: var(--bs-body-color);
            --bs-table-active-bg: rgba(0, 0, 0, 0.1);
            --bs-table-hover-color: var(--bs-body-color);
            --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
            width: 100%;
            margin-bottom: 1rem;
            vertical-align: top;
            border-color: var(--bs-table-border-color);
        }

        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid var(--bs-table-border-color);
        }

        .table th {
            background-color: var(--bs-light);
            border-bottom: 2px solid var(--bs-secondary);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: var(--bs-table-striped-bg);
        }

        .table-hover tbody tr:hover {
            background-color: var(--bs-table-hover-bg);
        }

        .card {
            background-color: var(--bs-light); /* Light gray for card background */
            border-color: var(--bs-secondary);
            border-radius: 0.25rem;
            box-shadow: var(--bs-shadow);
            margin-bottom: 1rem;
        }

        .card-header,
        .card-footer {
            background-color: var(--bs-light); /* Light gray for card header and footer */
            border-color: var(--bs-secondary);
            color: var(--bs-body-color);
            padding: 0.75rem;
            border-bottom: 1px solid var(--bs-secondary);
        }

        .card-body {
            color: var(--bs-body-color);
            padding: 1rem;
        }

        .card-footer {
            border-top: 1px solid var(--bs-secondary);
        }

        .form-check-input:focus {
            border-color: #fd6e0d;
            outline: 0;
            box-shadow: 0 0 0 .25rem #fd6e0d;
        }



        .btn-check:focus + .btn-primary, .btn-primary:focus {
            color: #fff;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-primary {
            --bs-btn-color: #fff;
            --bs-btn-bg: #fdb40d;
            --bs-btn-border-color: #ffc107;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: #ffc107;
            --bs-btn-hover-border-color: #ffc107;
            --bs-btn-focus-shadow-rgb: 49, 132, 253;
            --bs-btn-active-color: #fff;
            --bs-btn-active-bg: #ffc107;
            --bs-btn-active-border-color: #ffc107;
            --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #ffc107;
            --bs-btn-disabled-border-color: #ffc107;
        }
        .p-3 {
        padding: 0.5rem !important;
        }
        .text-primary {
        --bs-text-opacity: 1;
        color: #fd730d !important;
        }
        .text-danger {
            --bs-text-opacity: 1;
            color: #fd730d !important;
        }
        .text-success {
            --bs-text-opacity: 1;
            color: #fd730d !important;
        }
        .text-warning {
            --bs-text-opacity: 1;
            color: #fd730d !important;
        }
        .text-info {
            --bs-text-opacity: 1;
            color: #fd730d !important;
        }
        .modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    color: var(--bs-modal-color);
    pointer-events: auto;
    background-color: #f9e8ce;
    background-clip: padding-box;
    border: var(--bs-modal-border-width) solid var(--bs-modal-border-color);
    border-radius: var(--bs-modal-border-radius);
    outline: 0;
}
.bg-light {
    --bs-bg-opacity: 1;
    background-color: #f9e8ce57 !important;
}
.card {
    background-color: #f9e8ce;
    border-color: var(--bs-secondary);
    border-radius: 0.25rem;
    box-shadow: var(--bs-shadow);
    margin-bottom: 1rem;
}
    </style>
</head>
<body>
<div class="container-fluid bg-primary text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font"><img src="../images/term/camel.png" alt="Logo" style="height: 40px; margin-right: 10px;">Hotel Dakar</h3>
    <a href="logout.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> SE DÉCONNECTER</a>
</div>

<div class="d-flex flex-column flex-lg-row">
    <div class="bg-light text-dark p-3 sidebar" id="dashboard-menu">
        <nav class="navbar navbar-expand-lg navbar-light flex-lg-column">
            <div class="container-fluid flex-lg-column align-items-stretch">
                <h4 class="mt-2 text-dark"><i class="bi bi-shield-lock"></i> PANEL D'ADMINISTRATION</h4>
                <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="dashboard.php"><i class="bi bi-speedometer2"></i> Tableau de bord</a>
                        </li>
                        <li class="nav-item">
                            <button class="btn text-dark px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks" aria-expanded="false" aria-controls="collapseExample">
                                <span><i class="bi bi-calendar-check"></i> Réservations</span>
                                <span><i class="bi bi-caret-down-fill"></i></span>
                            </button>
                            <div class="collapse px-3 small mb-1" id="bookingLinks">
                                <ul class="nav nav-pills flex-column rounded border border-secondary">
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="new_bookings.php"><i class="bi bi-calendar-plus"></i> Nouvelles Réservations</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="refund_bookings.php"><i class="bi bi-arrow-clockwise"></i> Remboursements</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="booking_records.php"><i class="bi bi-archive"></i> Historique des Réservations</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="users.php"><i class="bi bi-people"></i> Utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="user_queries.php"><i class="bi bi-question-circle"></i> Requêtes Utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="rooms.php"><i class="bi bi-door-closed"></i> Chambres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="features_facilities.php"><i class="bi bi-lightbulb"></i> Caractéristiques et Installations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="carousel.php"><i class="bi bi-images"></i> Carrousel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="gallery.php"><i class="bi bi-card-image"></i> Galerie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="settings.php"><i class="bi bi-gear"></i> Paramètres</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>


        <div class="flex-grow-1 p-4">
            <!-- Main content goes here -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
