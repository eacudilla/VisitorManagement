

<?php
// Include config file
//include('session.php');
//session_start();
include('config.php');



$purpose = $idVisitor = $status = $idEntry = $delete =  $idVisitorUpdate = "";
//$_SESSION["imgPath"] = "";

//if(isset($_POST['submit'])) 



//for data dot sql
  
  
  $status =  $_POST['status'];
  $dateTime = date("Y-m-d H:i:s");
  

  
    if( $status === 'in'){

        $idVisitor = $_POST['idVisitor'];
        $purpose = $_POST['purpose'];
        $temp = $_POST['temp'];


    $sql = "INSERT INTO visitorEntry (  idVisitor, purpose, statusEntry, time_in,temp) VALUES (?,?,?,?,?)";
    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters

       // rename($imagePath,$newImagePath);
        

        mysqli_stmt_bind_param($stmt, "isssd", $paramidVisitor, $parampurpose, $paramstatus,$paramdateTime,$paramtemp);
        
        // Set parameters
        $parampurpose = $purpose;
        $paramidVisitor = $idVisitor;
        $paramstatus = $status;
        $paramdateTime = $dateTime;
        $paramtemp = $temp;



        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
           
          //  $result = "Added Succesfully";
          
            $result = 'Time in Successful!';
           
        } else{
            $result = "Something went wrong. Please try again later.";
        }

        // Close statement
        //mysqli_stmt_close($stmt);
        $stmt -> close();
        print_r($result);
    
    }
    
    $db -> close();
}
//} else {printr()
    if( $status === 'out'){

        $idEntry = $_POST['idEntry'];
        $purpose = $_POST['purpose'];



        //$sql = "UPDATE visitorEntry SET purpose = ?, statusEntry = ?, time_out = ?  WHERE idEntry = ?";
        $sql = "UPDATE visitorEntry, visitor SET visitorEntry.purpose = ?, visitorEntry.statusEntry = ?, visitorEntry.time_out = ?, visitor.statusVisitor = ?  
        WHERE visitorEntry.idVisitor = visitor.idVisitor AND idEntry = ?";




        if($stmt = mysqli_prepare($db, $sql)){
            // Bind variables to the prepared statement as parameters
    
           // rename($imagePath,$newImagePath);
            
    
            mysqli_stmt_bind_param($stmt, "ssssi",  $parampurpose, $paramstatus, $paramdateTime, $paramstatusV, $paramidEntry);
            
            // Set parameters
            $parampurpose = $purpose;
            $paramidEntry = $idEntry;
            $paramstatus = $status;
            $paramstatusV = $status;
            $paramdateTime = $dateTime;
    
    
    
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
               
              //  $result = "Added Succesfully";
              
                $result = 'Time out successful!';
               
            } else{
                $result = "Something went wrong. Please try again later.";
            }
    
            // Close statement
            $stmt -> close();
            print_r($result);
        
        }
        
        $db -> close();
    }
    







 if( $status === 'update'){

        $idEntry = $_POST['idEntry'];
        $purpose = $_POST['purpose'];

         $sql = "UPDATE visitorEntry SET purpose = ?
                   WHERE  idEntry = ?";



                    if($stmt = mysqli_prepare($db, $sql)){
                        // Bind variables to the prepared statement as parameters

                    // rename($imagePath,$newImagePath);
                        

                        mysqli_stmt_bind_param($stmt, "si",  $parampurpose, $paramidEntry);
                        
                        // Set parameters
                        $parampurpose = $purpose;
                        $paramidEntry = $idEntry;
                    

                                    // Attempt to execute the prepared statement
                                    if(mysqli_stmt_execute($stmt)){
                                        // Redirect to login page
                                    
                                    //  $result = "Added Succesfully";
                                    
                                        $result = 'Edit Successful';
                                    
                                    } else{
                                        $result = "Something went wrong. Please try again later.";
                                    }

                                    // Close statement
                                    $stmt -> close();
                                    print_r($result);

                                }

                                $db -> close();


        }



        


 if( $status === 'delete'){

    $idEntry = $_POST['idEntry'];
    $idVisitorUpdate = $_POST['idVisitorUpdate'];

    $sql = "DELETE FROM visitorEntry WHERE  idEntry = ?";


 
      
     if($stmt = mysqli_prepare($db, $sql)){
         // Bind variables to the prepared statement as parameters

     // rename($imagePath,$newImagePath);
         

         mysqli_stmt_bind_param($stmt, "i",  $paramidEntry);
         
         // Set parameters
        
         $paramidEntry = $idEntry;
     

                     // Attempt to execute the prepared statement
                     if(mysqli_stmt_execute($stmt)){
                         // Redirect to login page
                     
                     //  $result = "Added Succesfully";
                     
                        
                         $delete='yes';
                     } else{
                         $result = "Something went wrong deleting it. Please try again later.";
                     }

                     // Close statement
                    
                 

                 }

              
                
              if( $delete === 'yes'){


                     //$sql = "UPDATE visitorEntry SET purpose = ?, statusEntry = ?, time_out = ?  WHERE idEntry = ?";
                     $sqlUpdate = "UPDATE visitor SET statusVisitor = ? WHERE  idVisitor = ?";
                    
                                    if($stmtu = mysqli_prepare($db, $sqlUpdate)){
                                        // Bind variables to the prepared statement as parameters
                                
                                    // rename($imagePath,$newImagePath);
                                    
                                
                                        mysqli_stmt_bind_param($stmtu, "si", $paramstatus, $paramidVisitor);
                                        
                                        // Set parameters
                                      
                                        $paramstatus = 'out' ;
                                        $paramidVisitor = $idVisitorUpdate;
                                
                                
                                
                                        // Attempt to execute the prepared statement
                                        if(mysqli_stmt_execute($stmtu)){
                                            // Redirect to login page
                                        
                                        //  $result = "Added Succesfully";
                                        
                                            $result = 'Successfully Deleted';
                                        
                                        } else{
                                            $result = "Something went wrong. Please try again later.";
                                        }
                                
                                        // Close statement
                                        $stmt -> close();
                                        print_r($result);
                                    
                                    }
                                   
                             $db -> close();
                             $delete =  $paramstatus = "";



                 }
                


 }

                    
        

?>

