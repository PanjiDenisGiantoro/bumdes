@extends('errors::illustrated-layout')

@section('title', __('Hak Akses Terbatas'))
@section('code', 'Hak Akses Terbatas')
@section('message', __($exception->getMessage() ?: 'Forbidden'))


