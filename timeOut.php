

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
  <link href="./fontawesome/css/all.css" rel="stylesheet"> 
 
  <script defer src="fontawesome/js/all.js"></script> <!--load all styles -->
  <script src="lodash.js"></script>
  


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="queryVisitor()">
  <main>
    <div class="container text-center" >
      <h1 class="p-3 mb-2 bg-info text-white">
        <div><img src="logo.gif" width="40" height="auto"></i> Visitor Management Software</div>
        <div class="btn-group">
          <button class="btn buttonMenu" id="addNew" onclick="window.location.href='addNew.php'">Add Visitor</button>
          <button class="btn buttonMenu" id="timeIn" onclick="window.location.href='timeIn.php'">Time In</button>
          <button class="btn buttonMenu" id="timeOut" style="font-weight: bold;">Time Out</button>
          <button class="btn buttonMenu" id="report" onclick="window.location.href='report.php'">Reports</button>
          <button class="btn buttonMenu" name="logout" value="Logout"onclick="window.location.href='logout.php' ">Log Out</button>
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
              <th scope="col" style="width: 3%">Log#</th>
              <th scope="col" style="width: 3%">Photo</th>
              <th scope="col" style="width: 25%">Name</th>
              <th scope="col" style="width: 20%">Company</th>
              <th scope="col" style="width: 30%">Purpose</th>
              <th scope="col" style="width: 10%">Time In</th>
              <th scope="col" style="width: 9%">Action</th>
              
             
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

                    url: "queryOut.php",
                    method: "post", 
                    
                  //  async: false,

                    data: {'search': jsearch},

                  }).done(function( data ) { 

                    var result= $.parseJSON(data); 

                    
                    var string='';

                

                    $.each( result, function( key, value ) { 
                      
                        string += '<tr> <td class=\"align-middle\">' +  value['idVisitor'] + '</td><td class=\"align-middle\">' 
                                + '<img src=\" ' + value['imagePath'] 
                                + '\" id = \"img' + value['idVisitor'] + '\" onclick=imgModal(this.id) class = \"myImg\ img-thumbnail\" alt=\"No Photo for this user\" style=\"width:50px; height:auto;\">'  
                                + '</td> <td class=\"align-middle\">'+_.startCase(value['fname']) 

                            + " " + _.startCase(value['lname']) + '</td> <td class=\"align-middle\">'+value['company'] 
                            + '</td> <td class = \"d-flex flex-row\">   <textarea readonly class =\"form-control col-sm-11\" id = \"purpose' + value['idEntry'] + '\"   name = \"purpose' 
                            + value['idVisitor'] + ' style="margin: 0;   box-sizing: border-box;" width: 100%;  rows=\"2\" >' + value['purpose']
                            
                            
                            +'</textarea> <input type=\"hidden\" id=\"check'+ value['idEntry'] +'\" style=\"padding:0; margin:auto; border-style:none;\"  value =\" ✅\"  onclick=checkEdit(this.id)  >   </td> <td class=\"align-middle\" >' 
                            
                            
                            + value['time_in'] +'</td> <td class=\"align-middle\">' 

                            + '<input type=\"button\"  class=\"far fa-edit  \" style=\"margin-right: 15px; color: black;\"  id = \"edit' + value['idEntry'] + '\" value = \"Edit\" onclick=editEntry(this.id) />'
                            + '<input type=\"button\" class=\"far fa-trash-alt   \" style=\"margin-right: 15px; color: red;\"  id = \"delete' + value['idEntry'] + '\" value = \"Edit\" onclick=deleteEntry(this.id) />'
                            + '<input type=\"button\"  class=\"fas fa-sign-out-alt   \" style=\"color: #5bc0de;\"  id = \"out' + value['idEntry'] + '\" value = \"Add\" onclick=outExit(this.id) />' + '</td> </tr>'; 
                            }); 


                                        string += '</table>'; 

                                      $("#tbody").html(string); 
                                  }); 



   }          


   function editEntry(editEntry){
    var idEntry = editEntry.substr(4);
    var editText = "purpose" + idEntry;
    let check_button = "check" + idEntry;
    let edit_button = "edit" +  idEntry;
    let delete_button = "delete" +  idEntry;
    let out_button = "out" +  idEntry;

    
    document.getElementById(editText).removeAttribute('readonly');
    document.getElementById(check_button).setAttribute("type", "button");
    document.getElementById(check_button).style.visibility = 'visible';
    document.getElementById(edit_button).onclick = null;
    document.getElementById(delete_button).onclick = null;
    document.getElementById(out_button).setAttribute("onclick", "this.disabled=true;");

    
   }


 function checkEdit(checkEdit ){
    let check = checkEdit.substr(5)
    let check_purpose = "purpose" + check;
    let check_button = "check" + check;
    let edit_button = "edit" + check;
    let delete_button = "delete" + check;
    let out_button = "out" + check;

    document.getElementById(check_purpose).readOnly = true;
    document.getElementById(check_button).style.visibility = 'hidden';
    document.getElementById(edit_button).setAttribute("onclick", "editEntry(this.id)");
    document.getElementById(delete_button).setAttribute("onclick", "deleteEntry(this.id)");
    document.getElementById(out_button).setAttribute("onclick", "outExit(this.id)");


    let purposeVisitor = document.getElementById(check_purpose).value;
    let status = "update"


       
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
                                         'idEntry': check,
                                         'status' : status
                                               
                                },
                                    success: function(response){
                                    alert(response);
                                  // window.location.href = 
                                                                
                                      }
                            })
        









   }


   function deleteEntry(delEntry){
    let delID = delEntry.substr(6);
    let status = "delete"

    if (confirm("Are you sure to delete this Entry?")) {
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
                                                                                                                    
                                         'idEntry': delID,
                                         'status' : status
                                               
                                },
                                    success: function(response){
                                    alert(response);
                                  // window.location.href = 
                                   queryVisitor();
                                                                                            
                                      }
                            })
    
         }

   }
  





   function outExit(outExit){
   let idEntry = outExit.substr(3);
   let purposeV = "purpose" + idEntry;
   let purposeVisitor = document.getElementById(purposeV).value;
   let status = "out"


       
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
                                         'idEntry': idEntry,
                                         'status' : status
                                               
                                },
                                    success: function(response){
                                    alert(response);
                                  // window.location.href = 
                                   queryVisitor();
                                                                                            
                                      }
                            })
        


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