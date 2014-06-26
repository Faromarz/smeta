<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Группы товаров</span></h1>
    <div class='innerContent'>
        <div class="itemNews">
            <table style="width: 500px">
                <tr>
                    <td><span style="width: 202px;">№</span></td>
                    <td><span style="width: 202px;" class="width_40">Название</span></td>                    
                    <td><span class="">Формулы</span></td>                    
                <tr>
            </table>
        </div>
        <div style="overflow-x:hidden; overflow-y:scroll; height: 600px;">
            <?/*$i=0;?>
            <? foreach ($objects as $object):?>
                <form name="myform_<?=$i?>"<?$i++?>  method="POST" action="/admin/groups/edit/<?=$object->id;?>">
                    <div class="itemNews" style="position: relative;">
                        <span style="width: 200px;"><?=$object->id;?></span>
                        <input type="text" name="name" value="<?=$object->name;?>" style="width: 200px;" />
                        <select name="price">
                            <option value=''<?if(empty($object->price)):?> selected<?  endif;?>>Нет формулы цены/или не используется</option>
                            <!--<option value='сount_rom'<?if($object->price == 'сount_rom'):?> selected<?  endif;?>>Количество комнат</option>-->
                            <option value='P_1_2_3'<?if($object->price == 'P_1_2_3'):?> selected<?  endif;?>>Периметр комнат 1-3</option>
                            <option value='S_room'<?if($object->price == 'S_room'):?> selected<?  endif;?>>S комнат</option>
                            <option value='S_SD_05'<?if($object->price == 'S_SD_05'):?> selected<?  endif;?>>S стен + S пола - S двери - 0.5(!)</option>
                            <option value='S_spec'<?if($object->price == 'S_spec'):?> selected<?  endif;?>>S плитка для кухни(!)</option>
                            <option value='return_1'<?if($object->price == 'return_1'):?> selected<?  endif;?>> 1 шт.</option>
                            <option value='door_count'<?if($object->price == 'door_count'):?> selected<?  endif;?>> Количество дверей</option>
                            <option value='door_count_ru'<?if($object->price == 'door_count_ru'):?> selected<?  endif;?>> Количество дверей для ручек/петли</option>
                            <option value='door_count_zam'<?if($object->price == 'door_count_zam'):?> selected<?  endif;?>> Количество дверей для замков/накдалки/целиндры</option>
                            <option value='oboi'<?if($object->price == 'oboi'):?> selected<?  endif;?>> Обои (!)</option>
                            <option value='kley_plit'<?if($object->price == 'kley_plit'):?> selected<?  endif;?>> Клей для плитки (!)</option>
                            <option value='kley_oboi'<?if($object->price == 'kley_oboi'):?> selected<?  endif;?>> Клей для обоев (!)</option>
                            <option value='zatir'<?if($object->price == 'zatir'):?> selected<?  endif;?>> Затирка (!)</option>
                            <option value='window'<?if($object->price == 'window'):?> selected<?  endif;?>> Окна (!)</option>
                        </select>
                        <input type="submit" value="Сохранить" style="position: absolute;right: 1px;top: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">
                        <a href="/admin/groups/delete/<?=$object->id;?>" style="display: block;position: absolute;right: 1px;bottom: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">Удалить</a>
                    </div>
                </form>
            <? endforeach;*/ ?>
        </div>
    </div>
    <!--End innerContent-->

    <div style="height: 35px">
        <div style="margin: 0 auto; width:400px;">
            <?//=$pagination;?>
        </div>
    </div>
</div>
