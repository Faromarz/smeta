<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Категории</span></h1>
	<div class='innerContent'>
		<?php if ( $errors ) { ?>
		<div class="inputBlock alert error">
			<?=implode(', ', $errors);?>
			<a href="#"></a>
		</div>
		<?php } ?>
            <form action="" method="POST" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value="0">
                                        Добавить категорию
                                    </td>

                                    <td>
                                        <input type="text" name="name">
                                    </td>
                                    <td>
                                        <?=Form::submit('add', 'Добавить категорию', array('class' => 'm'));?>
                                    </td>
                                </tr>
                            </table>
                    </form>
                <?  foreach ($object as $val):?>
                    <form action="" method="POST" enctype="multipart/form-data"  style="width: 100%;">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value="<?=$val->id?>">
                                        <?=str_repeat('&nbsp;&nbsp;&nbsp;', $val->lvl);?><input <?if($val->lvl == 1):?>style="font-size: 24px;"<?  endif;?> type="text" name="name1" value="<?=$val->name?>">
                                    </td>
                                    <td>
                                    <?php if($val->lvl == 1):?>
                                        <input type="text" name="name">
                                   <?php endif;?>
                                    </td>
                                    <td>
                                    <?php if($val->lvl == 1):?>
                                        <?=FORM::submit('add', 'Добавить подкатегорию', array('class' => 'm'));?>
                                   <?php endif;?>
                                    </td>
                                   
                                    <td>
                                        <?=FORM::submit('del', 'Удалить', array('class' => 'm del'));?>
                                    </td>
                                    <td>
                                        <?=FORM::submit('edit', 'Сохранить изменения', array('class' => 'm'));?>
                                    </td>
                                </tr>
                            </table>
                    </form>
                <?  endforeach;?>

	</div>
	<!--End innerContent-->
</div> 
<!--End content-->	