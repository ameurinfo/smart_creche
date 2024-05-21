@extends('layout-app.base')

@section('content')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <h2> {{$student->name}}</h2>
                
                   <h5> {{$student->parents->name}}</5>
                
        </div>

    </div>
 </div>
@endsection