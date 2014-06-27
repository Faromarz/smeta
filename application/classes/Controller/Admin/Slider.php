<?php

class Controller_Admin_Slider extends Controller_Admin_Index
{
    /**
     * @var  View  page template
     */

    public function before() {
        parent::before();

//        $this->template->left_menu->links = array(
//            '/admin/timpl/create'	=> 'Добавить работу',
//        );
    }


    public function action_index()
    {
        if(isset($_POST['save'])){
             try
            {
                // Обновление даних
                $object = ORM::factory('slider', (int)$_POST['id']);
                
                                              
                    $post = $_POST;
                if(!empty($_POST['video'])){
                    $video = $_POST['video'];
                    $post['video'] = $video;
                }else if($_FILES['img']['tmp_name']){
                    $file = $_FILES['img']['tmp_name'];
                    $name = $_FILES['img']['name'];
                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                    $filename = $this->_upload_img($file, $type);
                    $post['img'] = $filename;
                }
                    // Создаём запись
                
                $object->update_slider( $post );
                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
                if(isset($_POST['ajax'])){
                    die ($errors);
                }
            }
            
        }elseif(isset ($_POST['del'])){
            $work = ORM::factory('slider',(int)$_POST['id'])->delete();
        }
        $this->template->styles[] = '/resources/css/admin/timpl.css';
        $object = ORM::factory('slider');

//        $pagination = $object->where('type_id' , '=', 31)->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/slider/index');
//        $this->template->v_body->v_page->class = ' full-content pages';
        $this->template->title   = 'iRen - administration system';
        $this->template->v_body->v_page->objects	 = $object->order_by('id')->find_all();
//        $this->template->content->pagination = $pagination;
        
//        echo View::factory('profiler/stats');
    }

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
        $this->template->v_body->v_page =  View::factory('admin/blocks/slider/edit');
        $this->template->v_body->v_page->class = ' full-content pages';
        $object = ORM::factory('slider');
        $errors = array();

       if ($_POST)
		{
			try
			{
                           
                            $video = NULL;
                           
                                
                               
                           
                            if(!empty($_POST['video'])){
                                $video = $_POST['video'];
                            }else{
                                 $file = $_FILES['img']['tmp_name'];
                                $name = $_FILES['img']['name'];
                                $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                                $filename = $this->_upload_img($file, $type);
                            }
				// Создаём запись
                                $post = $_POST;
                                $post['img'] = $filename;
                                $post['video'] = $video;
				$object = $object->create_slider($post);
				
				HTTP::redirect("/admin/slider/");
			}
			catch (ORM_Validation_Exception $e) 
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}

        $this->template->title = 'Добавить слайд';
        $this->template->v_body->v_page->errors = $errors;
        $this->template->v_body->v_page->object = $object;
    }

    /**
     * Редактирование основних параметров работи в портфолио
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_edit()
    {
        $object = ORM::factory('slider')->where('id', '=', $this->request->param('param'))
               ->find();
        $this->template->v_body->v_page =  View::factory('admin/blocks/slider/edit');
        $this->template->v_body->v_page->class = ' full-content pages';
        $errors = array();
        $id = $object->id;
        $count = ORM::factory('slider')->where('id', '<=', $id)->count_all();
        $page = ceil ($count/10);
        $next = ORM::factory('slider')->where('id', '=', $id+1)->find();
        if($next->loaded())$id = $next->id;

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_slider( $_POST );
              

                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }else{
                    if(isset($_POST['save'])){
                        HTTP::redirect('/admin/slider/?page='.$page);
                    }else{
                        HTTP::redirect('/admin/slider/');
                    }
                }
            }
            catch (ORM_Validation_Exception $e)
            {
                if(isset($_POST['ajax'])){
                    die (Arr::flatten($e->errors("")));
                }else{
                    $errors = Arr::flatten($e->errors(""));
                }
            }
        }

        $this->template->title 	= 'Редактирование';

        $this->template->v_body->v_page 	= View::factory('admin/blocks/help/edit');
        $this->template->v_body->v_page->object = $object;
        $this->template->v_body->v_page->errors = $errors;
    }

    /**
     * Удаление работу
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
       $object = ORM::factory('slider', $this->request->param('param'));
		
		if ( $object->loaded() ) {
                        
			if (is_file('resources/libs/slider/images/'.$object->img)){
                            if (unlink('resources/libs/slider/images/'.$object->img)){}
                        }
			if (is_file('resources/libs/slider/images/540_300_'.$object->img)){
                            if (unlink('resources/libs/slider/images/540_300_'.$object->img)){}
                        }
                        
			if (is_file('resources/libs/slider/images/96_53_'.$object->img)){
                            if (unlink('resources/libs/slider/images/96_53_'.$object->img)){}
                        }
                        if(isset($_GET['img'])){                            
                            $object->img = NULL;
                            $object->save();
                            HTTP::redirect('/admin/slider/');                            
                        }else if(isset($_GET['video'])){
                            $object->video = NULL;
                            $object->save();
                            HTTP::redirect('/admin/slider/'); 
                        }else{
                            $object->delete();
                        }

		} else {
			throw new Kohana_HTTP_Exception_404("Материал не загружен");
		}
    }
    public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}
             public function _upload_img($file,$ext) {

        $directory = 'resources/libs/slider/images/';

        // генерируем название
        $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';

        $filename = '';
        for ($i = 0; $i < 10; $i++) {
            $filename .= rand(1, strlen($symbols));
        }
        // изменяем размер изобржаения и загружаем
        copy($file, $directory . $filename . '.' . $ext);
        
        $image = Image::factory($file);
        $ratio = $image->width / $image->height;// коефициент картинки
        
        $width = '540';        
        $height = '300';  
        if($image->height > $height || $image->width > $width){
                  
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/540_300_$filename.$ext");
        $width = '96';        
        $height = '53';  
        if($image->height > $height || $image->width > $width){
                  
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/96_53_$filename.$ext");
       
        return "$filename.$ext";
    }
}
