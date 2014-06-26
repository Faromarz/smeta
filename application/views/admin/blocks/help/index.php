<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Подсказки</span></h1>

    <div class='innerContent'>
        <div class="itemNews">
            <table>
                <tr>
                    <td>
            <span style="width: 20px;">№</span>
                    </td>
                    <td>
            <span  style="width: 120px;">Идентификатор</span>
                    </td>
                    <td>
            <span style="width:300px">Подсказка</span>
                    </td>
                  
                <tr>
            </table>
        </div>
        <div style="overflow-x:hidden; overflow-y:scroll; height: 600px;">
            <?$i=0;?>
        <? foreach ($objects as $object):?>
            <form name="myform_<?=$i?>"<?$i++?>  method="POST" action="/admin/helps">
                <input type="hidden" name="id" value="<?=$object->id;?>" />
            <div class="itemNews" style="position: relative;">
                <table>
                    <tr>
                        <td>
                             <span  style="width: 20px;"><?=$object->id;?></span>
                        </td>
                        <td>
                            <span style="width: 120px;"><input type="text" name="alias" value="<?=$object->alias;?>" style="width: 40px;" /></span>
                        </td>
                        <td>
                            <span  style="width:300px"><textarea style="width:270px" name="text"><?=htmlspecialchars($object->text);?></textarea></span>
                        </td>
               
                    </tr>
                </table>
                <input type="submit" name="save" value="Сохранить" style="position: absolute;right: 1px;top: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">
                <input type="submit" name="del" value="Удалить" style="position: absolute;right: 1px;bottom: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">
            </div>
            </form>

<!--                <p class="specialFunctions">
                    <a class="redact" href="/admin/timpl/edit/<?=$object->id;?>">редактировать</a> |
                    <a class="delete" href="/admin/timpl/delete/<?=$object->id;?>">удалить</a>
                </p>-->
            <!--End .itemNews-->
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
