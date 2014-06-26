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
                                    <option value=""<?php if(!isset($_GET['group']) || $_GET['group'] == ''):?> selected<?php endif;?>>Все</option>
                                    <?php foreach ($groups_filtr as $group):?>
                                        <option value="<?=$group->id?>"<?php if(isset($_GET['group']) && $group->id == $_GET['group']):?> selected<?php endif;?>><?=$group->nam?></option>
                                    <?php  endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Сегмент рынка</h3>
                        </div>
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                <select class="select_ch" id="main_patrner" style="width:112px;">
                                    <option value=""<?php if(!isset($_GET['patrner']) || $_GET['patrner'] == ''):?> selected<?php endif;?>>Все</option>
                                        <?php foreach ($partner_groups_filtr as $group):?>
                                    <option value="<?=$group->id?>"<?php if(isset($_GET['patrner']) &&  $group->id == $_GET['patrner']):?> selected<?php  endif;?>><?=$group->name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Категория</h3>
                        </div>sset($_GE
                     <div class="close_open">
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                 <select class="select_ch" id="main_country" style="width:112px;">
                                    <option value=""<?php if(!isset($_GET['country']) || $_GET['country'] == ''):?> selected<?php endif;?>>Все</option>
                                    <?php foreach ($counties_filtr as $group):?>
                                        <option value="<?=$group->id?>"<?php if(isset($_GET['country']) && $group->id == $_GET['country']):?> selected<?php endif;?>><?=$group->country?></option>
                                    <?php  endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Страна</h3>
                        </div>
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                 <?php foreach ($counties_filtr as $country):?>
                                    <select <?php if(isset($_GET['country']) &&  $country->id == $_GET['country']):?>class="select_ch sel_coubtry"  id="main_region" <?php else:?> style="display: none"<?php endif;?> id="table_<?=$country->id?>_main" style="width:112px;">
                                        <option value=""<?php if(!isset($_GET['region'])|| $_GET['region'] == ''):?> selected<?php endif;?>>Все</option>
                                        <?php foreach ($regions_filtr as $group):?>
                                            <?php if($country->id == $group->country_id):?>
                                                <option id="<?=$group->id?>_main" value="<?=$group->id?>"<?php if(isset($_GET['region']) && $group->id == $_GET['region']):?> selected<?php endif;?>><?=$group->region?></option>
                                            <?php endif;?>
                                        <?php  endforeach;?>
                                    </select>
                                <?php endforeach;?>
                                
                                <select <?php if(isset($_GET['country']) && '' == $_GET['country'] || !isset($_GET['country'])):?>class="select_ch"  id="main_region" <?php else:?> style="display: none"<?php endif;?> style="width:112px;">
                                    <option value=""<?php if(!isset($_GET['region'])|| $_GET['region'] == ''):?> selected<?php  endif;?>>Все</option>
                                <?php foreach ($regions_filtr as $group):?>
                                        <option id="<?=$group->id?>_main" value="<?=$group->id?>"<?php if(isset($_GET['region']) &&$group->id == $_GET['region']):?> selected<?php endif;?>><?=$group->region?></option>
                                 <?php  endforeach;?>
                                </select>
                            </div>
                            <h3 class="select">Регион</h3>
                        </div>
                        <div class="inputBlock" style="position: relative">
                            <div style="position:absolute; left: 210px;">
                                 <?php foreach ($regions_filtr as $region):?>
                                        <select <?php if(isset($_GET['region']) && $region->id == $_GET['region']):?>class="select_ch" id="main_city" <?php else:?> style="display: none"<?php endif;?> id="region_<?=$region->id?>_<?//=$object->id?>"  style="width:112px;">
                                            <option value=""<?php if(!isset($_GET['city'])|| $_GET['city'] == ''):?> selected<?php endif;?>>Все</option>
                                            <?php foreach ($cities_filtr as $city):?>
                                                <?php if($region->id == $city->region_id):?>
                                                    <option value="<?=$city->id?>"<?php if(isset( $_GET['city']) && $city->id == $_GET['city']):?> selected<?php endif;?>><?=$city->city?></option>
                                                <?php endif;?>
                                            <?php  endforeach;?>
                                        </select>
                                    <?php  endforeach;?>
                                
                                    <select <?php if(isset( $_GET['region']) && '' == $_GET['region'] && '' != $_GET['country']):?>class="select_ch" id="main_city" <?php else:?> style="display: none"<?php endif;?> id="region_<?=$region->id?>_<?//=$object->id?>"  style="width:112px;">
                                            <option value=""<?php if(!isset($_GET['city'])|| $_GET['city'] == ''):?> selected<?php endif;?>>Все</option>
                                        <?php foreach ($regions_filtr as $region):?>
                                                <?php if(isset( $_GET['country']) && $region->country_id == $_GET['country']):?>
                                                    <?php foreach ($cities_filtr as $city):?>
                                                        <?php if($region->id == $city->region_id):?>
                                                            <option value="<?=$city->id?>"<?php if($city->id == $_GET['city']):?> selected<?php  endif;?>><?=$city->city?></option>
                                                        <?php  endif;?>
                                                    <?php  endforeach;?>
                                                <?php  endif;?>
                                    <?php endforeach;?>
                                        </select>
                                
                                
                                <select <?php if((isset( $_GET['region']) &&'' == $_GET['region'] || !isset($_GET['region'])) &&(isset( $_GET['country']) &&'' == $_GET['country'] || !isset($_GET['country']))):?>class="select_ch" id="main_city" <?php else:?> style="display: none"<?php endif;?> id="region_<?=$region->id?>_<?//=$object->id?>"  style="width:112px;">
                                            <option value=""<?php if(!isset($_GET['city'])|| $_GET['city'] == ''):?> selected<?php endif;?>>Все</option>
                                            <?php foreach ($cities_filtr as $city):?>
                                                 <option value="<?=$city->id?>"<?php if(isset($_GET['city']) && $city->id == $_GET['city']):?> selected<?php endif;?>><?=$city->city?></option>
                                            <?php endforeach;?>
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
                            <?php  foreach ($work_dem as $val):?>
                            <?php if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?php endif;?>
                                <tr>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->name?></h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->price?></h3></div></td>
                                </tr>
                            <?php  endforeach;?>
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
                            <?php  foreach ($work_mont as $val):?>
                            <?php if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?php  endif;?>
                                <tr>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->name?></h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input">1</h3></div></td>
                                    <td><div class="inputBlock"><h3 class="input"><?=$val->price?></h3></div></td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                </td>
                <td>
                    <div style="float: left; width: 1100px; overflow-x:scroll; overflow-y:hidden;">
                        <div style='width: 90000px;'>
                            <?php $i=0;?>
                            <?php foreach ($objects as $object): ?>
                                <div style='float: left; width: 220px;'>

                                    <?php if (isset( $errors )):?>
                                        <div class="inputBlock alert error">
                                            <?=implode(', ', $errors);?>
                                            <a href="#"></a>
                                        </div>
                                    <?php endif; ?>

                                    <form name="myform_<?=$i?>"<?php $i++;?> action="/admin/partn/edit/<?=$object->id?>?all" method="POST" enctype="multipart/form-data">
                                        
                                        <div class="inputBlock"><div class="input"><input name="name" type="text" value="<?=htmlspecialchars($object->name);?>" ></div></div>
                                        
                                        <?php // Сегмент рынкa ?>
                                        <div class="inputBlock">
                                            <div class="select">
                                                <select name="group" class="group" id="<?=$object->id?>">
                                                    <?php $grop = 'business'; foreach ($groups as $group):?>
                                                        <option value="<?=$group->id?>"<?php if($group->id == $object->group):$grop = $group->name?> selected<?php  endif;?>><?=$group->nam?></option>
                                                    <?php  endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="inputBlock">
                                            <div class="select">
                                                <input type="hidden" id="inp_part_<?=$object->id?>" value="<?=$object->id?>">
                                                <select name="patrner_id" class="partn" id="part_<?=$object->id?>">
                                                    <?php foreach ($partner_groups as $group):?>
                                                        <option value="<?=$group->id?>"<?php if($group->id == $object->patrner_id):?> selected<?php endif;?>><?=$group->name?></option>
                                                    <?php  endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="close_open">
                                        <div class="inputBlock">
                                            <div class="select">
                                                <select name="country" onchange="change_country(this, '_<?=$object->id?>');">
                                                    <?php foreach ($counties as $group):?>
                                                        <option value="<?=$group->id?>"<?php if($group->id == $object->country):?> selected<?php endif;?>><?=$group->country?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="inputBlock">
                                            <div class="select">
                                                <?php foreach ($counties as $country):?>
                                                    <select <?php if($country->id == $object->country):?>name="region"<?php else:?> style="display: none"<?php  endif;?> id="table_<?=$country->id?>_<?=$object->id?>" onchange="change_region(this);return true;">
                                                        <?php foreach ($regions as $group):?>
                                                            <?php if($country->id == $group->country_id):?>
                                                                <option id="<?=$group->id?>_<?=$object->id?>" value="<?=$group->id?>"<?php if($group->id == $object->region):?> selected<?php  endif;?>><?=$group->region?></option>
                                                            <?php endif;?>
                                                        <?php endforeach;?>
                                                    </select>
                                                <?php  endforeach;?>
                                            </div>
                                        </div>
                                        <div class="inputBlock">
                                            <div class="select">
                                                 <?php foreach ($regions as $region):?>
                                                    <select <?php if($region->id == $object->region):?>name="city"<?php else:?> style="display: none"<?php  endif;?> id="region_<?=$region->id?>_<?=$object->id?>">
                                                        <?php foreach ($cities as $city):?>
                                                            <?php if($region->id == $city->region_id):?>
                                                                <option value="<?=$city->id?>"<?php if($city->id == $object->city):?> selected<?php  endif;?>><?=$city->city?></option>
                                                            <?php  endif;?>
                                                        <?php  endforeach;?>
                                                    </select>
                                                <?php endforeach;?>
                                            </div>
                                        </div>
                                        <div class="inputBlock"><div class="input"><input name="telephon" type="text" value="<?=$object->telephon;?>" /></div></div>
                                        <div class="inputBlock"><div class="input"><input name="site" type="text" value="<?=$object->site;?>" ></div></div>
                                        
                                        <div class="inputBlock">
                                            <div class="logo">
                                                <?php if($object->img):?>
                                                    <img alt="" src="/resources/logotype/<?=$object->img;?>" style="max-width: 200px;max-height: 200px;">
                                                    <br>
                                                    <input name="img_dell" type="hidden" value="<?=$object->img;?>" >

                                                     <?=Form::submit('dell', 'Удалить логотип', array('class' => 'm', "style"=>'width: 200px;margin-left: 0px;margin-top: 0px;'));?>
                                                <?php else:?>
                                                    <input name="img" type="file" />
                                                <?php  endif;?>
                                            </div>
                                        </div>
                                        <?php // Описание ?>
                                        <div class="inputBlock"><div class="textarea"><textarea name="descript"><?=htmlspecialchars($object->descript);?></textarea></div></div>
                                        
                                        <?php // Примечание ?>
                                        <div class="inputBlock"><div class="textarea"><textarea name="prim"><?=htmlspecialchars($object->prim);?></textarea></div></div>
                                </div>
                                        
                                        <?php //  демонтажные работы ?>
                                            <div class="inputBlock"><div class="input"></div></div>
                                            <div id="dem_<?= $object->id?>" class="rit">
                                           
                                            <?php  foreach ($work_dem  as $val):?>
                                               
                                              <?php if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?php  endif;?>
                                                <div class="inputBlock">
                                                    <div class="input">
                                                        <?php foreach ($partner_groups as $group):?>
                                                            <?php if($group->id == $object->patrner_id): ?>
                                                                <?php if(!array_diff(explode(',',$val->categor_arr),  explode(',',$group->type_arr)) ||(empty($group->type_arr) &&  array_diff(explode(',',$val->categor_arr),  explode(',',$group->no_type_arr)))):?>
                                                                    <?php $price = 0;?>
                                                                    <?php $price_load = ORM::factory('Partnerswork')->select(array('price_'.$grop, 'price'))->where('user_id', '=', $object->user_id)->where('work_id', '=', $val->id)->find();?>
                                                                    <?php if($price_load->loaded()) :$price = $price_load->price?>
                                                                    <!--<input type="text" value="<?php if($object->group == 1):?><?php if(in_array($object->patrner_id, array(2))):?><?=bcsub($price, bcmul(bcdiv($price,100),30,2),2);?><?php else:?><?=bcsub($price, bcmul(bcdiv($price,100),30,2),2);?><?php  endif;?><?php elseif($object->group == 2):?><?=$price;?><?php elseif($object->group == 3):?><?php if(in_array($object->patrner_id, array(2))):?><?=bcadd($price, bcmul(bcdiv($price,100),30,2),2);?><?php else:?><?=bcadd($price, bcmul(bcdiv($pricee,100),30,2),2);?><?php endif;?><?php endif;?>" >-->
                                                                    <input type="text" value="<?=$price;?>" />
                                                                <?php endif;?>
                                                                <?php endif;?>
                                                            <?php endif;?>
                                                        <?php endforeach;?>
                                                    </div>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                         <div class="inputBlock"><div class="input"></div></div>
                                         
                                        <?php //  монтажные работы ?>
                                        <div  id="mon_<?= $object->id?>"  class="rit">
                                            
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 6):?><input  type="text" value="100"><?php endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 6):?><input  type="text" value="200"><?php endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 6):?><input  type="text" value="270"><?php endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 6):?><input  type="text" value="250"><?php endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 6):?><input  type="text" value="140"><?php endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 4):?><input  type="text" value="10"><?php  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 4):?><input  type="text" value="20"><?php  endif;?></div></div>
                                            <div class="inputBlock"><div class="input"><?php if($object->patrner_id == 4):?><input  type="text" value="20"><?php  endif;?></div></div>
                                            
                                       
                                            <?php  foreach ($work_mont as $val):?>
                                            <?php if(isset($_GET['patrner']) && $_GET['patrner'] == 6 && !in_array('31', explode(',', $val->categor_arr))):continue;?><?php  endif;?>
                                                <div class="inputBlock">
                                                    <div class="input">
                                                       <?php foreach ($partner_groups as $group):?>
                                                            <?php if($group->id == $object->patrner_id):?>
                                                                <?php if(!array_diff(explode(',',$val->categor_arr),  explode(',',$group->type_arr)) ||(empty($group->type_arr) &&  array_diff(explode(',',$val->categor_arr),  explode(',',$group->no_type_arr)))):?>
                                                                <?php $price = 0;?>
                                                                    <?php $price_load = ORM::factory('Partnerswork')->select(array('price_'.$grop, 'price'))->where('user_id', '=', $object->user_id)->where('work_id', '=', $val->id)->find();?>
                                                                    <?php if($price_load->loaded()): $price = $price_load->price?>
                                                        
