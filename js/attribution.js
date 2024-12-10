function searchTable() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("parrainageTable");
            var rows = table.getElementsByTagName("tr");

            for (var i = 1; i < rows.length; i++) {
                var td = rows[i].getElementsByTagName("td");
                var parrain = td[0].textContent.toUpperCase();
                var filleuls = td[1].textContent.toUpperCase();

                if (parrain.indexOf(filter) > -1 || filleuls.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        function validerParrainage() {
            alert("Les relations de parrainage ont été validées.");
        }