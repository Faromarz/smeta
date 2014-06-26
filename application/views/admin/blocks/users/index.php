<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Пользователи</span></h1>

	<div class='innerContent'>
		<?php if (empty($objects)) { ?>
			
		<center>Пользователей не найдени <a href="/admin/profile/new">Добавить нового</a></center>
		
		<?php } ?>
		<?php foreach($objects as $object) { ?>

		<div class="itemNews">
			<p><strong><?=$object->username;?></strong></p>
			<p class="specialFunctions">
				<a class="redact" href="/admin/users/edit/<?=$object->id?>">редактировать</a> | 
				<a class="delete" href="/admin/users/delete/<?=$object->id?>" onclick="return confirm('Удалить?')">удалить</a>
			</p>
		</div>
		<!--End .itemNews-->
		
		<?php } ?>
	</div>
	<!--End innerContent-->
</div>