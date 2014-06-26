<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Общая информация</span></h1>

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
                <input name="name" type="text" value="" >
            </div>
            
            <div class="inputBlock">
                <h3>Материалы</h3>
                <input name="material" id="material" type="text" value="" onblur="sum(this);" />
            </div>
            
            <div class="inputBlock">
                <h3>Выравнивание потолка</h3>
                <input name="vurav" id="vurav" type="text" value="" onblur="sum(this);" />
            </div>
            <div class="inputBlock">
                <h3>Штукатурка потолка</h3>
                <input name="chtycat" id="chtycat" type="text" value="" onblur="sum(this);" />
            </div>
            <div class="inputBlock">
                <h3>Окраска потолка</h3>
                <input name="okras" id="okras" type="text" value="" onblur="sum(this);" />
            </div>
            <div class="inputBlock">
                <h3>Установка потолка</h3>
                <input name="ystan_t" id="ystan_t" type="text" value="" onblur="sum(this);" />
            </div>
            <div class="inputBlock">
                <h3>Установка освещения</h3>
                <input name="ystan_osv" id="ystan_osv" type="text" value="" onblur="sum(this);" />
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Цена ИТОГО</h3>
                <input name="price" id="price" type="text" value="" onblur="this.value = this.value.replace (/[^\d\.]/g, '')" />
            </div>
            <!--End inputBlock-->

            
            
            <div class="inputBlock">
                <h3>Короткое писание</h3>
                <input name="description" type="text" value="" >
            </div>
            <div class="inputBlock">
                <h3>Полное описание</h3>
                <input name="attr" type="text" value=">" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Название картинки</h3>
                <input name="image" type="text" value="" >
            </div>
            <div class="inputBlock">
                <h3>Страна производитель</h3>
                <input name="co" type="text" value="" >
            </div>
            <div class="inputBlock">
                <h3>Кол-во уровней</h3>
                <input name="ordertable" type="text" value="" >
            </div>
            <div class="inputBlock">
                <h3>Шумоизоляция</h3>
                <input name="dl" type="text" value="" >
            </div>
            <div class="inputBlock">
                <h3>Освещение</h3>
                <input name="shr" type="text" value="" >
            </div>
            <!--End inputBlock-->

           
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>&nbsp;</h3>
                <input type="submit" name="save" value="Сохранить" class="m">
                <input type="submit" name="save_next" value="Сохранить и перейти к следующей позиции" class="m">
            </div>
           
            <!--End inputBlock-->

        </form>

    </div>
    <!--End innerContent-->
</div>
<!--End content-->	