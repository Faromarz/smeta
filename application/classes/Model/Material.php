<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material extends ORM
{
    protected $_table_name = 'materials';
    protected $_primary_key = 'id';

    protected $_belongs_to = array(
        'category' => array(
            'model'   => 'Material_Categories',
            'foreign_key'   => 'category_id',
        ),
        'country' => array(
            'model'   => 'Country',
            'foreign_key'   => 'country_id',
        ),
    );

    public function min_price()
    {
        $materials = ORM::factory('Material')
            ->where('category_id','=',$this->category_id)
            ->order_by('price','ASC')
            ->order_by('id','ASC')
            ->find_all();
        $result = array();
        foreach ($materials as $material){
            $result[] = $material->price;
            if($material->id==$this->id) break;
        }
        return count($result)>4?$result[(count($result)-1)-5]:$result[0];
    }

    public function max_price()
    {
        $materials = ORM::factory('Material')
            ->where('category_id','=',$this->category_id)
            ->and_where('price','>=',$this->price)
            ->order_by('price','ASC')
            ->order_by('id','ASC')
            ->find_all();
        $i = 0;
        $result = 0;
        $last = 0;
        foreach ($materials as $material){
            $i++;
            $last = $material->price;
            if($i==5) {
                $result=$material->price;
                break;
            }
        }
        return $result==0?$last:$result;
    }
}
