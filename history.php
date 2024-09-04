<?php
 session_start();
 include("connection.php");
 include("historyList.php");
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
    <link rel="stylesheet" href="history.css" />
    <link rel="stylesheet" href="footer.css" />
  </head>
  <body>

  <?php include("header.php"); ?>
  <div class="center " style="margin-bottom:20rem">

   <div>
    <h1>Movie Booking History</h1>
   <table>
  <tr>
    <th>Customer Name</th>
    <th>Movie Name</th>
    <th>Booked Date</th>
    <th>Booking Seat</th>
    <th>Action</th>
  </tr>

  <?php
      if(is_array($fetchData)){      
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $data['user']??''; ?></td>
      <td><?php echo $data['movie']??''; ?></td>
      <td><?php echo $data['movieDate']??''; ?></td>
      <td><?php echo $data['seat']??''; ?></td>
      <td>
        
      <button data-id='<?php echo $data['id'] ?>' onclick='deleteRow(this)'>Delete</button>

      </td>
     </tr>
     <?php
      }}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?> 

</table>
   </div>
  </div>
  <?php include("footer.php"); ?>
    <script>
    // JavaScript function to handle row deletion
   

 

     function deleteRow(button) {
      var id = button.getAttribute('data-id'); // Get the ID from the data-id attribute

        if (confirm('Are you sure you want to delete this row?')) {
            // Send an AJAX request or submit a form to delete.php
            // You can use fetch or XMLHttpRequest to send a request to delete.php with the ID
            // Here, we'll simply redirect to delete.php with the ID as a query parameter
            window.location.href = `delete.php?id=${id}`;
        }
    }



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


