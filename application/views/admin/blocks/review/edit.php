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
				<h3>Подпись</h3>
				<input class="m" name="user" type="text" value="<?=$object->user;?>" >
			</div>
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>Город</h3>
				<input class="m" name="city" type="text" value="<?=$object->city;?>" >
			</div>
			
			<!--End inputBlock--> 

			<div class="inputBlock">
				<h3>Отзыв</h3>
				<div style="float: left; width: 800px;">
					<?=Form::textarea('text', $object->text, array('class'=> 'm', 'id' => 'redactor'))?>
				</div>
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