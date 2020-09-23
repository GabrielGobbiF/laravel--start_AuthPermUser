@extends('layouts.app')

@section('title', 'Edição')

@section('content')
    <div class="container">
        <div class="card">
            <form role="form" id="form" action="{{ route('plans.details.update', [$plan->url, $detail->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @include('painel.pages.plans._partials.form_details')
            </form>
        </div>
    </div>
@endsection
