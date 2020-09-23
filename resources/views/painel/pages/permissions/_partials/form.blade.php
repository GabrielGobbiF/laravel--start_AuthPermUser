@csrf
<div class="card-body">
    <div class="form-group">
        <label for="input--name">Nome</label>
        <input type="text" name="name" class="form-control" id="input--name"
            value="{{ $permission->name ?? old('name') }}">
    </div>
    <div class="form-group">
        <label for="input--description">Descrição</label>
        <input type="text" name="description" class="form-control" id="input--description"
            value="{{ $permission->description ?? old('description') }}">
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
