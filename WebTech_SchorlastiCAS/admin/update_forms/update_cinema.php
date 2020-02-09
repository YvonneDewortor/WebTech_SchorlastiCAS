<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/submit_admin_forms.js"></script>
    
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../../css/admin_forms.css"></link>
    <title>Update Cinema</title>
</head>
<body>

    <div class="back">
        <button class="arrow left" onclick="window.location.href = '../';">
            <svg width="60px" height="80px" viewBox="0 0 50 80" xml:space="preserve">
            <polyline fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" points="
            45.63,75.8 0.375,38.087 45.63,0.375 "/>
            </svg>  
        </button>
    </div>

    <div class="container">
        <h2>Update Flicks</h2>
        <h1>Update a cinema!</h1>

        <div class="entry-selection" id="selection_div">
            <input type="hidden" name="get_cinema_data" id="get_cinema_data" value="empty" />
            <input name="cinema_id" id="cinema_id" placeholder="Cinema ID" type="text" readonly />
            <select name="cinema_selection" id="cinema_selection">
                <option value="" selected="selected">Select a Cinema</option>
                <?php
                    require_once("../../db/cinema.php");
                    $cinema = new Cinema();
                    $result = $cinema->all_cinema();

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['Cinema_ID'].'">'.$row['Cinema_Name'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <!-- Update data in form based on button click -->
        <div class="entry-selection-btn">
            <button id="get_cinema_data_btn">Get Cinema</button>
        </div>
    
        <form action="" method="POST" id="update_cinema_form">
            <div class="fields">
                <input type="hidden" name="cinema_update_post" id="cinema_update_post" value="empty" />
                <span>
                    <input name="cinema_name" id="cinema_name" placeholder="Cinema name" type="text" required />
                </span>
                <br />
                <span>
                    <input name="cinema_address" id="cinema_address" placeholder="Address" type="text" required />
                </span>
                <br />
                <span>
                    <input name="cinema_telephone" id="cinema_telephone" placeholder="Telephone" type="text" required />
                </span>
                <br />
                <span>
                    <input name="cinema_email" id="cinema_email" placeholder="Email" type="email" required />
                </span>
            </div>
            <div class="submit">
                <input class="submit" value="Submit" type="button" id="update_cinema" />
            </div>
        </form>
    </div>

</body>
</html>