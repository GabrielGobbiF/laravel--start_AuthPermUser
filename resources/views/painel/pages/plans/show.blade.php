@extends('layouts.app')

@section('title', 'Edição')

@section('content')
    <div class="container">
        <div class="card">
            <form role="form" id="form" action="{{ route('plans.update', $plan->url) }}" method="POST">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="input--name">Nome</label>
                        <input type="text" name="name" class="form-control" id="input--name" required
                            value="{{ $plan->name }}">
                    </div>
                    <div class="form-group">
                        <label for="input--description">Descrição</label>
                        <input type="text" name="description" class="form-control" id="input--description"
                            value="{{ $plan->description }}">
                    </div>
                    <div class="form-group">
                        <label for="input--price">Price</label>
                        <input type="price" name="price" class="form-control" id="input--price" value="{{ $plan->price }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
