$(document).ready(function(){

        listarRecursos("");
        $("#buscar").keyup(function(){//busca los recursos en tiempo real
          buscar = $("#buscar").val();
          listarRecursos(buscar);
        });

        $("#btnBuscar").click(function(){//busca todos los recursos
          listarRecursos("");
        });


        $("body").on("click", ".btnSeleccionar", function(event){//cambia el select recurso cuando selecciona uno desde la ventana modal 
         event.preventDefault();
          var id = $(this).val();//obtiene el valor del buton seleccionado   
          recursoSeleccionado(id);//funcion recursoSeleccionado
          $("#ventana1").modal('hide');//cierra la ventana modal
        });
        
         $("#formularioModal").submit(function(e){
        e.preventDefault();
        });
        



        $('#tipoRecurso').on('change', function(){
          var tipoRecursoId = $(this).val();
          var areaValorId = $('#area').val();

            if(tipoRecursoId == '' && areaValorId == '')
            {
              $('#recurso :nth-child(1)').prop('selected', true); //el select recurso vuelve al indice 1 si no se ha elegido area
              $('#recurso').prop('disabled', true);
            }
            else if(tipoRecursoId == '' && areaValorId !== '' )
            {
              $('#recurso').prop('disabled', false);//el select recurso se habilita
              $.ajax({
                url: baseurl+"Con_planificar/getRecursoPorArea", //llama a la funcion para obtener los recursos asociados al area
                type: "post",
                data: {'id_area_recurso' : areaValorId},
                dataType: 'json',
                success: function(data){
                  
                  $('#recurso').html(data);

                },

                error: function(data){
                  alert(data);
                  alert('Error occur...!!');
                }
              });
            }
            else if(tipoRecursoId !== '' && areaValorId == '')
            {
              $('#recurso').prop('disabled', false);
                $.ajax({
                  url: baseurl+"Con_planificar/getRecursoPorTipo",
                  type: "post",
                  data: {'id_tipo_recurso' : tipoRecursoId},
                  success: function(data){

                    $('#recurso').html(data);
                    
                  },

                  error: function(data){
                    alert(data);
                    alert('Error occur....!!');
                  }
                });
            }
            else
            {
              $('#recurso').prop('disabled', false);
                $.ajax({
                  url: baseurl+"Con_planificar/getRecursoPorAreaTipo",
                  type: "post",
                  data: {'id_tipo_recurso' : tipoRecursoId, 'id_area_recurso' : areaValorId},
                  success: function(data){

                    $('#recurso').html(data);
                    
                  },

                  error: function(data){
                    alert(data);
                    alert('Error occur....!!');
                  }
                });
            }
              
        });

         $('#area').on('change', function(){//Si cambia el select area, el select recurso cambiara(Select anidado)
          var areaValorId = $(this).val();//obtiene el id del area
          var tipoRecursoId = $('#tipoRecurso').val();
          

          if(areaValorId == '' && tipoRecursoId == '')
          {
            $('#recurso :nth-child(1)').prop('selected', true); //el select recurso vuelve al indice 1 si no se ha elegido area
            $('#recurso').prop('disabled', true);//el select recurso esta deshabilitado si no se ha seleccionado una area
          }
          else if(areaValorId == '' && tipoRecursoId !== '')//si selecciona un area
          {
              $('#recurso').prop('disabled', false);
                $.ajax({
                  url: baseurl+"Con_planificar/getRecursoPorTipo",
                  type: "post",
                  data: {'id_tipo_recurso' : tipoRecursoId},
                  success: function(data){

                    $('#recurso').html(data);
                    
                  },

                  error: function(data){
                    alert(data);
                    alert('Error occur....!!');
                  }
              });
          }
          else if (areaValorId !== '' && tipoRecursoId == '')
          {
            $('#recurso').prop('disabled', false);//el select recurso se habilita
            $.ajax({
              url: baseurl+"Con_planificar/getRecursoPorArea", //llama a la funcion para obtener los recursos asociados al area
              type: "post",
              data: {'id_area_recurso' : areaValorId},
              dataType: 'json',
              success: function(data){
                
                $('#recurso').html(data);

              },

              error: function(data){
                alert(data);
                alert('Error occur...!!');
              }
            });
          }
          else
          {
            $('#recurso').prop('disabled', false);
                $.ajax({
                  url: baseurl+"Con_planificar/getRecursoPorAreaTipo",
                  type: "post",
                  data: {'id_tipo_recurso' : tipoRecursoId, 'id_area_recurso' : areaValorId},
                  success: function(data){

                    $('#recurso').html(data);
                    
                  },

                  error: function(data){
                    alert(data);
                    alert('Error occur....!!');
                  }
                });
            }
        });

        $('#modalArea').on('change', function(){
          var id_area_recurso = $(this).val();

          if(id_area_recurso == '')
          {
            listarRecursos("");
          }
          else
          {
            filtrarArea(id_area_recurso);
          }
          
        });

        $('#modalTipo').on('change', function(){
          var id_tipo_recurso = $(this).val();

          if(id_tipo_recurso == '')
          {
            listarRecursos("");
          }
          else
          {
            filtrarTipoRecurso(id_tipo_recurso);
          }

        });

});

function recursoSeleccionado (id_recurso) {//ingresa el id del recurso seleccionado en la ventana modal
  $.ajax({
    url: baseurl+"Con_planificar/recursoSeleccionado",
    type: "POST",
    data: {id_recurso: id_recurso},
    success: function(respuesta){
      
      $('#recurso').prop('disabled', false);//habilita el select recurso
      $('#recurso').html(respuesta); //llena el select recurso con la respuesta enviada
    },

    error: function (respuesta) {
      alert(data);
      alert('Error occur...!!');
    }

  });
}

