


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