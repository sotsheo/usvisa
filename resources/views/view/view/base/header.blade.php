
<header>
    <div class="header_top">
        <div class="container">
            <div class="header_top_left">
                <p>Hotline: <a href=" tel:<?= $w->phone?>"> <?= $w->phone?></a></p>
            </div>
            <!-- Menu header -->
            <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view_8',1);?>
        </div>
    </div>
    <div class="header_content">
        <div class="container">
            <div class="logo">
                <a href="/"><img src="<?= $w->logo?>"></a>
            </div>
        </div>
        <div class="menu-btn-show">
            <span class="border-style"></span>
            <span class="border-style"></span>
            <span class="border-style"></span>
        </div>
    </div>
    <div class="menu_pc">
        <div class="container">

            <div class="menu_main">
                 <?= App\Http\Controllers\Widget\AllWidgetController::getDataWidget('view',2);?>
            </div>
        </div>
    </div>
</header>