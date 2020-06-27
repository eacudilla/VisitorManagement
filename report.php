

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
 
  <script src="lodash.js"></script>
  <script src="./js/report.js" type="module"></script>
  


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
          <button class="btn buttonMenu" id="timeOut"onclick="window.location.href='timeOut.php'" >Time Out</button>
          <button class="btn buttonMenu" id="report" style="font-weight: bold;" >Reports</button>
          <button class="btn buttonMenu" name="logout" value="Logout"onclick="window.location.href='logout.php' ">Log Out</button>
        </div>
  
      </h1>

      



      <div class="row d-flex justify-content-center">
           
            
                <form class="w-35" style="width: 75%" >
                  <input type="hidden" id="search" name="search" class="form-control" autocomplete="off" placeholder="Search: Name or Company" oninput="queryVisitor() " />
                       <div class="input-group  d-flex justify-content-center" >
                        <div class="input-group-prepend">
                             <div class="input-group-text"  style = "background:none; border:none; ">Show: </div>
                              <select id="pageRow" class="input-group-text" name="page"  style = "background: none; border: none; font-weight: bold;" onchange="queryVisitor()">
                                  <option value="10">10</option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                              </select>
                              <div class="input-group-text"  style = "background:none; border:none; ">entries </div>
                             <div class="input-group-text"  style = "background:none; border:none; ">Start Date</div>
                             <input type="date"  class="form-control" id="startDate" name="startDate"  >
                             <div class="input-group-text"  style = "background:none; border:none;">End Date</div>
                            <input type="date"  class="form-control" id="endDate" name="endDate" >
                            </div> 
                            </div>
                    </div>         
                          
                </form>
                         
          
         



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
              <th scope="col" style="width: 9%">Time Out</th>
              
             
            </tr>
          </thead>
          <tbody id="tbody">
            
          </tbody>
        </table>
      </div>

    <div> <input type="text"  class="form-control" id="inputTest" name="inputTest" > </div>



      <div id="notfound"></div>
    
  </main>



  <script>
   
   
var jsearch = document.getElementById("search").value;
var pageNumber = 1;
var pageLast = 1;


 function queryVisitor() {
           
          let pageRow = document.getElementById("pageRow").value;
           
          getLast();

                  $.ajax({ 

                    url: "queryReport.php",
                    method: "post", 
                    
                  //  async: false,

                    data: {
                      
                          'search': jsearch,
                          'pageRow': pageRow,
                          'pageNumber': pageNumber
                    
                    
                    
                    },

                  }).done(function( data ) { 

                    var result= $.parseJSON(data); 

                    
                    var string='';

                

                    $.each( result, function( key, value ) { 
                      
                        string += '<tr> <td class=\"align-middle\">' +  value['idVisitor'] + '</td><td class=\"align-middle\">' 
                                + '<img src=\" ' + value['imagePath'] 
                                + '\" id = \"img' + value['idVisitor'] + '\" onclick=imgModal(this.id) class = \"myImg\ img-thumbnail\" alt=\"No Photo for this user\" style=\"width:50px; height:auto;\">'  
                                + '</td> <td class=\"align-middle\">'+_.startCase(value['fname']) 

                            + " " + _.startCase(value['lname']) + '</td> <td class=\"align-middle\">'+value['company'] 
                            + '</td> <td class = \"d-flex flex-row\"> ' + value['purpose'] +
                            
                            
                               '</td> <td class=\"align-middle\" >' 
                            
                            
                            + value['time_in']  + '</td> <td>'+ value['time_out'] + '</td> </tr>'; 
                            }); 

                                        string += '</table>'; 
  
                                     
                                      $("#tbody").html(string);

                                   
                                      document.getElementById("inputTest").setAttribute("value", pageLast);


                                  }); 

               

   }          


function getLast(){
    
    let pageRow = document.getElementById("pageRow").value;
   

    
    $.ajax({ 

        url: "queryLast.php",
        method: "post", 
        
        async: false,

        data: {
          
              'search': jsearch,
              'pageRow': pageRow,
              
        },

      }).done(function( data ) { 

        pageLast = data;

   

                 }); 




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