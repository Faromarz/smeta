<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Тексты</span></h1>

    <div class='innerContent'>

        <?php if ( $errors ) { ?>
            <div class="inputBlock alert error">
                <?=implode(', ', $errors);?>
                <a href="#"></a>
            </div>
        <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <div class="inputBlock">
                <h3>Время отображения</h3>
                <table><tr><td><input name="time_start"  class="time_valid" type="text" value="" style="width:150px;" ></td><td> --- </td><td><input name="time_stop"  class="time_valid" type="text" value="" style="width:150px;" ></td></tr></table>
                  <script type="text/javascript" src="/resources/libs/jquery.inputmask.js"></script>
                                <script type="text/javascript" src="/resources/libs/jquery.inputmask.extensions.js"></script>
                                <script type="text/javascript" src="/resources/libs/jquery.inputmask.numeric.extensions.js"></script>
                            <script>
                                $(".time_valid").inputmask("99:99:99");
                            </script>
            </div>
            <div class="inputBlock">
                    <h3>Картинка</h3>
                    <?if(empty($object->img)):?>
                        <input class="m" name="img" type="file" >
                    <?else:?>
                        <img src="/resources/libs/slider/images/96_53_<?=$object->img;?>">
                        <a class="delete" href="/admin/slider/delete/<?=$object->id;?>?img">удалить</a>
                    <?  endif;?>
            </div>			
            <div class="inputBlock">
                    <h3>Видео</h3>
                          <input class="m" name="video" type="text" value="<?if(!empty($object->video)):?><?=$object->video?><?  endif;?>">
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