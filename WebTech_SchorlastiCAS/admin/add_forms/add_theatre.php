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
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Add a New Theatre</title>
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
        <h2>New Theatre</h2>
        <h1>Add a new theatre!</h1>
    
        <form action="" id="add_theatre_form">
            <div class="fields">
                <input type="hidden" name="theatre_post" id="theatre_post" value="empty" />
                <span>
                    <input name="theatre_name" id="theatre_name" placeholder="Theatre name" type="text" required />
                </span>
                <br />
                <span>
                    <select name="theatre_cinema" id="theatre_cinema" required>
                        <option value="" selected="selected">Select a cinema</option>
                        <?php
                            require_once("../../db/cinema.php");
                            // Generate all cinemas
                            // Make <option> text the cinema_name, and cinema_id the the value
                            $cinema = new Cinema();
                            $result = $cinema->all_cinema();
                            
                            if ($result->num_rows > 0) {

                                while($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row['Cinema_ID'].'">'.$row['Cinema_Name'].'</option>';
                                }

                            }
                        ?>
                    </select>
                </span>
            </div>
            <div class="submit">
                <input class="submit" value="Submit" type="button" id="add_theatre" />
            </div>
        </form>
    </div>
</body>
</html>