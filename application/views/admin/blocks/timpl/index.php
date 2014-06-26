<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Работы с потолком</span></h1>

    <div class='innerContent'>
        <div class="itemNews">
            <table>
                <tr>
                    <td>
            <span style="width: 202px;">Название</span>
                    </td>
                    <td>
            <span class="width_40">Мате-риалы</span>
                    </td>
                    <td>
            <span class="width_40">Вырав-нивание<br> потолка</span>
                    </td>
                    <td>
            <span class="width_40">Штука-турка<br> потолка</span>
                    </td>
                    <td>
            <span class="width_40">Окраска<br> потолка</span>
                    </td>
                    <td>
            <span class="width_40">Устано-вка<br> потолка</span>
                    </td>
                    <td>
            <span class="width_40">Устано-вка<br> освеще-ния</span>
                    </td>
                    <td>
            <span class="width_40">Цена<br> ИТОГО</span>
                    </td>
                    <td>
            <span style="width: 95px;">Короткое<br> описание</span>
                    </td>
                    <td>
            <span style="width: 89px;">Полное<br> описание</span>
                    </td>
                    <td>
            <span style="width: 56px;">Название<br> картинки</span>
                    </td>
                    <td>
            <span>Страна<br> произво-дитель</span>
                    </td>
                    <td>
            <span>Кол-во уровней</span>
                    </td>
                    <td>
            <span>Шумоизо-ляция</span>
                    </td>
                    <td>
            <span style="border: none;">Освещение</span>
                    </td>
                <tr>
            </table>
        </div>
        <div style="overflow-x:hidden; overflow-y:scroll; height: 600px;">
            <?$i=0;?>
        <? foreach ($objects as $object):?>
            <form name="myform_<?=$i?>"<?$i++?>  method="POST" action="/admin/timpl">
        <div class="itemNews" style="position: relative;">
                <input type="hidden" name="id" value="<?=$object->id;?>" />
                <input type="text" name="name" value="<?=$object->name;?>" style="width: 200px;" />
                <input type="text" name="material" value="<?=$object->material;?>" class="width_40" id="material_<?=$object->id?>" onblur="sum_all(this, <?=$object->id?>);"/>
                <input type="text" name="vurav" value="<?=$object->vurav;?>" class="width_40" id="vurav_<?=$object->id?>" onblur="sum_all(this, <?=$object->id?>);"/>
                <input type="text" name="chtycat" value="<?=$object->chtycat;?>" class="width_40" id="chtycat_<?=$object->id?>" onblur="sum_all(this, <?=$object->id?>);"/>
                <input type="text" name="okras" value="<?=$object->okras;?>" class="width_40" id="okras_<?=$object->id?>" onblur="sum_all(this, <?=$object->id?>);"/>
                <input type="text" name="ystan_t" value="<?=$object->ystan_t;?>" class="width_40" id="ystan_t_<?=$object->id?>" onblur="sum_all(this, <?=$object->id?>);"/>
                <input type="text" name="ystan_osv" value="<?=$object->ystan_osv;?>" class="width_40" id="ystan_osv_<?=$object->id?>" onblur="sum_all(this, <?=$object->id?>);"/>
                <input type="text" name="price" value="<?=$object->price;?>" class="width_40" id="price_<?=$object->id?>" onblur="sum_all(this, <?=$object->id?>);"/>
                <textarea name="description" style="width: 80px;"><?=htmlspecialchars($object->description);?></textarea>
                <textarea name="attr" style="width: 80px;"><?=htmlspecialchars($object->attr);?></textarea>
                <img alt="" src="/resources/images/products/<?=$object->image?>" width="50" style="max-height: 50px;" />
                <input type="text" name="co" value="<?=htmlspecialchars($object->co);?>" style="width: 80px;" />
                <input type="text" name="ordertable" value="<?=htmlspecialchars($object->ordertable);?>" style="width: 80px;" />
                <input type="text" name="dl" value="<?=htmlspecialchars($object->dl);?>" style="width: 80px;" />
                <input type="text" name="shr" value="<?=htmlspecialchars($object->shr);?>" style="width: 80px;" />
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
