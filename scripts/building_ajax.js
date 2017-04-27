function renameBuilding()
{
  var bID = $("#buildingID").val();
  $.post("building_rename.php",
    {
      buildingid: bID
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

            if(data != "")
            {
              var str = data.split("\n");

              for(var i = 0; i < str.length-1; i++)
              {
                var nextBuilding = JSON.parse(str[i]);
                var bID = nextBuilding.BuildingID;
                var bName = nextBuilding.Name;
                var bStatus = nextBuilding.Status;

                if(bStatus == "Inactive")
                {
                  $("#statusLabel").show();
                  $("#reactivateButton").show();
                }
                else
                {
                  $("#statusLabel").hide();
                  $("#reactivateButton").hide();
                }
              }

            }

            $("#buildingLabel").show();
            $("#newName").show();
            $("#submit").show();
          }
        }
      };
      xhr.open("get", "building_rename.php", true);
      xhr.send();
    });

}
