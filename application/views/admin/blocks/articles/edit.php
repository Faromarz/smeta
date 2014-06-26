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
				<h3>Превдоним</h3>
				<input class="m" name="alias" type="text" value="<?=$object->alias;?>" >
			</div>
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>Название</h3>
				<input class="m" name="name" type="text" value="<?=$object->name;?>" >
			</div>
			<?if($object->alias == 'about'):?>
                            <div class="inputBlock">
				<h3>Картинка</h3>
                                <?if(empty($object->img)):?>
                                    <input class="m" name="img" type="file" />
                                <?  else:?>
                                    <img src="/resources/images/category/about_40_40_<?=$object->img?>" /><a href="/admin/articles/delimg/<?=$object->id;?>">Удалить картинку</a>
                                <?  endif;?>
                            </div>
                            <div class="inputBlock">
				<h3>ALT для картинки</h3>
				<input class="m" name="img_alt" type="text" value="<?=$object->img_alt;?>" >
                            </div>
                            <div class="inputBlock">
				<h3>Title для картинки</h3>
				<input class="m" name="img_title" type="text" value="<?=$object->img_title;?>" >
                            </div>
                        <?  endif;?>
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>Контент</h3>
				<div style="float: left; width: 800px;">
					<?=Form::textarea('content', $object->content, array('class'=> 'm', 'id' => 'redactor'))?>
				</div>
			</div>
			<div class="inputBlock">
				<h3>Дополнительное поле</h3>
				<div style="float: left; width: 800px;">
					<?=Form::textarea('name2', $object->name2, array('class'=> 'm', 'id' => 'redactor1'))?>
				</div>
			</div>
			<!--End inputBlock--> 


			<div class="inputBlock">
				<h3>SEO title</h3>
				<input class="m" name="title" type="text" value="<?=$object->title;?>" >
			</div>
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>SEO description</h3>
				<input class="m" name="description" type="text" value="<?=$object->description;?>" >
			</div>
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>SEO keywords</h3>
				<input class="m" name="keywords" type="text" value="<?=$object->keywords;?>" >
			</div>
			<!--End inputBlock--> 

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