<?php

class Controller_Admin_Images extends Template_Admin
{
    /**
     * @var  View  page template
     */
    public $template = 'admin/index';

    public function before() {
        parent::before();

        $this->template->title   = 'Картинки';
    }


    public function action_prod(){
        $lam = ORM::factory('laminat')
                ->where('pl', 'is', NULL)
                ->where('thic_cm', 'is not', NULL)
                ->find_all();
        foreach ($lam as $val){
            $str = str_replace('x','|',$val->thic_cm);
            $str = str_replace('х','|',$str);
            $ex = explode('|', $str);
            $val->pl = bcdiv(bcmul($ex[0],$ex[1],2),1000,2);
            $val->save();
        }
        die('готово');
       
    }
    public function action_index()
    {
        $products_count = ORM::factory('product')->where('image', 'is not', NULL)->count_all();
        $products = ORM::factory('product')->where('image', 'is not', NULL)->find_all();
        
        foreach ($products as $val){
            if (!is_file('resources/images/products/80_80/'.$val->image)){
                if (is_file('resources/images/products/'.$val->image)){
                    $file = 'resources/images/products/'.$val->image;

                    $this->_upload_img($file, $val->image);
                }
            }
        }
        
        $dir = opendir('resources/images/products/');
        $dir80 = opendir('resources/images/products/80_80/');
        $count = 0;
        $count80 = 0;
        foreach (glob('resources/images/products/*') as $file) {
            if($file == '.' || $file == '..' || is_dir('resources/images/products/80_80' . $file)){
                continue;
            }
            $count++;
        }
        foreach (glob('resources/images/products/80_80/*') as $file) {
            if($file == '.' || $file == '..' || is_dir('resources/images/products/80_80' . $file)){
                continue;
            }
           $count80++;
        }
//        if(isset($_POST['sub_80'])){
//            // сжимаем картинки
//            foreach (glob('resources/images/products/*') as $file) {
//                if($file == '.' || $file == '..' || is_dir('resources/images/products/80_80' . $file)){
//                    continue;
//                }
//                if (!is_file('resources/images/products/80_80/'.$file)){
//                    $this->_upload_img($file, $name, $height = NULL, $width = NULL);
//                }
//            }
//        }


        $this->template->content = View::factory('admin/blocks/images/index');
        $this->template->content->products_count= $products_count;
        $this->template->content->objects	= $count;
        $this->template->content->objects80	= $count80;
        
//        echo View::factory('profiler/stats');
    }
   

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
       
        $region_obj = new Model_Geo();
                
//        $region_obj->define_region();
        $select_country = $region_obj->generate_select_c();
        $select_regions = $region_obj->generate_select_r();
        
        $Partner_obj = new Model_Partner();
        $select_partner = $Partner_obj->generate_select_cat();
                
                
        $this->template->content =  View::factory('admin/blocks/partner/edit')
                ->bind("select_partner", $select_partner)
                ->bind("select_country", $select_country)
                ->bind("select_regions", $select_regions);
        $object = ORM::factory('partner');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->create_group($_POST);

                HTTP::redirect("/admin/partner/");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->content->title = 'Добавить группу';
        $this->template->content->errors = $errors;
        $this->template->content->object = $object;
  
 
                
    }

    /**
     * Редактирование основних параметров работи в портфолио
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_edit()
    {
        $object = ORM::factory('partner')->where('partner.id', '=', $this->request->param('param'))->find();
        $this->template->content =  View::factory('admin/blocks/partner/edit');
        $errors = array();

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_article( $_POST );
                $work = ORM::factory('partner', $object->id);
                $work->update_article( $_POST );

                HTTP::redirect("/admin/partner/");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->title 	= 'Редактирование';

        $this->template->content 	= View::factory('admin/blocks/partner/edit');
        $this->template->content->object = $object;
        $this->template->content->errors = $errors;
    }

    /**
     * Удаление работу
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
        $object = ORM::factory('partner', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect('/admin/partner');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
     public function _upload_img($file, $name, $height = '80', $width = '80') {

         $directory = 'resources/images/products/'.$height.'_'.$width.'/'.$name;

        $im = Image::factory($file);
        $im->resize($width, $height, Image::NONE);
        $im->save("$directory");

    }
    public function after() {
        if(empty($this->template->left_menu->links))
            $this->template->content->class = ' full-content';
        parent::after();
    }
}
