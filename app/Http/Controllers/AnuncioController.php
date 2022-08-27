<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->buscador){
            $filtro = $request ->buscador;
            return Anuncio::where('titulo','LIKE','%'.$filtro.'%')->get();
        }else{
            return Anuncio::with('categorias')->get();
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anuncios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required',
        'descripcion' => 'required',
        'numero' => 'required',
    ]);
    $anuncio = new Anuncio();
    $anuncio->titulo = $request->titulo;
    $anuncio->descripcion = $request->descripcion;
    $anuncio->numero = $request->numero;
    $anuncio->user_id = auth()->id();

    if($imagen = $request->file('imagen')){
        $rutaImg = 'imagen/';
        $imgAnuncio = date('YmdHis').".".$imagen->getClientOriginalExtension();
        $imagen->move($rutaImg,$imgAnuncio);
        $anuncio['imagen']="$imgAnuncio";
    }
    $anuncio->save();

    return redirect()->route('home');
    

    Blog::create($request->all());
}  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function show(Anuncio $anuncio)
    {
        return view('anuncios.show',compact('anuncio'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function edit(Anuncio $anuncio)
    {
        return view('anuncios.edit',compact('anuncio'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $anuncio = Anuncio::find($id);
        $anuncio->titulo = $request->titulo;
        $anuncio->descripcion = $request->descripcion;
        $anuncio->numero = $request->numero;

        $anuncio->update();
        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anuncio = Anuncio::find($id);
        $anuncio->delete();
    }
    public function subirImagen(Request $request, $id)
    {
        $objAnuncio = Anuncio::find($id);
        if ($objAnuncio == null) {
            return response()->json(array('message' => 'Item not found'), Response::HTTP_NOT_FOUND);
        }
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $photoName = $id . ".jpg";
            $file->move(public_path("img/anuncios"), $photoName);
//            Storage::disk('public')->put('img/personas/' . $photoName, (string)file_get_contents($file));
            return response()->json(["res" => "success"]);
        }
        return response()->json(["message" => "Image not found"], Response::HTTP_BAD_REQUEST);
    }
}
