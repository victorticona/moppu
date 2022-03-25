@extends ('admin.index')

@section('contenido')

<anuncio-vico direc="{{session('pdv_name')." ".session('dir_name')}}"></anuncio-vico>

@endsection
