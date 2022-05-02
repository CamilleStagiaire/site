let btnDeviner = document.getElementById('btnDeviner');
let affichage = document.getElementById('afficherResultat');

btnDeviner.addEventListener('click', function() {

    let xhr = new XMLHttpRequest();
    let nombre = document.getElementById('nombre').value;

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            affichage.innerHTML = xhr.responseText;      
        }  
    }
    xhr.open("POST", "data/devinette.php");
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded') // transforme l'entête pour envoyer l'information en array(data)
    xhr.send("nombre=" + nombre);
})


let form = document.querySelector('form');
let alerts = document.getElementById('alerts');

form.addEventListener('submit', function (e) {
    e.preventDefault();
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let user = JSON.parse(xhr.responseText);
            alerts.innerHTML = xhr.responseText;
           

            alerts.innerHTML = "Bonjour " + user.username + " votre mot de passe est : " + user.password
        }
    }

    xhr.open("POST", "data/user.php");
    let data = new FormData(form); // il n'y a plus besoin de modifier l'entête avec formData
    xhr.send(data);
    
})