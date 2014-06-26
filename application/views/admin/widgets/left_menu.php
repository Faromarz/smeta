<?if(is_array($links) && !empty($links)):?>
    <div class="menu">
            <h1><span>Меню</span></h1>
            <ul>
                <? foreach($links as $href => $name):?>
                    <li><a href="<?=$href;?>"><?=$name?></a></li>
                <? endforeach;?>
            </ul>	
    </div>
<?  endif;?>