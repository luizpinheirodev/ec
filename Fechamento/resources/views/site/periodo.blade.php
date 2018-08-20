@extends('layouts.site')



@section('content')



<div class="row">
    
    <div class="col s12 m9 mt">
        @include('layouts._includes._site._pendencia._periodo')
        
    </div>

    <div class="col s12 m3 mt">

        @include('layouts._includes._site._logs')
        @include('layouts._includes._site._calendario')
        

       

</div>
   



@endsection