$(document).ready(function() {

    $(".movie-card").click(function() {

        var movie_id = $(this).children('div').prop("id");

        $("#overlay").load("../common/movie_payment.php", {
            movie_id: movie_id
        }, function(data, status) {
            on();
        });
    });

    // Close payment when clicking outside
    $("body").click(function(e) {
        if (e.target.id == "container" || $(e.target).parents("#wrapper").length) {

        } else {
            off();
        }
    });

    $("#showtimes").on('change', function() {
        alert("this.value");
    });

    function on() {
        document.getElementById("overlay").style.display = "block";
        // document.getElementById("overlay-blur").style.display = "block";
    }

    function off() {
        document.getElementById("overlay").style.display = "none";
        // document.getElementById("overlay-blur").style.display = "none";
    }

});