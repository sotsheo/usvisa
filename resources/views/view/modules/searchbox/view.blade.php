<div class="box-search-show">
        <form method="get" action="{{route('search')}}" class="searchform" role="search">
            <div class="close">x</div>
            <input type="text" class="form-control" name="t" placeholder="Tìm kiếm tin bài..." autocomplete="off" value="<?= (isset($_GET['t']))?  $_GET['t'] :'' ?>">
            <button><i class="fa fa-search"></i></button>
        </form>
    </div>