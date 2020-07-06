<?php
include('config.php');
   
   $compSearch=$_POST['compSearch'];

   $result_array = array();
  

   //if (!empty($search)){
    $sql = "SELECT * FROM company WHERE comp_name like '%$compSearch%' ORDER BY id_comp ASC";
  
    
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