<!--                                                                    <input type="text" value="<?php if($object->group == 1):?><?php if(in_array($object->patrner_id, array(2))):?><?=bcsub($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?php else:?><?=bcsub($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?php endif;?><?php elseif($object->group == 2):?><?=$val->price;?><?php elseif($object->group == 3):?><?php if(in_array($object->patrner_id, array(2))):?><?=bcadd($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?php else:?><?=bcadd($val->price, bcmul(bcdiv($val->price,100),30,2),2);?><?php endif;?><?php endif;?>" >-->
                                                                    <input type="text" value="<?=$price;?>" />
                                                                <?php  endif;?>
                                                                <?php  endif;?>
                                                            <?php endif;?>
                                                        <?php  endforeach;?>
                                                </div></div>
                                            <?php  endforeach;?>
                                        </div>
                                         <div class="inputBlock"><div class="input"></div></div>
                                        
                                        <div class="inputBlock"><div class="input"><?=FORM::submit('', 'Сохранить', array('class' => 'm'));?></div></div>
                                    </form>
                                    <div class="inputBlock"><div class="input">
                                        <a href="/admin/partn/delete/<?=$object->id?>?all" class ='m' style="margin: 0 auto;float:none;">
                                            Удалить
                                        </a>
                                    </div></div>
                                   
                                </div>
                            <?php endforeach;?>
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
<?=  View::factory('profiler/stats');?>
