@extends('principal')

@section('contenido')

<div class="container">

    <div class="row justify-content-around">


        <div class="col-md-8 mt-5">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>L</th>
                            <th>M</th>
                            <th>M</th>
                            <th>J</th>
                            <th>V</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($horarios as $horario)
                            <tr>
                            <form action="{{ route('actualizar', $horario->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')

                                <td>
                                 {{ $horario->hora }}

                                </td>
                                <td>

                                <select name="lunes" class="form-select form-select-md">
                                
                                        <option value="{{ $horario->lunes }}" selected=""> {{ $horario->lunes }}</option>
                                        @for ($i = 1; $i <= 4; $i++)
                                            @if($i!=$horario->lunes)
                                            <option value="{{$i}}" >{{$i}}</option>
                                            @endif
                                        @endfor

                                </select> 
                                  
                                </td>
                                <td>
                                  
                                <select name="martes" class="form-select form-select-md">
                                
                                           <option value="{{ $horario->martes }}" selected=""> {{ $horario->martes }}</option>
                                        @for ($i = 1; $i <= 4; $i++)
                                            @if($i!=$horario->martes)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor

                                </select> 


                                </td>

                                <td>
                                
                                <select name="miercoles" class="form-select form-select-md">
                                    
                                        <option value="{{ $horario->miercoles }}" selected=""> {{ $horario->miercoles }}</option>
                                    @for ($i = 1; $i <=4; $i++)
                                        @if($i!=$horario->miercoles)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endif
                                    @endfor

                                </select> 

                                </td>

                                <td>
                                    
                                <select name="jueves" class="form-select form-select-md">
                                    
                                    <option value="{{ $horario->jueves }}" selected=""> {{ $horario->jueves }}</option>
                                @for ($i = 1; $i <=4; $i++)
                                    @if($i!=$horario->jueves)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                @endfor

                               </select> 

                                </td>

                                <td>
                                
                                <select name="viernes" class="form-select form-select-md">
                                    
                                    <option value="{{ $horario->viernes }}" selected=""> {{ $horario->viernes }}</option>
                                @for ($i = 1; $i <=4; $i++)
                                    @if($i!=$horario->viernes)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endif
                                @endfor

                               </select> 

                                </td>

                                <td id="fijar">
                                     <button type="submit" class="btn btn-outline-success"><i class="bi bi-arrow-clockwise"></i>  </button> 
                                    </form>
                                    
                                    <form action="{{ route('borrar', $horario->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i>  </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td></td>
                                <td>NO</td>
                                <td>HAY</td>
                                <td>HORARIOS</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforelse
                        <tr>
                            <form method="post" action="{{ route('nuevaFila') }}">
                                @csrf

                                <td>
                                    <input class="form-control" type="time" size="5" name="hora"
                                        value="{{ old('hora') }}" />
                                </td>

                                <td>
                                    <select name="lunes" class="form-select form-select-sm">
                                        <option value="0"></option>
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                </td>
                                <td>
                                    <select name="martes" class="form-select form-select-sm">
                                        <option value="0"></option>
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                </td>
                                <td>

                                    <select name="miercoles" class="form-select form-select-sm">
                                        <option value="0"></option>
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                </td>
                                <td>
                                    <select name="jueves" class="form-select form-select-sm">
                                        <option value="0"></option>
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>

                                <td>
                                    <select name="viernes" class="form-select form-select-sm">
                                        <option value="0"></option>
                                        <option value="1" selected="">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success ms-3"><i class="bi bi-plus-circle"></i> Nuevo</button>
                                </td>

                            </form>

                        </tr>

                    </tbody>

                </table>
            </div>




            <div class="col-md-6 mt-4">
                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong> 
                    </div>
                @endif

                @if($message = Session::get('error'))
                <div class="alert alert-danger">
                        <strong>{{ $message }}</strong> 
                    </div>
                @endif

                <form action="{{ route('subirCancion') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 border p-2">
                        <label for="formFile" class="form-label">Subir Fichero:</label>
                        <input class="form-control" type="file" name="fileToUpload" id="formFile">
                        <br>
                        <button type="submit" class="btn btn-success"><i class="bi bi-cloud-arrow-up"></i> Subir</button>
                    </div>

                </form>
                <br>
                <h5>Espacio disponible disco: {{ $espacio }} GB ({{$porcenDispo}}%) <i class="bi bi-hdd"></i></h5>
                <br>

            </div>

            <div class="col-sm-6 mt-4">



            </div>

        </div>

        <div class="col-md-3 mt-5">

            <form method="post" action="{{ route('elegirCancion') }}">
                <fieldset class="form-group border p-2">
                    <legend>Seleccionar Canción:</legend>
                   
                    @csrf
                    <br>
                    <div class="mb-3 mt-3">
                        <label for="num1" class="form-label">1</label>

                        <select name="num1" class="form-select form-select-md">
                            <option value="0" selected="">Selecciona...</option>

                            @forelse($canciones as $cancion)
                                @if($cancion->num == 1)
                                    <option value="{{ $cancion->id }}" selected="selected">{{ $cancion->nombre }}
                                    </option>
                                @else
                                    <option value="{{ $cancion->id }}">{{ $cancion->nombre }}</option>
                                @endif
                            @empty
                                <option value=""></option>
                            @endforelse

                        </select>

                    </div>

                    <br>
                    <div class="mb-3 mt-3">
                        <label for="num2" class="form-label">2</label>

                        <select name="num2" class="form-select form-select-md">
                            <option value="0" selected="">Selecciona...</option>
                            @forelse($canciones as $cancion)

                                @if($cancion->num == 2)
                                    <option value="{{ $cancion->id }}" selected="selected">{{ $cancion->nombre }}
                                    </option>
                                @else
                                    <option value="{{ $cancion->id }}">{{ $cancion->nombre }}</option>
                                @endif

                            @empty
                                <option value=""></option>
                            @endforelse

                        </select>
                    </div>

                    <br>
                    <div class="mb-3 mt-3">
                        <label for="num3" class="form-label">3</label>

                        <select name="num3" class="form-select form-select-md">
                            <option value="0" selected="">Selecciona...</option>

                            @forelse($canciones as $cancion)

                                @if($cancion->num == 3)
                                    <option value="{{ $cancion->id }}" selected="selected">{{ $cancion->nombre }}
                                    </option>
                                @else
                                    <option value="{{ $cancion->id }}">{{ $cancion->nombre }}</option>

                                @endif
                            @empty
                                <option value=""></option>
                            @endforelse

                        </select>
                    </div>

                    <br>
                    <div class="mb-3 mt-3">
                        <label for="num4" class="form-label">4</label>

                        <select name="num4" class="form-select form-select-md">
                            <option value="0" selected="">Selecciona...</option>

                            @forelse($canciones as $cancion)
                                @if($cancion->num == 4)
                                    <option value="{{ $cancion->id }}" selected="selected">{{ $cancion->nombre }}
                                    </option>
                                @else
                                    <option value="{{ $cancion->id }}">{{ $cancion->nombre }}</option>
                                @endif
                            @empty
                                <option value=""></option>
                            @endforelse

                        </select>
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Selecciona Canción <i class="bi bi-cassette"></i></button>

                </fieldset>
            </form>


        </div>











    </div>
</div>

@endsection
