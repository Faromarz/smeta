<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span><?=$title_text;?></span></h1>

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
				<h3>Текст</h3>
				<div style="float: left; width: 800px;">
					<?=Form::textarea('text', $text, array('class'=> 'm', 'id' => 'redactor'))?>
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