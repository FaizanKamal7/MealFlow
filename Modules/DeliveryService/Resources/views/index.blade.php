@extends('deliveryservice::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('deliveryservice.name') !!}
    </p>

    <form method="post" enctype="multipart/form-data" action="{{ route("upload_file") }}">
        @csrf
        <input type="file" name="excel_file">
        <input type="submit" value="Upload">
    </form>
@endsection
