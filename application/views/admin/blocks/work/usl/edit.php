<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span><?=htmlspecialchars($object->type_name);?></span></h1>

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
                <input name="type_name" type="text" value="<?=htmlspecialchars($object->type_name);?>" >
            </div>
            
                              
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