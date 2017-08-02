@extends('layouts.app')

@section('content')
                     @include('grid.top',["title"=>"Thank you", "size"=>8])
                     Your Application has been sent, please expect to be reviewed within 2-3 business days.
                    @include('grid.bottom')
                    
                  
@endsection

