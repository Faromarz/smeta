<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Подвал</span></h1>

    <div class='innerContent'>
        <div class="itemNews">
            <table>
                <tr>
                    <td><span style="width: 20px;">№</span></td>
                    <td><span  style="width: 210px;">Время отображения</span></td>
                    <td><span  style="width: 300px;">Фото/Видео</span></td>         
                <tr>
            </table>
        </div>
        <div style="overflow-x:hidden; overflow-y:scroll; height: 600px;">
            <?$i=0;?>
        <? foreach ($objects as $object):?>
            <form name="myform_<?=$i?>"<?$i++?> enctype="multipart/form-data" method="POST" action="/admin/slider">
                <input type="hidden" name="id" value="<?=$object->id;?>" />
            <div class="itemNews" style="position: relative;">
                <table>
                    <tr>
                        <td>
                             <span  style="width: 20px;"><?=$object->id;?></span>
                        </td>
                        <td>
                            <span style="width: 210px;"><input type="text" class="time_valid" name="time_start" value="<?=$object->time_start;?>" style="width: 50px;" /> - <input  class="time_valid" type="text" name="time_stop" value="<?=$object->time_stop;?>" style="width: 50px;" /></span>
                                <script type="text/javascript" src="/resources/libs/jquery.inputmask.js"></script>
                                <script type="text/javascript" src="/resources/libs/jquery.inputmask.extensions.js"></script>
                                <script type="text/javascript" src="/resources/libs/jquery.inputmask.numeric.extensions.js"></script>
                            <script>
                                $(".time_valid").inputmask("99:99:99");
                            </script>
                        </td>
                        <td>
                            <?if(empty($object->img) && empty($object->video)):?>
                                <table>
                                    <tr>
                                        <td>Добавить картинку</td>
                                        <td><input class="m" name="img" type="file" ></td>
                                    </tr>
                                    <tr>
                                        <td>Добавить видео</td>
                                        <td><input class="m" name="video" type="text" value="<?if(!empty($object->video)):?><?=$object->video?><?  endif;?>"></td>
                                    </tr>
                                </table>
                            <?elseif(!empty($object->img)):?>
                                <img src="/resources/libs/slider/images/540_300_<?=$object->img;?>">
                                <a class="delete" href="/admin/slider/delete/<?=$object->id;?>?img">удалить</a>
                            <?elseif(!empty($object->video)):?>
                                <?=$object->video;?>
                                <a class="delete" href="/admin/slider/delete/<?=$object->id;?>?video">удалить</a>
                            <?  endif;?>
                            <!--<span style="width: 300px;"><input type="text" name="title" value="<?//=$object->title;?>" style="width: 200px;" /></span>-->
                        </td>
               
                    </tr>
                </table>
                <input type="submit" name="save" value="Сохранить" style="position: absolute;right: 1px;top: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">
                <input type="submit" name="del" value="Удалить" style="position: absolute;right: 1px;bottom: 2px;margin: 0px; width: 80px;height: 16px;padding: 0px;">
            </div>
            </form>
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
