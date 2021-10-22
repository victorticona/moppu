@extends ('admin.index')

@section('contenido')

<cliente-vico super="{{session('per_is_super')}}"></cliente-vico>

@endsection
