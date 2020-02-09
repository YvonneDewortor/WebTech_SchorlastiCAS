$(document).ready(function() {

    // Adding a Cinema
    $("#add_cinema").click(function() {
        var cinema_name = $("#cinema_name").val();
        var cinema_address = $("#cinema_address").val();
        var cinema_telephone = $("#cinema_telephone").val();
        var cinema_email = $("#cinema_email").val();
        var cinema_post = $("#cinema_post").val();

        if (cinema_name == "" || cinema_address == "" || cinema_telephone == "" || cinema_email == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            c_name: cinema_name,
            c_address: cinema_address,
            c_telephone: cinema_telephone,
            c_email: cinema_email,
            cinema_post: cinema_post
        }, function(data, status) {
            if (data == 1) {
                alert("Cinema added successfully");
            } else {
                alert("Unsuccessful submission.");
            }

            $('#add_cinema_form').each(function() {
                this.reset();
            });
        });
    });

    // Displaying cinema data
    $("#cinema_selection").change(function() {
        var cinema_selection = $("#cinema_selection");
        $('#cinema_id').prop('readonly', false);
        $('#cinema_id').prop("placeholder", "Cinema ID: " + cinema_selection.val());
        $('#cinema_id').prop('readonly', true);
        $('#cinema_update_post').val(cinema_selection.val());
    });

    // Loading cinema data
    $("#get_cinema_data_btn").click(function() {

        var cinema_id = $("#cinema_selection").val();
        var get_cinema_data = $("#get_cinema_data").val();

        $.get("../../common/submit_admin_forms.php", {
            c_id: cinema_id,
            get_cinema_data: get_cinema_data
        }, function(data, status) {
            data = JSON.parse(data);
            $("#cinema_name").val(data[0]);
            $("#cinema_address").val(data[1]);
            $("#cinema_telephone").val(data[2]);
            $("#cinema_email").val(data[3]);
        });
    });

    //Updating a cinema
    $("#update_cinema").click(function() {
        var cinema_name = $("#cinema_name").val();
        var cinema_address = $("#cinema_address").val();
        var cinema_telephone = $("#cinema_telephone").val();
        var cinema_email = $("#cinema_email").val();
        var cinema_update_post = $("#cinema_update_post").val();

        if (cinema_name == "" || cinema_address == "" || cinema_telephone == "" || cinema_email == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            c_name: cinema_name,
            c_address: cinema_address,
            c_telephone: cinema_telephone,
            c_email: cinema_email,
            cinema_update_post: cinema_update_post
        }, function(data, status) {
            if (data == 1) {
                alert("Cinema updated successfully.");
            } else {
                alert("Unsuccessful update.");
            }

            $('#update_cinema_form').each(function() {
                this.reset();
            });
            $("#cinema_id").empty();
            $("#cinema_selection").empty();
            window.location.reload();
        });
    })

    // Deleting a Cinema
    $("#delete_cinema").click(function() {

        var cinema_id = $("#cinema_id_entry").text();
        var cinema_delete_post = $("#cinema_delete_post").val();

        if (cinema_id == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            c_id: cinema_id,
            cinema_delete_post: cinema_delete_post
        }, function(data, status) {
            if (data == 1) {
                alert("Cinema deleted successfully.");
            } else {
                alert("Unsuccessful delete.");
            }
            window.location.reload();
        });
    });

    // Adding a Theatre
    $("#add_theatre").click(function() {

        var theatre_name = $("#theatre_name").val();
        var theatre_cinema = $("#theatre_cinema").val();
        var theatre_post = $("#theatre_post").val();
        if (theatre_name == "" || theatre_cinema == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            t_name: theatre_name,
            t_cinema: theatre_cinema,
            theatre_post: theatre_post
        }, function(data, status) {
            if (data == 1) {
                alert("Theatre added successfully.");
            } else {
                alert("Unsuccessful submission.");
            }

            $('#add_theatre_form').each(function() {
                this.reset();
            });
        });
    });

    // Displaying theatre data
    $("#theatre_selection").change(function() {
        var theatre_selection = $("#theatre_selection");
        $('#theatre_id').prop('readonly', false);
        $('#theatre_id').prop("placeholder", "Theatre ID: " + theatre_selection.val());
        $('#theatre_id').prop('readonly', true);
        $('#theatre_update_post').val(theatre_selection.val());
    });

    // Loading theatre data
    $("#get_theatre_data_btn").click(function() {

        var theatre_id = $("#theatre_selection").val();
        var get_theatre_data = $("#get_theatre_data").val();

        $.get("../../common/submit_admin_forms.php", {
            t_id: theatre_id,
            get_theatre_data: get_theatre_data
        }, function(data, status) {
            data = JSON.parse(data);
            $("#theatre_name").val(data[0]);
            $("#theatre_cinema").val(data[1]);
        });
    });

    // Updating a theatre
    $("#update_theatre").click(function() {

        var theatre_name = $("#theatre_name").val();
        var theatre_cinema = $("#theatre_cinema").val();
        var theatre_update_post = $("#theatre_update_post").val();
        if (theatre_name == "" || theatre_cinema == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            t_name: theatre_name,
            t_cinema: theatre_cinema,
            theatre_update_post: theatre_update_post
        }, function(data, status) {
            if (data == 1) {
                alert("Theatre updated successfully.");
            } else {
                alert("Unsuccessful update.");
            }

            $('#update_theatre_form').each(function() {
                this.reset();
            });
            $("#theatre_id").empty();
            $("#theatre_selection").empty();
            window.location.reload();
        });
    });

    // Deleting a Theatre
    $("#delete_theatre").click(function() {

        var theatre_id = $("#theatre_id_entry").text();
        var theatre_delete_post = $("#theatre_delete_post").val();

        if (theatre_id == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            t_id: theatre_id,
            theatre_delete_post: theatre_delete_post
        }, function(data, status) {
            if (data == 1) {
                alert("Theatre deleted successfully.");
            } else {
                alert("Unsuccessful delete.");
            }
            window.location.reload();
        });
    });

    // Displaying movie data
    $("#movie_selection").change(function() {
        var movie_selection = $("#movie_selection");
        $('#movie_id').prop('readonly', false);
        $('#movie_id').prop("placeholder", "Movie ID: " + movie_selection.val());
        $('#movie_id').prop('readonly', true);
        $('#movie_update_post').val(movie_selection.val());
    });

    // Loading movie data
    $("#get_movie_data_btn").click(function() {

        var movie_id = $("#movie_selection").val();
        var get_movie_data = $("#get_movie_data").val();

        $.get("../../common/submit_admin_forms.php", {
            m_id: movie_id,
            get_movie_data: get_movie_data
        }, function(data, status) {
            data = JSON.parse(data);
            $("#movie_title").val(data[0]);
            $("#movie_genre").val(data[1]);
            $("#movie_about").val(data[2]);
            alert("Select new movie cover!");
        });
    });

    // Deleting a Movie
    $("#delete_movie").click(function() {

        var movie_id = $("#movie_id_entry").text();
        var movie_delete_post = $("#movie_delete_post").val();

        if (movie_id == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            m_id: movie_id,
            movie_delete_post: movie_delete_post
        }, function(data, status) {
            if (data == 1) {
                alert("Movie deleted successfully.");
            } else {
                alert("Unsuccessful delete.");
            }
            window.location.reload();
        });
    });

    // Adding a movie showTime
    $("#add_showtime").click(function() {
        var showtime_movie_id = $("#showtime_movie").val();
        var showtime = $("#showtime").val();
        var showdate_start = $("#showdate_start").val();
        var showdate_end = $("#showdate_end").val();
        var showtime_theatre = $("#showtime_theatre").val();
        var showtime_post = $("#showtime_post").val()

        if (showtime_movie_id == "" || showtime == "" || showdate_start == "" || showdate_end == "" || showtime_theatre == "") {
            alert("empty");
            return;
        }

        // Check if date in past
        var start_date = new Date(showdate_start);
        var end_date = new Date(showdate_end);

        if (start_date.getTime() > end_date.getTime()) {
            alert("Showing date ends before it start.");
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            showtime_movie_id: showtime_movie_id,
            showtime: showtime,
            showdate_start: showdate_start,
            showdate_end: showdate_end,
            showtime_theatre: showtime_theatre,
            showtime_post: showtime_post
        }, function(data, status) {
            if (data == 1) {
                alert("Showtime added successfully.");
            } else {
                alert("Unsuccessful submission.");
            }

            $('#add_showtime_form').each(function() {
                this.reset();
            });
        });
    });

    // Displaying a movie showTime
    $("#showtime_selection").change(function() {
        var showtime_selection = $("#showtime_selection");
        $('#showtime_id').prop('readonly', false);
        $('#showtime_id').prop("placeholder", "Showtime ID: " + showtime_selection.val());
        $('#showtime_id').prop('readonly', true);
        $('#showtime_update_post').val(showtime_selection.val());
    });

    // Loading a movie showTime
    $("#get_showtime_data_btn").click(function() {

        var showtime_id = $("#showtime_selection").val();
        var get_showtime_data = $("#get_showtime_data").val();

        $.get("../../common/submit_admin_forms.php", {
            s_id: showtime_id,
            get_showtime_data: get_showtime_data
        }, function(data, status) {
            data = JSON.parse(data);
            $("#showtime_movie").val(data[0]);
            $("#showtime").val(data[1]);
            var start_date = new Date(data[2]);
            var start_date_day = ("0" + start_date.getDate()).slice(-2);
            var start_date_month = ("0" + (start_date.getMonth() + 1)).slice(-2);
            var end_date = new Date(data[3]);
            var end_date_day = ("0" + end_date.getDate()).slice(-2);
            var end_date_month = ("0" + (end_date.getMonth() + 1)).slice(-2);
            $("#showdate_start").val(start_date.getFullYear() + "-" + start_date_month + "-" + start_date_day);
            $("#showdate_end").val(end_date.getFullYear() + "-" + end_date_month + "-" + end_date_day);
            $("#showtime_theatre").val(data[4]);
        });
    });

    // Updating a movie showTime
    $("#update_showtime").click(function() {
        var showtime_movie_id = $("#showtime_movie").val();
        var showtime = $("#showtime").val();
        var showdate_start = $("#showdate_start").val();
        var showdate_end = $("#showdate_end").val();
        var showtime_theatre = $("#showtime_theatre").val();
        var showtime_update_post = $("#showtime_update_post").val()

        if (showtime_movie_id == "" || showtime == "" || showdate_start == "" || showdate_end == "" || showtime_theatre == "") {
            alert("empty");
            return;
        }

        // Check if date in past
        var start_date = new Date(showdate_start);
        var end_date = new Date(showdate_end);

        if (start_date.getTime() > end_date.getTime()) {
            alert("Showing date ends before it start.");
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            showtime_movie_id: showtime_movie_id,
            showtime: showtime,
            showdate_start: showdate_start,
            showdate_end: showdate_end,
            showtime_theatre: showtime_theatre,
            showtime_update_post: showtime_update_post
        }, function(data, status) {
            if (data == 1) {
                alert("Showtime updated successfully.");
            } else {
                alert("Unsuccessful update.");
            }

            $('#update_showtime_form').each(function() {
                this.reset();
            });
            $("#showtime_id").empty();
            $("#showtime_selection").empty();
            window.location.reload();
        });
    });

    // Deleting a Theatre
    $("#delete_showtime").click(function() {

        var showtime_id = $("#showtime_id_entry").text();
        var showtime_delete_post = $("#showtime_delete_post").val();

        if (showtime_id == "") {
            return;
        }

        $.post("../../common/submit_admin_forms.php", {
            s_id: showtime_id,
            showtime_delete_post: showtime_delete_post
        }, function(data, status) {

            if (data == 1) {
                alert("Showtime deleted successfully.");
            } else {
                alert("Unsuccessful delete.");
            }
            window.location.reload();
        });
    });
});