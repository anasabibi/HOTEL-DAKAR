<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php require('inc/links.php'); ?>
    
    <title>  <?php echo $settings_r['site_title']?> - Chambres</title>
</head>
<style>
    /* Add this to your custom styles.css or within the <style> tag in your HTML file */

.h-font {
    font-family: 'Poppins', sans-serif;
}

.h-line {
    width: 50px;
    height: 4px;
    background-color: #f4511e;
    margin: 10px auto;
}
.card{
    background-color: #f9e8ce;
}

.filters {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.filter-group h5 {
    font-size: 18px;
    color: #333;
}

.filter-group label {
    font-weight: 500;
    color: #333;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 10px;
}

.room-card h6 {
    font-size: 1rem;
    margin-bottom: 15px;
    color: #f4511e;
}

.btn {
    border-radius: 5px;
}

.btn:hover {
    background: linear-gradient(45deg, #f4511e, #FFFFFF);
    color: #fff;
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .filters {
        margin-bottom: 20px;
    }
}
 /* Vos styles personnalisés ici */
 .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 25px;
                padding: 0 35px;
            }
        }

        #scrollBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            background-color: #f4511e;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 10px;
        }

        #scrollBtn:hover {
            background-color: #d63c17;
        }

</style>

<body class="bg-light">

    <?php 
        require('inc/header.php'); 

        $checkin_default="";
        $checkout_default="";
        $checkin_default="";
        $adult_default="";
        $children_default="";

        if(isset($_GET['check_availability']))
        {
            $frm_data = filteration($_GET);

        $checkin_default = $frm_data['checkin'];
        $checkout_default = $frm_data['checkout'];
        $adult_default = $frm_data['adult'];
        $children_default = $frm_data['children'];

        }
        
        ?>

<div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">NOS CHAMBRES</h2>
        <div class="h-line "></div>
    </div>

    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-4">
            <div class="filters bg-white rounded shadow p-4">
                <h4 class="mb-4">FILTRES</h4>

                <div class="filter-group mb-4">
                    <h5 class="d-flex align-items-center justify-content-between mb-3">
                        <span>VÉRIFIER LA DISPONIBILITÉ</span> 
                        <button id="chk_avail_btn" onclick="chk_avail_clear()" class="btn btn-sm text-secondary d-none">Réinitialiser</button>
                    </h5>
                    <label class="form-label">Date d'arrivée</label>
                    <input type="date" class="form-control shadow-none mb-3" value="<?php echo $checkin_default ?>" id="checkin" onchange="chk_avail_filter()">
                    <label class="form-label">Date de départ</label>
                    <input type="date" class="form-control shadow-none" id="checkout" value="<?php echo $checkout_default ?>" onchange="chk_avail_filter()">
                </div>

                <div class="filter-group mb-4">
                    <h5 class="d-flex align-items-center justify-content-between mb-3">
                        <span>INSTALLATIONS</span> 
                        <button id="facilities_btn" onclick="facilities_clear()" class="btn btn-sm text-secondary d-none">Réinitialiser</button>
                    </h5>
                    <?php
                        $facilities_q = selectAll('facilities');
                        while($row = mysqli_fetch_assoc($facilities_q)) {
                            echo<<<facilities
                            <div class="form-check mb-2">
                                <input type="checkbox" onclick="fetch_rooms()" name="facilities" value="$row[id]" class="form-check-input shadow-none me-1" id="$row[id]">
                                <label class="form-check-label" for="$row[id]">$row[name]</label>
                            </div> 
                            facilities;
                        }
                    ?>            
                </div>
                
                <div class="filter-group mb-4">
                    <h5 class="d-flex align-items-center justify-content-between mb-3">
                        <span>INVITÉS</span> 
                        <button id="guests_btn" onclick="guests_clear()" class="btn btn-sm text-secondary d-none">Réinitialiser</button>
                    </h5>
                    <div class="d-flex">
                        <div class="me-3">
                            <label class="form-label">Adultes</label>
                            <input type="number" min="1" id="adults" value="<?php echo $adult_default ?>" oninput="guests_filter()" class="form-control shadow-none">  
                        </div>    
                        <div>
                            <label class="form-label">Enfants</label>
                            <input type="number" min="1" id="children" value="<?php echo $children_default ?>" oninput="guests_filter()" class="form-control shadow-none">  
                        </div>  
                    </div>     
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-12 px-4" id="rooms-data">
            <!-- Les cartes des chambres seront chargées dynamiquement ici -->
        </div>
    </div>
