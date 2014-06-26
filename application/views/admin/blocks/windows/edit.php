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
                <h3>Имя профиля</h3>
                <input name="profil_name" type="text" value="<?=$object->profil_name;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Цена 100 см<sup>2</sup></h3>
                <input name="price" type="text" value="<?=$object->price;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>База глухая</h3>
                <input name="base_gluh" type="text" value="<?=$object->base_gluh;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>База поворотная</h3>
                <input name="base_povorot" type="text" value="<?=$object->base_povorot;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>База поворотно-откидная</h3>
                <input name="base_povorot_otk" type="text" value="<?=$object->base_povorot_otk;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Подоконник + Отлив</h3>
                <input name="podokonnik_otliv" type="text" value="<?=$object->podokonnik_otliv;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Откос штукатурка</h3>
                <input name="otkos_shtuk" type="text" value="<?=$object->otkos_shtuk;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Откос пластик</h3>
                <input name="otkos_plastik" type="text" value="<?=$object->otkos_plastik;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Монтаж</h3>
                <input name="montaj" type="text" value="<?=$object->montaj;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Сетка</h3>
                <input name="setka" type="text" value="<?=$object->setka;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Створка2</h3>
                <input name="stvorka2" type="text" value="<?=$object->stvorka2;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Створка3</h3>
                <input name="stvorka3" type="text" value="<?=$object->stvorka3;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Фрамуга</h3>
                <input name="framuga" type="text" value="<?=$object->framuga;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Цвет под дерево1</h3>
                <input name="color_wood" type="text" value="<?=$object->color_wood;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Сайт</h3>
                <input name="site" type="text" value="<?=$object->site;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Телефон</h3>
                <input name="tel" type="text" value="<?=$object->tel;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Адрес</h3>
                <input name="address" type="text" value="<?=$object->address;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Доп. Инфа.1</h3>
                <input name="dop_info1" type="text" value="<?=$object->dop_info1;?>" >
            </div>
            <!--End inputBlock-->

            <div class="inputBlock">
                <h3>Доп. Инфа.2</h3>
                <input name="dop_info2" type="text" value="<?=$object->dop_info2;?>" >
            </div>
            <!--End inputBlock-->

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