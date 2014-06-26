<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Группы товаров</span></h1>
    <div class='innerContent'>
        <div class="itemNews">
            <table>
                <tr>
                    <td><span style="width: 202px;">id</span></td>
                    <td><span class="width_40">Название</span></td>                    
                <tr>
            </table>
        </div>
        <div style="overflow-x:hidden; overflow-y:scroll; height: 600px;">
            <?$i=0;?>
            <? foreach ($objects as $object):?>
                <form name="myform_<?=$i?>"<?$i++?>  method="POST" action="/admin/group/edit/<?=$object->id;?>">
                    <div class="itemNews" style="position: relative;">
                        <span style="width: 200px;"><?=$object->id;?></span>
                        <input type="text" name="name" value="<?=$object->name;?>" style="width: 200px;" />
                        <input type="submit" value="Сохранить" style="position: absolute;right: 1px;top: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">
                        <a href="/admin/group/delete/<?=$object->id;?>" style="display: block;position: absolute;right: 1px;bottom: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">Удалить</a>
                    </div>
                </form>
            <? endforeach; ?>
        </div>
    </div>
    <!--End innerContent-->

    <div style="height: 35px">
        <div style="margin: 0 auto; width:400px;">
            <?//=$pagination;?>
        </div>
    </div>
</div>