</div>
<!-- Scroll to Top Button -->
<button onclick="topFunction()" id="scrollBtn" title="Go to top">
        <i class="bi bi-arrow-up-circle"></i>
    </button>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Script JavaScript pour le bouton de retour en haut -->
        <script>
        let rooms_data = document.getElementById('rooms-data');
        let check_in = document.getElementById('check-in');
        let check_out = document.getElementById('check-out');
        let chk_avail_btn = document.getElementById('chk_avail_btn');

        let adults = document.getElementById('adults');
        let children = document.getElementById('children');
        let guests_btn = document.getElementById('guests_btn');

        let facilities_btn = document.getElementById('facilities_btn');


        function fetch_rooms()
        {
            let chk_avail = JSON.stringify({
            checkin: checkin.value,
            checkout: checkout.value
            });

            let guests = JSON.stringify({
            adults: adults.value,
            children: children.value
            });

            let facility_list = {"facilities":[]};

            let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
            if(get_facilities.length>0)
            {
            get_facilities.forEach((facility)=>{
                facility_list.facilities.push(facility.value);
            });
            facilities_btn.classList.remove('d-none');
            }
            else{
            facilities_btn.classList.add('d-none');
            }

            facility_list = JSON.stringify(facility_list);

            let xhr = new XMLHttpRequest();
            xhr.open("GET","ajax/rooms.php?fetch_rooms&chk_avail="+chk_avail+"&guests="+guests+"&facility_list="+facility_list,true);

            xhr.onprogress = function(){
            rooms_data.innerHTML =`<div class="spinner-border text-info mb-3 d-block mx-auto" id="loader" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>`;
            }

            xhr.onload = function(){
            rooms_data.innerHTML = this.responseText;
            }

            xhr.send();
        }

        function chk_avail_filter(){
            if(checkin.value!='' && checkout.value !=''){
            fetch_rooms();
            chk_avail_btn.classList.remove('d-none');
            }
        }

        function chk_avail_clear(){
            checkin.value='';
            checkout.value=''
            chk_avail_btn.classList.add('d-none');
            fetch_rooms();
        }

        function guests_filter(){
            if(adults.value>0 || children.value>0){
            fetch_rooms();
            guests_btn.classList.remove('d-none');
            }
        }

        function guests_clear(){
            adults.value=''; 
            children.value='';
            guests_btn.classList.add('d-none');
            fetch_rooms();
        }
        
        function facilities_clear(){
            let get_facilities = document.querySelectorAll('[name="facilities"]:checked');
            get_facilities.forEach((facility)=>{
            facility.checked=false;
            });
            facilities_btn.classList.add('d-none');
            fetch_rooms();
        }
        
        window.onload = function(){
            fetch_rooms();
        }
         // Get the button
         let mybutton = document.getElementById("scrollBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    scrollFunction();
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
document.addEventListener("DOMContentLoaded", function() {
const roomCards = document.querySelectorAll('.room-card');

roomCards.forEach((card, index) => {
setTimeout(() => {
  card.classList.add('visible');
}, index * 300); // Ajustez le délai au besoin
});

roomCards.forEach(card => {
card.addEventListener('mouseenter', () => {
  card.classList.add('hovered');
});

card.addEventListener('mouseleave', () => {
  card.classList.remove('hovered');
});

const cardBtn = card.querySelector('.btn');
cardBtn.addEventListener('mouseenter', () => {
  cardBtn.classList.add('hovered');
});

cardBtn.addEventListener('mouseleave', () => {
  cardBtn.classList.remove('hovered');
});
});
});

        </script>

<br>
    <?php require('chatbot.php'); ?>
    <?php require('inc/footer.php'); ?>

  </body>
</html> 