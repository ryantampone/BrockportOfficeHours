function formattedJSON (str)
{
  var newStr = str.split("\n");
  return newStr;
}

function updateFaculty()
{
  var facName = $("#FacultyName").val();
  if (facName != "")
  {
  $.post("officehours_lookup_facultyName_change.php",
    {
      facultyName: facName
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
            else
            {
              $("#netid").empty();
              $("#netid").append("<option value='" + "" + "'>" + "Select One" + "</option>");
              //alert("No faculty members found.");
            }
          }
        }
      };
      xhr.open("get", "officehours_lookup_facultyName_change.php", true);
      xhr.send();
    });
  }
  else
  {
    $("#netid").empty();
    $("#netid").append("<option value='" + "" + "'>" + "Select One" + "</option>");
  }

}

function process_query(j)
{
  // str is formatted to split the responseText input in individual entries
  // from the database and put into an array
  var str = formattedJSON(j);

  // empty the Faculty Name drop down list before populating it with data retrieved
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
