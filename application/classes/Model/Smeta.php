<?php defined('SYSPATH') or die('No direct script access.');

class Model_Smeta extends ORM
{
    protected $_table_name = 'smeta';

    protected $_has_many = array(
        'materials' => array(
            'model'   => 'Smeta_Material',
            'foreign_key'   => 'smeta_id',
        ),
        'works' => array(
            'model'   => 'Smeta_Work',
            'foreign_key'   => 'smeta_id',
        ),
        'rooms' => array(
            'model'   => 'Smeta_Room',
            'foreign_key'   => 'smeta_id',
        ),
        'other' => array(
            'model'   => 'Smeta_Other',
            'foreign_key'   => 'smeta_id',
        ),
    );

    protected $_belongs_to = array(
        'repair' => array(
            'model'   => 'Types_Repair',
            'foreign_key'   => 'repair_id',
        ),
        'rate' => array(
            'model'   => 'Types_Rate',
            'foreign_key'   => 'rate_id',
        ),
        'apartment' => array(
            'model'   => 'Types_Apartment',
            'foreign_key'   => 'apartment_id',
        ),
    );


    public function count_categories_works($type, $category, $room)
    {
        $result = 0;
        $smeta_works = $this->works->where('room_id','=',$room)->find_all();
        foreach ($smeta_works as $smeta_work){
            if ($smeta_work->works->type==$type and $smeta_work->works->category_id==$category) $result++;
        }
        return $result;
    }

}