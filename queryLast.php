<?php
include('config.php');


   
   $result_array = array();
   $searchq = $_POST['search'];
   $pageRow = $_POST['pageRow'];




$sql = "SELECT ve.idEntry, ve.idVisitor, v.imagePath, v.fname, v.lname, v.contact, v.company, ve.purpose, ve.time_in, ve.time_out
FROM visitorEntry AS ve INNER JOIN visitor as v ON ve.idVisitor = v.idVisitor WHERE (v.fname LIKE '%$searchq%' OR v.fname LIKE '%$searchq%'
OR v.company LIKE '%$searchq%') AND ve.time_out IS NOT NULL ORDER BY ve.time_in ASC";


$pageResult = $db->query($sql);
$totalRow = $pageResult->num_rows;
$last = ceil($totalRow/$pageRow);


   echo $last;
  

   $db->close();

?>
