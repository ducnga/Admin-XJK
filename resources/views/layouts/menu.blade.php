<div class="menu">
    <nav class="header_menu">
        <div class="container" style="width: 100%;">
            <div id="cssmenu">
                @php
                    $data=App\Models\Category::select('id','ParentID','Alias','Name','Type','IsActive','Level','Icon')->where([['IsActive','=',1]])->orderBy('Idx')->get()->ToArray();
                    subMenu($data,0,$root);
                @endphp
            </div>
        </div>
    </nav>
</div>