

<?php
// Include config file
include('session.php');
//session_start();
include('config.php');



$fname = $lname = $contact = $company = $result = "";
//$_SESSION["imgPath"] = "";

//if(isset($_POST['submit'])) 



//for data dot sql
  
  $fname= $_POST['fname'];
  $lname = $_POST['lname'];
  $contact = $_POST['contact'];
  $company = $_POST['company'];
  $date = date("Y-m-d H:i:s");
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $compAddress = $_POST['compAddress'];  
  $folderPath = "imageDB/";
  $img= $_POST['cam_image'];
  $stmt = null;
 // $uniqueName = $_SESSION["uniqueName"];
  
   /*
    $sql = "INSERT INTO visitor (fname, lname, contact, company) VALUES ('$fname','$lname','$contact','$company')";
    $result = "Added Succesfully";
*/
      //  if (isset($_POST['cam_image'])) {
          

          //$img=substr($imgData, strpos($imgData, ",")+1);
         
         
          //$image_parts = base64_decode($img);
          $image_parts = explode(";base64,", $img);
          $image_type_aux = explode("image/", $image_parts[0]);
          $image_type = $image_type_aux[1];

          $image_base64 = base64_decode($image_parts[1]);
          $fileName = uniqid() . '.png';

          $file = $folderPath . $lname ."-". $fileName;
         
          $imagePath = $file;
          
          file_put_contents($file, $image_base64);
 

        // print_r($fileName);
       // } 
    
    //$newImagePath = $folderPath . $fname . $lname . $uniqueName;

    $sql = "INSERT INTO visitor (fname, lname, contact, company, imagePath,dateAdded,age,gender,compAddress,statusVisitor) VALUES (?,?,?,?,?,?,?,?,?,?)";
  
    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters

       // rename($imagePath,$newImagePath);
        

        mysqli_stmt_bind_param($stmt, "ssssssssss", $paramfname, $paramlname,$paramcontact,$paramcompany, $paramimagePath ,$paramdate,$paramage, $paramgender,$paramcompAddress, $paramstatusVisitor);
        
        // Set parameters
        $paramfname = $fname;
        $paramlname = $lname;
        $paramcontact = $contact;
        $paramcompany = $company;
        $paramimagePath=  $imagePath;
        $paramdate=  $date;
        $paramage = $age;
        $paramgender = $gender;
        $paramcompAddress = $compAddress;
        $paramstatusVisitor ="out";



        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
           
          //  $result = "Added Succesfully";
          
            $result = 'Successfully added '.$fname.' '.$lname.'!';
           
           
        } else{
            $result = "Something went wrong. Please try again later.";
        }

        // Close statement
        //mysqli_stmt_close($stmt);
        $stmt -> close();
        print_r($result);
    
    }
    
    else {
        
        $result = "No Captured Photo";
        print_r($result);
    }

    //mysqli_stmt_close($db);
    $db -> close();

//} else {printr()

                    
        

?>

