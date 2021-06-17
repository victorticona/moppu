@extends ('admin.index')

@section('contenido')

<miperfil-vico session="{{session('per_name').' '.session('per_lastname')}} "></miperfil-vico>

@endsection
