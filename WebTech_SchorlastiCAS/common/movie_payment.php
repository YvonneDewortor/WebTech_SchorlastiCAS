<div id="wrapper">
    <div id="container">

        <div id="info">
        
            <?php

                // Handling POST Requests
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                    // Adding a Cinema
                    if (isset($_POST["movie_id"])) {
                        require_once("../db/movie.php");
                        require_once("../db/movietime.php");

                        $movie = new Movie();
                        $result = $movie->get_movie($_POST["movie_id"]);
                        if ($result->num_rows > 0){
                            $row = $result->fetch_assoc();
                        }

                        echo '<div id="img-div"><img id="movie" src="'.$row["Movie_Cover"].'" alt="Movie img"/> </div>';
                        
                        echo '<div id="showtime_select_div">';

                        echo '<div id="showing_times"> <h2>'.$row["Movie_Title"].'</h2> </div>';

                        echo '<p>Showing Times</p>';

                        //Show Cinema options and change show_time options accordingly
                        echo '<select name="showtimes" id="showtimes" required>'.
                             '<option value="" selected="selected">Select a showtime</option>';
                        $showtime = new MovieTime();
                        $result = $showtime->all_movie_times_by_movie($_POST["movie_id"]);
                            
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['Movie_Time_ID'].'">'.$row['Movie_Time'].' : '.explode (" ", $row['ShowingDate_Start'])[0].' - '.explode (" ", $row['ShowingDate_End'])[0].'</option>';
                            }
                        }

                        echo '</select>';

                        echo '</div>';
                    }
                }
            ?>

        </div>

        <div id="payment">

            <form id="checkout">

                <input class="card" id="visa" type="button" name="card" value="">
                <input class="card" id="mastercard" type="button" name="card" value="">

                <label>Credit Card Number</label>
                <input id="cardnumber" type=text pattern="[0-9]{13,16}" name="cardnumber"  placeholder="0123-4567-8901-2345" required>

                <label>Card Holder</label>
                <input id="cardholder" type="text" name="name" maxlength="50" placeholder="Cardholder" required>

                <label>Expiration Date</label>
                <label id="cvc-label">CVC/CVV</label>
                <div id="left">
                    <select name="month" id="month" onchange="" size="1">
                    <option value="00">MM</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    </select>
                    <p>/</p>
                    <select name="year" id="year" onchange="" size="1">
                    <option value="00">YY</option>
                    <option value="01">16</option>
                    <option value="02">17</option>
                    <option value="03">18</option>
                    <option value="04">19</option>
                    <option value="05">20</option>
                    <option value="06">21</option>
                    <option value="07">22</option>
                    <option value="08">23</option>
                    <option value="09">24</option>
                    <option value="10">25</option>
                    </select>
                </div>


                <input id="cvc" type="text" placeholder="Cvc/Cvv" maxlength="3" required />

                <input class="btn" type="button" name="purchase" value="Purchase">
            </form>
        </div>
    </div>
</div>