<?php
include('config.php');

//$output ='';
//$print ='';

//if(isset($_POST['search'])){
//    $searchq = $_POST['search'];
   // $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
   $result_array = array();
   $s_fname=$_POST['s_fname'];
   $s_lname=$_POST['s_lname'];
   $s_company=$_POST['s_company'];
    $search1 = '';
    $search2 = '';
    $search3 = '';



    
   if( $s_fname){

            $search1 = "%".$s_fname."%";

   } 
   
   if( $s_lname){

    $search2 = "%".$s_lname."%";

    }
    if( $s_company){

        $search3 = "%".$s_company."%";

     }


   //if (!empty($search)){
    $sql = "SELECT * FROM visitor WHERE (fname LIKE '$search1' OR lname LIKE '$search2' OR company LIKE '$search3') AND statusVisitor = 'out' ORDER BY dateAdded DESC";
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
