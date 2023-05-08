$(document).ready(function() {
    // Add event listeners for user interaction with X3D models
    $("#coke_can").click(function() {
      // Handle user click on Coke can model
    });
  
    $("#coke_bottle").click(function() {
      // Handle user click on Coke bottle model
    });
  
    // Make AJAX request to update content div
    $.ajax({
      url: "data.php",
      type: "POST",
      dataType: "json",
      data: { id: 1 },
      success: function(data) {
        $("#content").html(data.content);
      },
      error: function(xhr, status, error) {
        console.log("Error: " + error);
      }
    });
  });