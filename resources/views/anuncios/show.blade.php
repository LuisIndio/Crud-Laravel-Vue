@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Anuncio</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('home') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h1>Titulo:</h1>
                <h1>
                {{ $anuncio->titulo }}
                </h1>
            </div>
        </div>
        <hr>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h1>Descripcion:</h1>
                <h1>
                    {{ $anuncio->descripcion }}
                    </h1>
            </div>
        </div>
        <hr>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h1>Numero:</h1>
                <h1>
                    {{ $anuncio->numero }}
                    </h1>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h1>Categorias:</h1>
                <h1>
                    {{ $anuncio->categorias }}
                    </h1>
            </div>
        </div>
    </div>
@endsection