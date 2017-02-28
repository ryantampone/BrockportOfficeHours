function updateFaculty()
{
  var dept = $("#deptcode").val();
  alert(dept);
  $.ajax({
    type: "POST",
    url: "course_add_process.php",
    success: function(result)
    {
      $("#status").html(result);
    }

    //data: {text:$(this).val()}
  });

  /*$.post("course_add_process.php", { selected_dept: dept }, function(data)
  {
    alert(data);
  });*/

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
