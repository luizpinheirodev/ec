@extends('layouts.site')

@section('content')



<div class="row">
    <div class="col s12 m9 mt">
        @include('layouts._includes._site._graficoCentral')
        @include('layouts._includes._site._painelAero')
        @include('layouts._includes._site._graficoDias')
    </div>

    <div class="col s12 m3 mt">

        @include('layouts._includes._site._logs')
        @include('layouts._includes._site._calendario')
        @include('layouts._includes._site._contasCriticas')
        @include('layouts._includes._site._feriados')

</div>
   
@endsection