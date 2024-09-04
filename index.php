
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movie Booking site.</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="stylesheet" href="footer.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
  </head>

  <body>
     <?php include("header.php") ?>
    <div class="slide-sec">
      <div class="wrapper">
        <img src="slide01.jpg" alt="" />
        <img src="slise02.webp" alt="" />
        <img src="slide03.webp" alt="" />
        <img src="slide04.jpg" alt="" />
      </div>
    </div>

    <div class="recommended-movie">
      <h3>Now Showing</h3>
      <br />
      <div class="movie-poster">
        <img src="animal-poster.jpg" alt="" />
        <img src="mujib.webp" alt="" />
        <img src="wish-poster.jpg" alt="" />
      </div>
    </div>

    <div class="booking-sec">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
        <div class="select-movies">
          <h3>Book Movies Here</h3>

          <select name="movie" onchange="handleMovieName(this)" name="select-movies">
            <option value="">Select Movies</option>
            <option value="Animal" selected>Animal</option>
            <option value="Mujib">Mujib: The Making of Nation</option>
            <option value="Wish">Wish</option>
            <option value="Wonka">Wonka</option>
          </select>
        </div>
        <div class="select-date">
          <input
            onchange="handleDate(this)"
            type="date"
            name="date"
            placeholder="Select Date"
          />
        </div>
        <div class="book-button">
          <button type="submit" >Book Now</button>
        </div>
      </form>
    </div>

     <?php include("footer.php") ?>
  </body>

</html>

<?php

 include("connection.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $movie = $_POST["movie"];
    $date = $_POST["date"];

    $_SESSION['movie'] = $movie;
    $_SESSION['date'] = $date;

    if(isset($_SESSION['user'])){

      if($movie && $date){
        echo   '<script>
                  window.location.href = "ticket.php";
                </script>';
      }else{
        echo   '<script>
       alert("Please Select movie and  Date..")
      </script>';
      }
    }else{
      echo   '<script>
                 alert("Please login first..")
             </script>';
    }





}
?>