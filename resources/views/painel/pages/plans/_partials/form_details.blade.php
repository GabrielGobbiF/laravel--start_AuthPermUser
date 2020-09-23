@csrf
<div class="card-body">
    <div class="form-group">
        <label for="input--name">Nome</label>
        <input type="text" name="name" class="form-control" id="input--name"
            value="{{ $detail->name ?? old('name') }}">
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

