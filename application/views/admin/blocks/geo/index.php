<div id="save_all_forms" style="position: fixed; right: 10px;top: 50%;background-color: green;height: 15px;padding: 7px 5px;cursor: pointer;z-index: 10;"> Сохранить все изменения</div>
<div class="content<?if(isset($class)):?><?=$class?><?  endif;?> geolocation">
    <?php foreach($res_c as $arr_c) { ?>
        <form name="input" action="/admin/geo/update" method="post">
            <h1>
			<span><?=$arr_c->name;?></span>
			<span>№</span>
			<span>Регион</span>
			<span>Коэф-т к работам</span>
			<span>Коэф-т к материалам</span>
			</h1>
			
	    <?$i = 0;	?>
            <?php foreach($res_r as $arr_r) { ?>
                <?php if($arr_c->id == $arr_r->country_id) { ?>
                <div class="innerContent">
                    <div class="itemNews">
						<div> <?=++$i;	?></div>
						<div>
							<a href="#"><h3><?=$arr_r->name;?></h3></a>
						</div>
						<div>
							<input name="<?=$arr_r->id;?>" type="text" value="<?=$arr_r->price;?>" >
						</div>
						<div>
							<input type="text" value="1" >
						</div>
                    </div>
                </div>
            <?php } } ?>
            <input type="hidden" name="country_update" value="<?=$arr_c->id;?>">
            <input type="submit" value="Submit"><br/><br/><br/><br/>
        </form>
    <?php } ?>
</div> 