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
        $object = ORM::factory('Article_Categories')->fulltree();
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
            $cat = ORM::factory('Article_Categories');
            $cat->name = $post['name'];
            if(empty($post['parent_id'])){
                if(ORM::factory('Article_Categories')->where('name', '=', $post['name'])->where('parent_id', '=', 0)->find()->loaded()){
                    $errors['name'] = array('Категория <b>"'.$post['name'].'"</b> уже добавлена');
                }else{
                /*if($_FILES['img']['tmp_name']){
                        $file = $_FILES['img']['tmp_name'];
                        $name = $_FILES['img']['name'];
                        $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                        $cat->img = $this->_upload_img($file, $type, $cat->pk());
                }*/
                    $cat->make_root();
                    HTTP::redirect("/admin/category/");
                }
            }else{
                $cld = ORM::factory('Article_Categories',(int)$post['parent_id'])->children();
                if(count($cld) > 0 && ORM::factory('Article_Categories')->where('name', '=', $post['name'])->where('parent_id', '=', $cld[0]->parent_id)->find()->loaded()){
                    $errors['name'] = array('Подкатегория <b>"'.$post['name'].'"</b> уже добавлена');
                }else{
                    /*if($_FILES['img']['tmp_name']){
                        $file = $_FILES['img']['tmp_name'];
                        $name = $_FILES['img']['name'];
                        $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                        $cat->img = $this->_upload_img($file, $type, $cat->pk());
                    }*/
                    $cat->insert_as_last_child((int)$post['parent_id']);
                    HTTP::redirect("/admin/category/");
                }
            }
            
        }
        $objects = ORM::factory('Article_Categories')->fulltree();
        $this->set('_categories', $objects);
        $this->set('_errors', $errors);
    }

    public function action_save()
    {
        $array = array();
        if ($this->request->post()) {
            $post = $this->request->post();
            $name = (string) Arr::get($post, 'name', false);
            $id = (int) Arr::get($post, 'pk', false);
            $value = trim(Arr::get($post, 'value', false));

            if ($name && $id && ($name == 'name' && $value != '' || in_array($name, array('img_title', 'img_alt')))) {
                $object = ORM::factory('Article_Categories', $id);
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
//    public function action_saveimg()
//    {
//        $array = array();
//        if ($this->request->param('id')) {
//            $object = ORM::factory('Article_Categories', $this->request->param('id'));
//            if ($object->loaded()) {
//                 if($_FILES['img']['tmp_name']){
//                    $file = $_FILES['img']['tmp_name'];
//                    $name = $_FILES['img']['name'];
//                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
//                    $directory = '/media/img/cat/';
//                     if (is_file($directory . $object->img)) {
//                        if (unlink($directory . $object->img)) {
//
//                        }
//                    }
//                    $object->img = $this->_upload_img($file, $type, $object->pk());
//                    $object->save();
//                    $array['file'] = $object->img;
//                } else {
//                    $array = array('error' => 'File empty');
//                }
//            } else {
//                $array = array('error' => 'category not found');
//            }
//        } else {
//            $array = array('error' => 'data empty');
//        }
//        $this->set('_result', json_encode($array));
//    }

    /**
     * 
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
        $object = ORM::factory('Article_Categories', $this->request->param('id'));

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
            foreach ($object->articles->find_all() as $article) {
                if (is_file($article->getImg())) {
                    if (unlink($article->getImg())) {
                        
                    }
                }
                $article->delete();
            }
            $object->delete();
            HTTP::redirect('/admin/category');
        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }

    public function after()
    {
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
    }
}
