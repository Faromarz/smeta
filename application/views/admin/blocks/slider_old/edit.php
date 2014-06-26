<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Добавить слайд</span></h1>

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
                                <h3>Номер слайдера</h3>
                                    <input class="m" name="orderby" type="text" value="<?if(!empty($object->orderby)):?><?=$object->orderby?><?  endif;?>">
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
<!--                        <div class="inputBlock">
                                <h3>Заголовок</h3>
                                <input class="m" name="title" type="text" value="<?=$object->title;?>" >
                        </div>			-->
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>Заголовок</h3>
				<div style="float: left; width: 800px;">
					<?=Form::textarea('title', $object->title, array('class'=> 'm', 'id' => 'redactor'))?>
				</div>
			</div>
			<div class="inputBlock">
				<h3>Описание</h3>
				<div style="float: left; width: 800px;">
					<?=Form::textarea('text', $object->text, array('class'=> 'm', 'id' => 'redactor1'))?>
				</div>
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