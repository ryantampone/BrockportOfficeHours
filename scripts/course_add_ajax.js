function formattedJSON (str)
{
  var newStr = str.split("\n");
  return newStr;
}

function updateFaculty()
{
  var dept = $("#deptcode").val();
  $.post("course_add_process.php",
    {
      deptcode: dept
    },
    function(data)
    {
      // newobject to communicate with course_add_process.php
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function()
      {
        // if request is done
        if(xhr.readyState === 4)
        {
          // if request is successful
          if(xhr.status === 200)
          {
            // Reached here if successful
            // data = {"NetID:","fjones","FirstName:","Faculty" ...}
            if (data != "")
              process_query(data);
            else alert("There are no faculty members saved in this department.");
          }
        }
      };
      xhr.open("get", "course_add_process.php", true);
      xhr.send();
    });

}

function process_query(j)
{
  // str is formatted to split the responseText input in individual entries
  // from the database and put into an array
  var str = formattedJSON(j);

  //empty the Faculty Name drop down list before populating it with data retrieved
  $("#netid").empty();

  // For each entry retrieved from database
  for (var i = 0; i < str.length-1; i++)
  {
    // Get each key,value pair in entry i
    var nextProf = JSON.parse(str[i]);
    var netid = nextProf.NetID;
    var fn = nextProf.FirstName;
    var ln = nextProf.LastName;

    // add the option to the Faculty Name drop down list
    $("#netid").append("<option value='" + netid + "'>" + ln + ", " + fn + "</option>");
  }
}
  /*$.ajax({
    url: "course_add_process.php",
    data: "",
    dataType: "json",
    success: function(data)
    {
      alert(data);
      //$("#status").html("Ajax successful: Department = " + dept);
    }

    //data: {text:$(this).val()}
  });

*/
  /*
    Options to add to dropdown:
    Option # = text to show in drop down
    value# = value of the corresponding option

  var options = {
    "Option 1": "value1",
    "Option 2": "value2",
    "Option 3": "value3"
  }

  //$("<option></option>").attr("value", "smitra").text("Mitra, Sandeep");
  var $netid = $("#netid");
  $netid.empty();
  $.each(options, function(key, value)
  {
    $netid.append($("<option></option>").attr("value", value).text(key));
  });
  */
  //document.write(dept);
  /*
  $.ajax({
    url: "course_add_ajax.php",
    type: "POST",
    data: dept,
    dataType: 'JSON',
    success: function(data){
      alert("success" + data);
    }
  })
  .done(function(data) {
    alert("success" + data);
  })
  .fail(function(data) {
    alert("failure" + data);
  })
  */
