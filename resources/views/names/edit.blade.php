@extends('layouts.app')

@section('content')

<div class="container">
    @isset($sucess)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            El nombre se ha actualizado
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endisset
    <h1 class="text-center mt-5 mb-5">Editar a {{$name->name}} {{$name->lastname}}</h1>
        <form action="{{url("/names/".$name->id)}}" method="post">
        {{csrf_field()}}
        {{method_field("PATCH")}}
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{$name->name}}" minlength="5" maxlength="40" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Apellido</label>
                <input type="text" class="form-control" name="lastname" value="{{$name->lastname}}" minlength="5" maxlength="40" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
