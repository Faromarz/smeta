<?php defined('SYSPATH') or die('No direct script access.');

class Model_Work extends ORM
{
    protected $_table_name = 'works';
    protected $_primary_key = 'id';

    public function getPrice(){
        $city_id = Cookie::get('city')==null?1:Cookie::get('city');
        $city = ORM::factory('City',$city_id);
        $partner = $city->partners->order_by('summa_materials','ASC')->find();
        if ($partner->loaded()){
            $partner_work = ORM::factory('Partner_Work')->where('partner_id','=',$partner->id)->and_where('work_id','=',$this->id)->find();
            if ($partner_work->loaded()){
                return $partner_work->price_econom;
            } else return $this->price;
        } else return $this->price;
    }
}
