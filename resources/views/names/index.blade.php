@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->get('sucess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            El nombre se ha creado
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <h1 class="text-center my-5">Lista de nombres</h1>
    <form class="form" action="{{ url('/search') }}" method="GET">
        {{csrf_field()}}
        <div class="form-group">
          <input type="text" name="query" class="form-control" id="inputSearch" placeholder="Busque aqui">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
      </form>
    <a href="{{url('/names/create')}}"><button type="button" class="btn btn-primary my-5">Crear nuevo nombre</button></a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($names as $row) 
            <tr>
                <td>{{$row->name}}</td>
                <td>{{$row->lastname}}</td>
                <td class="d-flex">
                    <a href="{{url('/names/'.$row->id.'/edit/')}}" class="mr-2">
                        <i class="fas fa-user-edit"></i>
                    </a>
                    <form method="post" action="{{url('/names/'.$row->id)}}">
                        {{csrf_field()}}
                        {{method_field('Delete')}}
                        <!--MODAL-->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">¿Estás seguro de que quieres eliminar a {{$row->name." ".$row->lastname}}?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <i data-toggle="modal" data-target="#exampleModalCenter" type="button" class="fas fa-user-slash" aria-hidden="true"></i>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>  
    {!! $names->render() !!}    
</div>
@endsection
