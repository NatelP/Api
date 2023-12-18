<!doctype html>
<html lang="es">
  <head>
    <title>Empresa</title>
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
    <div class="w3-container w3-teal">
      <div class="alert alert-info mt-2">
      <h5>Lista de empleados</h5>
    </div>
    </div>
  <form action="" id="formVehiculo" autocomplete="off">
      <div class="d-grid gap-2 col-6 d-md-block mx-auto">
        <a href="registro-empleados.php"><button class="btn btn-primary" type="button">Registrar</button></a>
        <a href="buscador-empleados.php"><button class="btn btn-primary" type="button">Buscar</button></a>
        <a href="informe.html"><button class="btn btn-primary" type="button">Informe Gráfico</button></a>
      </div>
  </form>
  <div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Sede</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Nombres</th>
                <th scope="col">Número de Documento</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Teléfono</th>
            </tr>
        </thead>
        <tbody id="tablaEmpleados">
        </tbody>
      </table>
    </div>
    
    <script>
      document.addEventListener("DOMContentLoaded", () => {
    
        function $(id) { return document.querySelector(id) }
    
        (function () {
          fetch(`../controllers/Empleados.controller.php?operacion=listar`)
            .then(respuesta => respuesta.json())
            .then(datos => {
              console.log(datos);
    
              datos.forEach(element => {
                const fila = document.createElement("tr");
    
                const tdSede = document.createElement("td");
                tdSede.textContent = element.sede;
    
                const tdApellidos = document.createElement("td");
                tdApellidos.textContent = element.apellidos;
    
                const tdNombres = document.createElement("td");
                tdNombres.textContent = element.nombres;
    
                const tdNroDocumento = document.createElement("td");
                tdNroDocumento.textContent = element.nrodocumento;
    
                const tdFechaNac = document.createElement("td");
                tdFechaNac.textContent = element.fechanac;
    
                const tdTelefono = document.createElement("td");
                tdTelefono.textContent = element.telefono;
    
                fila.appendChild(tdSede);
                fila.appendChild(tdApellidos);
                fila.appendChild(tdNombres);
                fila.appendChild(tdNroDocumento);
                fila.appendChild(tdFechaNac);
                fila.appendChild(tdTelefono);
    
                $("#tablaEmpleados").appendChild(fila);
              });
            })
            .catch(e => {
              console.error(e);
            });
        })();
      });
    </script>
  </body>
</html>
