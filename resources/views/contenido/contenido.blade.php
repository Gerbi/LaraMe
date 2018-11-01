@extends('principal')
@section('contenido')

    @if(Auth::check())

            <template v-if="menu==0">
                <posts></posts>
            </template>

            <template v-if="menu==2">
                <articulo></articulo>
            </template>


    @endif


@endsection
