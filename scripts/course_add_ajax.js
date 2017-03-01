function updateFaculty()
{
  var dept = $("#deptcode").val();
  /*var myData = $("#deptcode").serialize();
  alert(dept + "\n" + myData);*/

  $.post("course_add_process.php", { deptcode: dept }, function(data)
  {
    alert(data);
  });

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
}
