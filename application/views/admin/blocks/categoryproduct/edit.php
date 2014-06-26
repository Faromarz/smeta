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

			 <select name="id">
                            <option value="0">Добавить категорию</option>
                            <?if(is_array($object)):?>
                                <?  foreach ($object as $val):?>
                                    <option value="<?=$val->id?>"><?=str_repeat('-', $val->lvl);?><?=$val->name?></option>
                                <?  endforeach;?>
                            <?  endif;?>
                        </select>
                        <select name="fun">
                               <option value="add">Добавить категорию</option>
                               <option value="edit">Редактировать категорию</option>
                               <option value="del">Удалить категорию</option>
                       </select>
			 <input type="text" name="name">
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>&nbsp;</h3>
				<?=FORM::submit('ok', 'ОК', array('class' => 'm'));?>
			</div>
			<!--End inputBlock-->

		</form>

	</div>
	<!--End innerContent-->
</div> 
<!--End content-->	