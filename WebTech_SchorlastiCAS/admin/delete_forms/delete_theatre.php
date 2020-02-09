<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/submit_admin_forms.js"></script>
    <script type="text/javascript" src="../../js/autocomplete_search.js"></script>

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../../css/admin_forms.css"></link>
        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Delete - Theatre</title>
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
        <h2>Delete Theatre</h2>
        <h1>Remove a Theatre!</h1>
    
        <div class="tbl-container">
            <div class="centered-div">
                <form autocomplete="off" action="" class="search_form">
                    <input type="hidden" name="theatre_call" id="theatre_call"/>
                    <input type="search" name="theatre_search" id="theatre_search" placeholder="Movie Name">
                    <i class="fa fa-search"></i>
                </form>
            </div>
            <input name="theatre_id" id="theatre_id" placeholder="Theatre ID: " type="text" readonly />


            <ul class="responsive-table pagination">
                <li class="table-header">
                    <div class="col col-1"><b>ID</b></div>
                    <div class="col col-2"><b>Name</b></div>
                    <div class="col col-3"><b>Action</b></div>
                </li>
                <li class="table-row">
                    <input type="hidden" name="theatre_delete_post" id="theatre_delete_post" value="empty"/>
                    <div class="col col-1" id="theatre_id_entry">Null</div>
                    <div class="col col-2" id="theatre_name_entry">Null</div>
                    <div class="col col-3" id=""><button id="delete_theatre"><i class="fas fa-trash"></i></button></div>
                </li>
            </ul>
        </div>
    </div>

</body>
</html>