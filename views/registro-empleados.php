<!doctype html>
<html lang="es">
  <head>
    <title>Registro Empleados</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <div class="container">
      <div class="alert alert-info mt-2">
        <h5>Registro de Empleados</h5>
      </div>
    </div>
    <form action="" id="formEmpleados" autocomplete="off">
      <div class="mb-3">
        <label for="sede" class="form-label">Sedes</label>
        <select name="sede" id="sede" class="form-select" required>
          <option value="">Seleccione la sede</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos :</label>
        <input type="text" class="form-control" id="apellidos" required>
      </div>
      <div class="mb-3">
        <label for="nombres" class="form-label">Nombres :</label>
        <input type="text" class="form-control" id="nombres" required>
      </div>
      <div class="mb-3">
        <label for="nrodocumento" class="form-label">Numero de Documento :</label>
        <input type="number" class="form-control" id="nrodocumento" required>
      </div>
      <div class="mb-3">
        <label for="fechanac" class="form-label">Fecha de Nacimiento :</label>
        <input type="date" id="fechanac"  value="2018-07-22" min="1900-12-30" max="2023-12-31" required/>
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Telefono :</label>
        <input type="number" class="form-control" id="telefono">
      </div>
      <div class="mb-3 text-end">
        <button class="btn btn-primary" id="guardar" type="submit">guardar Datos</button>
        <button class="btn btn-secondary" type="reset">cancelar</button>
        <a href="Lista-empleados.php"><button class="btn btn-secondary" type="button">Regresar</button></a>
      </div>
    </form>

    <script>
      document.addEventListener("DOMContentLoaded",()=>{
        function $(id) {return document.querySelector(id)}

        (function(){
          fetch(`../controllers/Sede.controller.php?operacion=listar`)
          .then(respuesta=>respuesta.json())
          .then(datos=>{
            console.log(datos)

            datos.forEach(element => {
              const tagOption = document.createElement("option")
              tagOption.value = element.idsede
              tagOption.innerHTML = element.sede
              $("#sede").appendChild(tagOption)
            });
          })
          .catch(e=>{
            console.error(e)
          })
        })();

        $("#formEmpleados").addEventListener("submit",() => {
          event.preventDefault();

          if(confirm("¿Desea registrar a este empleado?")){

            const parametros = new FormData()
            parametros.append("operacion","add")

            parametros.append("idsede",$("#sede").value)
            parametros.append("apellidos",$("#apellidos").value)
            parametros.append("nombres",$("#nombres").value)
            parametros.append("nrodocumento",$("#nrodocumento").value)
            parametros.append("fechanac",$("#fechanac").value)
            parametros.append("telefono",$("#telefono").value)
            
            fetch(`../controllers/Empleados.controller.php`,{
              method: "POST",
              body: parametros
            })
            .then(respuesta=>respuesta.json())
            .then(datos=>{
              if (datos.idempleado >0){
                $("#formEmpleados").reset()
                alert(`Empleado registrado`)
              }
            })
            .catch(e => {
              console.error(e)
            })
          }
        })

      })
    </script>


  </body>
</html>
