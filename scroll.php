<style>

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




<button onclick="topFunction()" id="scrollBtn" title="Go to top">
    <i class="bi bi-arrow-up-circle"></i>
</button>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // Fonction pour afficher ou masquer le bouton de retour en haut
    let mybutton = document.getElementById("scrollBtn");

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

    // Fonction pour remonter en haut de la page
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
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