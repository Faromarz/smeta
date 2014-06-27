<?php

class Model_Photo extends ORM {

    protected $_table_name = 'news';
    protected $_primary_key = 'id';
    protected $_db_group = 'default';

    protected $_has_many = array(
        'images' => array(
            'model' => 'image',
            'foreign_key' => 'news_id',
        ),
        'comments' => array(
            'model' => 'comment',
            'foreign_key' => 'new_id',
        ),
        'favorit' => array(
            'model' => 'favorit',
            'foreign_key' => 'news_id',
        ),
        'comment' => array(
            'model' => 'comment',
            'foreign_key' => 'new_id',
        ),
    );
    protected $_belongs_to = array(
        'podcategories' => array(
            'model' => 'podcategori',
            'foreign_key' => 'podcategories_id'
            ),
        'categories' => array(
            'model' => 'categori',
            'foreign_key' => 'categories_id'
            ),
        'podheadinges' => array(
            'model' => 'podheading',
            'foreign_key' => 'podheadinges_id'
            ),
        'users' => array(
            'model' => 'user',
            'foreign_key' => 'users_id'
            ),
    );
    protected $_rules = array(
        'categories_id' => array(
            'numeric' => NULL,
        ),
        'podcategories_id' => array(
           'numeric' => NULL,
        ),
        'podheadinges_id' => array(
           'numeric' => NULL,
        ),
        'title' => array(
            'not_empty' => NULL,
        ),
    );
    protected $_labels = array(
        'categories_id' => 'Раздел',
        'podcategories_id' => 'Рубрика',
        'podheadinges_id' => 'Подрубрика',
        'title' => 'Название',
    );
    protected $_filters = array(
        TRUE => array(
            'trim' => NULL,
        ),
    );

    public function get_all() {
        $sql = "SELECT * FROM " . $this->_table_pages;

        return DB::query(Database::SELECT, $sql)
                        ->execute();
    }
   public function _upload_photo_zn($file, $ext, $domain, $login) {
         if ($ext == NULL) {         $ext = 'jpg';        }
         if ($domain == NULL) {         $domain = "ostriv.tv";  }
         if ($login == NULL) {         $login = "ostriv";  }
         $text = $login.'.'.$domain;
        $directory = 'media/upimages/';
         // генерируем название
            $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';
            $filename = '';
            for ($i = 0; $i < 10; $i++) {
                $filename .= rand(1, strlen($symbols));
            }
        if (is_file("$directory/$filename.$ext")){
            $filename .= '_';
        }
        $image = Image::factory($file);
        @copy($file, "$directory/original/$filename.$ext");


       if (!is_file("$directory/login/$login.png")){
           
        // ================ создаем картинку
        $font = "/var/www/ostriv/data/www/ostriv.tv/media/fonts/forte.ttf";
        $font_size = "100";
        $angle = 0;
        $w = mb_strlen($text);

        $im = ImageCreate(70*$w,140);
        $background_color = imagecolorallocate ($im, 0, 0, 0);
        $text_color = imagecolorallocate ($im, 255, 255, 255);
        imagePng($im, "$directory/login/$login.png"); 
        
        $image_2 = imagecreatefrompng("$directory/login/$login.png");

        $black = imagecolorallocate($image_2,255,255,255);
        $image_width = imagesx($image_2);  
        $image_height = imagesy($image_2);

        $text_box = imagettfbbox($font_size,$angle,$font,$text);
        $text_width = $text_box[2]-$text_box[0]; // lower right corner - lower left corner
        $text_height = $text_box[3]-$text_box[1];

        $x = ($image_width/2) - ($text_width/2);
        $y = ($image_height/2) - ($text_height/2)+30;

        imagettftext($image_2,$font_size,0,$x,$y,$black,$font,$text );
        imagePng($image_2, "$directory/login/$login.png"); 
        
        // ==== end  создаем картинку
       }
            
        $watermark= Image::factory("$directory/login/$login.png");
        $ratio = $image->width / $image->height;
        $ratio_2 = $watermark->width / $watermark->height;
         if($ratio < $ratio_2){
                $watermark->resize($image->width, $image->height, Image::WIDTH);
            }else{
                $watermark->resize($image->width, $image->height, Image::HEIGHT);
            }      
            
            
            
        $image->watermark($watermark, NULL, NULL, 20);
        $image->save("$directory/$filename.$ext");
        
                
        return "$filename.$ext";
    }
    public function _upload_photo($file, $ext) {
         if ($ext == NULL) {         $ext = 'jpg';        }
         // генерируем название
            $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';
            $filename = '';
            for ($i = 0; $i < 10; $i++) {
                $filename .= rand(1, strlen($symbols));
            }
        $directory = 'media/upimages/';
        $image = Image::factory($file);
        @copy($file, "$directory/$filename.$ext");
        //$image->save("$directory/$filename.$ext");// сохряняем оригинал
        $ratio = $image->width / $image->height;// коефициент картинки
        
        $width = '600';        
        $height = '450';  
        if($image->height > $height || $image->width > $width){
                  
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/600_450_$filename.$ext");
        $width = '400';        
        $height = '400';  
        if($image->height > $height || $image->width > $width){
                  
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/400_400_$filename.$ext");
        $width = '237'; 
        $height = '175';
        if($image->height > $height || $image->width > $width){
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/237_175_$filename.$ext");
        $width = '200';        
        $height = '150';
        if($image->height > $height || $image->width > $width){
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/200_150_$filename.$ext");
        
        // лого для стр. события    
        $width = '155';        
        $height = '116'; 
        if($image->height > $height || $image->width > $width){
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/155_116_$filename.$ext");
        // лого для оствльных стр    
        
                
        return "$filename.$ext";
    }
    
    
}