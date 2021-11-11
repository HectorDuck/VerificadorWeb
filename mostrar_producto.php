<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "index.html";
        }, 5000);
    </script>

    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
      window.addEventListener("keydown", function (e) {
          codigo += String.fromCharCode(e.keyCode);
          if (e.keyCode == 13) {
              window.location = "mostrar_producto.php?codigo=" + codigo;
              codigo = "";
          }
      }, true);
}
</script>
<style>
  body{ 
    background-color:lightseagreen;
  }
  #noencontrada {
    width: 35%;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
                }
</style>
</head>

<body>
  <h1>
    <?php
        include ("./inc/settings.php");
                
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM productos WHERE producto_codigo = ".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
            
            if ($renglones==1) {
                 echo "<div style='display:flex; position:absolute; left:50%; top:50%; -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);'>
                 <div><img src='{$result['producto_imagen']}' width='550px' height='500px'></div>
            <div style='display:flex; align-items:center; text-align: left;'>Producto: {$result['producto_nombre']}<br>
                        Precio: {$result['producto_precio']}<br>
            Stock: {$result['producto_cantidad']}<br>
                    </div>
            
            </div>"; 
            
            }
          } catch(Exception $e) {
            
            echo "<h1 style='text-align: center'>No se encontró el producto <br></h1>
            <img id = 'noencontrada' src='img/error.png' width='550px' height='500px'>";
          }
    ?>
  </h1>
</body>
</html>