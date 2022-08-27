@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="text-align: center">Crear Nuevo Anuncio</h2>
        </div>
        <div style="text-align: center" class="pull-right">
            <a class="btn btn-primary" href="{{ route('home') }}"> Volver</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-    danger">
        <strong>Warning!</strong> Porfavor Rellena Todos Los Campos<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div style="text-align: center" class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        
        <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div style="text-align: center" class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                <div class="grid grid-cols-1">
                    <label >Titulo:</label>
                    <input name="titulo" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" required/>
                </div>
                <div>
                    <label >Descripcion:</label>
                    <input name="descripcion" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" required/>
                </div>
                <div class="grid grid-cols-1">
                    <label >Numero:</label>
                    <input name="numero" class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number" required/>
                </div>
            </div>

            <!-- Para ver la imagen seleccionada, de lo contrario no se -->
            <hr>
            <div>
                <img id="imagenSeleccionada" style="max-height: 300px;">           
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <div class='flex items-center justify-center w-full'>
                    <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    <input name="imagen" id="imagen" type='file' class="hidden" />
                    </label>
                </div>
            </div>

            <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                <button type="submit" class='btn btn-success btn-sm'>Guardar</button>
            </div>
        </form> 

        </div>
    </div>
</div> 
@endsection
<!-- Script para ver la imagen antes de CREAR UN NUEVO PRODUCTO -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
<script>   
    $(document).ready(function (e) {   
        $('#imagen').change(function(){            
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#imagenSeleccionada').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files[0]); 
        });
    });
</script>