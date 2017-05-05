@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in! click<a href="{{ url('/checking') }}" onclick="event.preventDefault(); document.getElementById('checking-form').submit();"><i class="fa fa-fw fa-power-off"></i> here</a>
                    to continue.
                    <form id="checking-form" action="{{ url('/checking') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
