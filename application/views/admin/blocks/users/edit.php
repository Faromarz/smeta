<div class="content<?if(isset($class)):?><?=$class?><?  endif;?>">
<h1><span>Редактировать пользователя</span>
</h1>
<div class='innerContent'>
	<form action="" method="POST">
	<!--
		Succes: none
		Error: .error
		Info: .info
		Warning: .warning-->
	<?php if ( !empty($errors)) { ?>
 
	<div class="inputBlock alert error">
		<?=implode(", ", $errors);?>
<!--		<a href="#"></a>-->
	</div>-->
	<!--End inputBlock-->

	<?php } ?>
	
	<div class="inputBlock">
		<h3>Логин</h3>
		<input class="m" name="username" type="text" value="<?=$object->username;?>">
	</div>
	<div class="inputBlock">
		<h3>E-mail</h3>
		<input class="m" name="email" type="text" value="<?=$object->email;?>">
	</div>
	<div class="inputBlock">
		<h3>Телефон</h3>
		<input class="m" name="phone" type="text" value="<?=$object->phone;?>" class="phone">
	</div>
	<!--End inputBlock--> 

	<div class="inputBlock">
		<h3>Пароль</h3>
		<input class="m" name="password" type="password" value="">
	</div>
	<!--End inputBlock-->

	<div class="inputBlock">
		<h3>Еще раз</h3>
		<input class="m" name="password_confirm" type="password" value="">
	</div>
	<div class="inputBlock">
		<h3>Роль</h3>
                <table>
                    <tr>
                        <td>
                            <input type="checkbox" name="role[]" value="2"<?if($object->roles->where('role_id', '=', 2)->find()->loaded()):?> checked<?  endif;?> /></td>
                        <td>Админ</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="role[]" value="3"<?if($object->roles->where('role_id', '=', 3)->find()->loaded()):?> checked<?  endif;?> /></td>
                        <td>Партнер</td>
                    </tr>
                </table>
	</div>
	<!--End inputBlock--> 

	<div class="inputBlock">
		<h3>&zwnj;</h3>
		<input name="" type="submit" value="Сохранить" >
	</div>
	<!--End inputBlock-->
	
	</form>
</div>
<!--End innerContent-->
</div>