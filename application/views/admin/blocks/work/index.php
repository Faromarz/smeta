<?if(empty($_FILES['work']['name'])):?> 
<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
<?  endif;?>
    <h1><span>Демонтажные работы</span></h1>
    <table class='act' width="100%" style="text-align: center;">
        <tr>
            <td style="vertical-align: top;width: 2%;">
                <div class="inputBlock"><h3 class="input">№ <br>п/п</h3></div>
            </td>
            <td style="vertical-align: top;width: 13%;">
                <div class="inputBlock"><h3 class="input">Название</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%">
                <div class="inputBlock"><h3 class="input">Часы</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%">
                <div class="inputBlock"><h3 class="input">Ед. изм.</h3></div>
            </td>
            <td style="vertical-align: top;width: 8%">
                <div class="inputBlock"><h3 class="input">Категория</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%;">
                <div class="inputBlock"><h3 class="input">Нв./Вт</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%;">
                <div class="inputBlock"><h3 class="input">Цена стандарт</h3></div>
            </td>
            <td style="vertical-align: top;width: 7%;">
                <div class="inputBlock"><h3 class="input">Категории2</h3></div>
            </td>
            <td style="vertical-align: top;width: 13%;">
                <div class="inputBlock"><h3 class="input">Формулы</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Комната</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Косметический</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Капитальный</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Кнопки</h3></div>
            </td>
        </tr>
    </table>
    <?$i=0;?>
    <? foreach ($objects as $object): $object = (object)$object;?>
             <?if($object->type == 0):?>
                    <?++$i?>
                    <form <?if($object->id==0):?>id="dem_del_<?=$i?>"<?  endif;?> action="/admin/work/demontedit/<?=$object->id;?>" method="POST" enctype="multipart/form-data">
                        <table  class='act'  width="100%" style="text-align: center;<?if(isset($object->color)):?> background-color: #<?=$object->color?>;<?  endif;?>">
                             <tr>
                                  <td style="vertical-align: top;width: 2%;">
                                    <div class="inputBlock">
                                        <?=$i?>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 13%;">
                                    <div class="inputBlock">
                                        <textarea style="height: 50px;" name="name"><?=htmlspecialchars($object->name);?></textarea>
                                        <input name="type" type="hidden" value="<?=$object->type?>" >
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">
                                    <div class="inputBlock">
                                        <input type="text" style="text-align: right;width: 50px;float: none" name="watch" value="<?=htmlspecialchars($object->watch);?>">
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">
                                    <div class="inputBlock">
                                        <input type="text" style="text-align: right;width: 50px;float: none" name="unit" value="<?=htmlspecialchars(str_replace(array('<sup>','</sup>'), '', $object->unit));?>">
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">  
                                    <div class="inputBlock">
                                         <select name="categor_arr[]" multiple  style="float: none;height: 88px;">
                                            <option value=""<?if(empty($object->categor_arr)):?> selected<?  endif;?>>Все</option>
                                            <?  foreach ($categories as $val):?>
                                            <option value="<?=$val->id?>" <?if(in_array($val->id,  explode(',',$object->categor_arr))):?> selected<?  endif;?>><?=$val->type_name?></option>
                                            <?  endforeach;?>
                                            <option value="Линолеум"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 1):?> selected<?  endif;?>>Линолеум</option>
                                            <option value="Ламинат"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 2):?> selected<?  endif;?>>Ламинат</option>
                                            <option value="Паркет"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 5):?> selected<?  endif;?>>Паркет</option>
                                            <option value="Массив"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 6):?> selected<?  endif;?>>Массив</option>
                                            <option value="Модули"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 7):?> selected<?  endif;?>>Модули</option>
                                            <option value="Плитка напольная"<?if($val->id == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 3):?> selected<?  endif;?>>Плитка напольная</option>

                                            <option value="Виниловые"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 2):?> selected<?  endif;?>>Виниловые</option>
                                            <option value="Флизелиновые"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr =='1'):?> selected<?  endif;?>>Флизелиновые</option>
                                            <option value="Текстильные"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 3):?> selected<?  endif;?>>Текстильные</option>
                                            <option value="Флоковые"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 4):?> selected<?  endif;?>>Флоковые</option>
                                            <option value="Натуральные"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 5):?> selected<?  endif;?>>Натуральные</option>
                                            <option value="Бумажные"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 6):?> selected<?  endif;?>>Бумажные</option>
                                            <option value="Плитка настенна"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 7):?> selected<?  endif;?>>Плитка настенная</option>

                                        </select>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">   
                                    <div class="inputBlock">
                                        <?if($object->nv_vt ==2)$object->nv_vt = NULL;?>
                                         <input name="nv_vt" id="nv_vt" type="hidden" value="<?=$object->nv_vt;?>" >
                                        <ul class="nv_vt">
                                            <li data-id="0"<?if(empty($object->nv_vt)):?> class="activ"<?  endif;?>>Нв</li>
                                            <li data-id="1"<?if($object->nv_vt == 1 || $object->nv_vt === NULL):?> class="activ"<?  endif;?>>Вт</li>
                                        <ul>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">   
                                    <div class="inputBlock">
                                        <input style="text-align: right;width: 50px;float: none" name="price" type="text" value="<?=$object->price;?>" >
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 7%;">   
                                    <div class="inputBlock">
                                        <input name="work_cat" id="work_cat" type="hidden" value="<?=$object->work_cat;?>" >
                                        <ul class="work_cat">
                                            <li data-id="1"<?if($object->work_cat == 1):?> class="activ"<?  endif;?>>Стены</li>
                                            <li data-id="2"<?if($object->work_cat == 2):?> class="activ"<?  endif;?>>Пол</li>
                                            <li data-id="3"<?if($object->work_cat == 3):?> class="activ"<?  endif;?>>Потолок</li>
                                            <li data-id="4"<?if($object->work_cat == 4):?> class="activ"<?  endif;?>>Электрика</li>
                                            <li data-id="5"<?if($object->work_cat == 5):?> class="activ"<?  endif;?>>Сантехника</li>
                                            <li data-id="6"<?if($object->work_cat == 6):?> class="activ"<?  endif;?>>Двери и Окна</li>
                                            <li data-id="7"<?if($object->work_cat == 7):?> class="activ"<?  endif;?>>Прочие работы</li>
                                        <ul>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 13%;">           
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" cellspacing="1.5">
                                            <tr style="height:17px;">
                                                <? $strpos =  strripos($object->count,'S');?>
                                                <td data-form="S" class="form<?if($strpos !== false):?> activ<?  endif;?>">Площадь пола</td>
                                                <? $strpos =  strripos($object->count,'*');?>
                                                <td data-form="*" width="25px" rowspan="3" style="vertical-align: middle;" class="znak<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>*</span>
                                                </td>
                                                <? $strpos =  strripos($object->count,'0')?>
                                                <td data-form="0" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>0</span>
                                                </td>
                                                <td rowspan="6" width="50px" style="vertical-align: middle">
                                                     <input style="text-align: center;width: 50px;float: none" class="count_form" name="count" type="text" value="<?=$object->count;?>" />
                                                </td>
                                            </tr>
                                            <tr style="height:17px;">
                                                 <? $strpos =  strncasecmp('PW', $object->count, 2);?>
                                                <td data-form="PW" class="form<?if($strpos == 0):?> activ<?  endif;?>"><span>Площадь стен</span></td>

                                                <? $strpos =  strripos($object->count,'1')?>
                                                <td data-form="1" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>1</span>
                                                </td>
                                            </tr>
                                            <tr style="height:15px;">
                                                <? $strpos =  strncmp('C', $object->count,1);?>
                                                <td data-form="C" class="form<?if($strpos == 0 && strncasecmp('CW', $object->count, 2) != 0 && strncasecmp('CD', $object->count, 2) != 0):?> activ<?  endif;?>"><span>Количество комнат</span></td>
                                                <? $strpos =  strripos($object->count,'2')?>
                                                <td data-form="2" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>2</span>
                                                </td>
                                            </tr>
                                            <tr style="height:17px;">
                                                <? $strpos =  strncasecmp('CD', $object->count,2);?>
                                                <td data-form="CD" class="form<?if($strpos == 0):?> activ<?  endif;?>"><span>Количество дверей</span></td>
                                                 <? $strpos =  strripos($object->count,'/')?>
                                                 <td data-form="/"  width="25px" rowspan="3" style="vertical-align: middle;" class="znak<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>/</span>
                                                </td>
                                                <? $strpos =  strripos($object->count,'3')?>
                                                <td data-form="3" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>3</span>
                                                </td>
                                            </tr>
                                            <tr  style="height:17px;">
                                                <? $strpos =  strncasecmp('CW', $object->count, 2);?>
                                                <td data-form="CW" class="form<?if($strpos == 0):?> activ<?  endif;?>"><span>Количество окон</span></td>
                                                <? $strpos =  strripos($object->count,'4')?>
                                                <td data-form="4" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>4</span>
                                                </td>
                                            </tr>
                                            <tr  style="height:17px;">
                                                <? $strpos =   strncasecmp('P', $object->count, 1);?>
                                                <td data-form="P" class="form<?if($strpos == 0 && strncasecmp('PW', $object->count, 2) != 0):?> activ<?  endif;?>">Периметр</td>

                                                <? $strpos =  strripos($object->count,'5')?>
                                                <td data-form="5" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>5</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>    
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;">
                                            <tr><td><input name="room_id[]" value="1" type="checkbox"<?if(in_array('1', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Комната</td></tr>
                                            <tr><td><input name="room_id[]" value="2" type="checkbox"<?if(in_array('2', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Кухня</td></tr>
                                            <tr><td><input name="room_id[]" value="3" type="checkbox"<?if(in_array('3', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Коридор</td></tr>
                                            <tr><td><input name="room_id[]" value="4" type="checkbox"<?if(in_array('4', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Bанна</td></tr>
                                            <tr><td><input name="room_id[]" value="5" type="checkbox"<?if(in_array('5', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Туалет</td></tr>
                                        </table> 
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" class="cosmetic">
                                            <tr><td><input name="remontType[]" class="remontTypecosmetic" value="calc-remont-group-cosmetic" type="checkbox"<?if(in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Косметический</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-econom,w_d_calc-price-group-econom" type="checkbox"<?if(in_array('calc-price-group-econom', explode(',', $object->remontType)) && in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Эконом</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-business,w_d_calc-price-group-business" type="checkbox"<?if(in_array('calc-price-group-business', explode(',', $object->remontType)) && in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Стандарт</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-premium,w_d_calc-price-group-premium" type="checkbox"<?if(in_array('calc-price-group-premium', explode(',', $object->remontType)) && in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Премиум</td></tr>
                                        </table>  
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" class="capital">
                                            <tr><td><input name="remontTypeDef[]" class="remontTypecapital" value="calc-remont-group-capital" type="checkbox"<?if(in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Капитальный</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-econom,w_d_calc-price-group-econom" type="checkbox"<?if(in_array('calc-price-group-econom', explode(',', $object->remontTypeDef))&& in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Эконом</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-business,w_d_calc-price-group-business" type="checkbox"<?if(in_array('calc-price-group-business', explode(',', $object->remontTypeDef)) && in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Стандарт</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-premium,w_d_calc-price-group-premium" type="checkbox"<?if(in_array('calc-price-group-premium', explode(',', $object->remontTypeDef)) && in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Премиум</td></tr>
                                        </table> 
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">  
                                    <div class="inputBlock">
                                        <?=  Form::submit('', 'Сохранить', array('class' => 'm inp',  'style'=>"margin: 0;float:none"));?>
                                    </div>
                                        <div class="inputBlock"><div class="input">
                                            <a <?if($object->id==0):?>onClick="$('#dem_del_<?=$i?>').remove();"<?else:?>href="/admin/work/delete/<?=$object->id;?>"<?  endif;?> class ='m' style="margin: 0 auto;float:none">
                                                Удалить
                                            </a>
                                        </div></div>
                                </td>
                            </tr>
                        </table>
                    </form>
            <?  endif;?>
        <? endforeach; ?>
  
    <h1><span>Монтажные работы</span></h1>
    <table class='act' width="100%" style="text-align: center;">
        <tr>
            <td style="vertical-align: top;width: 2%;">
                <div class="inputBlock"><h3 class="input">№ <br>п/п</h3></div>
            </td>
            <td style="vertical-align: top;width: 13%;">
                <div class="inputBlock"><h3 class="input">Название</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%">
                <div class="inputBlock"><h3 class="input">Часы</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%">
                <div class="inputBlock"><h3 class="input">Ед. изм.</h3></div>
            </td>
            <td style="vertical-align: top;width: 8%">
                <div class="inputBlock"><h3 class="input">Категория</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%;">
                <div class="inputBlock"><h3 class="input">Нв./Вт</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%;">
                <div class="inputBlock"><h3 class="input">Цена стандарт</h3></div>
            </td>
            <td style="vertical-align: top;width: 7%;">
                <div class="inputBlock"><h3 class="input">Категории2</h3></div>
            </td>
            <td style="vertical-align: top;width: 13%;">
                <div class="inputBlock"><h3 class="input">Формулы</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Комната</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Косметический</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Капитальный</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Кнопки</h3></div>
            </td>
        </tr>
    </table>
     <?$i=0;?>
    <? foreach ($objects as $object): $object = (object)$object; ?>
             <?if($object->type == 1):?><?++$i?>
    <form <?if($object->id==0):?>id="mon_del_<?=$i?>"<?  endif;?> action="/admin/work/demontedit/<?=$object->id;?>" method="POST" enctype="multipart/form-data">
                        <table  class='act'  width="100%" style="text-align: center;<?if(isset($object->color)):?> background-color: #<?=$object->color?>;<?  endif;?>">
                             <tr>
                                  <td style="vertical-align: top;width: 2%;">
                                    <div class="inputBlock">
                                        <?=$i?>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 13%;">
                                    <div class="inputBlock">
                                        <textarea style="height: 50px;" name="name"><?=htmlspecialchars($object->name);?></textarea>
                                        <input name="type" type="hidden" value="<?=$object->type?>" >
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">
                                    <div class="inputBlock">
                                        <input type="text" style="text-align: right;width: 50px;float: none" name="watch" value="<?=htmlspecialchars($object->watch);?>">
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">
                                    <div class="inputBlock">
                                        <input type="text" style="text-align: right;width: 50px;float: none" name="unit" value="<?=htmlspecialchars(str_replace(array('<sup>','</sup>'), '', $object->unit));?>">
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">  
                                    <div class="inputBlock">
                                         <select name="categor_arr[]" multiple  style="float: none;height: 88px;">
                                            <option value=""<?if(empty($object->categor_arr)):?> selected<?  endif;?>>Все</option>
                                            <?  foreach ($categories as $val):?>
                                            <option value="<?=$val->id?>" <?if(in_array($val->id,  explode(',',$object->categor_arr))):?> selected<?  endif;?>><?=$val->type_name?></option>
                                            <?  endforeach;?>
                                            <option value="Линолеум"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 1):?> selected<?  endif;?>>Линолеум</option>
                                            <option value="Ламинат"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 2):?> selected<?  endif;?>>Ламинат</option>
                                           <option value="Паркет"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 5):?> selected<?  endif;?>>Паркет</option>
                                            <option value="Массив"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 6):?> selected<?  endif;?>>Массив</option>
                                            <option value="Модули"<?if($object->categor_arr == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 7):?> selected<?  endif;?>>Модули</option>
                                            <option value="Плитка напольная"<?if($val->id == 32 && !empty($object->podceteg_arr) && $object->podceteg_arr == 3):?> selected<?  endif;?>>Плитка напольная</option>

                                            <option value="Виниловые"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 2):?> selected<?  endif;?>>Виниловые</option>
                                            <option value="Флизелиновые"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr =='1'):?> selected<?  endif;?>>Флизелиновые</option>
                                            <option value="Текстильные"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 3):?> selected<?  endif;?>>Текстильные</option>
                                            <option value="Флоковые"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 4):?> selected<?  endif;?>>Флоковые</option>
                                            <option value="Натуральные"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 5):?> selected<?  endif;?>>Натуральные</option>
                                            <option value="Бумажные"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 6):?> selected<?  endif;?>>Бумажные</option>
                                            <option value="Плитка настенна"<?if($object->categor_arr == 13 && !empty($object->podceteg_arr) && $object->podceteg_arr == 7):?> selected<?  endif;?>>Плитка настенная</option>

                                        </select>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">   
                                    <div class="inputBlock">
                                        <?if($object->nv_vt ==2)$object->nv_vt = NULL;?>
                                         <input name="nv_vt" id="nv_vt" type="hidden" value="<?=$object->nv_vt;?>" >
                                        <ul class="nv_vt">
                                            <li data-id="0"<?if(empty($object->nv_vt)):?> class="activ"<?  endif;?>>Нв</li>
                                            <li data-id="1"<?if($object->nv_vt == 1 || $object->nv_vt === NULL):?> class="activ"<?  endif;?>>Вт</li>
                                        <ul>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">   
                                    <div class="inputBlock">
                                        <input style="text-align: right;width: 50px;float: none" name="price" type="text" value="<?=$object->price;?>" >
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 7%;">   
                                    <div class="inputBlock">
                                        <input name="work_cat" id="work_cat" type="hidden" value="<?=$object->work_cat;?>" >
                                        <ul class="work_cat">
                                            <li data-id="1"<?if($object->work_cat == 1):?> class="activ"<?  endif;?>>Стены</li>
                                            <li data-id="2"<?if($object->work_cat == 2):?> class="activ"<?  endif;?>>Пол</li>
                                            <li data-id="3"<?if($object->work_cat == 3):?> class="activ"<?  endif;?>>Потолок</li>
                                            <li data-id="4"<?if($object->work_cat == 4):?> class="activ"<?  endif;?>>Электрика</li>
                                            <li data-id="5"<?if($object->work_cat == 5):?> class="activ"<?  endif;?>>Сантехника</li>
                                            <li data-id="6"<?if($object->work_cat == 6):?> class="activ"<?  endif;?>>Двери и Окна</li>
                                            <li data-id="7"<?if($object->work_cat == 7):?> class="activ"<?  endif;?>>Прочие работы</li>
                                        <ul>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 13%;">           
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" cellspacing="1.5">
                                            <tr style="height:17px;">
                                                <? $strpos =  strripos($object->count,'S');?>
                                                <td data-form="S" class="form<?if($strpos !== false):?> activ<?  endif;?>">Площадь пола</td>
                                                <? $strpos =  strripos($object->count,'*');?>
                                                <td data-form="*" width="25px" rowspan="3" style="vertical-align: middle;" class="znak<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>*</span>
                                                </td>
                                                <? $strpos =  strripos($object->count,'0')?>
                                                <td data-form="0" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>0</span>
                                                </td>
                                                <td rowspan="6" width="50px" style="vertical-align: middle">
                                                     <input style="text-align: center;width: 50px;float: none" class="count_form" name="count" type="text" value="<?=$object->count;?>" />
                                                </td>
                                            </tr>
                                            <tr style="height:17px;">
                                                 <? $strpos =  strncasecmp('PW', $object->count, 2);?>
                                                <td data-form="PW" class="form<?if($strpos == 0):?> activ<?  endif;?>"><span>Площадь стен</span></td>

                                                <? $strpos =  strripos($object->count,'1')?>
                                                <td data-form="1" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>1</span>
                                                </td>
                                            </tr>
                                            <tr style="height:15px;">
                                                <? $strpos =  strncmp('C', $object->count,1);?>
                                                <td data-form="C" class="form<?if($strpos == 0 && strncasecmp('CW', $object->count, 2) != 0 && strncasecmp('CD', $object->count, 2) != 0):?> activ<?  endif;?>"><span>Количество комнат</span></td>
                                                <? $strpos =  strripos($object->count,'2')?>
                                                <td data-form="2" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>2</span>
                                                </td>
                                            </tr>
                                            <tr style="height:17px;">
                                                <? $strpos =  strncasecmp('CD', $object->count,2);?>
                                                <td data-form="CD" class="form<?if($strpos == 0):?> activ<?  endif;?>"><span>Количество дверей</span></td>
                                                 <? $strpos =  strripos($object->count,'/')?>
                                                 <td data-form="/"  width="25px" rowspan="3" style="vertical-align: middle;" class="znak<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>/</span>
                                                </td>
                                                <? $strpos =  strripos($object->count,'3')?>
                                                <td data-form="3" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>3</span>
                                                </td>
                                            </tr>
                                            <tr  style="height:17px;">
                                                <? $strpos =  strncasecmp('CW', $object->count, 2);?>
                                                <td data-form="CW" class="form<?if($strpos == 0):?> activ<?  endif;?>"><span>Количество окон</span></td>
                                                <? $strpos =  strripos($object->count,'4')?>
                                                <td data-form="4" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>4</span>
                                                </td>
                                            </tr>
                                            <tr  style="height:17px;">
                                                <? $strpos =   strncasecmp('P', $object->count, 1);?>
                                                <td data-form="P" class="form<?if($strpos == 0 && strncasecmp('PW', $object->count, 2) != 0):?> activ<?  endif;?>">Периметр</td>

                                                <? $strpos =  strripos($object->count,'5')?>
                                                <td data-form="5" width="50px" style="vertical-align: middle;" class="num<?if($strpos !== false):?> activ<?  endif;?>">
                                                    <span>5</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>    
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;">
                                            <tr><td><input name="room_id[]" value="1" type="checkbox"<?if(in_array('1', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Комната</td></tr>
                                            <tr><td><input name="room_id[]" value="2" type="checkbox"<?if(in_array('2', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Кухня</td></tr>
                                            <tr><td><input name="room_id[]" value="3" type="checkbox"<?if(in_array('3', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Коридор</td></tr>
                                            <tr><td><input name="room_id[]" value="4" type="checkbox"<?if(in_array('4', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Bанна</td></tr>
                                            <tr><td><input name="room_id[]" value="5" type="checkbox"<?if(in_array('5', explode(',', $object->room_id)) || empty($object->room_id)):?>  checked<?  endif;?>></td><td>Туалет</td></tr>
                                        </table> 
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" class="cosmetic">
                                            <tr><td><input name="remontType[]" class="remontTypecosmetic" value="calc-remont-group-cosmetic" type="checkbox"<?if(in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Косметический</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-econom,w_d_calc-price-group-econom" type="checkbox"<?if(in_array('calc-price-group-econom', explode(',', $object->remontType)) && in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Эконом</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-business,w_d_calc-price-group-business" type="checkbox"<?if(in_array('calc-price-group-business', explode(',', $object->remontType)) && in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Стандарт</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-premium,w_d_calc-price-group-premium" type="checkbox"<?if(in_array('calc-price-group-premium', explode(',', $object->remontType)) && in_array('calc-remont-group-cosmetic', explode(',', $object->remontType))):?>  checked="checked"<?  endif;?>></td><td>Премиум</td></tr>
                                        </table>  
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" class="capital">
                                            <tr><td><input name="remontTypeDef[]" class="remontTypecapital" value="calc-remont-group-capital" type="checkbox"<?if(in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Капитальный</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-econom,w_d_calc-price-group-econom" type="checkbox"<?if(in_array('calc-price-group-econom', explode(',', $object->remontTypeDef))&& in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Эконом</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-business,w_d_calc-price-group-business" type="checkbox"<?if(in_array('calc-price-group-business', explode(',', $object->remontTypeDef)) && in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Стандарт</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-premium,w_d_calc-price-group-premium" type="checkbox"<?if(in_array('calc-price-group-premium', explode(',', $object->remontTypeDef)) && in_array('calc-remont-group-capital', explode(',', $object->remontTypeDef))):?>  checked="checked"<?  endif;?>></td><td>Премиум</td></tr>
                                        </table> 
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">  
                                    <div class="inputBlock">
                                        <?=FORM::submit('', 'Сохранить', array('class' => 'm inp',  'style'=>"margin: 0;float:none"));?>
                                    </div>
                                        <div class="inputBlock"><div class="input">
                                                <a <?if($object->id==0):?>onClick="$('#mon_del_<?=$i?>').remove();"<?else:?>href="/admin/work/delete/<?=$object->id;?>"<?  endif;?> class ='m' style="margin: 0 auto;float:none">
                                                Удалить
                                            </a>
                                        </div></div>
                                </td>
                            </tr>
                        </table>
                    </form>
            <?  endif;?>
        <? endforeach; ?>
     <?if(empty($_FILES['work']['name'])):?> 
    <h1><span>Добавить работу</span></h1>
    <table class='act' width="100%" style="text-align: center;">
        <tr>
            <td style="vertical-align: top;width: 5%;">
                <div class="inputBlock"><h3 class="input">Тип</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Название</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%">
                <div class="inputBlock"><h3 class="input">Часы</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%">
                <div class="inputBlock"><h3 class="input">Ед. изм.</h3></div>
            </td>
            <td style="vertical-align: top;width: 8%">
                <div class="inputBlock"><h3 class="input">Категория</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%;">
                <div class="inputBlock"><h3 class="input">Нв./Вт</h3></div>
            </td>
            <td style="vertical-align: top;width: 5%;">
                <div class="inputBlock"><h3 class="input">Цена стандарт</h3></div>
            </td>
            <td style="vertical-align: top;width: 7%;">
                <div class="inputBlock"><h3 class="input">Категории2</h3></div>
            </td>
            <td style="vertical-align: top;width: 13%;">
                <div class="inputBlock"><h3 class="input">Формулы</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Комната</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Косметический</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Капитальный</h3></div>
            </td>
            <td style="vertical-align: top;width: 10%;">
                <div class="inputBlock"><h3 class="input">Кнопки</h3></div>
            </td>
        </tr>
    </table>
    <form action="/admin/work/edit/0" method="POST" enctype="multipart/form-data">
                        <table  class='act'  width="100%" style="text-align: center;">
                             <tr>
                                  <td style="vertical-align: top;width: 2%;">
                                    <div class="inputBlock">
                                        <input type="radio" name="type" value="0"> Демонтажная<br>
                                        <input type="radio" name="type" value="1"> Монтажная
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 13%;">
                                    <div class="inputBlock">
                                        <textarea style="height: 50px;" name="name"></textarea>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">
                                    <div class="inputBlock">
                                        <input type="text" style="text-align: right;width: 50px;float: none" name="watch" value="">
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">
                                    <div class="inputBlock">
                                        <input type="text" style="text-align: right;width: 50px;float: none" name="unit" value="">
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">  
                                    <div class="inputBlock">
                                         <select name="categor_arr[]" multiple  style="float: none;height: 88px;">
                                            <option value="" selected>Все</option>
                                            <?  foreach ($categories as $val):?>
                                            <option value="<?=$val->id?>"><?=$val->type_name?></option>
                                            <?  endforeach;?>
                                            <option value="Линолеум">Линолеум</option>
                                            <option value="Ламинат">Ламинат</option>
                                            <option value="Паркет">Паркет</option>
                                            <option value="Массив">Массив</option>
                                            <option value="Модули">Модули</option>
                                            <option value="Плитка напольная">Плитка напольная</option>

                                            <option value="Виниловые">Виниловые</option>
                                            <option value="Флизелиновые">Флизелиновые</option>
                                            <option value="Текстильные">Текстильные</option>
                                            <option value="Флоковые">Флоковые</option>
                                            <option value="Натуральные">Натуральные</option>
                                            <option value="Бумажные">Бумажные</option>
                                            <option value="Плитка настенна">Плитка настенная</option>

                                        </select>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">   
                                    <div class="inputBlock">
                                        
                                         <input name="nv_vt" id="nv_vt" type="hidden" value="" >
                                        <ul class="nv_vt">
                                            <li data-id="0" class="activ">Нв</li>
                                            <li data-id="1" class="activ">Вт</li>
                                        <ul>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 5%;">   
                                    <div class="inputBlock">
                                        <input style="text-align: right;width: 50px;float: none" name="price" type="text" value="" >
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 7%;">   
                                    <div class="inputBlock">
                                        <input name="work_cat" id="work_cat" type="hidden" value="" >
                                        <ul class="work_cat">
                                            <li data-id="1">Стены</li>
                                            <li data-id="2">Пол</li>
                                            <li data-id="3">Потолок</li>
                                            <li data-id="4">Электрика</li>
                                            <li data-id="5">Сантехника</li>
                                            <li data-id="6">Двери и Окна</li>
                                            <li data-id="7">Прочие работы</li>
                                        <ul>
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 13%;">           
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" cellspacing="1.5">
                                            <tr style="height:17px;">
                                                <td data-form="S" class="form">Площадь пола</td>
                                                <td data-form="*" width="25px" rowspan="3" style="vertical-align: middle;" class="znak">
                                                    <span>*</span>
                                                </td>
                                                <td data-form="0" width="50px" style="vertical-align: middle;" class="num">
                                                    <span>0</span>
                                                </td>
                                                <td rowspan="6" width="50px" style="vertical-align: middle">
                                                     <input style="text-align: center;width: 50px;float: none" class="count_form" name="count" type="text" value="" />
                                                </td>
                                            </tr>
                                            <tr style="height:17px;">
                                                <td data-form="PW" class="form"><span>Площадь стен</span></td>
                                                <td data-form="1" width="50px" style="vertical-align: middle;" class="num">
                                                    <span>1</span>
                                                </td>
                                            </tr>
                                            <tr style="height:15px;">
                                                <td data-form="C" class="form"><span>Количество комнат</span></td>
                                                <? $strpos =  strripos($object->count,'2')?>
                                                <td data-form="2" width="50px" style="vertical-align: middle;" class="num">
                                                    <span>2</span>
                                                </td>
                                            </tr>
                                            <tr style="height:17px;">
                                                <td data-form="CD" class="form"><span>Количество дверей</span></td>
                                                 <td data-form="/"  width="25px" rowspan="3" style="vertical-align: middle;" class="znak">
                                                    <span>/</span>
                                                </td>
                                                <td data-form="3" width="50px" style="vertical-align: middle;" class="num">
                                                    <span>3</span>
                                                </td>
                                            </tr>
                                            <tr  style="height:17px;">
                                                <td data-form="CW" class="form"><span>Количество окон</span></td>
                                                <td data-form="4" width="50px" style="vertical-align: middle;" class="num">
                                                    <span>4</span>
                                                </td>
                                            </tr>
                                            <tr  style="height:17px;">
                                                <td data-form="P" class="form">Периметр</td>
                                                <td data-form="5" width="50px" style="vertical-align: middle;" class="num">
                                                    <span>5</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>    
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;">
                                            <tr><td><input name="room_id[]" value="1" type="checkbox"></td><td>Комната</td></tr>
                                            <tr><td><input name="room_id[]" value="2" type="checkbox"></td><td>Кухня</td></tr>
                                            <tr><td><input name="room_id[]" value="3" type="checkbox"></td><td>Коридор</td></tr>
                                            <tr><td><input name="room_id[]" value="4" type="checkbox"></td><td>Bанна</td></tr>
                                            <tr><td><input name="room_id[]" value="5" type="checkbox"></td><td>Туалет</td></tr>
                                        </table> 
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" class="cosmetic">
                                            <tr><td><input name="remontType[]" class="remontTypecosmetic" value="calc-remont-group-cosmetic" type="checkbox"></td><td>Косметический</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-econom,w_d_calc-price-group-econom" type="checkbox"></td><td>Эконом</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-business,w_d_calc-price-group-business" type="checkbox"></td><td>Стандарт</td></tr>
                                            <tr><td><input name="remontType[]" class="child" value="calc-price-group-premium,w_d_calc-price-group-premium" type="checkbox"></td><td>Премиум</td></tr>
                                        </table>  
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">
                                    <div class="inputBlock">
                                        <table style="margin: 0 auto;" class="capital">
                                            <tr><td><input name="remontTypeDef[]" class="remontTypecapital" value="calc-remont-group-capital" type="checkbox"<></td><td>Капитальный</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-econom,w_d_calc-price-group-econom" type="checkbox"></td><td>Эконом</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-business,w_d_calc-price-group-business" type="checkbox"></td><td>Стандарт</td></tr>
                                            <tr><td><input name="remontTypeDef[]" class="child" value="calc-price-group-premium,w_d_calc-price-group-premium" type="checkbox"></td><td>Премиум</td></tr>
                                        </table> 
                                    </div>
                                </td>
                                <td style="vertical-align: top;width: 10%;">  
                                    <div class="inputBlock">
                                        <?=  Form::submit('', 'Добавить', array('class' => 'm inp',  'style'=>"margin: 0;float:none"));?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
 

            <?//=$pagination;?>
</div>
<?  endif;?>



