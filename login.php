<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
 if(isset($_SESSION['user'])){
  header('Location: index.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="header.css" />
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="footer.css" />
  </head>
  <body>
  <?php include("header.php") ?>
    <div class="login-form">
    <h6  id="invalidMsg">Invalid email or password!<h6/>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >


        <div class="form-group">
          <label class="form-text" for="exampleInputEmail1"
            >Email address</label
          >
          <input
            type="email"
            name="email"
            class="form-control"
            id="email"
            aria-describedby="emailHelp"
            placeholder="Enter email"
            required
          />
          <small class="form-text" id="emailHelp" class="form-text text-muted"
            >We'll never share your email with anyone else.</small
          >
        </div>
        <div class="form-group">
          <label class="form-text" for="exampleInputPassword1">Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="Password"
            required
          />
        </div>

        <p style="margin-top: 10px; color: white">
          Need an account? <a id="signUpBtn" href="register.php">Sign Up</a>
        </p>

        <button type="submit" class="btn btn-primary form-btn">Login</button>
      </form>
    </div>

    <div class="popup-con">
      <div class="popup" id="popup">
        <img src="tick.png" />
        <h2>Congratulations<span id="customerName"></span></h2>
        <p>Your have successfully logged In!</p>
        <button type="button" onclick="closePopup()">Go to Home page</button>
      </div>
    </div>
    <?php include("footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
    "></script>

    <script>

      // form handling
      document
        .getElementById("myForm")
        .addEventListener("submit", function (event) {
          event.preventDefault(); // Prevent the default form submission

          // Using direct access to form elements
          const name = document.getElementById("name").value;
          const email = document.getElementById("email").value;
          const password = document.getElementById("password").value;

          localStorage.setItem("name", name);
          localStorage.setItem("email", email);

          document.getElementById("customerName").innerText = name;

          document.getElementById("myForm").reset();

          popup.classList.add("open-popup");
        });

      // signupBtn

      document
        .getElementById("signUpBtn")
        .addEventListener("submit", function (event) {
          event.preventDefault(); // Prevent the default form submission
          // Using direct access to form elements
          redirectTo("/register.php");
        });

      function closePopup() {
        popup.classList.remove("open-popup");
        redirectTo("/index.php");
      }

      function redirectTo(page) {
        let current_url = window.location.href;
        let current_url_split = current_url.split("/");
        let removed_url = current_url_split.pop();
        let redirect_url = current_url_split.join("/") + page;
        window.location.href = redirect_url;
      }

      function checkLoginOrNot() {
        let name = localStorage.getItem("name");
        if (name) {
          redirectTo("/index.php");
        }
      }
      checkLoginOrNot();
    </script>
  </body>
</html>


<?php

 include("connection.php");


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

     // Check if the entered credentials are valid
     $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
     $result = $conn->query($sql);
     

     if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      
             $name = $user['name'];
             $_SESSION["user"] = $name;

  
             echo '<script>
                let name = "<?php echo $name; ?>";
                document.getElementById("customerName").innerHTML = "<span><?php echo $name; ?></span>";
                let popup = document.getElementById("popup");
                popup.classList.add("open-popup");
              </script>';
         // You can redirect the user to another page or perform other actions upon successful login
     } else {

      echo   '<script>
                document.getElementById("invalidMsg").style.display = "block";

                setTimeout(function() {
                  document.getElementById("invalidMsg").style.display = "hide";
              }, 2000); // Hide after 5 seconds
             </script>';
      }
 

}
?>