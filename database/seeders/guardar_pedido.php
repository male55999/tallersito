<?php
// Obtener datos del pedido desde la solicitud POST
$data = json_decode(file_get_contents("php://input"), true);

// Conectar a la base de datos y ejecutar la consulta para insertar los datos
$pdo = new PDO('mysql:host=nombre_del_servidor;dbname=nombre_de_la_base_de_datos', 'nombre_de_usuario', 'contraseña');

$stmt = $pdo->prepare('INSERT INTO order_product (name_client, cel_client, ubi_client, mail_client, productos, order_id, product_id, quantity, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())');
$stmt->execute([$data['cliente']['nombre'], $data['cliente']['celular'], $data['cliente']['direccion'], $data['cliente']['correo'], json_encode($data['productos']), $data['id'], $data['productos']['product_id'], $data['productos']['quantity']]);

// Responder con un mensaje de éxito o error al cliente
header('Content-Type: application/json');
echo json_encode(['mensaje' => 'Pedido recibido y guardado con éxito']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["Nombre"];
    $correo = $_POST["Correo"];
    $direccion = $_POST["Direccion"];
    $celular = $_POST["Celular"];
    $metodoPago = $_POST["MetodoPago"];

    // Conectar a la base de datos y ejecutar la consulta para insertar los datos
    $pdo = new PDO('mysql:host=nombre_del_servidor;dbname=nombre_de_la_base_de_datos', 'nombre_de_usuario', 'contraseña');

    $stmt = $pdo->prepare('INSERT INTO pedidos (nombre, correo, direccion, celular, metodo_pago) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$nombre, $correo, $direccion, $celular, $metodoPago]);

    // Redirigir de vuelta a la página de confirmación o a donde desees
    header('Location: confirmacion.html');
    exit();
}
?>