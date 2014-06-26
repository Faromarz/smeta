<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
		<h1><span>SEO настройки</span></h1>

	<div class='innerContent'>
	<?php if (empty($seo)) { ?>

		<div class="itemNews">
			<center>SEO груп не найдено. <a href="/admin/seo/edit">Добавить SEO слова</a></center>
		</div>
		
	<?php } else foreach($seo as $key => $seoItem) { ?>

		<div class="itemNews">
			<p><strong>Страница</strong></p>
			<input name="" type="text" class="urlField" value="<?=URL::site($seoItem['url'], TRUE);?>">
			<p class="specialFunctions">
				<a target="_blank" href="<?=URL::site($seoItem['url'], TRUE);?>">посмотреть</a> | 
				<a class="redact" href="<?=URL::site(Route::get('administrator')->uri(array(
					'directory'		=> 'admin',
					'controller'	=> 'seo',
					'action'		=> 'edit'
				)) . URL::query($seoItem))?>">редактировать</a> | 
				<a class="delete" href="<?=URL::site(Route::get('administrator')->uri(array(
					'directory'		=> 'admin',
					'controller'	=> 'seo',
					'action'		=> 'delete'
				)) . URL::query(array( 'key'=> $key)))?>" onclick="return confirm('Удалить?')">удалить</a>
			</p>
		</div>

	<?php } ?>

	</div>
	<!--End innerContent-->
</div>