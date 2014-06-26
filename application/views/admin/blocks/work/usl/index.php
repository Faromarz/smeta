<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Демонтажные работы</span></h1>

    <div class='innerContent'>
        <?php foreach ($objects as $object) { ?>
            <div class="itemNews">
                <a href="#">
                    <?=$object->id;?>  <?=$object->type_name;?> 
                </a>

                <p class="specialFunctions">
                    <a class="redact" href="/admin/work/usledit/<?=$object->id;?>">редактировать</a> |
                    <a class="delete" href="/admin/work/usldelete/<?=$object->id;?>">удалить</a>
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
