
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration</title>
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
    <?php include("header.php"); ?>
    <div class="login-form">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
        <div class="form-group">
          <label class="form-text" for="exampleInputEmail1"> Name</label>
          <input
            type="name"
            name="name"
            class="form-control"
            id="name"
            placeholder="Enter Name"
            
          />
        </div>

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
            
          />
        </div>

        <p style="margin-top: 10px; color: white">
          Have an account? <a href="login.php">Login</a>
        </p>

        <button type="submit" class="btn btn-primary form-btn">Register</button>
      </form>
    </div>

    <div class="popup-con">
      <div class="popup" id="popup">
        <img src="tick.png" />
        <h2>Successfull</h2>
        <p>User has successfully registerd!</p>
        <button type="button" onclick="closePopup('/login')">Go to Login</button>
        <button type="button" onclick="closePopup()">Cancel</button>
      </div>
    </div>

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
    "></script>

    <script>
      let popup = document.getElementById("popup");


      document
        .getElementById("myRegisterForm")
        .addEventListener("submit", function (event) {
          event.preventDefault(); // Prevent the default form submission

          console.log('comes')
          // Using direct access to form elements
          // const name = document.getElementById("name").value;
          // const email = document.getElementById("email").value;
          // const password = document.getElementById("password").value;
          // localStorage.setItem("name", name);
          // localStorage.setItem("email", email);
          // document.getElementById("customerName").innerText = name;
          // document.getElementById("myForm").reset();
          // popup.classList.add("open-popup");
        });

      function closePopup(path) {
        popup.classList.remove("open-popup");

        if(path){
          redirectTo(path);
        }
       
      }
      function redirectTo(path) {
        let current_url = window.location.href;
        let current_url_split = current_url.split("/");
        let removed_url = current_url_split.pop();
        let redirect_url = current_url_split.join("/") + path;
        window.location.href = redirect_url;
      }

      function checkLoginOrNot() {
        let name = localStorage.getItem("name");
        if (name) {
          redirectTo();
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // SQL query to insert data into the 'users' table
$sql = "INSERT INTO users (name, email,password) VALUES ('$name', '$email','$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
      echo    '<script>
        
                  alert("User has succssfully registered.You can login now using register email & password");
                  window.location.href = "login.php";
              </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    

}
?>

