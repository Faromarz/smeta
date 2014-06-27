<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
	<h1><span>Категории</span></h1>
	<div class='innerContent'>
		<?php if ( $errors ) { ?>
		<div class="inputBlock alert error">
			<?=implode(', ', $errors);?>
			<a href="#"></a>
		</div>
		<?php } ?>
            <form action="" method="POST" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value="0">
                                        Добавить категорию
                                    </td>

                                    <td>
                                        <input type="text" name="name">
                                    </td>
                                    <td>
                                        <?=Form::submit('add', 'Добавить категорию', array('class' => 'm'));?>
                                    </td>
                                </tr>
                            </table>
                    </form>
                <?  foreach ($object as $val):?>
                    <form action="" method="POST" enctype="multipart/form-data"  style="width: 100%;">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <input type="hidden" name="id" value="<?=$val->id?>">
                                        <?=str_repeat('&nbsp;&nbsp;&nbsp;', $val->lvl);?><input <?if($val->lvl == 1):?>style="font-size: 24px;"<?  endif;?> type="text" name="name1" value="<?=$val->name?>">
                                    </td>
                                   
                                    <td>
                                        <input type="text" name="name">
                                    </td>
                                    <td>
                                        <?=FORM::submit('add', 'Добавить подкатегорию', array('class' => 'm'));?>
                                    </td>
                                   
                                    <td>
                                        <?=FORM::submit('del', 'Удалить', array('class' => 'm del'));?>
                                    </td>
                                    <?if(empty($val->img)):?>
                                        <td>
                                           <input type="file" name="img">
                                        </td>
                                        <td>
                                            <?=FORM::submit('add_img', 'Добавить картинку', array('class' => 'm'));?>
                                        </td>
                                    <?else:?>
                                        <td>
                                            <img src="/resources/images/category/40_40_<?=$val->img?>">
                                        </td>
                                        <td>
                                            <?=FORM::submit('del_img', 'Удалить картинку', array('class' => 'm del_img'));?>
                                        </td>
                                    <?  endif;?>
                                    <td>
                                        <input type="text" name="img_alt" value="<?=$val->img_alt?>" placeholder="Alt для картинки">
                                    </td>
                                    <td>
                                        <input type="text" name="img_title" value="<?=$val->img_title?>"  placeholder="Title для картинки">
                                    </td>
                                    <td>
                                        <?=FORM::submit('edit', 'Сохранить изменения', array('class' => 'm'));?>
                                    </td>
                                    <td>
                                       <a href="/admin/news/create?cat_id=<?=$val->id?>">Добавить статью</a>
                                    </td>
                                </tr>
                            </table>
                    </form>
                    <? $news = ORM::factory('news')->where('cat_id', '=', $val->id)->find_all(); ?>
                    <?if(isset($news[0]->id)):?>
                        <?  foreach ($news as $n):?>
                            <table>
                                <tr>
                                    <td>
                                        <?=str_repeat('&nbsp;&nbsp;&nbsp;', $val->lvl+1);?><a href="/admin/news/edit/<?=$n->id?>"><?=$n->title?></a>
                                    </td>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;<a class="del_news" href="/admin/news/delete/<?=$n->id?>">Удалить</a>
                                    </td>
                                  
                                    <td>
                                        &nbsp;&nbsp;&nbsp;<a href="/admin/news/edit/<?=$n->id?>">Редактировать</a>
                                    </td>
                                </tr>
                            </table>
                        <?  endforeach;?>
                    <?  endif;?>
                <?  endforeach;?>

	</div>
	<!--End innerContent-->
</div> 
<!--End content-->	