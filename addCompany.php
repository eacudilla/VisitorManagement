

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

<body >
  <main>
    <div class="container text-center" >
      <h1 class="p-3 mb-2 bg-info text-white">
      <div><img src="logo.gif" width="40" height="auto"></i> Visitor Management Software</div>
        <div class="btn-group">
          <button class="btn buttonMenu" id="addNew" onclick="window.location.href='addNew.php'">Add Visitor</button>
           <button class="btn buttonMenu" id="addComp" style="font-weight: bold;">Add Company</button> 
          <button class="btn buttonMenu" id="timeIn" onclick="window.location.href='timeIn.php'">Time In</button>
          <button class="btn buttonMenu" id="timeOut" onclick="window.location.href='timeOut.php'">Time Out</button>
          <button class="btn buttonMenu" id="report" onclick="window.location.href='report.php'">Reports</button>
          <button class="btn buttonMenu" name="logout" value="Logout"onclick="window.location.href='logout.php' ">Log Out</button>
        </div>
  
      </h1>

      



      <div class="row d-flex justify-content-center">
           
              <div class=" col-8" >
                <form class="w-35" style="width: 75%" >
                  <input type="text" id="compName" name="compName" class="form-control" autocomplete="off" placeholder="Company Name" />
                  <input type="text" id="compAddress" name="compAddress" class="form-control" autocomplete="off" placeholder="Company Address" />
                
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
                    <button type = "button" class="btn btn-info btn-sm" id="btn-submit" name="btn-submit" value="Submit" onclick = "submitCompReg()">Submit</button>
                    <button type = "button" class="btn btn-info btn-sm" name="reset" value="Reset">Reset</button>

                   
              
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
              <th scope="col">NO</th>
              <th scope="col">Company</th>
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
  <script src="/js/addNew.js"></script>


  <script>
   

            







      function queryComp() {
                  // $(function(){ 
                          

                      $.ajax({ 

                        url: "queryComp.php",
                        method: "get", 
                        
                      //  async: false,
                        /** 
                        data: {'s_fname': s_fname,
                               's_lname': s_lname,
                               's_company': s_company
                        
                              }, */

                      }).done(function( data ) { 

                        var result= $.parseJSON(data); 

                        
                        var string='';
                
                      
                        $.each( result, function( key, value ) { 
                          
                            string += '<tr> <td>' +  value['id_comp'] + '</td> <td>'+_.startCase(value['comp_name']) 

                                + " " + _.startCase(value['lname']) + '</td> <td>'+ _.startCase(value['comp_address']) + '</td> <td>' + value['comp_number'] + '</td> <td>' 
                                + _.startCase(value['comp_type']) + '</td> </tr>'; 
                                }); 

     
                            string += '</table>'; 

                          $("tbody").html(string); 
                      }); 
                  // }); 
                //}); 
         






   }          








</script>





</body>

</html>