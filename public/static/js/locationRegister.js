$(document).ready(function () {
    $.ajax({
    url: "/get-estadosRegister",
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#estados").empty();
      $("#estados").append('<option value="1">Seleccione un Estado</option>');
      $.each(data, function (key, value) {
        $("#estados").append(
          '<option value="' + value.id + '">' + value.nombre + "</option>"
        );
      });
    },
  });
  $("#estados").on("change", function () {
    var estadoId = $(this).val();
    if (estadoId) {
      $.ajax({
        url: "/get-ciudades-by-estado/" + estadoId,
        type: "GET",
        dataType: "json",
        success: function (data) {
          $("#ciudades").empty();
          $.each(data, function (key, value) {
            $("#ciudades").append(
              '<option value="' + value.id + '">' + value.nombre + "</option>"
            );
          });
        },
      });
    } else {
      $("#ciudades").empty();
    }
  });

  $("#ciudades").on("change", function () {
    var ciudadId = $(this).val();
    if (ciudadId) {
      $.ajax({
        url: "/get-comisarias-by-ciudad/" + ciudadId,
        type: "GET",
        dataType: "json",
        success: function (data) {
          $("#comisarias").empty();
          $.each(data, function (key, value) {
            $("#comisarias").append(
              '<option value="' + value.id + '">' + value.nombre + "</option>"
            );
          });
        },
      });
    } else {
      $("#comisarias").empty();
    }
  });
});  