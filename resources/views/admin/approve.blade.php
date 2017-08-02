@extends('layouts.app')

@section('content')
            <table>
            <tr>
              <td>Name</td>
               <td>bio</td>
               <td>why</td>
               <td>experience</td>
               <td>rate</td>
               <td>Approve</td>
               <td>Deny</td>
            </tr>
          @foreach($users as $key=>$user)
          <tr>
            <td>{{$user->firstname." ".$user->lastname}}</td>
            <td>{{$user->bio}}</td>
            <td>{{$user->why}}</td>
            <td>{{$user->experience}}</td>
            <td>{{$user->rate}}</td>
            <td><a href="{{url('approve/'.$user->id)}}">Approve</a></td>
            <td><a href="{{url('deny/'.$user->id)}}">Deny</a></td>
          </tr>

        @endforeach
        </table>  
                    
          
@endsection

