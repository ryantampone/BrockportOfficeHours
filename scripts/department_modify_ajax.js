function formattedJSON (str)
{
  var newStr = str.split("\n");
  return newStr;
}

function updateDeptForm()
{
  var deptID = $("#deptID").val();
  $.post("course_department_change.php",
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
            else
            {
              $("#netid").empty();
              alert("There are no faculty members saved in this department.");
            }
          }
        }
      };
      xhr.open("get", "course_department_change.php", true);
      xhr.send();
    });

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

function checkCount(cbox)
{
  var numChecked = 0;
  var sun = document.getElementById("sundayBox");
  var mon = document.getElementById("mondayBox");
  var tue = document.getElementById("tuesdayBox");
  var wed = document.getElementById("wednesdayBox");
  var thu = document.getElementById("thursdayBox");
  var fri = document.getElementById("fridayBox");
  var sat = document.getElementById("saturdayBox");

  if (sun.checked === true)
  {
    numChecked++;
  }
  if (mon.checked === true)
  {
    numChecked++;
  }
  if (tue.checked === true)
  {
    numChecked++;
  }
  if (wed.checked === true)
  {
    numChecked++;
  }
  if (thu.checked === true)
  {
    numChecked++;
  }
  if (fri.checked === true)
  {
    numChecked++;
  }
  if (sat.checked === true)
  {
    numChecked++;
  }

  if(numChecked > 3)
  {
    cbox.checked = false;
    alert("You can only select 3 days per course.");
  }
}
