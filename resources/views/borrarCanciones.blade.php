@extends('principal')

@section('contenido')

<div class="container">

    <div class="row">


        <div class="col-sm mt-5">
          
        <h5>Espacio disponible disco GB: {{$espacio}} ({{$porcenDispo}}%) <i class="bi bi-hdd"></i></h5> 
        <h5>Espacio disponible disco MB: {{$espacio*1024}} ({{$porcenDispo}}%) <i class="bi bi-hdd"></i></h5> 
        <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>CANCIÓN</th>
                        <th>TAMAÑO MB</th>
                        <th>CANCIÓN SELEC.</th>
                        <th>BORRAR</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse( $canciones as $cancion )
                        <tr>
                        <td> <h5>{{ $cancion->nombre }}</h5> </td>
                        <td> <h5>{{ $cancion->size }} MB</h5></td>
                        <td> <h5>{{ $cancion->num }}</h5></td>
                        <td>
                            <form action="{{ route('eliminarCancion', $cancion->id) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" type="submit"><i class="bi bi-trash"></i> Borrar</button>
                            </form>
                        </td>
                        </tr>

                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>BORRAR</th>
                        </tr>
                    @endforelse
                    <tr>

        </div>
    </div>
</div>

@endsection
