function submitCompReg() {



  var jcompName = document.getElementById("compName").value;
  var jcompAddress = document.getElementById("compAddress").value;
  var jcompContact = document.getElementById("compContact").value;
  var jcompType = document.getElementById("compType").value;


  var j1 = document.getElementById("compName");
  var j2 = document.getElementById("compAddress");
  var j3 = document.getElementById("compType");



  var isValid = true;

  var j = [j1, j2, j3];

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
