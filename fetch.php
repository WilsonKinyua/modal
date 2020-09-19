
  <?php  include "config.php";

 if(isset($_POST["user_id"]))  
 {  
      $query = "SELECT * FROM users WHERE id = '".$_POST["user_id"]."'";  
      $result = mysqli_query($connection, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>