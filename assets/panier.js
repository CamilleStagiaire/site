let btnAjouter = document.getElementsByClassName('panier');
let message = document.getElementById('alert')
let nbrArticle = document.getElementById('nbrArticle')

for (let i = 0; i < btnAjouter.length; i++) {
    const lien = btnAjouter[i];

    lien.addEventListener('click', function (e) {
        e.preventDefault();
        let idArticle = this.dataset.id;
        let xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let result = JSON.parse(xhr.responseText)
                 message.textContent = "Vous avez ajouté la bière " + result.biere.nom_article + " à votre panier";
                 message.classList.add('alert', 'alert-success');
                nbrArticle.innerHTML = result.nbr_article; 

            }

        }
        xhr.open("POST", "data/panier.php");
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("article=" + idArticle);

    })

}