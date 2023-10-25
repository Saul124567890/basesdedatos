<!DOCTYPE html>
 <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=<, initial-scale-1.0">
        <link rel="stylesheet" href="si.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>Captura-Muestra</title>
</head>
<body>
   <script>
    $(document).ready(function(){

        function actualizardatos(){

            $.get("mostrar.php", function(data){
              // esta parte sera util para poner el codigo en css
                $("resultados").html(data);
            });
        }
        //con esto se llama a la funcion para cargar los datos al cargar la pagina
        actualizardatos();
        //manejo del envio del formulario
        $("#formulario").submit(function(event){
            event.preventDefault();
            $.post("insertarnuevo.php", $this.serialize(), function(data));
            $("mensaje").html(data);
            actualizardatos(); //llama la funcion para cargar los datos de la funcion
            $("#formulario")[0].reset; //limpia el formulario
        });
    });
   </script>
   <form id= "formulario">
        <label form "nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label form "apellido">Apellido: </label>
        <input type="text" id="apellido" name="apellido" required><br>
        <label form "nacimiento">Nacimiento: </label>
        <input type="text" id="nacimiento" name="nacimiento" required><br>
        <input type="submit" value="Agregar Registro">
</form>
<?php
     // Configuración de la conexión a la base de datos
     $servername = "localhost";
     $username = "root";
     $password = "admin";
     $dbname = "lunes";
 
     // Crear conexión
     $conn = new mysqli($servername, $username, $password, $dbname);
 
     // Verificar la conexión
     if ($conn->connect_error) {
         die("La conexión a la base de datos falló: " . $conn->connect_error);
     }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados desde el formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $nacimiento = $_POST["nacimiento"];
 

    // Consulta SQL para insertar una nueva persona en la tabla
    $sql = "INSERT INTO martes (id, nombre, apellido, nacimiento) VALUES ('$id ', '$nombre', '$apellido', '$nacimiento')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Nueva persona agregada con éxito.";
    } else {
        echo "Error al agregar la persona: " . $conn->error;
    }
}
    ?>

 <div id="mensaje"></div>
 <div id="resultados"></div>
    </body>
</html>