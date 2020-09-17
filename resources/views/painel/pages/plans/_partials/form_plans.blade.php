
<div class="card-body">
    <div class="form-group">
        <label for="input--name">Nome</label>
        <input type="text" name="name" class="form-control" id="input--name" value="{{ $plan->name ?? old('name') }}">
    </div>
    <div class="form-group">
        <label for="input--description">Descrição</label>
        <input type="text" name="description" class="form-control" id="input--description"
            value="{{ $plan->description ?? old('description') }}">
    </div>
    <div class="form-group">
        <label for="input--price">Price</label>
        <input type="price" name="price" class="form-control" id="input--price" value="{{ $plan->price ?? old('price') }}">
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
