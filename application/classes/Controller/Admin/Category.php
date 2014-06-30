<?php

class Controller_Admin_Category extends Controller_Admin_Index
{

    /**
     * @var  View  page template
     */
    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $object = ORM::factory('Category')->fulltree();
        $this->set('_categories', $object);
    }

    /**
     * Новая категория
     */
    public function action_create()
    {
        $errors = array();
        if($this->request->post()){
            $post = $this->request->post();
            $cat = ORM::factory('Category');
            $cat->name = $post['name'];
            if(empty($post['parent_id'])){
                if(ORM::factory('Category')->where('name', '=', $post['name'])->where('parent_id', '=', 0)->find()->loaded()){
                    $errors['name'] = array('Категория <b>"'.$post['name'].'"</b> уже добавлена');
                }else{
                    if($_FILES['img']['tmp_name']){
                        $file = $_FILES['img']['tmp_name'];
                        $name = $_FILES['img']['name'];
                        $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                        $cat->img = $this->_upload_img($file, $type, $cat->pk());
                    }
                    $cat->make_root();
                    HTTP::redirect("/admin/category/");
                }
            }else{
                $cld = ORM::factory('Category',(int)$post['parent_id'])->children();
                if(count($cld) > 0 && ORM::factory('Category')->where('name', '=', $post['name'])->where('parent_id', '=', $cld[0]->parent_id)->find()->loaded()){
                    $errors['name'] = array('Подкатегория <b>"'.$post['name'].'"</b> уже добавлена');
                }else{
                    if($_FILES['img']['tmp_name']){
                        $file = $_FILES['img']['tmp_name'];
                        $name = $_FILES['img']['name'];
                        $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                        $cat->img = $this->_upload_img($file, $type, $cat->pk());
                    }
                    $cat->insert_as_last_child((int)$post['parent_id']);
                    HTTP::redirect("/admin/category/");
                }
            }
            
        }

//        if ($_POST) {
//            try {
////                // Создаём запись
////                $object = $object->create_article($_POST);
////
////                HTTP::redirect("/admin/category/");
//            } catch (ORM_Validation_Exception $e) {
//                $errors = Arr::flatten($e->errors(""));
//            }
//        }
        $objects = ORM::factory('Category')->fulltree();
        $this->set('_categories', $objects);
        $this->set('_errors', $errors);
    }

    public function action_save()
    {
        $array = array();
        if ($this->request->post()) {
            $name = (string) Arr::get($_POST, 'name', false);
            $id = (int) Arr::get($_POST, 'pk', false);
            $value = trim(Arr::get($_POST, 'value', false));

            if ($name && $id && ($name == 'name' && $value != '' || in_array($name, array('img_title', 'img_alt')))) {
                $object = ORM::factory('Category', $id);
                if ($object->loaded()) {
                    if (in_array($name, array('img_title', 'img_alt', 'name'))) {
                        $object->$name = $value;
                        $object->save();
                        $array = array('save' => 'ok');
                    } else {
                        $array = array('error' => 'atribut ' . $name . ' not found');
                    }
                } else {
                    $array = array('error' => 'category not found');
                }
            } else {
                $array = array('error' => 'data');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }

    /**
     * Редактирование основних параметров работи в портфолио
     * 
     * @throws Kohana_HTTP_Exception_404
     */
//    public function action_edit()
//    {
//        $object = ORM::factory('category', $this->request->param('param'));
//        $this->template->v_body->v_page = View::factory('admin/blocks/category/edit');
//        $errors = array();
//
//        // Если рабр\оти нет, тогда 404 ошибка
//        if (!$object->loaded())
//            throw new Kohana_HTTP_Exception_404("Страница не найдена");
//
//        if ($_POST) {
//            try {
//                // Обновление даних
//                $object->update_article($_POST);
//
//                HTTP::redirect("/admin/category/");
//            } catch (ORM_Validation_Exception $e) {
//                $errors = Arr::flatten($e->errors(""));
//            }
//        }
//
//        $this->template->title = 'Редактирование';
//
//        $this->template->v_body->v_page = View::factory('admin/blocks/category/edit');
//        $this->template->v_body->v_page->object = $object;
//        $this->template->v_body->v_page->errors = $errors;
//    }

    /**
     * 
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
        $object = ORM::factory('Category', $this->request->param('id'));

        if ($object->loaded()) {
            $directory = 'media/img/cat/';
            if (is_file($directory . $object->img)) {
                if (unlink($directory . $object->img)) {
                    
                }
            }
            foreach ($object->children() as $chaild) {
                if (is_file($directory . $chaild->img)) {
                    if (unlink($directory . $chaild->img)) {
                        
                    }
                }
                $chaild->delete();
            }
            $object->delete();
            HTTP::redirect('/admin/category');
        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }

    public function after()
    {
//		if(empty($this->template->left_menu->links))
//                    $this->template->v_body->v_page ->class = ' full-content pages';
        parent::after();
    }

    public function _upload_img($file, $ext, $filename)
    {
        if ($ext == NULL) {
            $ext = 'jpg';
        }
        if ($filename == NULL) {
            $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';
            $filename = '';

            for ($i = 0; $i < 10; $i++) {
                $key = rand(0, strlen($symbols) - 1);
                $filename .= $symbols[$key];
            }
        }

        $directory = 'media/img/cat/';
        // генерируем название

        $image = Image::factory($file);
//            $image->save("$directory/logo/$filename.$ext");// сохряняем оригинал
        $watermark = Image::factory("media/img/logo.png");
        $ratio = $image->width / $image->height;
        $ratio_2 = $watermark->width / $watermark->height;
        if ($ratio < $ratio_2) {
            $watermark->resize($image->width, $image->height, Image::WIDTH);
        } else {
            $watermark->resize($image->width, $image->height, Image::HEIGHT);
        }
        $image->watermark($watermark, NULL, NULL, 20);
        $image->save("$directory/$filename.$ext");
//        // лого для стр. события    
//        $width = '290';
//        $height = '1000';
//        if ($image->height > $height || $image->width > $width) {
//            // изменяем размер изобржаения и загружаем
//            $original_ratio = $width / $height; // нужный коефициент картинки
//            if ($ratio > $original_ratio) {
//                $image->resize($width, $height, Image::WIDTH);
//            } else {
//                $image->resize($width, $height, Image::HEIGHT);
//            }
//        }
//        $image->save("$directory/290_$filename.$ext");
//        // лого для стр. события    
//        $width = '100';
//        $height = '100';
//        if ($image->height > $height || $image->width > $width) {
//            // изменяем размер изобржаения и загружаем
//            $original_ratio = $width / $height; // нужный коефициент картинки
//            if ($ratio > $original_ratio) {
//                $image->resize($width, $height, Image::WIDTH);
//            } else {
//                $image->resize($width, $height, Image::HEIGHT);
//            }
//        }
//        $image->save("$directory/100_100_$filename.$ext");
//        $width = '40';
//        $height = '40';
//        if ($image->height > $height || $image->width > $width) {
//            // изменяем размер изобржаения и загружаем
//            $original_ratio = $width / $height; // нужный коефициент картинки
//            if ($ratio > $original_ratio) {
//                $image->resize($width, $height, Image::WIDTH);
//            } else {
//                $image->resize($width, $height, Image::HEIGHT);
//            }
//        }
//        $image->save("$directory/40_40_$filename.$ext");

        return $filename . '.' . $ext;
    }
}
