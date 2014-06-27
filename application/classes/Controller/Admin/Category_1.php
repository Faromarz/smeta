<?php

class Controller_Admin_Category extends Controller_Admin_Index
{
	/**
	 * @var  View  page template
	 */

	public function before() {
		parent::before();
		
//		$this->template->left_menu->links = array(
//			'/admin/articles/create' => 'Добавить статью',
//		);
	}


	public function action_index()
	{
                $this->template->v_body->v_page = View::factory('admin/blocks/category/index')
                        ->bind('errors', $errors)
                        ->bind('object', $object);
                $this->template->v_body->v_page->class = ' full-content pages';
            $this->template->scripts = array('/resources/js/admin/category.js');
            if(isset($_POST['add']) && !empty($_POST['name'])){
                $cat = ORM::factory('Category');
                $cat->name = $_POST['name'];
                    if($_POST['id'] == 0){
                        if(ORM::factory('Category')->where('name', '=', $_POST['name'])->where('parent_id', '=', 0)->find()->loaded()){
                            $errors = array('Категория "'.$_POST['name'].'" уже добавлена');
                        }else{
                            $cat->make_root();
                }       
                    }else{
                        $cld = ORM::factory('Category',(int)$_POST['id'])->children();
                        if(ORM::factory('Category')->where('name', '=', $_POST['name'])->where('parent_id', '=', $cld[0]->parent_id)->find()->loaded()){
                            $errors = array('Подкатегория "'.$_POST['name'].'" уже добавлена');
                        }else{
                            $cat->insert_as_last_child((int)$_POST['id']);
                        }
                    }
            }else if(isset($_POST['edit']) && !empty($_POST['name1'])){
                $cat = ORM::factory('Category',$_POST['id']);
                if(ORM::factory('Category')->where('name', '=', $_POST['name1'])->where('parent_id', '=', $cat->parent_id)->find()->id != $_POST['id']){
                    $errors = array($_POST['name'].' - это название уже занято');
                }else{
                    $cat->name = $_POST['name1'];
                    $cat->img_alt = $_POST['img_alt'];
                    $cat->img_title = $_POST['img_title'];
                    $cat->save();
                }
            }else if(isset ($_POST['del'])){
                $cat = ORM::factory('Category',$_POST['id']);
                if (is_file('resources/images/category/'.$cat->img)){
                    if (unlink('resources/images/category/'.$cat->img)){}
                }
                if (is_file('resources/images/category/100_100_'.$cat->img)){
                    if (unlink('resources/images/category/100_100_'.$cat->img)){}
                }
                if (is_file('resources/images/category/40_40_'.$cat->img)){
                    if (unlink('resources/images/category/40_40_'.$cat->img)){}
                }
                if($cat->has_children()){
                    foreach ($cat->children() as $img){
                        if (is_file('resources/images/category/'.$img->img)){
                            if (unlink('resources/images/category/'.$img->img)){}
                        }
                        if (is_file('resources/images/category/100_100_'.$img->img)){
                            if (unlink('resources/images/category/100_100_'.$img->img)){}
                        }
                        if (is_file('resources/images/category/40_40_'.$img->img)){
                            if (unlink('resources/images/category/40_40_'.$img->img)){}
                        }
                    }
                }
                $cat->delete();
            }else if(isset ($_POST['del_img'])){
                $cat = ORM::factory('Category',$_POST['id']);
                if (is_file('resources/images/category/'.$cat->img)){
                    if (unlink('resources/images/category/'.$cat->img)){}
                }
                if (is_file('resources/images/category/100_100_'.$cat->img)){
                    if (unlink('resources/images/category/100_100_'.$cat->img)){}
                }
                if (is_file('resources/images/category/40_40_'.$cat->img)){
                    if (unlink('resources/images/category/40_40_'.$cat->img)){}
                }
                $cat->img = NULL;
                $cat->save();
            }else if(isset ($_POST['add_img']) && $_FILES['img']['tmp_name']){
                    $cat = ORM::factory('Category',$_POST['id']);
                    $file = $_FILES['img']['tmp_name'];
                    $name = $_FILES['img']['name'];
                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                    $cat->img = $this->_upload_img($file, $ext, $_POST['id']);
                    $cat->save();
            }
            $object = ORM::factory('category')->fulltree();
      
//		$pagination = $object->get_pagination();
		
//		$this->template->title   = 'iRen - administration system';
//		$this->template->v_body->v_page ->objects	 = $object;
//		$this->template->v_body->v_page ->objects	 = $object->get_objects($pagination);
//		$this->template->v_body->v_page ->pagination = $pagination;
	}
	
