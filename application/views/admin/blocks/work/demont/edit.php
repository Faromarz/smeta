<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Демонтажная работа <?=htmlspecialchars($object->name);?></span></h1>

    <div class='innerContent'>

        <?php if ( $errors ) { ?>
            <div class="inputBlock alert error">
                <?=implode(', ', $errors);?>
                <a href="#"></a>
            </div>
        <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="inputBlock">
                <h3>Название</h3>
                <input name="name" type="text" value="<?=htmlspecialchars($object->name);?>" >
                <input name="type" type="hidden" value="0" >
            </div>
            <div class="inputBlock">
                <h3>Категория</h3>
                <select name="categor_arr[]" multiple>
                    <option value=""<?if(empty($object->categor_arr)):?> selected<?  endif;?>>Все</option>
                    <?  foreach ($categories as $val):?>
                    <option value="<?=$val->id?>" <?if(in_array($val->id,  explode(',',$object->categor_arr))):?> selected<?  endif;?>><?=$val->type_name?></option>
                    <?  endforeach;?>
                </select>
            </div>
            
            
<!--            <div class="inputBlock">
                <h3>Категория</h3>
                    <?php echo $select_partner; ?>
            </div>
            
            <div class="inputBlock">
                <h3>Страна</h3>
                    <?php echo $select_country; ?>
            </div>
            
            <div class="inputBlock">
                <h3>Регион</h3>
                 <?php echo $select_regions; ?>
            </div>
            <div class="inputBlock">
                <h3>Город</h3>
                 <?php echo $select_cities; ?>
                
                <input name="city" type="text" value="<?//=$object->city;?>" id='city'>
               
                
            </div>-->
<!--            <div class="inputBlock">
                <script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
                <script type="text/javascript" src="/resources/js/admin/partners.js"></script>
                <h3>Координаты</h3>
                <input name="coordin" type="text" value="<?//=$object->coordin;?>" id='coordin' readonly>
                
            </div>-->

            <div class="inputBlock">
                <h3>Цена стандарт</h3>
                <input name="price" type="text" value="<?=$object->price;?>" >
            </div>
            <div class="inputBlock">
                <h3>Формулы</h3>
                <!--<input name="count" type="text" value="<?=$object->count;?>" >-->
                <table>
                    <tr><td><input name="count" value="all_size" type="radio"<?if($object->count == 'all_size'):?>  checked<?  endif;?>></td><td>Общая площадь</td></tr>
                    <tr><td><input name="count" value="ret" type="radio"<?if($object->count == 'ret'):?>  checked<?  endif;?>></td><td>1</td></tr>
                    <tr><td><input name="count" value="getcountwin_6" type="radio"<?if($object->count == 'getcountwin_6'):?>  checked<?  endif;?>></td><td>Количество окон</td></tr>
                    <tr><td><input name="count" value="getcountdoor" type="radio"<?if($object->count == 'getcountdoor'):?>  checked<?  endif;?>></td><td>Количество дверей</td></tr>
                </table>
            </div>

<!--            <div class="inputBlock">
                <h3>Картинка логотип</h3>
                <?/*if($object->img):?>
                    <img alt="" src="/resources/logotype/<?=$object->img;?>" style="max-width: 200px;max-height: 200px;">
                    <br>
                    <br>
                    <input name="img_dell" type="hidden" value="<?=$object->img;?>" >
                   
                     <?=FORM::submit('dell', 'Удалить логотип', array('class' => 'm', "style"=>'width: 200px;margin-left: 347px;margin-top: 0px;'));?>
                <?else:?>
                    <input name="img" type="file" />
                <?  endif;*/?>
            </div>-->
                              
            <div class="inputBlock">
                <h3>&nbsp;</h3>
                <?=FORM::submit('', 'Сохранить', array('class' => 'm'));?>
            </div>
            <!--End inputBlock-->

        </form>

    </div>
    <!--End innerContent-->
</div>
<!--End content-->	