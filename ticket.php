<?php
    session_start();
     include("connection.php");
     include("historyList.php");
    if(!$_SESSION['user']){
       header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticket Booking</title>
    <!--Google Fonts and Icons-->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="header.css" />
    <link rel="stylesheet" href="ticket.css" />
    <link rel="stylesheet" href="footer.css" />
  </head>
  <body>
  <?php include("header.php") ?>
    <div class="center">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
      <div class="tickets">
        <div class="ticket-selector">
          <div class="head">
            <div class="title">
              <p>Movie:<?php echo $_SESSION['movie'];  ?></p>

            </div>
          </div>
          <div class="seats">
            <div class="status">
              <div class="item">Available</div>
              <div class="item">Booked</div>
            </div>
           

            <div class="all-seats">

            <?php
           




            $seatValues = [];

            if(is_array($fetchData)){
              $seatValues =  array_map(function ($row) {
                return $row['seat'];
                }, $fetchData);
            }
            
           


            for ($i = 1; $i <= 30; $i++) {

              $seatId = "T" . $i;

              $selectedMovieDate = "";   // all selected movies date from database     
              $selectedMovie = "";   // all selected movies from database    
              $date =  $_SESSION['date']; // current name
              $movie =  $_SESSION['movie']; // current selected movie


              if(is_array($fetchData)){
                foreach ($fetchData as $row) {
                  $id = $row['seat'];
          
        
                  // Check if the seat matches the searched seat
                  if ($seatId === $id) {
                      // If matched, extract movieDate and movie
                      $selectedMovieDate = $row['movieDate'];  
                      $selectedMovie = $row['movie'];        
                      break;
                  }
              }
              }

          


              $isDateSame = ($selectedMovieDate==$date);
              $isMovieSame = ($selectedMovie==$movie);

                $isChecked = in_array($seatId, $seatValues) && $isDateSame && $isMovieSame ? 'checked disabled' : ''; // Check if the seat is booked
                echo "<input value=\"$seatId\" type=\"checkbox\" name=\"tickets[]\" id=\"$seatId\" $isChecked />";
                echo "<label for=\"$seatId\" class=\"seat " . (in_array($seatId, $seatValues) && $isDateSame  && $isMovieSame  ? "booked" : "") . "\"></label>";
            }
            ?>

            </div>

            <div>
             
            </div>

          

 
          
        </div>
        <div class="price">
          <div class="total">
            <span> <span class="count">0</span> Tickets </span>
            <div class="amount">0</div>
          </div>
          <button type="submit" class="btn">Book</button>
        </div>
      </div>
     </form>
    </div>

    <?php include("footer.php") ?>

    <script>
      let seats = document.querySelector(".all-seats");
      

      let tickets = seats.querySelectorAll("input");
      tickets.forEach((ticket) => {
        ticket.addEventListener("change", () => {
          let amount = document.querySelector(".amount").innerHTML;
          let count = document.querySelector(".count").innerHTML;
          amount = Number(amount);
          count = Number(count);

          if (ticket.checked) {
            count += 1;
            amount += 200;
          } else {
            count -= 1;
            amount -= 200;
          }
          document.querySelector(".amount").innerHTML = amount;
          document.querySelector(".count").innerHTML = count;
        });
      });

      let popup = document.getElementById("popup");
      function openPopup() {
        popup.classList.add("open-popup");
      }
      function closePopup() {
        popup.classList.remove("open-popup");
      }

    </script>
  </body>
</html>


<?php

 include("connection.php");
// Check if the form is submitted


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the selected checkboxes as an array
  $selectedCheckboxes = isset($_POST['tickets']) ? $_POST['tickets'] : [];

  // Output the selected checkboxes
      $movie = $_SESSION['movie'];
      $date =  $_SESSION['date'];
      $user = $_SESSION['user'];
     // $movie = isset($_POST['movie']) ? $_POST['movie'] : '';

   
      if (isset($_POST['tickets'])) {
        // Retrieve the selected checkboxes as an array
        $selectedCheckboxes = $_POST['tickets'];

        // Process the selected checkboxes
        foreach ($selectedCheckboxes as $checkbox) {
            $sql = "INSERT INTO tickets (movie,movieDate,seat,user) VALUES ('$movie','$date','$checkbox','$user')";
            if ($conn->query($sql) !== TRUE) {
              echo "<script>
                  alert('Something went wrong');
              </script>";
          }
        }
    } 


      // Close the database connection

      echo '<script>
              alert("Ticket has successfully booked")
           </script>';
 




}
?>
