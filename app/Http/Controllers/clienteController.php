<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Cliente;
use App\Models\Documento;
use App\Models\Persona;
use Exception;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Catch_;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::with('persona.documento')->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all(); // Asegúrate de que este modelo exista y funcione
        return view('clientes.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        try{
            DB::beginTransaction();
            $persona = Persona:: create($request->validated());
            $persona -> cliente() -> create([

                'persona_id' => $persona -> id
            ]);

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente registrado');
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
    public function edit(Cliente $cliente)
    {
        $cliente -> load('persona.documento');
        $documentos = Documento::all();
        return view('clientes.edit', compact('cliente','documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        try {
            DB::beginTransaction();

            Persona::where('id', $cliente->persona->id)
                ->update($request->validated());

            DB::commit(); 
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('clientes.index')->with('success', 'Cliente editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $persona = Persona::find($id);
        if ($persona->estado == 1) {
            Persona::where('id', $persona->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Cliente eliminado';
        } else {
            Persona::where('id', $persona->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Cliente restaurado';
        }

        return redirect()->route('clientes.index')->with('success', $message);
    }

    public function indexReporte(){
        $clientes = Cliente::with('persona.documento')->get();
        return view('reportes.clientes', compact('clientes'));
    }

    public function generarReportePDF(){
        // Puedes obtener datos de tu modelo, por ejemplo, clientes
        $clientes = Cliente::all(); // Asegúrate de importar tu modelo Cliente

        // Carga una vista y pasa los datos
        $pdf = PDF::loadView('reportes.clientes', compact('clientes'));

        // Descarga el PDF
        return $pdf->download('reporte_clientes.pdf');
    }
}
