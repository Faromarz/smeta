<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Тексты сайта</span></h1>


    <div class='innerContent'>
    <?if(isset($errors)):?>
        <?  foreach ($errors as $error):?>
            <div class="itemNews">
                <?=$error?>
            </div>
        <?  endforeach;?>
    <?  endif;?>
        <div class="itemNews">
            <table>
                <tr>
                    <td><span style="width: 20px;">№</span></td>
                    <td><span  style="width: 100px;">alias</span></td>
                    <td><span  style="width: 300px;">Название</span></td>
                    <td><span style="width:300px">Текст</span></td>                  
                <tr>
            </table>
        </div>
        <div style="overflow-x:hidden; overflow-y:scroll; height: 600px;">
            <?$i=0;?>
        <? foreach ($objects as $object):?>
            <form name="myform_<?=$i?>"<?$i++?>  method="POST" action="/admin/content" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$object->id;?>" />
            <div class="itemNews" style="position: relative;">
                <table>
                    <tr>
                        <td>
                             <span  style="width: 20px;"><?=$object->id;?></span>
                        </td>
                        <td>
                            <span style="width: 100px;"><input type="text" name="alias" value="<?=$object->alias;?>" style="width: 90px;" /></span>
                        </td>
                        <td>
                            <span style="width: 300px;"><input type="text" name="title" value="<?=$object->title;?>" style="width: 200px;" /></span>
                        </td>
                        <td>
                            <span  style="width:300px"><textarea style="width:270px" name="text"><?=htmlspecialchars($object->text);?></textarea></span>
                        </td>
                        
                        <?if($object->alias == 'no_photo_partner'):?>
                            <td>
                                <span  style="width:300px">
                                    <?if(isset($errors['img'])):?><?=$errors['img']?><?  endif;?>
                                    <?if (is_file('resources/images/par/290_no_photo.png')):?>
                                        <img src="/resources/images/par/40_40_no_photo.png">
                                        <input type="file" name="img">                                   
                                         <input type="submit" name="save" value="Сохранить новое фото" style="margin: 0px; width: 180px;height: 16px;padding: 0px;">
                                    <?else:?>
                                    <?  endif;?>
                                </span>
                            </td>
                        <?  endif;?>
               
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
