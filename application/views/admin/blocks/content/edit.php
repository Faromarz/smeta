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
                <h3>alias</h3>
                <input name="alias" type="text" value="" >
            </div>
            <div class="inputBlock">
                <h3>Название</h3>
                <input name="title" type="text" value="" >
            </div>
         
            <div class="inputBlock">
                <h3>Текст</h3>
                <textarea name="text"></textarea>
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