<?php defined('SYSPATH') or die('No direct script access.');

class Model_Article extends ORM
{
    protected $_table_name = 'article';
    protected $_primary_key = 'id';

    protected $directory = 'media/img/article/';
    
    protected $_belongs_to = array(
        'category' => array(
            'model' => 'Article_Categories',
            'foreign_key' => 'cat_id'
        )
    );
    public function __toString()
    {
        return $this->title;
    }
    
    public function getDirectory()
    {
        return $this->directory;
    }
    public function getImg()
    {
        return $this->directory . $this->img;
    }

    function delete()
    {
        $this->deleteImg();
        parent::delete();
    }
    function save(Validation $validation = NULL)
    {
        $this->upload_img();
        parent::save($validation);
    }
    public function deleteImg()
    {
        if (is_file($this->directory . $this->img)) {
            if (unlink($this->directory . $this->img)) {
                return true;
            }
        } elseif (empty($this->img)) {
            return false;
        } else {
            throw new Exception('File don`t found: '.$this->directory . $this->img, 404);
        }
    }
    public function getText()
    {
        return json_encode($this->text);
    }
    public function upload_img()
    {
        if(!$_FILES['img']['tmp_name']){
            return false;
        }
        $this->deleteImg();
        $file = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];
        $ext = strtolower(substr($name, 1 + strrpos($name, ".")));
        $filename = $this->pk();          
        if ($ext == NULL) {
            $ext = 'jpg';
        }

        $directory = $this->directory;

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

        $this->img = $filename . '.' . $ext;
    }

}
