@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Anuncios') }}</div>

                <div class="card-body">
                    <anuncios></anuncios>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
