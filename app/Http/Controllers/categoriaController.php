<?php

namespace App\Http\Controllers;// Define el espacio de nombres para el controlador

use App\Http\Requests\StoreCaracteristicaRequest;// Importa la solicitud de validación específica para almacenar categorías
Use Illuminate\Http\Request;// Importa la clase Request para manejar las solicitudes HTTP

use App\Http\Requests\UpdateCategoriaRequest; // Importa la solicitud de validación específica para actualizar categorías. Similar a StoreCategoriaRequest, pero para la lógica de actualización.
use App\Models\Caracteristica;// Importa el modelo Caracteristica para interactuar con la tabla de características
use App\Models\Categoria;// Importa el modelo Categoria para interactuar con la tabla de categorías
use Exception;// Importa la clase Exception para manejar errores
use Illuminate\Support\Facades\DB;// Importa la fachada DB para manejar transacciones de base de datos



class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Route::view('/categorias','categoria.index');
        //$categorias = Categoria::with('caracteristica')->latest()->get();
        //, ['categorias' => $categorias]
        
        $categorias = Categoria::with('caracteristica')->latest()->get();
        //dd($categorias);
        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaracteristicaRequest $request)
    {
        //dd($request);
        try{
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->categoria()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::COMMIT();
        }catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('categorias.index')->with('success','Categoria registrada');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //dd($categoria);
        //
        return view('categoria.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCategoriaRequest $request, Categoria $categoria)
    {
        //
        Caracteristica::where('id', $categoria->caracteristica->id)
            ->update($request->validated());

        return redirect()->route('categorias.index')->with('success', 'Categoría editada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //dd($id);
        $message = '';
        $categoria = Categoria::find($id);
        if ($categoria->caracteristica->estado == 1) {
            Caracteristica::where('id', $categoria->caracteristica->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Categoría eliminada';
        } else {
            Caracteristica::where('id', $categoria->caracteristica->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Categoría restaurada';
        }

        return redirect()->route('categorias.index')->with('success', $message);
    }
}
