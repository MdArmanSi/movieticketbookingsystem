
<header>
      <div class="nav-sec">
        <div class="logo">
            <a style="color: white; text-decoration: none; font-weight: bold;" href="index.php">Cholo Dekhi</a>
        </div>
        <div class="nav-search">
          <input type="text" placeholder="Search Movies" />
          <button>Search</button>
        </div>
        <div class="location">
          <p>Chattagram</p>
          <i class="fa-solid fa-location-dot"></i>
        </div>


      <?php


// Check if the session variable is set (assuming 'user_id' as an example)
if (isset($_SESSION['user'])) {
    // The user is logged in; display content for logged-in users
?>
    <div class="location">
          <a style="color:#fff" href="history.php">History</a>
        </div>

        <div id="user" class="user">
          <p>welcome, <?php echo $_SESSION['user'];?></p>
        </div>

        <div id="logout" class="logout">
             <a style="color:#fff"  href="logout.php">Logout</a>

        </div>
<?php
} else {
    // The user is not logged in; display content for non-logged-in users
?>
  
        <div id="login" class="login">
        <a style="color:#fff; text-decoration:none"  href="login.php">Login</a>
        </div>
<?php
}
?>

    
      </div>


    </header>