<?php defined('SYSPATH') or die('No direct script access.');

class Model_Partner_Staff extends ORM
{
    protected $_table_name = 'partner_staff';
    protected $_primary_key = 'id';
    
    protected $directory = 'media/img/staff/';
    
    protected $_belongs_to = array(
        'partner' => array(
            'model'   => 'Partner',
            'foreign_key'   => 'partner_id',
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
    
    public function getPhoto()
    {
        return $this->directory.$this->photo;
    }
    function save(Validation $validation = NULL)
    {
        parent::save($validation);
        $this->upload_img();
        parent::save($validation);
    }
    public function upload_img()
    {
        if(!isset($_FILES['photo']['tmp_name'])){
            return false;
        }
        $this->deleteImg();
        $file = $_FILES['photo']['tmp_name'];
        $name = $_FILES['photo']['name'];
        $ext = strtolower(substr($name, 1 + strrpos($name, ".")));
        $filename = $this->pk();          
        if ($ext == NULL) {
            $ext = 'jpg';
        }
        $this->photo = "$filename.$ext";

        $image = Image::factory($file);
        $image->save("$this->directory/$filename.$ext");
    }
    function delete()
    {
        $this->deleteImg();
        parent::delete();
    }
    public function deleteImg()
    {
        if (is_file($this->directory . $this->photo)) {
            if (unlink($this->directory . $this->photo)) {
                $this->photo = null;
                return true;
            }
        } elseif (empty($this->photo)) {
            return false;
        } else {
            throw new Exception('File don`t found: '.$this->directory . $this->photo, 404);
        }
    }
}
