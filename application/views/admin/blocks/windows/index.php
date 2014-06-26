 <div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer"> Сохранить все изменения</div>
 <div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Общая информация по окнам</span></h1>
    <table>
        <tr>
            <td style="vertical-align: top;width: 200px;">
                <div class="inputBlock"><h3 class="input">Имя профиля</h3></div>
                <div class="inputBlock"><h3 class="input">Цена 100 см<sup>2</sup></h3></div>
                <div class="inputBlock"><h3 class="input">База глухая</h3></div>
                <div class="inputBlock"><h3 class="input">База поворотная</h3></div>
                <div class="inputBlock"><h3 class="input">База поворотно-откидная</h3></div>
                <div class="inputBlock"><h3 class="input">Подоконник + Отлив</h3></div>
                <div class="inputBlock"><h3 class="input">Откос штукатурка</h3></div>
                <div class="inputBlock"><h3 class="input">Откос пластик</h3></div>
                <div class="inputBlock"><h3 class="input">Монтаж</h3></div>
                <div class="inputBlock"><h3 class="input">Сетка</h3></div>
                <div class="inputBlock"><h3 class="input">Створка2</h3></div>
                <div class="inputBlock"><h3 class="input">Створка3</h3></div>
                <div class="inputBlock"><h3 class="input">Фрамуга</h3></div>
                <div class="inputBlock"><h3 class="input">Цвет под дерево1</h3></div>
                <div class="inputBlock"><h3 class="input">Сайт</h3></div>
                <div class="inputBlock"><h3 class="input">Телефон</h3></div>
                <div class="inputBlock"><h3 class="input">Адрес</h3></div>
                <div class="inputBlock"><h3 class="textarea">Доп. Инфа.1</h3></div>
                <div class="inputBlock"><h3 class="textarea">Доп. Инфа.2</h3></div>
            </td>
            <td>
                <div style="float: left; width: 1500px; overflow-y:hidden;">
                    <div style='max-width: 90000px;'>
                        <? foreach ($objects as $object): ?>
                            <div style='float: left; width: 220px;'>
                                <form action="/admin/windows/edit/<?=$object->id;?>" method="POST" enctype="multipart/form-data">

                                    <div class="inputBlock">
                                        <input name="profil_name" type="text" value="<?=$object->profil_name;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="price" type="text" value="<?=$object->price;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="base_gluh" type="text" value="<?=$object->base_gluh;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="base_povorot" type="text" value="<?=$object->base_povorot;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="base_povorot_otk" type="text" value="<?=$object->base_povorot_otk;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="podokonnik_otliv" type="text" value="<?=$object->podokonnik_otliv;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="otkos_shtuk" type="text" value="<?=$object->otkos_shtuk;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="otkos_plastik" type="text" value="<?=$object->otkos_plastik;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="montaj" type="text" value="<?=$object->montaj;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="setka" type="text" value="<?=$object->setka;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="stvorka2" type="text" value="<?=$object->stvorka2;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="stvorka3" type="text" value="<?=$object->stvorka3;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="framuga" type="text" value="<?=$object->framuga;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="color_wood" type="text" value="<?=$object->color_wood;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="site" type="text" value="<?=$object->site;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="tel" type="text" value="<?=$object->tel;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <input name="address" type="text" value="<?=$object->address;?>" >
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <div class="textarea"><textarea name="dop_info1"><?=$object->dop_info1;?></textarea></div>
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <div class="textarea"><textarea name="dop_info2"><?=$object->dop_info2;?></textarea></div>
                                    </div>
                                    <!--End inputBlock-->

                                    <div class="inputBlock">
                                        <?=  Form::submit('', 'Сохранить', array('class' => 'm'));?>
                                    </div>

                                </form>
                                <div class="inputBlock"><div class="input">
                                    <a href="/admin/windows/delete/<?=$object->id;?>" class ='m' style="margin: 0 auto;float:none">
                                        Удалить
                                    </a>
                                </div></div>
                               
                
                            </div>
                        <? endforeach; ?>
                        <a id="add" href="/admin/windows/create" style="padding-top: 10px;display: block;color: #393939;">Добавить окно</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    

<!--    <div style="height: 35px">
        <div style="margin: 0 auto; width:400px;">
            <?//=$pagination;?>
        </div>
    </div>-->
</div>
