$(document).ready(function() {

    if ($("#cinema_call").length) {
        cinemas = []
        all_cinema();
    }

    if ($("#theatre_call").length) {
        theatres = []
        all_theatre();
    }

    if ($("#movie_call").length) {
        movies = []
        all_movie();
    }

    if ($("#showtime_call").length) {
        showtimes = []
        all_showtime();
    }

    function all_cinema() {
        $.get("../../common/submit_admin_forms.php", {
            get_all_cinema: ''
        }, function(data, status) {
            data = JSON.parse(data);
            cinemas = data;
            keys = []
            for (var k in data) keys.push(k);
            autocomplete(document.getElementById("cinema_search"), keys);
        });
    }

    function all_theatre() {
        $.get("../../common/submit_admin_forms.php", {
            get_all_theatre: ''
        }, function(data, status) {
            data = JSON.parse(data);
            theatres = data;
            keys = []
            for (var k in data) keys.push(k);
            autocomplete(document.getElementById("theatre_search"), keys);
        });
    }

    function all_movie() {
        $.get("../../common/submit_admin_forms.php", {
            get_all_movie: ''
        }, function(data, status) {
            data = JSON.parse(data);
            movies = data;
            keys = []
            for (var k in data) keys.push(k);
            autocomplete(document.getElementById("movie_search"), keys);
        });
    }

    function all_showtime() {
        $.get("../../common/submit_admin_forms.php", {
            get_all_showtime: ''
        }, function(data, status) {
            data = JSON.parse(data);
            showtimes = data;
            keys = []
            for (var k in data) keys.push(k);
            autocomplete(document.getElementById("showtime_search"), keys);
        });
    }

    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false; }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        set_id_holder(inp.value);
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });

        // Close payment when clicking outside
        $("body").hover(function(e) {
            if (e.target.id == "showtime_search") {

            } else {
                closeAllLists();
            }
        });
    }

    function set_id_holder(input_value) {
        if ($("#cinema_call").length) {
            $('#cinema_id').prop('readonly', false);
            $('#cinema_id').prop("placeholder", "Cinema ID: " + cinemas[input_value]);
            $('#cinema_id').prop('readonly', true);

            $("#cinema_id_entry").text(cinemas[input_value]);
            $("#cinema_name_entry").text(input_value);
        }
        if ($("#theatre_call").length) {
            $('#theatre_id').prop('readonly', false);
            $('#theatre_id').prop("placeholder", "Theatre ID: " + theatres[input_value]);
            $('#theatre_id').prop('readonly', true);

            $("#theatre_id_entry").text(theatres[input_value]);
            $("#theatre_name_entry").text(input_value);
        }
        if ($("#movie_call").length) {
            $('#movie_id').prop('readonly', false);
            $('#movie_id').prop("placeholder", "Movie ID: " + movies[input_value]);
            $('#movie_id').prop('readonly', true);

            $("#movie_id_entry").text(movies[input_value]);
            $("#movie_name_entry").text(input_value);
        }
        if ($("#showtime_call").length) {
            $('#showtime_id').prop('readonly', false);
            $('#showtime_id').prop("placeholder", "Showtime ID: " + showtimes[input_value]);
            $('#showtime_id').prop('readonly', true);

            $("#showtime_id_entry").text(showtimes[input_value]);
            $("#showtime_name_entry").text(input_value);
        }
    }
});