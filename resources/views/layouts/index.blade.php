@extends('adminlte::page')

@section('content')
    {{$modulo}}
    <br/>
    {{$rotina}}
    <br/>
    {{url(Request::url().'/data')}}
    <br/>
    {{dd($params)}}
@endsection