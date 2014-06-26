<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Контактная информация</span></h1>

	<div class='innerContent'>
		<?php if ( $errors ) { ?>
		<div class="inputBlock alert error">
			<?=implode(', ', $errors);?>
			<a href="#"></a>
		</div>
		<?php } ?>

		<form action="" method="POST" enctype="multipart/form-data">

			<div class="inputBlock">
				<h3>адрес</h3>
				<div style="float: left; width: 800px;">
					<?=Form::input('adr', $adr, array('class'=> 'm', 'id' => 'adr_inp'))?>
				</div>
			</div>
                        <div class="inputBlock">
				<h3>телефон</h3>
				<div style="float: left; width: 800px;">
					<?=Form::input('phone', $phone, array('class'=> 'm', 'id' => 'phone_inp'))?>
				</div>
			</div>
                        <div class="inputBlock">
				<h3>e-mail</h3>
				<div style="float: left; width: 800px;">
					<?=Form::input('email', $email, array('class'=> 'm', 'id' => 'email_inp'))?>
				</div>
			</div>

			<div class="inputBlock">
				<h3>&nbsp;</h3>
				<?=FORM::submit('', 'Сохранить', array('class' => 'm'));?>
			</div>

		</form>
	</div>
</div>