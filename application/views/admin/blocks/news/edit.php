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
				<h3>Категория</h3>
                                 <select name="cat_id">
                                    <option value="">Выбрать категорию</option>
                                        <?  foreach ($cat as $val):?>
                                    <option value="<?=$val->id?>" <?if($val->id == $object->cat_id || (isset($_GET['cat_id'])&&$val->id == $_GET['cat_id'])):?> selected<?  endif;?>><?=str_repeat('&nbsp;&nbsp;&nbsp;', $val->lvl);?><?=$val->name?></option>
                                        <?  endforeach;?>
                        </select>
			</div>
			<!--End inputBlock--> 
                        
			<div class="inputBlock">
				<h3>Картинка -<?=ini_get( 'upload_max_filesize')?></h3>
                                <?if(empty($object->img)):?>
				<input class="m" name="img" type="file">
                                <?else:?>
                                <img src="/resources/images/news/100_100_<?=$object->img?>">
                                <a href="/admin/news/delete?del_img=<?=$object->id?>">Удалить картинку</a>
                                <?  endif;?>
                                
			</div>
                        <div class="inputBlock">
				<h3>Alt для картинки</h3>
				<input class="m" name="img_alt" type="text" value="<?=$object->img_alt;?>" >
			</div>
			<div class="inputBlock">
				<h3>Title для картинки</h3>
				<input class="m" name="img_title" type="text" value="<?=$object->img_title;?>" >
			</div>
                        <div class="inputBlock">
				<h3>Транислит названия</h3>
				<input class="m" id="title_alias_news" name="alias" type="text" value="<?=$object->alias;?>" >
			</div>
			<div class="inputBlock">
				<h3>Название</h3>
				<input class="m" id="title_news" name="title" type="text" value="<?=$object->title;?>" >
			</div>
			
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>Контент</h3>
				<div style="float: left; width: 800px;">
					<?=Form::textarea('text', $object->text, array('class'=> 'm', 'id' => 'redactor'))?>
				</div>
			</div>
			
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>SEO title</h3>
				<input class="m" name="SEO_title" type="text" value="<?=$object->SEO_title;?>" >
			</div>
			<div class="inputBlock">
				<h3>SEO description</h3>
				<input class="m" name="SEO_description" type="text" value="<?=$object->SEO_description;?>" >
			</div>
                        <!--
			End inputBlock 

-->			<div class="inputBlock">
				<h3>SEO keywords</h3>
				<input class="m" name="SEO_keywords" type="text" value="<?=$object->SEO_keywords;?>" >
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