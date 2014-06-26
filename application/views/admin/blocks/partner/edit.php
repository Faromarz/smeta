<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Добавление партнера</span></h1>

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
                <input name="name" type="text" value="<?=$object->name;?>" >
            </div>
            
           <div class="inputBlock">
                <h3>&nbsp;</h3>
                <?=Form::submit('', 'Сохранить', array('class' => 'm'));?>
            </div>
            <!--End inputBlock-->

        </form>

    </div>
    <!--End innerContent-->
</div>
<!--End content-->	