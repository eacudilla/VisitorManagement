<?php
include('config.php');

//$output ='';
//$print ='';

//if(isset($_POST['search'])){
//    $searchq = $_POST['search'];
   // $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
   $result_array = array();
  

   //if (!empty($search)){
    $sql = "SELECT * FROM company ORDER BY id_comp ASC";
    //$query = mysqli_query($db,"SELECT * FROM visitor WHERE fname LIKE '%$searchq%' OR fname LIKE '%$searchq%' OR company LIKE '%$searchq%'");
  // } //else {$sql = "SELECT  imagePath, idVisitor, fname, lname, company FROM visitor ";}
    
   $result = $db->query($sql);
   /* If there are results from database push to result array */
   
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           array_push($result_array, $row);
       }
   }
   /* send a JSON encded array to client */
   echo json_encode($result_array);
   
   $db->close();

?>
