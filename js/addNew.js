


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

function submitCompReg() {



  var jcompName = document.getElementById("compName").value;
  var jcompAddress = document.getElementById("compAddress").value;
  var jcompContact = document.getElementById("compContact").value;
  var jcompType = document.getElementById("compType").value;


  var j1 = document.getElementById("compName");
  var j2 = document.getElementById("compAddress");
  var j3 = document.getElementById("compContact");
  var j4 = document.getElementById("compType");



  var isValid = true;

  var j = [j1, j2, j3, j4];

  for (var i = 0; i < j.length; i++) {
    if (j[i].value.length < 1) {
      isValid = false;
    }
  }

  if (isValid) {
    // document.getElementById('ss-form').submit();
    $.ajax({
      url: 'addCompNewDB.php',
      type: 'post',
      enctype: 'multipart/form-data',
      // processData: false,  // Important!
      //   contentType: false,
      cache: false,
      timeout: 600000,
      async: false,
      data: {
        'compName': jcompName,
        'compAddress': jcompAddress,
        'compContact': jcompContact,
        'compType': jcompType,
      },
      success: function (response) {
        alert(response);
        window.location.href = "addCompany.php";
      }
    });

  }
  else {
    alert('Please fill all required fields');
  }



}

