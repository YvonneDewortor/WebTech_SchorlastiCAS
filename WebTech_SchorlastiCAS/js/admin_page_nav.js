var tabs = $('.tabs');
var selector = $('.tabs').find('a').length;
//var selector = $(".tabs").find(".selector");
var activeItem = tabs.find('.active');
var activeWidth = activeItem.innerWidth();
$(".selector").css({
    "left": activeItem.position.left + "px",
    "width": activeWidth + "px"
});

$(".tabs").on("click", "a", function(e) {
    e.preventDefault();
    $('.tabs a').removeClass("active");
    $(this).addClass('active');
    var activeWidth = $(this).innerWidth();
    var itemPos = $(this).position();
    $(".selector").css({
        "left": itemPos.left + "px",
        "width": activeWidth + "px"
    });

    var current_tab = $(this).text().toLowerCase();

    $("#flick_action").text(current_tab.charAt(0).toUpperCase() + current_tab.slice(1) + " an Entry");

    $("#add_a_cinema").text(current_tab.toUpperCase() + ' A CINEMA');
    $("#add_a_cinema").prop('href', current_tab + '_forms/' + current_tab + '_cinema.php');

    $("#add_a_theatre").text(current_tab.toUpperCase() + ' A THEATRE');
    $("#add_a_theatre").prop('href', current_tab + '_forms/' + current_tab + '_theatre.php');

    $("#add_a_movie").text(current_tab.toUpperCase() + ' A MOVIE');
    $("#add_a_movie").prop('href', current_tab + '_forms/' + current_tab + '_movie.php');

    $("#add_a_showtime").text(current_tab.toUpperCase() + ' A SHOWTIME');
    $("#add_a_showtime").prop('href', current_tab + '_forms/' + current_tab + '_showtime.php');
});