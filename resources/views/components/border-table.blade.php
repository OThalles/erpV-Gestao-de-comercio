<div class="border-table">
    <div class="top-border-table">
    <p class="record-count">Mostrando {{$count}} registros</p>

    @if($search)
    <form action="{{route($routes)}}" method="GET">
        <p>Pesquisar:</p>
        <input type="text" class="search-input" name="id" autocomplete="off" id="">
    </form>
    @endif

</div>
