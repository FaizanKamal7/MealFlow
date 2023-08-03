@extends('layouts.admin_master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('fleetservice.name') !!}
    </p>
@endsection
