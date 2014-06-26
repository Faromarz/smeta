
<div style="display: none" id="authModal" class="modal">
    <div class="tabs">
        <span class="tab active"  data-class="login"><?=__('Вхід')?></span>
        <span class="vertical divider"></span>
        <span class="tab" data-class="registration"><?=__('Реєстрація')?></span>
    </div>

    <form class="login" action="/auth/login" method="POST">
        <input type="text" name="email" value="" placeholder="<?=__('Логін або E-mail')?>">
        <input  type="password" name="password" placeholder="<?=__('Пароль')?>">
        <div class="bottom">
            <input id="c1" type="checkbox" name="rememberme" value="true">
            <label for="c1"><?=__('Запам’ятати')?></label>
            <div>
                <a href="/auth/forgot"><?=__('Забув пароль')?></a>
                <input type="submit" class="button" value="<?=__('Увійти')?>">
            </div>
        </div>
    </form>

    <form class="registration" action="/auth/registration" style="display: none;"  method="POST">
        <input type="text"  name="username" value="" placeholder="<?=__('Логін')?>">
        <input type="email" name="email" value=""  placeholder="<?=__('E-mail')?>">
        <input type="password" name="password" placeholder="<?=__('Пароль')?>">
        <input type="password" name="confirm_password" placeholder="<?=__('Повторіть пароль')?>">
        <div class="bottom">
            <input id="c2" type="checkbox" name="prof" value="true">
            <label for="c2"><?=__('Згоден з')?> <a href="#"><?=__('Умовами використання')?></a></label>
            <input type="submit" class="button" value="<?=__('Зареєструватися')?>">
        </div>
    </form>

    <div class="social">
        <span><?=__('Увійти через')?>:</span>
        <?//=Ulogin::factory()->render();?>
    </div>
    <a class="close-modal">&#215;</a>
</div>
<div id="wrapper">
	<div class="content blockAvtorization">
    	<h1><span>Авотризация</span></h1>
        <form action="" method="POST">
        	<input name="email" type="text" value="<?=Arr::get($_POST, 'email')?>" placeholder="Логин">
            <input name="password" type="password" id="password" placeholder="Пароль">
            <input name="" type="submit" value="Войти">
        </form>
        
    </div>
</div>