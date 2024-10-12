function get_users() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('users-data').innerHTML = this.responseText;
    }
    xhr.send('get_users');
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Statut basculé!');
            get_users();
        } else {
            alert('error', 'Serveur en panne!');
        }
    };
    xhr.send('toggle_status=' + id + '&value=' + val);
}


function remove_user(user_id) 
{
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        let data = new FormData();
        data.append('user_id', user_id);
        data.append('remove_user', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/users.php", true);

        xhr.onload = function () {
            if (this.responseText == 1) {
                alert('success','Utilisateur supprimé avec succès!');
                get_users();
            } else {
                alert('error', 'Échec de la suppression de l\'utilisateur!');
            }
        }

        xhr.send(data);
    }
}



function search_user(username){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('users-data').innerHTML = this.responseText;
    }
    xhr.send('search_user&name='+username);


}


window.onload = function() {
    get_users();
}
