

<?php

include('session.php');


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Visitor Monitoring Software</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
  <link rel="stylesheet" href="./style.css" />
  <link rel="stylesheet" href="operation.css">
  <script src="lodash.js"></script>
  


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="startStreaming()">
  <main>
    <div class="container text-center" >
      <h1 class="p-3 mb-2 bg-info text-white">
      <div><img src="logo.gif" width="40" height="auto"></i> Visitor Management Software</div>
        <div class="btn-group">
          <button class="btn buttonMenu" id="addNew" onclick="window.location.href='addNew.php'">Add Visitor</button>
         <!-- <button class="btn buttonMenu" id="addComp" style="font-weight: bold;">Add Company</button> -->
          <button class="btn buttonMenu" id="timeIn" onclick="window.location.href='timeIn.php'">Time In</button>
          <button class="btn buttonMenu" id="timeOut" onclick="window.location.href='timeOut.php'">Time Out</button>
          <button class="btn buttonMenu" id="report" onclick="window.location.href='report.php'">Reports</button>
          <button class="btn buttonMenu" name="logout" value="Logout"onclick="window.location.href='logout.php' ">Log Out</button>
        </div>
  
      </h1>

      



      <div class="row d-flex justify-content-center">
           
              <div class=" col-8" >
                <form class="w-35" style="width: 75%" >
                  <input type="text" id="compName" name="compName" class="form-control" autocomplete="off" placeholder="Company Name" oninput="queryVisitor()" />
                  <input type="text" id="compAddress" name="compAddress" class="form-control" autocomplete="off" placeholder="Company Address" oninput="queryVisitor()" />
                
                  <input type="text" id="compContact" name="contact" placeholder="Contact #" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); 
                                        this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                                    onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" autocomplete="off" />
                                                    <div class="col">
                    <select id="compType" name="compType" class="form-control m-0" >
                        <option value="" disabled selected>Type</option>
                        <option value="private">Private</option>
                        <option value="government">Government</option>
                    </select>
                    </div>
                  
                  
                  
                  
                  <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm" id="btn-submit" name="btn-submit" value="Submit">Submit</button>
                    <button type="button" class="btn btn-info btn-sm" name="reset" value="Reset">Reset</button>

                   
              
                  </div>
                 </form>
                </div>

             

        


      </div>

    </div>      

            <div id="myModal" class="modal">
            <span class="close" >&times;</span>
            <img class="modal-content" id="imgModal">
            <div id="caption"></div>
            </div>






 
      <!--  Table -->
      <div class="d-flex table-data">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Company/th>
              <th scope="col">Address</th>
              <th scope="col">Contact #</th>
              <th scope="col">Type</th>
            </tr>
          </thead>
          <tbody id="tbody">
         


          </tbody>
        </table>
      </div>
      <div id="notfound"></div>
    
  </main>



  <script>
   
  
                              var btnStart = document.getElementById( "btn-start" );
                               // var btnStop = document.getElementById( "btn-stop" );
                                var btnCapture = document.getElementById( "btn-capture" );
                                var btnSubmitReg=document.getElementById( "btn-submit" );
                           

                                // The stream & capture
                                var stream = document.getElementById( "stream" );
                                var capture = document.getElementById( "capture" );
                                var snapshot = document.getElementById( "snapshot" );

                                // The video stream
                                var cameraStream = null;
                                var ctx = null;
                                var img = null;
                                var image_data = null;

                                // Attach listeners
                                btnStart.addEventListener( "click", startStreaming );
                               // btnStop.addEventListener( "click", stopStreaming );
                                btnCapture.addEventListener( "click", captureSnapshot );
                                btnSubmitReg.addEventListener( "click", submitReg );
                                ctx = capture.getContext( '2d' );

                                       
                               

                                // Start Streaming
                                function startStreaming() {

                                    if (cameraStream !== null){
                                    ctx.clearRect(0, 0, capture.width, capture.height);
                                    } else {
                                    
                                    var mediaSupport = 'mediaDevices' in navigator;

                                    if( mediaSupport && null == cameraStream ) {

                                        navigator.mediaDevices.getUserMedia( { video: true } )
                                        .then( function( mediaStream ) {

                                            cameraStream = mediaStream;

                                            stream.srcObject = mediaStream;

                                            stream.play();
                                        })
                                        .catch( function( err ) {

                                            console.log( "Unable to access camera: " + err );
                                        });
                                    }
                                    else {

                                        alert( 'Your browser does not support media devices.' );

                                        return;
                                    }
                                    }
                                }

                                // Stop Streaming
                                function stopStreaming() {

                                    if( null != cameraStream ) {

                                        var track = cameraStream.getTracks()[ 0 ];

                                        track.stop();
                                        stream.load();

                                        cameraStream = null;
                                    }
                                }

                                function captureSnapshot() {

                                    if( null != cameraStream ) {

                                      
                                        //x = document.getElementById("demo")

                                      //  document.getElementById("capture").style.zIndex = "1";
                                         
                                         img = new Image();

                                        ctx.drawImage( stream, 0, 0, capture.width, capture.height );

                                        
                                       
                                    
                                    
                                    
                                             image_data = capture.toDataURL("image/png");
                                      // $.post("saveImg.php", {cam_image: image_data});
                                      
                                      //document.getElementById("capture").style.visibility = "visible"
                                       // var user = rand;
                                               // var userStr = JSON.stringify(user);
                                              
                                                }

                                       

                                    }




                                    //for submit button
                                    function submitReg() {



                                             var jfname = document.getElementById("fname").value;
                                            var jlname = document.getElementById("lname").value;
                                            var jage = document.getElementById("age").value;
                                            var jgender = document.getElementById("gender").value;
                                            var jcontact = document.getElementById("contact").value;
                                            var jcompany = document.getElementById("company").value;
                                            var jcompAddress = document.getElementById("compAddress").value;


                                            var j1 = document.getElementById("fname");
                                            var j2 = document.getElementById("lname");
                                            var j3 = document.getElementById("age");
                                            var j4 = document.getElementById("gender");
                                            var j5 = document.getElementById("contact");
                                            var j6 = document.getElementById("company");
                                            var j7 = document.getElementById("compAddress");


                                          
                                                var isValid = true;

                                                var j = [j1,j2,j3,j4,j6,j7];

                                                for(var i=0; i < j.length; i++){
                                                    if(j[i].value.length < 1){
                                                    isValid = false;
                                                    }
                                                }

                                                if(isValid){
                                                   // document.getElementById('ss-form').submit();
                                                   
                                                            if(image_data !== null){

                                                                $.ajax({
                                                                                url: 'newReg.php',
                                                                                type: 'post',
                                                                                enctype: 'multipart/form-data',
                                                                            // processData: false,  // Important!
                                                                            //   contentType: false,
                                                                                cache: false,                        
                                                                            timeout: 600000,
                                                                            async: false, 
                                                                                data: {          
                                                                                                                    
                                                                                        'fname': jfname,
                                                                                        'lname': jlname,
                                                                                        'age': jage,
                                                                                        'gender': jgender,
                                                                                        'contact': jcontact,
                                                                                        'company': jcompany,
                                                                                        'compAddress': jcompAddress,
                                                                                        'cam_image': image_data 
                                                                                    
                                                                                        },
                                                                                        success: function(response){
                                                                                            alert(response);
                                                                                            window.location.href = "addNew.php";
                                                                                            
                                                                                                }
                                                                                                }).error(function(){
                                                                                                    alert("somethings wrong");
                                                                                                })

                                                                                               
                                                                                            
                                                                        } else{
                                                                            alert('Please Capture Photo!');
                                                                        }
                                                        
                                                        }
                                                        else {
                                                            alert('Please fill all required fields');
                                                        }
                                                



            



                                    }
                                    







      function queryVisitor() {
                  // $(function(){ 
                        
                    //  $("#getusers").on('click', function(){ 
                        var s_fname = document.getElementById("fname").value;
                        var s_lname = document.getElementById("lname").value;
                        var s_company = document.getElementById("company").value;


        if (s_fname || s_lname || s_company) {                

                      $.ajax({ 

                        url: "queryDB.php",
                        method: "post", 
                        
                      //  async: false,

                        data: {'s_fname': s_fname,
                               's_lname': s_lname,
                               's_company': s_company
                        
                              },

                      }).done(function( data ) { 

                        var result= $.parseJSON(data); 

                        
                        var string='';
                
                      /* from result create a string of data and append to the div */
                      
                        $.each( result, function( key, value ) { 
                          
                            string += '<tr> <td>' +  value['idVisitor'] + '</td><td>' 
                                    + '<img src=\" ' + value['imagePath'] 
                                    + '\" id = \"img' + value['idVisitor'] + '\" onclick=imgModal(this.id) class = \"myImg\" alt=\"No Photo for this user\" style=\"width:40px; height:auto;\">'  
                                    + '</td> <td>'+_.startCase(value['fname']) 

                                + " " + _.startCase(value['lname']) + '</td> <td>'+ value['age'] + '</td> <td>' + value['gender'] + '</td> <td>' + value['contact'] 
                                + '</td> <td>' + value['company'] 
                                + '</td> <td>' + value['compAddress']  + '</td> </tr>'; 
                                }); 

     





                            string += '</table>'; 

                          $("tbody").html(string); 
                      }); 
                  // }); 
                //}); 
            } else {

                  string = "";
                  $("tbody").html(string); 

            }






   }          

  



var modal = document.getElementById("myModal");
var modalImg = document.getElementById("imgModal");


function imgModal(imgVisitor){
   
var imgSrc = document.getElementById(imgVisitor).src
  
   // var  = document.getElementById("youtubeimg").src
   // let img = imgModal;
   // alert (imgSrc);
        modal.style.display = "block";
        modalImg.src = imgSrc;
       // captionText.innerHTML = imgAlt;
   // captionText.innerHTML = imgSrc.alt;



}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}








</script>





</body>

</html>