<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Login extends Template_Admin
{
	public $template = 'admin/login';
        protected $domain_name;
        protected $auth;
        

	public function before()
	{
		parent::before();
                $this->auth = Auth::instance();
                $subdomain_mass = explode('.', $_SERVER['SERVER_NAME']); if (count($subdomain_mass) == 3) {$this->domain_name = $subdomain_mass[1] . '.' . $subdomain_mass[2];} else {$this->domain_name = $subdomain_mass[0] . '.' . $subdomain_mass[1];}
                View::set_global('domain_name', $this->domain_name);
                
		$this->template->left_menu->links = array(
			"/admin/users/new" => 'Добавить пользователя',
		);
	}
	
	public function action_index()
	{
            if($this->auth->logged_in() != 0){
			 HTTP::redirect('http://'.$this->domain_name);              
            }
		$login = Arr::get($_POST, 'login');
		$pass = Arr::get($_POST, 'pass');

		if ( $_POST AND $this->auth->login($login, $pass) )
		{
			HTTP::redirect('/');
		}
		 
		$this->template->title   = 'Авторизация';
	}
        
	public function action_start()
	{
            if($this->request->param('login') != 'start'){
                HTTP::redirect('http://'.$this->domain_name);
            }
         $count = Cookie::get('count_see', 1);
         Cookie::$domain = 'mastersmeta.ru';
         Cookie::set('count_see', ++$count, Date::WEEK);
            
           
            if(isset($_POST['email'])){
            $post = Validation::factory($_POST);
            
            $post->label('email', __('Email'))
                    ->rules( 'email', array(
                            array('not_empty'),
                            array('max_length', array(':value', 254)),
                            array('email')
                    ))
               ;
            
           if($post -> check()){
               $user = ORM::factory('user')->where('email', '=', $post['email'])->find();
               if($user->loaded()){
                    $errors = array('email' => __('Этот Email уже занят.').' <a href="/remember">'.__('Востановить пароль').'</a>');
                    $errors = array('email' => __('Этот Email уже занят.'));
               }else{
                    $password = func::generateCode(8);
                  
                    $login = func::generatelogin();
                    $data = $_POST;
                    $data['password']= $password;
                    $data['username']= $login;
                    $orm_user = ORM::factory('user');
                    $orm_user->values($data)->create()->add('roles', 1);
//                    $orm_user = ORM::factory('user')->values($data)->create();
//                    $orm_user->add('roles', ORM::factory('Role', array('name' => 'login')));
                    
                    // отправляем пользователю пароль
                    $to = $post['email']; //Кому
                    $from = "ab@mastersmeta.ru"; //От кого
//                    $shablon = ORM::factory('Email')->get_one(I18n::lang(),'regist');
//                    $shablon = $shablon[0];
                    $message = 'Здравствуйте. Спасибо, что воспользовались сервисом MasterSmeta
<br><br>
Знаете, у меня была такая же головная боль, как и у вас - понять: сколько же стоит ремонт моей квартиры? Какие работы необходимо произвести? В каком объёме? Какие материалы? В каком количестве? Как это всё посчитать, что бы не купить лишнее и не потратить деньги?
<br><br>
Какую ремонтную компанию выбрать? Что бы не обманули и ничего не сломали в моей квартире! Сделали качественно и в срок. Вариант - вызывать домой много разных бригад и ждать, кто же сможет себя продать. А как они продают - мы знаем уж. С начала говорят одно, а на деле оказывается другое.
<br><br>
Долго искал нужный сервис. Не нашёл. И решил! Создам такой сервис для себя и для всех, кто делает ремонт. И создал!
<br><br>
Посмотрев видео-ролик на главной странице http://mastersmeta.ru/ Вы узнаете, как за 2 минуты решить все задачи. Хотя всё и так максимально понятно.
<br><br>
И сейчас я хочу Вам помочь МАКСИМАЛЬНО эффективно использовать своё время и деньги.
<br><br>
Скажите, что бы вы ещё хотели увидеть на сервисе? Что поможет вам выбрать представленную компанию? 
<br><br>
Пожалуйста, помогите себе и другим людям, напишите, что вы ждёте от сайта - ПРЯМО СЕЙЧАС! (и мы это постараемся учесть в ближайшее время)
<br><br>
Ваш логин для доступа к сервису: '.$to.'<br>
Ваш пароль: '.$password.'<br>
<br>
С уважением,<br>
Генеральный директор<br>
сервиса MasterSmeta.ru<br>
Александр Быстров<br>
Звоните: 8 (903) 100-71-31<br>
Пишите: ab@mastersmeta.ru';
                    $subject = 'MasterSmeta - Ваша помощь при ремонт квартир. Логин + Пароль. Александр';
                    $boundary = "---"; //Разделитель
                    $headers = "From: $from\nReply-To: $from\n";
                    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";
                    $body = "--$boundary\n";
                    /* Присоединяем текстовое сообщение */
                    $body .= "Content-type: text/html; charset=utf-8 \n";
                    $body .= "Content-Transfer-Encoding: quoted-printablenn;";
                    $body .= "Content-Disposition: attachment; filename==?utf-8?B?=\n\n";
                    $body .= $message."\n";
                    mail($to, "=?utf-8?B?".base64_encode($subject)."?=", $body, $headers); //Отправляем письмо
//                    $exp = explode('@', $to);
//                    $page->message =  __('На Вашу почту').' '.$to.' '.__('отправлен новый пароль. Перейти на почту').': <a target="_blank" href="http://'.$exp[1].'">'.$exp[1].'</a>';
               }
               if (Auth::instance()->login($to, $password) )
		{
			HTTP::redirect('http://'.$this->domain_name);
                }
                
           }else{
                $errors = $post->errors('validation');
           }
        }
        
                 $this->template = View::factory('site/auth/v_login');
                 $this->template->scripts = array('/resources/js/start.js');
                 

		
		 
		$this->template->title   = 'Авторизация';
                $this->template->errors = $errors;
	}


	public function action_logout() 
	{
		Auth::instance()->logout();
		HTTP::redirect('/login');
	}
}
