function reactivateDepartment()
{
  var deptid = $("#deptid").val();
  var deptname = $("#old_deptname").val();

  $.post("department_reactivate.php",
    {
      departmentid: deptid,
      departmentname: deptname
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
              $("#reactivate").hide();
              $("#statusLabel").hide();
            }
          }
        }
      };
      xhr.open("get", "department_reactivate.php", true);
      xhr.send();
    }
  );
}
