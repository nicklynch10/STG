@extends('layouts.app')

@section('content')
                     
					@include('grid.separator')
                    @include('grid.grid',['title'=>$title,"display"=>$description,'size'=>6])
                  
          
@endsection
