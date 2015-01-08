<?php defined('SYSPATH') or die('No direct script access.');

class Model_Partner extends ORM
{
    protected $_table_name = 'partners';
    protected $_primary_key = 'id';
    
    protected $directory = 'media/img/partners/';

    protected $_has_many = array(
        'city' => array(
            'model'   => 'City',
            'through'   => 'partner_cities',
        ),
        'staff' => array(
            'model'   => 'Partner_Staff',
            'foreign_key'   => 'partner_id',
        )
    );

    protected $_belongs_to = array(
        'user' => array(
            'model'   => 'User',
            'foreign_key'   => 'user_id',
        ),
        'group' => array(
            'model'   => 'Partner_Spec',
            'foreign_key'   => 'group',
        )
    );
    
    public function filters()
    {
        return array(
            TRUE => array(
                array('Security::xss_clean'),
                array('strip_tags'),
                array('trim')
            ),
        );
    }
    public function getLogo()
    {
        return $this->directory.$this->img;
    }
    function save(Validation $validation = NULL)
    {
        $this->upload_img();
        parent::save($validation);
    }
    public function upload_img()
    {
        if(!isset($_FILES['img']['tmp_name'])){
            return false;
        }
        //$this->deleteImg();
        $file = $_FILES['img']['tmp_name'];
        $name = $_FILES['img']['name'];
        $ext = strtolower(substr($name, 1 + strrpos($name, ".")));
        $filename = $this->pk();          
        if ($ext == NULL) {
            $ext = 'jpg';
        }
        $this->img = "$filename.$ext";

        $image = Image::factory($file);
        $image->save("$this->directory/$filename.$ext");
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
       
}
