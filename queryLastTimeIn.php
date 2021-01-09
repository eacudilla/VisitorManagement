<?php
include('config.php');


   

$result_array = array();
   $searchq=$_POST['search'];
   $pageRow = $_POST['pageRow'];

    $sql = "SELECT * FROM visitor WHERE (fname LIKE '%$searchq%' OR lname LIKE '%$searchq%' OR company LIKE '%$searchq%') AND statusVisitor = 'out' ORDER BY dateAdded DESC";

$pageResult = $db->query($sql);
$totalRow = $pageResult->num_rows;
$last = ceil($totalRow/$pageRow);


   echo $last;
  

   $db->close();

?>
