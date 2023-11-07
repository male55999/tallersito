<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        $pedido = Pedido::all();
        return response()->json($pedidos);
    }*/

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pedido = new Pedido();
        $productos = $request->input('Productos');
        $nombreCliente = $request->input('NombreCliente');
        $correoCliente = $request->input('CorreoCliente');
        $direccionCliente = $request->input('DireccionCliente');
        $celularCliente = $request->input('CelularCliente');
        $estado = $request->input('Estado');
        $pedido->nombreCliente = $nombreCliente;
        $pedido->correoCliente = $correoCliente;
        $pedido->direccionCliente = $direccionCliente;
        $pedido->celularCliente = $celularCliente;
        $pedido->productos = $productos;
        $pedido->estado = $estado;
        $pedido->save();
        return response()->json($pedido, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        return response()->json($pedido);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = $request->input("Estado");
        $pedido->save();
        return response()->json($pedido);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function agregarPedido(Request $request)
    {
        $productos = $request->input('Productos');
        $nombreCliente = $request->input('NombreCliente');
        $correoCliente = $request->input('CorreoCliente');
        $direccionCliente = $request->input('DireccionCliente');
        $celularCliente = $request->input('CelularCliente');
        $estado = $request->input('Estado');
    
        // Crea un nuevo pedido con los datos
        $pedido = new Pedido();
        $pedido->nombreCliente = $nombreCliente;
        $pedido->correoCliente = $correoCliente;
        $pedido->direccionCliente = $direccionCliente;
        $pedido->celularCliente = $celularCliente;
        $pedido->productos = $productos;
        $pedido->estado = $estado;
        $pedido->save();
    
        // Puedes retornar una respuesta adecuada
        return response()->json(['mensaje' => 'Pedido guardado con éxito'], 201);
    }

    public function index(Request $request)
    {
        $estado = $request->query('Estado'); // Obtener el parámetro de consulta 'Estado'
    
        // Filtrar los productos según el estado
        $pedidos = Pedido::where('Estado', $estado)->get();
    
        return response()->json($pedidos);
    }

    public function buscarPorEmail(Request $request)
    {
        $email = $request->query('CorreoCliente'); // Obtener el parámetro de consulta 'CorreoCliente'
    
        // Filtrar los productos según el correo
        $pedidos = Pedido::where('CorreoCliente', $email)->get();
    
        return response()->json($pedidos);
    }

    public function buscarPorCelular(Request $request)
    {
        $celular = $request->query('CelularCliente'); // Obtener el parámetro de consulta 'CelularCliente'
    
        // Filtrar los productos según el celular
        $pedidos = Pedido::where('CelularCliente', $celular)->get();
    
        return response()->json($pedidos);
    }

    public function updateEstado(Request $request)
    {
        // Obtén el ID del pedido y el nuevo estado de la solicitud
        $idPedido = $request->input('id');
        $nuevoEstado = "atendido";
    
        // Encuentra el pedido en la base de datos por su ID
        $pedido = Pedido::find($idPedido);
    
        // Verifica si el pedido existe
        if (!$pedido) {
            return response()->json(['mensaje' => 'Pedido no encontrado'], 404);
        }
    
        // Actualiza el estado del pedido si no se ha actualizado antes
        if($pedido->Estado == $nuevoEstado){
            return response()->json(['mensaje' => 'Pedido ya actualizado'], 400);
        }
        else{
            $pedido->Estado = $nuevoEstado;
            $pedido->save();
        
            // Devuelve una respuesta de éxito
            return response()->json(['mensaje' => 'Estado actualizado con éxito'], 200);
        }
    }
      
}
