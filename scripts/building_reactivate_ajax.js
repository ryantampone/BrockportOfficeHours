function reactivateBuilding()
{
  var bID = $("#buildingID").val();

  $.post("building_reactivate.php",
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
            // data = {"NetID:","fjones","FirstName:","Faculty" ...}
            if (data != "")
            {
              alert(data);
              $("#reactivateButton").hide();
              $("#statusLabel").hide();
            }
          }
        }
      };
      xhr.open("get", "building_reactivate.php", true);
      xhr.send();
    }
  );
}