function filtrarArea (valor) {
  $.ajax({
    url: baseurl+"Con_planificar/filtrarArea", 
    type: "POST",
    data: {id_area_recurso: valor},
    success:function(respuesta){
      //alert(respuesta);
      var registros = eval(respuesta);
      
      html ="<table class='table table-responsive table-bordered'><thead>";
      html +="<tr><th>Acción</th><th>Código</th><th>Recurso</th><th>Cantidad</th><th>Descripción</th><th>Lugar</th></tr>";                                                                                                                                                                                                            
      html +="</thead><tbody>";
      
      for (var i = 0; i < registros.length; i++) {
        //el boton contiene el id de los recursos mostrados en la tabla
        html +="<tr><td><button type='button' value="+registros[i]["id_recurso"]+" class='btn btn-warning btnSeleccionar'>Seleccionar</button></td><td>"+registros[i]["codigo"]+"</td><td>"+registros[i]["nombre_recurso"]+"</td><td>"+registros[i]["cantidad_disponible"]+"</td><td>"+registros[i]["descripcion"]+"</td><td>"+registros[i]["LUGAR_RECURSO_id_lugar"]+"</td></tr>";
      };
      html +="</tbody></table>";
      $("#lista").html(html);
    }
  });
}

function filtrarTipoRecurso (valor) {
  $.ajax({
    url: baseurl+"Con_planificar/filtrarTipoRecurso", 
    type: "POST",
    data: {id_tipo_recurso: valor},
    success:function(respuesta){
      //alert(respuesta);
      var registros = eval(respuesta);
      
      html ="<table class='table table-responsive table-bordered'><thead>";
      html +="<tr><th>Acción</th><th>Código</th><th>Recurso</th><th>Cantidad</th><th>Descripción</th><th>Lugar</th></tr>";                                                                                                                                                                                                            
      html +="</thead><tbody>";
      
      for (var i = 0; i < registros.length; i++) {
        //el boton contiene el id de los recursos mostrados en la tabla
        html +="<tr><td><button type='button' value="+registros[i]["id_recurso"]+" class='btn btn-warning btnSeleccionar'>Seleccionar</button></td><td>"+registros[i]["codigo"]+"</td><td>"+registros[i]["nombre_recurso"]+"</td><td>"+registros[i]["cantidad_disponible"]+"</td><td>"+registros[i]["descripcion"]+"</td><td>"+registros[i]["LUGAR_RECURSO_id_lugar"]+"</td></tr>";
      };
      html +="</tbody></table>";
      $("#lista").html(html);
    }
  });
}

function listarRecursos(valor){//lista todos los recursos en una tabla segun el valor pasado por parametro. Buscara un nombre de recurso
  $.ajax({
    url: baseurl+"Con_planificar/listarRecursos", 
    type: "POST",
    data: {buscar: valor},
    success:function(respuesta){
      //alert(respuesta);
      var registros = eval(respuesta);
      
      html ="<table class='table table-responsive table-bordered'><thead>";
      html +="<tr><th>Acción</th><th>Código</th><th>Recurso</th><th>Unidades</th><th>Descripción</th><th>Lugar</th></tr>";                                                                                                                                                                                                            
      html +="</thead><tbody>";
      
      for (var i = 0; i < registros.length; i++) {
        //el boton contiene el id de los recursos mostrados en la tabla
        html +="<tr><td><button type='button' value="+registros[i]["id_recurso"]+" class='btn btn-warning btnSeleccionar'>Seleccionar</button></td><td>"+registros[i]["codigo"]+"</td><td>"+registros[i]["nombre_recurso"]+"</td><td>"+registros[i]["cantidad_disponible"]+"</td><td>"+registros[i]["descripcion"]+"</td><td>"+registros[i]["LUGAR_RECURSO_id_lugar"]+"</td></tr>";
      };
      html +="</tbody></table>";
      $("#lista").html(html);
    }
  });
}




        /*$('#form').submit(function(event){

          var fechaSeleccionada  = $("#dia").val();

          var milisegundosSeleccionados = Date.parse(fechaSeleccionada);

          var fechaActual = new Date();

          var anioActual = fechaActual.getFullYear();
          var mesActual = fechaActual.getMonth();
          var diaActual = fechaActual.getDate();

          

          if(mesActual < 10)
          {
            mesActual = mesActual + 1;
            var fecha = anioActual + "-" +"0"+mesActual + "-" + diaActual;  
            
            var milisegundosActuales = Date.parse(fecha);


            if(milisegundosActuales == milisegundosSeleccionados)
            {
              
              alert("Recurso solicitado con éxito");
            }
            else if(milisegundosActuales > milisegundosSeleccionados)
            {
              
              alert("La fecha no es correcta. Intente de nuevo");
              event.preventDefault();
            }
            else
            {
              alert("Recurso solicitado con éxito");
            }

          }
          else
          {
              mesActual = mesActual + 1;
              var fecha = anioActual + "-" +mesActual + "-" + diaActual;

              var milisegundosActuales = Date.parse(fecha);

              if(milisegundosActuales == milisegundosSeleccionados)
              {
                alert("Recurso solicitado con éxito");
              }
              else if(milisegundosActuales > milisegundosSeleccionados)
              {
                alert("La fecha no es correcta. Intente de nuevo");
                event.preventDefault();
              }
              else
              {
                alert("Recurso solicitado con éxito");
              }

            }

          
        });*/

      



