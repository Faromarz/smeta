<?php

class Controller_Admin_User extends Controller_Admin_Index
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
//        $filter = array();
//        $filter['work'] = array();
//        if ($this->request->post()) {
//            if ($this->request->post('formAlias') == 'Фильтр') {
//                $this->session->set('filter_work_admin', $this->request->post('name'));
//                $this->session->set('filter_work_admin_type', $this->request->post('type'));
//            }else{
//                $this->session->set('filter_work_admin', NULL);
//                $this->session->set('filter_work_admin_type', NULL);
//            }
//        }
        $object = ORM::factory('User')
//                ->select(array('work_categories.name', 'catName'))
//                ->select('work.name')
//                ->select('work.id')
                //->join('roles_users', 'left')
//                ->on('work.category_id', '=', 'work_categories.id')
                ;
//        $namesFilter = $this->session->get('filter_work_admin', false);
//        $typeFilter = $this->session->get('filter_work_admin_type', false);

//        if ($namesFilter && !empty($namesFilter)) {
//            if (!is_array($namesFilter)) {
//                $filter['work']['name'] = $namesFilter;
//                $namesFilter = explode(',', $namesFilter);
//            }
//            $object->where('work.name', 'in', $namesFilter);
//        }
//        if (in_array($typeFilter, array('0','1'))) {
//            if (!is_array($typeFilter)) {
//                $filter['work']['type'] = $typeFilter;
//                $typeFilter = explode(',', $typeFilter);
//            }
//            $object->where('work.type', 'in', $typeFilter);
//        }

//        $objectCount = clone $object;
       // $total_items =  $objectCount->count_all();
        //$pagination = Pagination::factory(array('total_items' => $total_items))->route_params(array(
//                'controller' => strtolower($this->request->controller()),
//                'action' => $this->request->action()
//              ));
        $objects = $object
//                ->limit($pagination->items_per_page)
//                ->offset($pagination->offset)
                ->find_all();

