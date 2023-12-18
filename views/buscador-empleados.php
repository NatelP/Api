<!doctype html>
<html lang="es">
    <head>
        <title>Buscador de Empleados</title>
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
                <h5>Buscador de Empleados</h5>
                <span>Ingrese el numero de documento del Empleado a Buscar</span>
            </div>
        </div>
        <form action="" id="formBuscaEmpleados" autocomplete="off">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Numero de Documento</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="nrodocumento">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="buscar">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="sede" class="form-label">Sede :</label>
                <input type="text" id="sede" class="form-control" placeholder="Nombre de la Sede" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="apellidos" class="form-label">Apellidos :</label>
                <input type="text" id="apellidos" class="form-control" placeholder="Apellidos del Empleado" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="nombres" class="form-label">Nombres :</label>
                <input type="text" id="nombres" class="form-control" placeholder="Nombres del Empleado" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="fechanac" class="form-label">Fecha de Nacimiento :</label>
                <input type="text" id="fechanac" class="form-control" placeholder="Fecha de Nacimiento" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="telefono" class="form-label">Numero de Telefono :</label>
                <input type="text" id="telefono" class="form-control" placeholder="Numero de Telefono" readonly>
            </div>
            <div class="mb-3 text-end">
                <a href="Lista-empleados.php"><button class="btn btn-primary" type="button">Regresar</button></a>
              </div>
        </form>

        <script>
            document.addEventListener("DOMContentLoaded",()=>{

                function $(id) {return document.querySelector(id)}

                function buscarnroDocumento(){
                    const nrodocumento=$("#nrodocumento").value

                    if(nrodocumento !=""){
                        const parametros = new FormData()
                        parametros.append("operacion","search")
                        parametros.append("nrodocumento",nrodocumento)

                        fetch(`../controllers/Empleados.controller.php`,{
                            method: "POST",
                            body: parametros,
                        })
                        .then(respuesta => respuesta.json())
                        .then(datos => {
                            console.log(datos)
                            if (!datos){
                                $("#formBuscaEmpleados").reset()
                                $("#nrodocumento").focus()
                            }
                            else{
                                $("#sede").value=datos.sede;
                                $("#apellidos").value=datos.apellidos;
                                $("#nombres").value=datos.nombres;
                                $("#fechanac").value=datos.fechanac;
                                $("#telefono").value=datos.telefono;
                            }
                        })
                        .catch(e => {
                            console.error(e)
                        })
                    }
                }

                $("#nrodocumento").addEventListener("keypress",(event) => {
                    if(event.keyCode == 13){
                        buscarnroDocumento()
                    }
                })
                $("#buscar").addEventListener("click",buscarnroDocumento)
            })
        </script>
    </body>
</html>
