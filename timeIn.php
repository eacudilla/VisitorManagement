

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
  <link href="fontawesome/css/all.css" rel="stylesheet"> 

  <script defer src="fontawesome/js/all.js"></script> <!--load all styles -->
  <script src="lodash.js"></script>
  


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="queryVisitor()">
  <main>
    <div class="container text-center" >
      <h1 class="p-3 mb-2 bg-info text-white">
       <div> <img src="sec.gif" width="40" height="auto"></i> Visitor Management Software</div>
        <div class="btn-group">
          <button class="btn buttonMenu" id="addNew" onclick="window.location.href='addNew.php'">Add Visitor</button>
          <button class="btn buttonMenu" id="timeIn" style="font-weight: bold;">Time In</button>
          <button class="btn buttonMenu" id="timeOut" onclick="window.location.href='timeOut.php'">Time Out</button>
          <button class="btn buttonMenu" id="report" onclick="window.location.href='report.php'">Reports</button>
          <button class="btn buttonMenu" name="logout" value="Logout"onclick="window.location.href='logout.php'" >Log Out</button>
        </div>
  
      </h1>

      



      <div class="row d-flex justify-content-center">
           
            
                <form class="w-35" style="width: 75%" >
                  <input type="text" id="search" name="search" class="form-control" autocomplete="off" placeholder="Search: Name or Company" oninput="queryVisitor()" />
                 
                 </form>
                </div>

         



    </div>      

            <div id="myModal" class="modal">
            <span class="close" >&times;</span>
            <img class="modal-content" id="imgModal">
            <div id="caption"></div>
            </div>





      <div class="d-flex table-data">
        <table class="table table-striped ">
          <thead>
            <tr>
              <th scope="col" style="width: 5%">ID</th>
              <th scope="col" style="width: 5%">Photo</th>
              <th scope="col" style="width: 25%">Name</th>
              <th scope="col" style="width: 20%">Company</th>
              <th scope="col" style="width: 35%">Purpose</th>
              <th scope="col" style="width: 10%">Action</th>
             
            </tr>
          </thead>
          <tbody id="tbody">
            

          </tbody>
        </table>
      </div>
      <div id="notfound"></div>
    
  </main>



  <script>
   



      function queryVisitor() {
           
          var jsearch = document.getElementById("search").value;

                  $.ajax({ 

                    url: "queryIn.php",
                    method: "post", 
                    
                  //  async: false,

                    data: {'search': jsearch},

                  }).done(function( data ) { 

                    var result= $.parseJSON(data); 

                    
                    var string='';

                

                    $.each( result, function( key, value ) { 
                      
                        string += '<tr  id = \"tr'+ value['idVisitor'] + '\"> <td class=\"align-middle\">' +  value['idVisitor'] + '</td><td class=\"align-middle\">' 
                                + '<img src=\" ' + value['imagePath'] 
                                + '\" id = \"img' + value['idVisitor'] + '\" onclick=imgModal(this.id) class = \"myImg\ img-thumbnail\" alt=\"No Photo for this user\" style=\"width:50px; height:auto;\">'  
                                + '</td> <td class=\"align-middle\">'+_.startCase(value['fname']) 

                            + " " + _.startCase(value['lname']) + '</td> <td class=\"align-middle\">'+value['company'] 
                            + '</td> <td> <textarea class =\"form-control col-sm-12\" id = \"purpose' + value['idVisitor'] + '\"   name = \"purpose' 
                            + value['idVisitor'] + ' style="margin: 0;   box-sizing: border-box;" width: 100%;  rows=\"2\" ></textarea></td> <td class=\"align-middle\">' 
                            
                            
                            
                            
                            + '<input type=\"button\"  class=\"fas fa-plus-circle fa-2x \" style=\"color: #5bc0de;\"  id = \"add' + value['idVisitor'] + '\" value = \"Add\" onclick=addEntry(this.id) />' + '</td> </tr>'; 
                            }); 


                                        string += '</table>'; 

                                      $("#tbody").html(string); 
                                  }); 



   }          

  



   function addEntry(addVisitor){
   var visitorNum = addVisitor.substr(3);
   var purposeV = "purpose" + visitorNum;
   var trRemove = "tr" + visitorNum;
   var purposeVisitor = document.getElementById(purposeV).value;
   let status = "in";



        if(purposeVisitor !== ''){
                $.ajax({
                             url: 'timeInDB.php',
                             type: 'post',
                             enctype: 'multipart/form-data',
                        // processData: false,  // Important!
                             //   contentType: false,
                                 cache: false,                        
                               timeout: 600000,
                               async: false,
                                                                            
                                  data: {          
                                                                                                                    
                                         'purpose': purposeVisitor,
                                         'idVisitor': visitorNum,
                                         'status' : status
                                               
                                },
                                    success: function(response){
                                    alert(response);
                                  // window.location.href = 
                                  $('#' + trRemove).remove();
                                                                                            
                                      }
                            })
        } else {

            alert ("Purpose field empty!");
        }


}







var modal = document.getElementById("myModal");
var modalImg = document.getElementById("imgModal");


function imgModal(imgVisitor){
   
var imgSrc = document.getElementById(imgVisitor).src
  
        modal.style.display = "block";
        modalImg.src = imgSrc;
   
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