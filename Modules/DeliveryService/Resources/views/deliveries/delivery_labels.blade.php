@extends('businessservice::layouts.master')
@section('title', 'Deliveries')

@section('extra_style')
@endsection

@section('main_content')

<p>{{$deliveries ?? ""}}</p>

@endsection

@section('extra_scripts')
<script src="{{ asset('static/js/custom/apps/ecommerce/customers/deliveries/deliveries.js')}}"></script>
@endsection