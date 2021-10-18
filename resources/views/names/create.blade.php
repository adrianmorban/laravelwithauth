@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-5 mb-5">Crear nuevo nombre</h1>
        <form action="{{url('/names')}}" method="post">
        {{csrf_field()}}
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" minlength="5" maxlength="40" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Apellido</label>
                <input type="text" class="form-control" name="lastname" minlength="5" maxlength="40" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
