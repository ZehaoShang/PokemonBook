<!DOCTYPE html>
<html>
	<head>
		<!--Unicode-->
		<meta charset="utf-8">
		<title>Pocket Map</title>
        <!--Responsive get the browser width-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link href="css/main.css" rel="stylesheet" type="text/css" media="all" />
        <!--Java Script Part-->
        <!--jQuery-->
        <script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
        <!--main javaScript-->
        <script src="js/main.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
            if(isset($_GET["PokemonID"])){
                $PokemonID = $_GET["PokemonID"];
            }else{
                $PokemonID = "1";
            };
            $prev = $PokemonID - 1;
            $next = $PokemonID + 1;
            $url = "http://localhost/test/PocketMap/?PokemonID=";
            $prevUrl = $url.$prev;
            $nextUrl = $url.$next;

            require 'config.php';
            // $severname = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "pokemonDB";

            //Creat connection
            $connect = mysqli_connect($severname,$username,$password,$dbname);
            //Check
            if(!$connect){
                die("Connection failed:" .mysqli_connect_error());
            }else{
                echo"<p class='head'>Welcome to the Pokemon BOOK!</p>";
            };

            // QUERY1
            $query = "SELECT * FROM pokedex WHERE pokedex_number = $PokemonID";
            $result = mysqli_query($connect,$query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                echo '<div class="contaner">';
                    echo '<div class="img-box">';
                        echo '<img src="'.$row[14].'" class="pokemonImg"/>';
                        if ($PokemonID > 1 AND $PokemonID <151) {
                            echo '<a href="'.$prevUrl.'" class="PrevBTN" id="PrevBTN">Prev</a>';
                            echo '<a href="'.$nextUrl.'" class="NextBTN" id="NextBTN">Next</a>';
                        }
                        elseif ($PokemonID = 1) {
                            echo '<a href="'.$nextUrl.'" class="NextBTN"  id="NextBTN">Next</a>';
                        }
                        elseif ($PokemonID = 151) {
                            echo '<a href="'.$prevUrl.'" class="PrevBTN" id="PrevBTN">Prev</a>';
                        };
                    echo '</div>';
                        echo '<p class="pokemonTitle">ID:'.$row[0].'&nbsp;&nbsp;&nbsp;'.$row[1].'</p>';
                        echo '<p>Height: '.$row[10].'m/Weight: '.$row[11].'kg</p>';
                        if($row[9] == NULL){
                            echo '<p>Type: '.$row[8].'</p>';
                        }else{
                            echo '<p>Type: '.$row[8].' / '.$row[9].'</p>';
                        };
                        echo '<p>Moves: '.$row[2].'</p>';
                echo '</div>';
            }
            else {
                echo '<p style="margin-top:40px;">Sorry, something wrong with web serve.</p>';
            }
            mysqli_free_result($result);
            mysqli_close($connect);
		?>
        <?php 
            include 'footer.php'
        ?>


        <script>
          
        </script>
	</body>
</html>