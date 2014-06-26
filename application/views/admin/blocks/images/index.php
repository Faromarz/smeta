<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
    <h1><span>Кртинки</span></h1>

    <div class='innerContent'>
      
          <div class="itemNews">
                <a href="#"><h3>Картинок нужно</h3></a><?=$products_count?>
            </div>
            <div class="itemNews">
                <a href="#"><h3>Оригинальных картинок</h3></a><?=$objects?>

<!--                <p class="specialFunctions">
                    <a class="redact" href="/admin/partner/edit/<?//=$object->id;?>">редактировать</a> |
                    <a class="delete" href="/admin/partner/delete/<?//=$object->id;?>">удалить</a>
                </p>-->
            </div>
          <div class="itemNews">
                <a href="#"><h3>Картинок 80x80</h3></a><?=$objects80?>
            </div>

    </div>
    <!--End innerContent-->

    <div style="height: 35px">
        <div style="margin: 0 auto; width:400px;">
            <?//=$pagination;?>
        </div>
    </div>
</div>
