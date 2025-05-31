$(document).ready(function () {
    $.ajax({
    url: "/get-estados",
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
//momentaneo
$(document).ready(function () {
    $.ajax({
    url: "/get-estados",
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#estadosCom").empty();
      $("#estadosCom").append('<option value="1">Seleccione un Estado</option>');
      $.each(data, function (key, value) {
        $("#estadosCom").append(
          '<option value="' + value.id + '">' + value.nombre + "</option>"
        );
      });
    },
  });
  $("#estadosCom").on("change", function () {
    var estadoId = $(this).val();
    if (estadoId) {
      $.ajax({
        url: "/get-ciudades-by-estado/" + estadoId,
        type: "GET",
        dataType: "json",
        success: function (data) {
          $("#ciudadesCom").empty();
          $.each(data, function (key, value) {
            $("#ciudadesCom").append(
              '<option value="' + value.id + '">' + value.nombre + "</option>"
            );
          });
        },
      });
    } else {
      $("#ciudadesCom").empty();
    }
  });

  $("#ciudadesCom").on("change", function () {
    var ciudadId = $(this).val();
    if (ciudadId) {
      $.ajax({
        url: "/get-comisarias-by-ciudad/" + ciudadId,
        type: "GET",
        dataType: "json",
        success: function (data) {
          $("#comisariasCom").empty();
          $.each(data, function (key, value) {
            $("#comisariasCom").append(
              '<option value="' + value.id + '">' + value.nombre + "</option>"
            );
          });
        },
      });
    } else {
      $("#comisariasCom").empty();
    }
  });
});  
$(document).ready(function () {
    $.ajax({
    url: "/get-estados",
    type: "GET",
    dataType: "json",
    success: function (data) {
      $("#estadosSub").empty();
      $("#estadosSub").append('<option value="1">Seleccione un Estado</option>');
      $.each(data, function (key, value) {
        $("#estadosSub").append(
          '<option value="' + value.id + '">' + value.nombre + "</option>"
        );
      });
    },
  });
  $("#estadosSub").on("change", function () {
    var estadoId = $(this).val();
    if (estadoId) {
      $.ajax({
        url: "/get-ciudades-by-estado/" + estadoId,
        type: "GET",
        dataType: "json",
        success: function (data) {
          $("#ciudadesSub").empty();
          $.each(data, function (key, value) {
            $("#ciudadesSub").append(
              '<option value="' + value.id + '">' + value.nombre + "</option>"
            );
          });
        },
      });
    } else {
      $("#ciudadesSub").empty();
    }
  });

  $("#ciudadesSub").on("change", function () {
    var ciudadId = $(this).val();
    if (ciudadId) {
      $.ajax({
        url: "/get-comisarias-by-ciudad/" + ciudadId,
        type: "GET",
        dataType: "json",
        success: function (data) {
          $("#comisariasSub").empty();
          $.each(data, function (key, value) {
            $("#comisariasSub").append(
              '<option value="' + value.id + '">' + value.nombre + "</option>"
            );
          });
        },
      });
    } else {
      $("#comisariasSub").empty();
    }
  });
});  