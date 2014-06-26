<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Партнеры | Человек <input type="text" class="chenge-char-count"  data-id="count_work" value="<?=$count_char->count_work?>" style="width: 20px;height: 16px;text-align: center;"> | Рабочых часов <input class="chenge-char-count" data-id="char_work" type="text" value="<?=$count_char->char_work?>" style="width: 20px;height: 16px;text-align: center;"> | <span id="sav" style="display:none">Сохранено</span></span></h1>
    <div class='innerContent' style="position: relative">
        <div id="CLOS_OPEN" style="position: absolute;top: 50px;left: 50px; font-size: 20px;cursor: pointer;z-index: 10;">
            <span>+ Свернуть</span><span style="display:none">- Развернуть</span>
        </div>
        <table>
            <tr>
                <td style="vertical-align: top;">
                    <div style="float: left;width: 430px;text-align: right;padding-right: 10px;">
                        <div class="inputBlock"><h3 class="input">Название</h3></div>
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                <select class="select_ch" id="main_group" style="width:112px;">
                                    <option value=""<?if(!isset($_GET['group']) || $_GET['group'] == ''):?> selected<?  endif;?>>Все</option>
                                    <? foreach ($groups_filtr as $group):?>
                                        <option value="<?=$group->id?>"<?if($group->id == $_GET['group']):?> selected<?  endif;?>><?=$group->nam?></option>
                                    <?  endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Сегмент рынка</h3>
                        </div>
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                <select class="select_ch" id="main_patrner" style="width:112px;">
                                    <option value=""<?if(!isset($_GET['patrner']) || $_GET['patrner'] == ''):?> selected<?  endif;?>>Все</option>
                                    <? foreach ($partner_groups_filtr as $group):?>
                                    <option value="<?=$group->id?>"<?if($group->id == $_GET['patrner']):?> selected<?  endif;?>><?=$group->name?></option>
                                    <?  endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Категория</h3>
                        </div>
                     <div class="close_open">
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                 <select class="select_ch" id="main_country" style="width:112px;">
                                    <option value=""<?if(!isset($_GET['country']) || $_GET['country'] == ''):?> selected<?  endif;?>>Все</option>
                                    <? foreach ($counties_filtr as $group):?>
                                        <option value="<?=$group->id?>"<?if($group->id == $_GET['country']):?> selected<?  endif;?>><?=$group->country?></option>
                                    <?  endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Страна</h3>
                        </div>
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                 <? foreach ($counties_filtr as $country):?>
                                    <select <?if($country->id == $_GET['country']):?>class="select_ch sel_coubtry"  id="main_region" <?else:?> style="display: none"<?  endif;?> id="table_<?=$country->id?>_main" style="width:112px;">
                                        <option value=""<?if(!isset($_GET['region'])|| $_GET['region'] == ''):?> selected<?  endif;?>>Все</option>
                                        <? foreach ($regions_filtr as $group):?>
                                            <?if($country->id == $group->country_id):?>
                                                <option id="<?=$group->id?>_main" value="<?=$group->id?>"<?if($group->id == $_GET['region']):?> selected<?  endif;?>><?=$group->region?></option>
                                            <?  endif;?>
                                        <?  endforeach;?>
                                    </select>
                                <? endforeach;?>
                                
                                <select <?if('' == $_GET['country'] || !isset($_GET['country'])):?>class="select_ch"  id="main_region" <?else:?> style="display: none"<?  endif;?> style="width:112px;">
                                    <option value=""<?if(!isset($_GET['region'])|| $_GET['region'] == ''):?> selected<?  endif;?>>Все</option>
                                <? foreach ($regions_filtr as $group):?>
                                        <option id="<?=$group->id?>_main" value="<?=$group->id?>"<?if($group->id == $_GET['region']):?> selected<?  endif;?>><?=$group->region?></option>
                                 <?  endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Регион</h3>
                        </div>
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                 <? foreach ($regions_filtr as $region):?>
                                        <select <?if($region->id == $_GET['region']):?>class="select_ch" id="main_city" <?else:?> style="display: none"<?  endif;?> id="region_<?=$region->id?>_<?=$object->id?>"  style="width:112px;">
                                            <option value=""<?if(!isset($_GET['city'])|| $_GET['city'] == ''):?> selected<?  endif;?>>Все</option>
                                            <? foreach ($cities_filtr as $city):?>
                                                <?if($region->id == $city->region_id):?>
                                                    <option value="<?=$city->id?>"<?if($city->id == $_GET['city']):?> selected<?  endif;?>><?=$city->city?></option>
                                                <?  endif;?>
                                            <?  endforeach;?>
                                        </select>
                                    <?  endforeach;?>
                                
                                    <select <?if('' == $_GET['region'] && '' != $_GET['country']):?>class="select_ch" id="main_city" <?else:?> style="display: none"<?  endif;?> id="region_<?=$region->id?>_<?=$object->id?>"  style="width:112px;">
                                            <option value=""<?if(!isset($_GET['city'])|| $_GET['city'] == ''):?> selected<?  endif;?>>Все</option>
                                        <? foreach ($regions_filtr as $region):?>
                                                <?if($region->country_id == $_GET['country']):?>
                                            <? foreach ($cities_filtr as $city):?>
                                                <?if($region->id == $city->region_id):?>
                                                    <option value="<?=$city->id?>"<?if($city->id == $_GET['city']):?> selected<?  endif;?>><?=$city->city?></option>
                                                <?  endif;?>
                                            <?  endforeach;?>
                                                <?  endif;?>
                                    <?  endforeach;?>
                                        </select>
                                
                                
                                <select <?if(('' == $_GET['region'] || !isset($_GET['region'])) &&('' == $_GET['country'] || !isset($_GET['country']))):?>class="select_ch" id="main_city" <?else:?> style="display: none"<?  endif;?> id="region_<?=$region->id?>_<?=$object->id?>"  style="width:112px;">
                                            <option value=""<?if(!isset($_GET['city'])|| $_GET['city'] == ''):?> selected<?  endif;?>>Все</option>
                                            <? foreach ($cities_filtr as $city):?>
                                                 <option value="<?=$city->id?>"<?if($city->id == $_GET['city']):?> selected<?  endif;?>><?=$city->city?></option>
                                            <?  endforeach;?>
                                        </select>
                                
                                
                            </div>
                            <h3 class="select">Город</h3></div>
                        <div class="inputBlock"><h3 class="input">Телефон</h3></div>
                        <div class="inputBlock"><h3 class="input">Сайт</h3></div>
                        <div class="inputBlock"><h3 class="logo">Логотип</h3></div>
                        <div class="inputBlock"><h3 class="textarea">Описание</h3></div>
                        <div class="inputBlock"><h3 class="textarea">Примечание</h3></div>
                    </div>
                        <table>
                            <tbody>
                            <tr>
                                <td width="290px"><div class="inputBlock"><h3 class="input" style="font-weight: bolder;">Демонтажные работы</h3></div></td>
                                <td width="70px"><div class="inputBlock"><h3 class="input" style="font-weight: bolder;">кол-во/<br> м.п./м2</h3></div></td>
                                <td width="70px"><div class="inputBlock"><h3 class="input" style="font-weight: bolder;">Цена за <br>Ед., руб.</h3></div></td>
                            </tr>
                            </tbody>
                            <?  foreach ($work_dem as $val):?>
                            <?if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?  endif;?>
                                <tr>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->name?></h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->price?></h3></div></td>
                                </tr>
                            <?  endforeach;?>
                        </table>
                            
                        <table>
                            <tbody>
                            <tr>
                                <td width="290px"><div class="inputBlock"><h3 class="input" style="font-weight: bolder;">Монтажные работы</h3></div></td>
                                <td width="70px"><div class="inputBlock"><h3 class="input" style="font-weight: bolder;">кол-во/<br> м.п./м2</h3></div></td>
                                <td width="70px"><div class="inputBlock"><h3 class="input" style="font-weight: bolder;">Цена за <br>Ед., руб.</h3></div></td>
                            </tr>
                            </tbody>
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Выравнивание потолка</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">100</h3></div></td>
                            </tr>
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Штукатурка потолка</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">200</h3></div></td>
                            </tr>
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Окраска потолка</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">270</h3></div></td>
                            </tr>
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Установка потолка</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">250</h3></div></td>
                            </tr>
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Установка освещения</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">140</h3></div></td>
                            </tr>
                            
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Откос штукатурка</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">10</h3></div></td>
                            </tr>
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Откос пластик</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">20</h3></div></td>
                            </tr>
                            <tr>
                                <td><div class="inputBlock"><h3 class="input">Монтаж</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                <td><div class="inputBlock"><h3 class="input">20</h3></div></td>
                            </tr>
                            <?  foreach ($work_mont as $val):?>
                            <?if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?  endif;?>
                                <tr>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->name?></h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->price?></h3></div></td>
                                </tr>
                            <?  endforeach;?>
                        </table>
                    </div>
                </td>
                <td>
                    <div style="float: left; width: 1100px; overflow-x:scroll; overflow-y:hidden;">
                        <div style='width: 90000px;'>
                            <?$i=0;?>
                            <? foreach ($objects as $object): ?>
                                <div style='float: left; width: 220px;'>

                                    <?if ( $errors ):?>
                                        <div class="inputBlock alert error">
                                            <?=implode(', ', $errors);?>
                                            <a href="#"></a>
                                        </div>
                                    <? endif; ?>

                                    <form name="myform_<?=$i?>"<?$i++?> action="/admin/partners/edit/<?=$object->id?>?all" method="POST" enctype="multipart/form-data">
                                        
                                        <div class="inputBlock"><div class="input"><input name="name" type="text" value="<?=htmlspecialchars($object->name);?>" ></div></div>
                                        
                                        <?/* Сегмент рынкa */?>
                                        <div class="inputBlock">
                                            <div class="select">
                                                <select name="group" class="group" id="<?=$object->id?>">
                                                    <? foreach ($groups as $group):?>
                                                    <option value="<?=$group->id?>"<?if($group->id == $object->group):?> selected<?  endif;?>><?=$group->nam?></option>
                                                    <?  endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="inputBlock">
                                            <div class="select">
                                                <input type="hidden" id="inp_part_<?=$object->id?>" value="<?=$object->id?>">
                                                <select name="patrner_id" class="partn" id="part_<?=$object->id?>">
                                                    <? foreach ($partner_groups as $group):?>
                                                    <option value="<?=$group->id?>"<?if($group->id == $object->patrner_id):?> selected<?  endif;?>><?=$group->name?></option>
                                                    <?  endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="close_open">
                                        <div class="inputBlock">
                                            <div class="select">
                                                <select name="country" onchange="change_country(this, '_<?=$object->id?>');">
                                                    <? foreach ($counties as $group):?>
                                                        <option value="<?=$group->id?>"<?if($group->id == $object->country):?> selected<?  endif;?>><?=$group->country?></option>
                                                    <?  endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="inputBlock">
                                            <div class="select">
                                                <? foreach ($counties as $country):?>
                                                    <select <?if($country->id == $object->country):?>name="region"<?else:?> style="display: none"<?  endif;?> id="table_<?=$country->id?>_<?=$object->id?>" onchange="change_region(this);return true;">
                                                        <? foreach ($regions as $group):?>
                                                            <?if($country->id == $group->country_id):?>
                                                                <option id="<?=$group->id?>_<?=$object->id?>" value="<?=$group->id?>"<?if($group->id == $object->region):?> selected<?  endif;?>><?=$group->region?></option>
                                                            <?  endif;?>
                                                        <?  endforeach;?>
                                                    </select>
                                                <?  endforeach;?>
                                            </div>
                                        </div>
                                        <div class="inputBlock">
                                            <div class="select">
                                                 <? foreach ($regions as $region):?>
                                                    <select <?if($region->id == $object->region):?>name="city"<?else:?> style="display: none"<?  endif;?> id="region_<?=$region->id?>_<?=$object->id?>">
                                                        <? foreach ($cities as $city):?>
                                                            <?if($region->id == $city->region_id):?>
                                                                <option value="<?=$city->id?>"<?if($city->id == $object->city):?> selected<?  endif;?>><?=$city->city?></option>
                                                            <?  endif;?>
                                                        <?  endforeach;?>
                                                    </select>
                                                <?  endforeach;?>
                                            </div>
                                        </div>
                                        <div class="inputBlock"><div class="input"><input name="telephon" type="text" value="<?=$object->telephon;?>" /></div></div>
                                        <div class="inputBlock"><div class="input"><input name="site" type="text" value="<?=$object->site;?>" ></div></div>
                                        
                                        <div class="inputBlock">
                                            <div class="logo">
                                                <?if($object->img):?>
                                                    <img alt="" src="/resources/logotype/<?=$object->img;?>" style="max-width: 200px;max-height: 200px;">
                                                    <br>
                                                    <input name="img_dell" type="hidden" value="<?=$object->img;?>" >

                                                     <?=FORM::submit('dell', 'Удалить логотип', array('class' => 'm', "style"=>'width: 200px;margin-left: 0px;margin-top: 0px;'));?>
                                                <?else:?>
                                                    <input name="img" type="file" />
                                                <?  endif;?>
                                            </div>
                                        </div>
                                        <?/* Описание */?>
                                        <div class="inputBlock"><div class="textarea"><textarea name="descript"><?=htmlspecialchars($object->descript);?></textarea></div></div>
                                        
                                        <?/* Примечание */?>
                                        <div class="inputBlock"><div class="textarea"><textarea name="prim"><?=htmlspecialchars($object->prim);?></textarea></div></div>
                                </div>
                                        
                                        <?/*  демонтажные работы */?>
                                            <div class="inputBlock"><div class="input"></div></div>
                                            <div id="dem_<?= $object->id?>" class="rit">
                                            <?  foreach ($work_dem as $val):?>
                                                 <?if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?  endif;?>
                                                <div class="inputBlock">
                                                    <div class="input">
                                                        <? foreach ($partner_groups as $group):?>
                                                            <?if($group->id == $object->patrner_id):?>
                                                                <?if(!array_diff(explode(',',$val->categor_arr),  explode(',',$group->type_arr)) ||(empty($group->type_arr) &&  array_diff(explode(',',$val->categor_arr),  explode(',',$group->no_type_arr)))):?>
                                                                    <input type="text" value="<?if($object->group == 1):?><?if(in_array($object->patrner_id, array(2))):?><?=bcsub($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?else:?><?=bcsub($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?  endif;?><?elseif($object->group == 2):?><?=$val->price;?><?elseif($object->group == 3):?><?if(in_array($object->patrner_id, array(2))):?><?=bcadd($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?else:?><?=bcadd($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?  endif;?><?  endif;?>" >
                                                                <?  endif;?>
                                                            <? endif;?>
                                                        <?  endforeach;?>
                                                        <?//if($val->categor_arr !=$type_arr && !empty($type_arr) && $no_type_arr == $val->categor_arr):?>  <?//else:?>
                                                    </div>
                                                </div>
                                            <?  endforeach;?>
                                        </div>
                                         <div class="inputBlock"><div class="input"></div></div>
                                         
                                        <?/*  монтажные работы */?>
                                        <div  id="mon_<?= $object->id?>"  class="rit">
                                            
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 6):?><input  type="text" value="100"><?  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 6):?><input  type="text" value="200"><?  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 6):?><input  type="text" value="270"><?  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 6):?><input  type="text" value="250"><?  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 6):?><input  type="text" value="140"><?  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 4):?><input  type="text" value="10"><?  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 4):?><input  type="text" value="20"><?  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?if($object->patrner_id == 4):?><input  type="text" value="20"><?  endif;?></div></div>
                                            <?  foreach ($work_mont as $val):?>
                                            <?if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?  endif;?>
                                                <div class="inputBlock">
                                                    <div class="input">
                                                       <? foreach ($partner_groups as $group):?>
                                                            <?if($group->id == $object->patrner_id):?>
                                                                <?if(!array_diff(explode(',',$val->categor_arr),  explode(',',$group->type_arr)) ||(empty($group->type_arr) &&  array_diff(explode(',',$val->categor_arr),  explode(',',$group->no_type_arr)))):?>
                                                                    <input type="text" value="<?if($object->group == 1):?><?if(in_array($object->patrner_id, array(2))):?><?=bcsub($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?else:?><?=bcsub($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?  endif;?><?elseif($object->group == 2):?><?=$val->price;?><?elseif($object->group == 3):?><?if(in_array($object->patrner_id, array(2))):?><?=bcadd($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?else:?><?=bcadd($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?  endif;?><?  endif;?>" >
                                                                <?  endif;?>
                                                            <? endif;?>
                                                        <?  endforeach;?>
                                                </div></div>
                                            <?  endforeach;?>
                                        </div>
                                         <div class="inputBlock"><div class="input"></div></div>
                                        
                                        <div class="inputBlock"><div class="input"><?=FORM::submit('', 'Сохранить', array('class' => 'm'));?></div></div>
                                    </form>
                                     <div class="inputBlock"><div class="input">
                                    <a href="/admin/partners/delete/<?=$object->id?>?all" class ='m' style="margin: 0 auto;float:none;">
                                        Удалить
                                    </a>
                                </div></div>
                                   
                                </div>
                            <? endforeach;?>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div style="height: 35px">
        <div style="margin: 0 auto; width:400px;">
            <?=$pagination;?>
        </div>
    </div>
</div>
