

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

  <script src="/js/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
  <link href="/fontawesome/css/all.css" rel="stylesheet"> 
  <script defer src="/fontawesome/js/all.js"></script> 
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/operation.css">
  <script src="/js/lodash.js"></script>
  <script src="/js/addNew.js"></script>
  
  
  
</head>


<body onload="startStreaming()">
  <main>
    <div class="container text-center" >
      <h1 class="p-3 mb-2 bg-info text-white">
      <div><img src="logo.gif" width="40" height="auto"></i> Visitor Management Software</div>
        <div class="btn-group">
          <button class="btn buttonMenu" id="addNew" style="font-weight: bold;">Add Visitor</button>
        <!--  <button class="btn buttonMenu" id="addComp" onclick="window.location.href='addCompany.php'">Add Company</button> -->
          <button class="btn buttonMenu" id="timeIn" onclick="window.location.href='timeIn.php'">Time In</button>
          <button class="btn buttonMenu" id="timeOut" onclick="window.location.href='timeOut.php'">Time Out</button>
          <button class="btn buttonMenu" id="report" onclick="window.location.href='report.php'">Reports</button>
          <button class="btn buttonMenu" name="logout" value="Logout"onclick="window.location.href='logout.php' ">Log Out</button>
        </div>
  
      </h1>

      



      <div class="row d-flex justify-content-center">
           
              <div class=" col-8" >
                <form class="w-35" style="width: 75%" >
                  <input type="text" id="fname" name="fname" class="form-control" autocomplete="off" placeholder="First Name" oninput="queryVisitor()" />
                  <input type="text" id="lname" name="lname" class="form-control" autocomplete="off" placeholder="Last Name" oninput="queryVisitor()" />
                
                  <div class="row">
                    <div class="col">
                      <input type="text" id="age" name="age" placeholder="Age" autocomplete="off" name="age" class="form-control m-0"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); 
                                        this.value = this.value.replace(/(\..*)\./g, '$1');"  onKeyDown="if(this.value.length==2 && event.keyCode!=8) return false;"  />
                    </div>
                    <div class="col">
                      <select id="gender" name="gender" class="form-control m-0" >
                        <option value="" disabled selected>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    </div>
                  </div>
                  <input type="text" id="contact" name="contact" placeholder="Contact #" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); 
                                        this.value = this.value.replace(/(\..*)\./g, '$1');" 
                                                    onKeyDown="if(this.value.length==11 && event.keyCode!=8) return false;" autocomplete="off" />
                    <!--   
                  <select id="visType" name="visType" class="form-control m-0" >
                        <option value="" disabled selected>Visitor Type</option>
                        <option value="Contractor">Contractor</option>
                        <option value="Sales">Sales</option>
                        <option value="Female">Employee Relative</option>
                  </select> 
                        <div class="row">

                        <div class="col">  -->
                        <input type="text" id="company" name="company" class="form-control" autocomplete="off" placeholder="Company" oninput="queryVisitor()" />
                      <!--  </div>
                        <div class="col">   
                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Select</button> 
                        </div> 
                  </div> -->

                  <input type="text" id="compAddress" name="compAddress" class="form-control" autocomplete="off" placeholder="Company Address" />
   
                  <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm" id="btn-submit" name="btn-submit" value="Submit">Submit</button>
                    <button type="button" class="btn btn-info btn-sm" id="btn-capture" name="btn-capture">Capture</button>
                    <button type="button" class="btn btn-info btn-sm" name="reset" value="Reset">Reset</button>
                    <button type="button" class="btn btn-info btn-sm" id="btn-start" >Re-shot</button>
                   
              
                  </div>
                 </form>
                </div>

                <div class="col " style="display: flex; justify-content: flex-end;">


            
                        
                        
                            <canvas id="capture" width="480" height="360"; style=" position: absolute; z-Index: 1; margin: 0;" ></canvas>
                            <video id="stream" width="480" height="360" style = "position: absolute; margin: 0; "></video>
                         




                  
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
              <th scope="col">Photo</th>
              <th scope="col">Name</th>
              <th scope="col">Age</th>
              <th scope="col">Gender</th>
              <th scope="col">Contact #</th>
              <th scope="col">Company</th>
              <th scope="col">Company Address</th>
            </tr>
          </thead>
          <tbody id="tbody">



          </tbody>
        </table>
      </div>
      <div id="notfound"></div>
    


  </main>

 


<!-- Modal -->
<div class="modal fade" data-backdrop="false" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Company</th>
                    <th scope="col">Address</th>
                    <th scope="col">Type</th>
                    <th scope="col">Select</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                </tbody>
              </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




  <script>


$('#btn-modal').click(function () {
	$('#exampleModalLong').modal('show');
});


$('#closeModal').click(function () {
	$('#exampleModalLong').hide();
});
    

  
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
                                                                                                })
     
                                                                        } else{
                                                                            alert('Please Capture Photo!');
                                                                        }
                                                        
                                                        }
                                                        else {
                                                            alert('Please fill all required fields');
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