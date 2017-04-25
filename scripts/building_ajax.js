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

            $("#buildingLabel").show();
            $("#newName").show();
            $("#submit").show();

          }
        }
      };
      xhr.open("get", "course_department_change.php", true);
      xhr.send();
    });

}
