<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">

	<h1><span>Добавить SEO слова</span></h1>

	<div class='innerContent'>
		<form action="" method="GET">

			<?php if (!empty($errors)) { ?>
				<div class="inputBlock alert error"> <?= implode(", ", $errors); ?> </div> 
			<?php } ?>

			<div class="inputBlock">
				<h3>Вставте URL Страницы</h3>
				<input class="m" name="url" type="text" value="<?=$url;?>">
				<span class="note"><b>Внимание</b>: Необходимо указівать URL страници без домена, например: "/catalog/17"</span>
			</div>
			<!--End inputBlock-->

			<?php if ($route instanceof Route) { ?>
				<div class="inputBlock">
					<h3>Канонический URL:</h3>
					<span><?=URL::site($route->uri(array(
						'directory'	 => $request->directory(),
						'controller' => $request->controller(),
						'action'	 => $request->action(),
					) + $request->param()), TRUE);?></span>
				</div>
			<?php } ?>

			<div class="inputBlock">
				<h3>&zwnj;</h3>
				<input name="" type="submit" value="Продолжить" >
			</div>
			<!--End inputBlock-->
		</form>

		<?php if ($route instanceof Route) { ?>

			<div style="clear: both"></div><hr>
			<form action="" method="POST">

				<div class="inputBlock">
					<h3>SEO TITLE *</h3>
					<input class="m" name="title" type="text" value="<?=Arr::get($seo, 'title');?>">
				</div>
				<!--End inputBlock--> 

				<div class="inputBlock">
					<h3>SEO DESCRIPTION</h3>
					<input class="m" name="description" type="text" value="<?=Arr::get($seo, 'description');?>">
				</div>
				<!--End inputBlock-->
				
				<div class="inputBlock">
					<h3>SEO KEYWORDS</h3>
					<input class="m" name="keywords" type="text" value="<?=Arr::get($seo, 'keywords');?>">
				</div>
				<!--End inputBlock-->

				<div class="inputBlock">
					<h3>&zwnj;</h3>
					<input name="" type="submit" value="Сохранить" >
				</div>
				<!--End inputBlock-->
			</form>

		<?php } ?>

	</div>
	<!--End innerContent-->
</div>