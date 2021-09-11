<form method="get" action="/">
    <div class="row">
        <div class=" col-sm input-group">
        <input type="text" class="form-control" name="search" placeholder="Buscar Mac Address..." value="{{ request()->search }}">

        <span class="input-group-btn">
            <button type="submit" class="btn btn-success"> Buscar </button>
        </span>

        </div>
    </div>
</form>