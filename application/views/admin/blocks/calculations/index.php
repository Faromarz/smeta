<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Сметы</span></h1>

	<div class='innerContent'>
 
		<?php foreach ($objects as $object) { ?>
		<div class="itemNews">
                    <a target="_blank" href="/smeta/<?=$object->name;?><?=URl::query()?>"><h3>Расчет <?=$object->name;?> / <?=$object->create_date?> </h3></a>
			<!--<a href="/admin/calculations/edit/<?=$object->id;?><?=URl::query()?>"><h3>Расчет <?=$object->name;?> / <?=$object->create_date?> </h3></a>-->
                    <p class="specialFunctions">
                            <a target="_blank" href="/smeta/<?=$object->name;?><?=URl::query()?>">посмотреть</a> | 
                            <a class="delete" href="/admin/calculations/delete/<?=$object->id;?><?=URl::query()?>">удалить</a>
                    </p>
		</div>
		<!--End .itemNews-->
		<?php } ?>
	</div>
	<!--End innerContent-->

	<div style="height: 35px">
		<div style="margin: 0 auto;">
		<?=$pagination;?>
		</div>
	</div>
</div>