	/**
	 * Новая работа в портфолио
	 */
	public function action_create()
	{
		$this->template->v_body->v_page =  View::factory('admin/blocks/category/edit');
//		$object = ORM::factory('category');
//		$errors = array();
//		
//		if ($_POST)
//		{
//			try
//			{
//				// Создаём запись
////				$object = $object->create_article($_POST);
////				
////				HTTP::redirect("/admin/category/");
//			}
//			catch (ORM_Validation_Exception $e) 
//			{
//				$errors = Arr::flatten($e->errors(""));
//			}
//		}
		
		$this->template->v_body->v_page ->title = 'Добавить категорию';
		$this->template->v_body->v_page ->errors = $errors;
		$this->template->v_body->v_page ->object = $object;
	}
	
	/**
	 * Редактирование основних параметров работи в портфолио
	 * 
	 * @throws Kohana_HTTP_Exception_404
	 */
	public function action_edit() 
	{
		$object = ORM::factory('category', $this->request->param('param'));
		$this->template->v_body->v_page  =  View::factory('admin/blocks/category/edit');
		$errors = array();
		
		// Если рабр\оти нет, тогда 404 ошибка
		if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");
	
		if ( $_POST )
		{
			try
			{
				// Обновление даних
				$object->update_article( $_POST );

				HTTP::redirect("/admin/category/");
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->title 	= 'Редактирование';
		
		$this->template->v_body->v_page  	= View::factory('admin/blocks/category/edit');
		$this->template->v_body->v_page ->object = $object;
		$this->template->v_body->v_page ->errors = $errors;
	}

	/**
	 * Удаление работу
	 * 
	 * @throws Kohana_HTTP_Exception_404 
	 */
	public function action_delete()
	{
		$object = ORM::factory('category', $this->request->param('param'));
		
		if ( $object->loaded() ) {
			
			$object->delete();
			HTTP::redirect('/admin/category');

		} else {
			throw new Kohana_HTTP_Exception_404("Страница не найдена");
		}
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->v_body->v_page ->class = ' full-content pages';
		parent::after();
	}
        public function _upload_img($file,$ext,$filename) {
            if ($ext == NULL) {   $ext = 'jpg';        }
            if ($filename == NULL) {  
                 $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';
                $filename = '';
                
                for ($i = 0; $i < 10; $i++) {
                    $key = rand(0, strlen($symbols)-1);
                    $filename .= $symbols[$key];
                }
            }

            $directory = 'resources/images/category/';
             // генерируем название
  
            $image = Image::factory($file);
//            $image->save("$directory/logo/$filename.$ext");// сохряняем оригинал
            $ratio = $image->width / $image->height;// коефициент картинки
            
        $watermark= Image::factory("resources/images/log.png"); 
        $ratio = $image->width / $image->height;
        $ratio_2 = $watermark->width / $watermark->height;
         if($ratio < $ratio_2){
            $watermark->resize($image->width, $image->height, Image::WIDTH);
        }else{
            $watermark->resize($image->width, $image->height, Image::HEIGHT);
        }      
        $image->watermark($watermark, NULL, NULL, 20);
         $image->save("$directory/$filename.$ext");

            // лого для стр. события    
            $width = '290';        
            $height = '1000'; 
            if($image->height > $height || $image->width > $width){
                // изменяем размер изобржаения и загружаем
                $original_ratio = $width / $height;// нужный коефициент картинки
                if($ratio > $original_ratio){
                    $image->resize($width, $height, Image::WIDTH);
                }else{
                    $image->resize($width, $height, Image::HEIGHT);
                }
            }
            $image->save("$directory/290_$filename.$ext");
            // лого для стр. события    
            $width = '100';        
            $height = '100'; 
            if($image->height > $height || $image->width > $width){
                // изменяем размер изобржаения и загружаем
                $original_ratio = $width / $height;// нужный коефициент картинки
                if($ratio > $original_ratio){
                    $image->resize($width, $height, Image::WIDTH);
                }else{
                    $image->resize($width, $height, Image::HEIGHT);
                }
            }
            $image->save("$directory/100_100_$filename.$ext");
            $width = '40';        
            $height = '40'; 
            if($image->height > $height || $image->width > $width){
                // изменяем размер изобржаения и загружаем
                $original_ratio = $width / $height;// нужный коефициент картинки
                if($ratio > $original_ratio){
                    $image->resize($width, $height, Image::WIDTH);
                }else{
                    $image->resize($width, $height, Image::HEIGHT);
                }
            }
            $image->save("$directory/40_40_$filename.$ext");
            
            return $filename.'.'.$ext;
        }
}
