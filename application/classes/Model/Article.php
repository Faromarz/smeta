<?php defined('SYSPATH') or die('No direct script access.');

class Model_Article extends ORM
{
    protected $_table_name = 'article';
    protected $_primary_key = 'id';
    protected $directory = 'media/img/news/';
    
    protected $_belongs_to = array(
        'category' => array(
            'model'   => 'Article_Categories',
            'foreign_key'   => 'cat_id',
        )
    );
    
    public function __toString()
    {
        return (string) $this->title;
    }
    
    public function getImg()
    {
        return $this->directory . $this->img;
    }
    public function getShortText()
    {
        $text = json_decode($this->text, true);
        if (is_array($text['data']) && isset($text['data'][0]['data']['text'])) {
            return Text::limit_chars($text['data'][0]['data']['text'], 200, '...');
        } else {
            return '';
        }
    }

}
