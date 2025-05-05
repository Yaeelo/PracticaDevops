<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;
use Illuminate\Support\Facades\Auth;

class DenunciaController extends Controller
{
    public function create()
    {
        return view('denuncias.create');
    }

    public function index()
{
    $denuncias = Denuncia::all();
    return view('denuncias.index', compact('denuncias'));
}


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|string',
            'evidencia' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $rutaArchivo = null;

        if ($request->hasFile('evidencia')) {
            $rutaArchivo = $request->file('evidencia')->store('evidencias', 'public');
        }

        Denuncia::create([
            'user_id' => Auth::id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'evidencia' => $rutaArchivo,
        ]);

        return redirect()->back()->with('success', 'Denuncia enviada con éxito.');


        {
            $denuncia = new Denuncia();
            $denuncia->titulo = $request->titulo;
            $denuncia->descripcion = $request->descripcion;
            // Otros campos...
        
            // Estado por defecto
            $denuncia->estado = 'pendiente';
        
            $denuncia->save();
        
            return redirect()->route('denuncias.index')->with('success', 'Denuncia enviada correctamente.');
        }
    }
    public function panico(Request $request)
{
    $denuncia = new Denuncia();
    $denuncia->titulo = 'Emergencia: Botón de pánico activado';
    $denuncia->descripcion = 'El usuario activó el botón de pánico.';
    $denuncia->ubicacion = $request->input('ubicacion');
    $denuncia->estado = 'urgente';
    $denuncia->save();

    return response()->json(['success' => true, 'mensaje' => 'Denuncia de pánico registrada']);
}

}
