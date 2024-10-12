let gallery_s_form = document.getElementById('gallery_s_form');
let gallery_picture_inp = document.getElementById("gallery_picture_inp");

gallery_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_image();
});

function add_image() {
    let data = new FormData();
    data.append('picture', gallery_picture_inp.files[0]);
    data.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/gallery_crud.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById("gallery-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', 'Seules les images JPG et PNG sont autorisées !');
        } else if (this.responseText == 'inv_size') {
            alert('error', 'L\'image doit être inférieure à 2 Mo !');
        } else if (this.responseText == 'upd_failed') {
            alert('error', 'Échec du téléchargement de l\'image. Serveur en panne');
        } else {
            alert('success', 'Nouvelle image ajoutée!');
            gallery_picture_inp.value = '';
            get_gallery();
        }
    }

    xhr.send(data);
}

function get_gallery() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/gallery_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('gallery-data').innerHTML = this.responseText;
    }

    xhr.send('get_gallery');
}

function rem_image(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/gallery_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Image supprimée!');
            get_gallery();
        } else {
            alert('error', 'Serveur en panne!');
        }
    }

    xhr.send('rem_image=' + val);
}

window.onload = function() {
    get_gallery();
};
