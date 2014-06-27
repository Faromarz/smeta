<?php

class Controller_Admin_Seo extends Template_Admin
{
	public $template = 'admin/index';


	public function before()
	{
		parent::before();
		
		$this->template->left_menu->links = array(
			'/admin/seo/edit'	=> 'Добавить seo слова',
		);
	}


	public function action_index()
	{
		$seo = (array) Kohana::$config->load('seo');

		$this->template->title   = 'SEO настройки';
		$this->template->content = View::factory('admin/blocks/seo/index');
		$this->template->content->seo = $seo;
	}


	public function action_edit() 
	{
		$url 		= Arr::get($_GET, 'url');
		$errors 	= array();
		$seo 		= array();
		$params 	= array();

		try 
		{
			// Request this url
			$request = Request::factory($url);

			// Get route
			$route = $request->route();

			if ( !($route instanceof Route) )
				throw new Kohana_Exception("Неверный url-адрес");

			$config = (array) Kohana::$config->load('seo');

			if ( $request->directory() != NULL )
				$params[] = $request->directory();

			if ( $request->controller() != NULL ) 
				$params[] = $request->controller();

			if ( $request->action() != NULL )
				$params[] = $request->action();

			$params = array_merge($params, $request->param());

			$key = implode(Arr::$delimiter , $params);

			// Current settings
			$seo = (array) Arr::get($config, $key);

			if ( $_POST )
			{
				// Update currnet seo settings
				if ( ! Arr::get($_POST, 'title') )
					throw new Kohana_Exception("Title не должен быть пустым");
				
				$seo = Arr::extract($_POST, array('title', 'description', 'keywords'));
				$seo['route'] 	= Route::name($route);
				$seo['params'] 	= $params;
				$seo['url'] 	= $url;

				$config[ $key ] = $seo;

				file_put_contents( APPPATH.'config/seo.json', json_encode($config));

				HTTP::redirect('/admin/seo/');
			}


		}
		catch (Kohana_Exception $e) 
		{
			$errors[] = $e->getMessage();
		}

		$this->template->title   = 'SEO настройки';
		$this->template->content = View::factory('admin/blocks/seo/edit');
		$this->template->content->url    = $url;
		$this->template->content->seo    = $seo;
		$this->template->content->errors = $errors;
		$this->template->content->route  = $route;
		$this->template->content->request= $request;
	}


	public function action_delete()
	{
		$key = Arr::get($_GET, 'key');

		$config = Kohana::$config->load('seo');

		if ( array_key_exists($key, $config) )
			unset($config[$key]);

		file_put_contents( APPPATH.'config/seo.json', json_encode($config));

		HTTP::redirect('/admin/seo/');
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}

}