//        $this->set('_filter', $filter);
        $this->set('_users', $objects);
        //$this->set('_pagination', $pagination);
    }

    /**
     * Новая категория
     */
    public function action_create()
    {
        $errors = array();
        if($this->request->post()){
            $post = $this->request->post();
            try {
                ORM::factory('User')->create_user($post, array(
                'username',
                'phone',
                'password',
                'email')
              );
                HTTP::redirect("/admin/user");
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('models');
            }
        }
        $this->set('_errors', $errors);
        $this->set('_post', $this->request->post());
    }

    public function action_save()
    {
        $array = array();
        if ($this->request->post()) {
            $name = (string) Arr::get($this->request->post(), 'name', false);
            $id = (int) Arr::get($this->request->post(), 'pk', false);
            $value = Arr::get($this->request->post(), 'value', false);

            if ($name && $id) {
                $object = ORM::factory('User', $id);
                if ($object->loaded()) {
                    if (in_array($name, array('username', 'email', 'phone'))) {
                        $object->$name = trim($value);
                        try {
                            $object->save();
                            $array = array('save' => 'ok');
                        } catch (ORM_Validation_Exception $e) {
                            $array = array('error' => $e);
                        }
                    } else if($name === 'role_ids') {
                        $object->remove('roles', 2);
                        $object->remove('roles', 3);
                        foreach ($value as $val){
                            $object->add('roles', $val);
                        }
                        try {
                            $object->save();
                            $array = array('save' => 'ok');
                        } catch (ORM_Validation_Exception $e) {
                             $array = array('error' => $e);
                        }
                    } else {
                        $array = array('error' => 'atribut ' . $name . ' not found');
                    }
                } else {
                    $array = array('error' => 'user not found');
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
     *//*
    public function action_findname()
    {
        $result = array();
        $query = $this->request->query('query');
        if (isset($query)) {
            $objects = ORM::factory('Work')
                    ->where('name', 'LIKE', $query.'%')
                    ->group_by('name')
                    ->find_all();
            
            foreach ($objects as $object) {
                $result[] =  array(
                    'id' => $object->name,
                    'name' => $object->name,
                    'value' => $object->name
                );
            }
        }
        $this->set('_result', json_encode($result));
    }*/
    /**
     * 
     * @throws Kohana_HTTP_Exception_404
     *//*
    public function action_delete()
    {
        $object = ORM::factory('Work', $this->request->param('id'));

        if ($object->loaded()) {
            $object->delete();
            HTTP::redirect('/admin/works');
        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }*/
    /*
    public function action_cat (){
        $object = ORM::factory('Material_Categories')->fulltree();
        $this->set('_categories', $object);
    }*//*
    public function action_catcreate()
    {
        $errors = array();
        if($this->request->post()){
            $post = $this->request->post();
            $cat = ORM::factory('Material_Categories');
            $cat->name = $post['name'];
            $cat->repair_id_rate_id = $post['repair_id_rate_id'];
            if(empty($post['parent_id'])){
                if(ORM::factory('Material_Categories')->where('name', '=', $post['name'])->where('parent_id', '=', 0)->find()->loaded()){
                    $errors['name'] = array('Категория <b>"'.$post['name'].'"</b> уже добавлена');
                }else{
                    $cat->make_root();
                    HTTP::redirect("/admin/materials/cat");
                }
            }else{
                $cld = ORM::factory('Material_Categories',(int)$post['parent_id'])->children();
                if(count($cld) > 0 && ORM::factory('Material_Categories')->where('name', '=', $post['name'])->where('parent_id', '=', $cld[0]->parent_id)->find()->loaded()){
                    $errors['name'] = array('Подкатегория <b>"'.$post['name'].'"</b> уже добавлена');
                }else{
                    $cat->insert_as_last_child((int)$post['parent_id']);
                    HTTP::redirect("/admin/materials/cat");
                }
            }
            
        }
        $objects = ORM::factory('Material_Categories')->fulltree();
        $this->set('_categories', $objects);
        $this->set('_errors', $errors);
    }
     public function action_catsave()
    {
        $array = array();
        if ($this->request->post()) {
            $post = $this->request->post();
            $name = (string) Arr::get($post, 'name', false);
            $id = (int) Arr::get($post, 'pk', false);
            $value = trim(Arr::get($post, 'value', false));

            if ($name && $id  && ($value != '' || $name == 'repair_id_rate_id' )) {
                $object = ORM::factory('Material_Categories', $id);
                if ($object->loaded()) {
                    if (in_array($name, array('name', 'repair_id_rate_id'))) {
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
     public function action_catdelete()
    {
        $object = ORM::factory('Material_Categories', $this->request->param('id'));

        if ($object->loaded()) {
            foreach ($object->children() as $chaild) {
                $chaild->delete();
            }
            $object->delete();
            HTTP::redirect('/admin/materials/cat');
        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    *//*
    public function action_cat(){
        $object = ORM::factory('Work_Categories')->find_all();
        $this->set('_categories', $object);
    }
    public function action_catcreate()
    {
        $errors = array();
        if($this->request->post()){
            $post = $this->request->post();
            $cat = ORM::factory('Work_Categories');
            $cat->name = $post['name'];
             if($_FILES['img']['tmp_name']){
                $file = $_FILES['img']['tmp_name'];
                $name = $_FILES['img']['name'];
                $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                $cat->img = $this->_upload_img($file, $type, $cat->pk());
            }
            $cat->save();
            HTTP::redirect("/admin/works/cat");
             
            
        }
        $this->set('_errors', $errors);
    }*//*
     public function action_catsave()
    {
        $array = array();
        if ($this->request->post()) {
            $post = $this->request->post();
            $name = (string) Arr::get($post, 'name', false);
            $id = (int) Arr::get($post, 'pk', false);
            $value = trim(Arr::get($post, 'value', false));

            if ($name && $id) {
                $object = ORM::factory('Work_Categories', $id);
                if ($object->loaded()) {
                    if (in_array($name, array('name',))) {
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
     public function action_catdelete()
    {
        $object = ORM::factory('Work_Categories', $this->request->param('id'));

        if ($object->loaded()) {
            $directory = '/media/img/cat/work/';
            if (is_file($directory . $object->img)) {
                if (unlink($directory . $object->img)) {

                }
            }
            $object->delete();
            HTTP::redirect('/admin/works/cat');
        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    public function action_saveimg()
    {
        $array = array();
        if ($this->request->param('id')) {
            $object = ORM::factory('Work_Categories', $this->request->param('id'));
            if ($object->loaded()) {
                 if($_FILES['img']['tmp_name']){
                    $file = $_FILES['img']['tmp_name'];
                    $name = $_FILES['img']['name'];
                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                    $directory = '/media/img/cat/work';
                     if (is_file($directory . $object->img)) {
                        if (unlink($directory . $object->img)) {

                        }
                    }
                    $object->img = $this->_upload_img($file, $type, $object->pk());
                    $object->save();
                    $array['file'] = $object->img;
                } else {
                    $array = array('error' => 'File empty');
                }
            } else {
                $array = array('error' => 'category not found');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }*/
    
    public function after()
    {
//		if(empty($this->template->left_menu->links))
//                    $this->template->v_body->v_page ->class = ' full-content pages';
        parent::after();
    }
/*
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
    *//*
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

        $directory = 'media/img/cat/work/';
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

        return $filename . '.' . $ext;
    }*/
    
}
