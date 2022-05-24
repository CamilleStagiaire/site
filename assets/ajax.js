
    var idRegion = document.getElementById('region');
    
    idRegion.addEventListener("change", function () {

        let xhr = new XMLHttpRequest();
        let region = document.getElementById('region').value;
        let depSelect = document.getElementById('depSelect');
        let result= document.getElementById('result');
        depSelect.innerHTML = '';
        result.innerHTML = '';

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                depSelect.innerHTML = xhr.responseText;
            }
        }

        xhr.open("POST", "data/villes.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

        xhr.addEventListener("load", function () {
            var idDep = document.getElementById('departement');

            idDep.addEventListener("change", function () {
                let xhr = new XMLHttpRequest();
                let departement = document.getElementById('departement').value;
                result.innerHTML = '';
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {     
                       result.innerHTML = xhr.responseText;
                    }
                }
                xhr.open("POST", "data/villes2.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send("dep=" + departement);
            })
        })

        xhr.send("region=" + region);
    });

