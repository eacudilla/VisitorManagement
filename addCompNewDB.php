

<?php
// Include config file
include('session.php');
//session_start();
include('config.php');



$compName = $compAddress = $compContact = $compType = "";


 



//for data dot sql
  
  $compName = $_POST['compName'];
  $compAddress = $_POST['compAddress'];
  $compContact = $_POST['compContact'];
  $compType = $_POST['compType'];


  
    $sql = "INSERT INTO company (comp_name, comp_address, comp_number, comp_type) VALUES (?,?,?,?)";
  
    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters

       // rename($imagePath,$newImagePath);
        mysqli_stmt_bind_param($stmt, "ssss", $paramCompName, $paramCompAddress,$paramCompContact,$paramCompType);
        
        // Set parameters
        $paramCompName = $compName;
        $paramCompAddress = $compAddress;
        $paramCompContact = $compContact;
        $paramCompType = $compType;
      



        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
           
          //  $result = "Added Succesfully";
          
            $result = 'Successfully added '.$compName.'!';
           

        } else{

            $result = "Something went wrong. Please try again later.";

        }

        // Close statement
        //mysqli_stmt_close($stmt);
        $stmt -> close();
        print_r($result);
    
    }
    
    else {
        
        $result = "Submit Fail!";
        print_r($result);
    }

    //mysqli_stmt_close($db);
    $db -> close();

//} else {printr()

                    
        

?>

