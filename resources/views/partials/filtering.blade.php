<div class="row">
    <form action="{{ strpos($_SERVER['REQUEST_URI'], 'admin') == false ? route('blog.posts') : route('admin.posts') }}">
        <input type="text" name="search"/><!--
    --><button><i class="fas fa-search"></i></button>
    </form>
    
    <form action="{{ route('admin.posts') }}">
        <select name="sort">
            <option value="DESC">Mais recente</option>
            <option value="ASC">Mais antigo</option>
        </select>
    </form>
</div>