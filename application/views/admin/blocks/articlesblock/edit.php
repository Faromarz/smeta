<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Общая информация</span></h1>

	<div class='innerContent'>

		<?php if ( $errors ) { ?>
		<div class="inputBlock alert error">
			<?=implode(', ', $errors);?>
			<a href="#"></a>
		</div>
		<?php } ?>

		<form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="block" value="1" />
			<div class="inputBlock">
				<h3>Страница</h3>
				<input class="m" name="alias" type="text" value="<?=$object->alias;?>" >
			</div>
			<div class="inputBlock">
				<h3>Описание</h3>
				<input class="m" name="name" type="text" value="<?=$object->name;?>" >
			</div>


			<div class="inputBlock">
				<h3>Контент</h3>
				<div style="float: left; width: 800px;">
                                        <textarea class="js-st-instance" name="content"><?=$object->content?></textarea>
  
                                         <script>
                                            new SirTrevor.Editor({ el: $('.js-st-instance') });
                                                       SirTrevor.setDefaults({
                                                           uploadUrl: "/index/ajax/pageimg"
                                                         });
                                          </script>
				</div>
			</div>

			<div class="inputBlock">
				<h3>&nbsp;</h3>
				<?=  Form::submit('', 'Сохранить', array('class' => 'm'));?>
			</div>
			<!--End inputBlock-->

		</form>

	</div>
	<!--End innerContent-->
</div>
<!--End content-->	