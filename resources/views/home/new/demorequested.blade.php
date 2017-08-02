@extends('layouts.app')

@section('content')
@include('grid.separator',['size'=>2])
        @include('grid.top',["title"=>"Thank you for your Demo Request","size"=>8])
        A Swing Tips Golf representative will contact you shortly.
        @include('grid.bottom')
       


@endsection