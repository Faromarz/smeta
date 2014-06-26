<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Личный кабинет компании <?=htmlspecialchars($object->name);?></span></h1>

    <div class='innerContent'>
        <!--
            Succes: none
            Error: .error
            Info: .info
            Warning: .warning
        -->

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
            </div>
            
            
            <div class="inputBlock">
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
                
                <!--<input name="city" type="text" value="<?=$object->city;?>" id='city'>-->
               
                
            </div>
<!--            <div class="inputBlock">
                <script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
                <script type="text/javascript" src="/resources/js/admin/partners.js"></script>
                <h3>Координаты</h3>
                <input name="coordin" type="text" value="<?//=$object->coordin;?>" id='coordin' readonly>
                
            </div>-->
            <div class="inputBlock">
                <h3>Телефон</h3>
                <input name="telephon" type="text" value="<?=$object->telephon;?>" >
            </div>
            <div class="inputBlock">
                <h3>Сайт</h3>
                <input name="site" type="text" value="<?=$object->site;?>" >
            </div>
            <div class="inputBlock">
                <h3>Картинка логотип</h3>
                <?if($object->img):?>
                    <img alt="" src="/resources/logotype/<?=$object->img;?>" style="max-width: 200px;max-height: 200px;">
                    <br>
                    <br>
                    <input name="img_dell" type="hidden" value="<?=$object->img;?>" >
                   
                     <?=  Form::submit('dell', 'Удалить логотип', array('class' => 'm', "style"=>'width: 200px;margin-left: 347px;margin-top: 0px;'));?>
                <?else:?>
                    <input name="img" type="file" />
                <?  endif;?>
            </div>
            <div class="inputBlock">
                <h3>Описание</h3>
                <input name="descript" type="text" value="<?=htmlspecialchars($object->descript);?>" >
            </div>
            <div class="inputBlock">
                <h3>Примечание</h3>
                <input name="prim" type="text" value="<?=htmlspecialchars($object->prim);?>" >
            </div>
                     
 

            <div class="inputBlock">
                <h3>&nbsp;</h3>
                <?=  Form::submit('', 'Сохранить', array('class' => 'm'));?>
            </div>
            <!--End inputBlock-->

        </form>

    </div>
    <!--End innerContent-->
</div>
<!--End content-->	