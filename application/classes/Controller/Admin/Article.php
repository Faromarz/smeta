<?php

class Controller_Admin_Article extends Controller_Admin_Index
{

    /**
     * @var  View  page template
     */
    public function before()
    {
        parent::before();
    }
    /**
     * Новая статья
     */
    public function action_create()
    {
        $catId = $this->request->query('cat');
        $errors = array();
        if($this->request->post()){
            $post = $this->request->post();
            $article = ORM::factory('Article');
            if(!empty($post['title'])){
                if(ORM::factory('Article')->where('title', '=', $post['title'])->find()->loaded()){
                    $errors['title'] = array('Статья <b>"'.$post['title'].'"</b> уже добавлена');
                }else{
                    if($_FILES['img']['tmp_name']){
                        $article->values($post);
                        $article->save();
                        HTTP::redirect("/admin/category/");
                    } else {
                        $errors['img'] = array('Укажите картинку');
                    }
                }
            } else {
                $errors['title'] = array('Укажите название');
            }
            
        }
        $objects = ORM::factory('Article_Categories')->fulltree();
        $this->set('_catId', $catId);
        $this->set('_categories', $objects);
        $this->set('_errors', $errors);
    }
    public function action_edit()
    {
        $id = (int)$this->request->param('id');
        $errors = array();
        $article = ORM::factory('Article', $id);
        if(!$article){
            throw new Exception('Article not found', 404);
        }
        if($this->request->post() && $id){
            $post = $this->request->post();
            if(!empty($post['title'])){
                if(ORM::factory('Article')->where('title', '=', $post['title'])->where('id', '!=', $id)->find()->loaded()){
                    $errors['title'] = array('Статья <b>"'.$post['title'].'"</b> уже добавлена');
                }else{
                    $article->values($post);
                    $article->save();
                    HTTP::redirect("/admin/category/");
                }
            } else {
                $errors['title'] = array('Укажите название');
            }
            
        }
        $objects = ORM::factory('Article_Categories')->fulltree();
        $this->set('_categories', $objects);
        $this->set('_article', $article);
        $this->set('_errors', $errors);
    }

//    public function action_save()
//    {
//        $array = array();
//        if ($this->request->post()) {
//            $post = $this->request->post();
//            $name = (string) Arr::get($post, 'name', false);
//            $id = (int) Arr::get($post, 'pk', false);
//            $value = trim(Arr::get($post, 'value', false));
//
//            if ($name && $id && ($name == 'name' && $value != '' || in_array($name, array('img_title', 'img_alt')))) {
//                $object = ORM::factory('Article_Categories', $id);
//                if ($object->loaded()) {
//                    if (in_array($name, array('img_title', 'img_alt', 'name'))) {
//                        $object->$name = $value;
//                        $object->save();
//                        $array = array('save' => 'ok');
//                    } else {
//                        $array = array('error' => 'atribut ' . $name . ' not found');
//                    }
//                } else {
//                    $array = array('error' => 'category not found');
//                }
//            } else {
//                $array = array('error' => 'data');
//            }
//        } else {
//            $array = array('error' => 'data empty');
//        }
//        $this->set('_result', json_encode($array));
//    }
    public function action_saveimg()
    {
        $this->default_template = 'json';
        $array = array();
        if ($this->request->param('id')) {
            $object = ORM::factory('Article', $this->request->param('id'));
            if ($object->loaded()) {
                 if($_FILES['img']['tmp_name']){
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
    }

    /**
     * 
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete_ajax()
    {
        $this->default_template = 'json';
        $object = ORM::factory('Article', $this->request->param('id'));
        if ($object->loaded()) {
            $object->delete();
            $this->set('_result', json_encode(array('delete' => true)));
        } else {
            $this->set('_result', json_encode(array('error' => 'Article not found')));
        }
    }

    public function after()
    {
        parent::after();
    }
}
