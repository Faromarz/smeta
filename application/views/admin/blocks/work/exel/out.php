<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <?if(isset($typ)):?><h1><span><? if($typ == 1):?>Монтажные работы<?else:?>Демонтажные работы<?  endif;?></span></h1><?  endif;?>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="work" value="" />
        <br><input type="submit" value="Загрузить" style="float: left;margin-left: 20px;" />
    </form>
</div>