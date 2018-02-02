@extends('adminlte::master')

@section('body')
    {{$errors->first()}}
    @if($errors->count() == 0)
        Cliente não especificado
    @endif
@stop