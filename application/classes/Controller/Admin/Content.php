<?php

class Controller_Admin_Content extends Controller_Admin_Index
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
        $name_img = 'no_photo.png';
        if(isset($_FILES['img']['tmp_name'])){
                $file = $_FILES['img']['tmp_name'];
                $name = $_FILES['img']['name'];
                $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                if($type == 'png'){
                    if (is_file('resources/images/par/'.$object->img)){
                        if (unlink('resources/images/par/'.$object->img)){}
                    }
                    if (is_file('resources/images/par/290_'.$object->img)){
                        if (unlink('resources/images/par/290_'.$object->img)){}
                    }
                    if (is_file('resources/images/par/100_100_'.$object->img)){
                        if (unlink('resources/images/par/100_100_'.$object->img)){}
                    }
                    if (is_file('resources/images/par/40_40_'.$object->img)){
                        if (unlink('resources/images/par/40_40_'.$object->img)){}
                    }
                    $this->_upload_img($file, 'png', 'no_photo');
                } else {
                    $errors = array('img'=>'Файл должен быть формата png');
                }
        }
                            
        if(isset($_POST['save'])){
             try
            {
                // Обновление даних
                $object = ORM::factory('Content', (int)$_POST['id']);
                $object->update_type( $_POST );
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
            $work = ORM::factory('Content',(int)$_POST['id'])->delete();
        }
        $this->template->styles[] = '/media/css/admin/timpl.css';
        $object = ORM::factory('Content');

//        $pagination = $object->where('type_id' , '=', 31)->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/content/index');
        $this->template->v_body->v_page->objects	 = $object->order_by('id')->find_all();
//        $this->template->content->pagination = $pagination;
//        $this->template->v_body->v_page->errors = $errors;
        
//        echo View::factory('profiler/stats');
    }

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
        $this->template->v_body->v_page =  View::factory('admin/blocks/content/edit');
        $object = ORM::factory('Content');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->create_type($_POST);

                HTTP::redirect("/admin/content/");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->v_body->v_page->title = 'Добавить подсказку';
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
        $object = ORM::factory('Content')->where('id', '=', $this->request->param('param'))
               ->find();
        $this->template->v_body->v_page =  View::factory('admin/blocks/content/edit');
        $errors = array();
        $id = $object->id;
        $count = ORM::factory('Content')->where('id', '<=', $id)->where('type_id', '=', 31)->count_all();
        $page = ceil ($count/10);
        $next = ORM::factory('Content')->where('id', '=', $id+1)->where('type_id', '=', 31)->find();
        if($next->loaded())$id = $next->id;

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_type( $_POST );
              

                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }else{
                    if(isset($_POST['save'])){
                        HTTP::redirect('/admin/content/?page='.$page);
                    }else{
                        HTTP::redirect('/admin/content/edit/'.$id);
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
        $object = ORM::factory('Content', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect('/admin/content');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    public function after() {
//        $this->template->v_body->v_page->class = ' full-content pages';
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}
        public function _upload_img($file,$ext,$filename) {
            if ($ext == NULL) {   $ext = 'png';        }
            if ($filename == NULL) {  
                 $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';
                $filename = '';
                
                for ($i = 0; $i < 10; $i++) {
                    $key = rand(0, strlen($symbols)-1);
                    $filename .= $symbols[$key];
                }
            }

            $directory = 'resources/images/par/';
             // генерируем название
               
            $image = Image::factory($file);
//            $image->save("$directory/$filename.$ext");// сохряняем оригинал
            $ratio = $image->width / $image->height;// коефициент картинки
            
          
         $image->save("$directory/$filename.$ext");
         
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
