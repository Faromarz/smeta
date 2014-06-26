<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Страницы</span></h1>

	<div class='innerContent'>

		<?php foreach ($objects as $object) { ?>
		<div class="itemNews">
			<a href="#"><h3><?=$object->title;?></h3></a>
<!--                        <div><?//=$object->content;?></div>
                        <div><?//=$object->name2;?></div>-->

			<p class="specialFunctions">
				<a class="redact" href="/admin/news/edit/<?=$object->id;?>">редактировать</a> | 
				<a class="delete" href="/admin/news/delete/<?=$object->id;?>">удалить</a>
			</p>
		</div>
                
		<!--End .itemNews-->
		<?php } ?>
	</div>
	<!--End innerContent-->

	<div style="height: 35px">
		<div style="margin: 0 auto; width:400px;">
		<?=$pagination;?>
		</div>
	</div>
</div>
