@extends('minimal')

@section('title', $title ?? config('app.name'))
@section('code', $code ?? 400)
@section('message', $message ?? 'Something went wrong')
