@extends('layouts.app')

@section('title', 'Edição')

@section('content')
    <div class="container">
        <div class="card">
            <form role="form" id="form" action="{{ route('plans.update', $plan->url) }}" method="POST">
                @csrf
                @method('PUT')
                @include('painel.pages.plans._partials.form')
            </form>
        </div>
    </div>
@endsection
