<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Materials extends Controller
{
    protected $user = false;

    public function before()
    {
        parent::before();
        if (method_exists(Auth::instance(), 'auto_login')) {
            Auth::instance()->auto_login();
        }
        $this->user = Auth::instance()->get_user();
        if ( ! $this->request->is_ajax())
        {
            throw new HTTP_Exception_500('Неверный запрос');
        }
    }

    public function action_index()
    {
        throw new HTTP_Exception_404;
    }

    public function action_load_categories()
    {
        $result = array();
        $materials_categories = ORM::factory('Material_Categories')->where('parent_id','=','0')->find_all();
        foreach ($materials_categories as $materials_category){
            if (($materials_category->count_categories()==0 && $materials_category->count_materials()>0) || $materials_category->count_categories()>0){
                $a = array();
                $materials_under = ORM::factory('Material_Categories')->where('parent_id','=',$materials_category->id)->find_all();
                $i=0;
                foreach ($materials_under as $material_under){
                    if ($material_under->count_materials()>0)
                        $a[] = array('id'=>$material_under->id, 'name'=>$material_under->name, 'repair_id_rate_id'=>$materials_category->repair_id_rate_id, 'rooms_type'=>$materials_category->rooms_type, 'calculation'=>$materials_category->calculation,'selected'=> ($i==0? 1: 0));
                    $i++;
                }
                if(($materials_category->count_categories()>0 && count($a)>0) || $materials_category->count_categories()==0)
                $result[] = array('id'=>$materials_category->id, 'name'=>$materials_category->name, 'repair_id_rate_id'=>$materials_category->repair_id_rate_id, 'rooms_type'=>$materials_category->rooms_type,'calculation'=>$materials_category->calculation, 'under' => $a);
            }
        }
        die(json_encode($result));
    }

    public function action_load_materials()
    {
        $result = array();
        $limit = 21;
        $materials_categories = ORM::factory('Material_Categories')->find_all();
        foreach ($materials_categories as $materials_category){
            if ($materials_category->count_materials()>0){
                $materials = ORM::factory('Material')->where('category_id','=',$materials_category->id)->order_by('price','ASC')->find_all();
                $for_result = array();
                foreach ($materials as $material){
                    $for_result[] = array(
                        'category_id'=>$material->category_id,
                        'id'=>$material->id,
                        'name'=>$material->name,
                        'price'=>$material->price,
                        'img'=>$material->img,
                        'country'=>$material->country->name,
                        'count_text'=>$material->count_text,
                        'size'=>$material->size,
                        'selected'=> 0
                    );
                }
                if (count($for_result) <= $limit) {
                    $i=0;
                    foreach ($for_result as $key => $value)
                    {
                        $for_result[$key]['selected'] = $i==0?1:0;
                        $i++;
                    }
                    $result = array_merge($result,$for_result);
                }
                else{
                    $for_result = array_chunk($for_result, (int) (count($for_result) / $limit));
                    array_walk($for_result, create_function('&$p', '$p = $p[array_rand($p, 1)];'));
                    $for_result = array_slice($for_result, 0, $limit);
                    $i=0;
                    foreach ($for_result as $key => $value)
                    {
                        $for_result[$key]['selected'] = $i==10?1:0;
                        $i++;
                    }
                    $result = array_merge($result,$for_result);
                }
            }
        }
        die(json_encode($result));
    }

    public function action_load_materials_smeta()
    {
        $result = array();
        $id = (int) Arr::get($_POST, 'id', 0);
        $rooms_smeta = ORM::factory('Smeta_Room')->where('smeta_id','=',$id)->find_all();
        foreach ($rooms_smeta as $room){
            $smeta_materials = ORM::factory('Smeta_Material')->where('smeta_id','=',$id)->where('room_id','=',$room->room_id)->find_all();
            foreach ($smeta_materials as $smeta_material){
                $cat = $smeta_material->materials->category->category_parent;
                $under_cat = $smeta_material->materials->category;
                $min_price = $smeta_material->materials->min_price();
                $max_price = $smeta_material->materials->max_price();
                $materials = ORM::factory('Material')
                    ->where('category_id','=',$smeta_material->materials->category_id)
                    ->and_where('price', 'between', DB::expr($min_price.' AND '.$max_price))
                    ->order_by('price','ASC')
                    ->find_all()->as_array();
                if(count($materials)==0 && $min_price==$max_price) {
                    $materials=ORM::factory('Material')->where('category_id','=',$smeta_material->materials->category_id)->order_by('price','ASC')->find_all()->as_array();
                }
                foreach ($materials as $material){
                    $result[] = array(
                        'category_id'=>$material->category_id,
                        'room_id'=>$room->room_id,
                        'id'=>$material->id,
                        'name'=>$material->name,
                        'price'=>$material->price,
                        'img'=>$material->img,
                        'country'=>$material->country->name,
                        'count_text'=>$material->count_text,
                        'size'=>$material->size,
                        'selected'=> ($smeta_material->material_id==$material->id?1:0)
                    );
                }
                if($cat->loaded()){
                    $categories = ORM::factory('Material_Categories')->where('parent_id','=',$cat->id)->and_where('id','<>',$under_cat)->find_all();
                    foreach ($categories as $category){
                        $materials = ORM::factory('Material')->where('category_id','=',$category->id)->order_by('price','ASC')->limit(11)->find_all();
                        $i=0;
                        foreach ($materials as $material){
                            $result[] = array(
                                'category_id'=>$material->category_id,
                                'room_id'=>$room->room_id,
                                'id'=>$material->id,
                                'name'=>$material->name,
                                'price'=>$material->price,
                                'img'=>$material->img,
                                'country'=>$material->country->name,
                                'count_text'=>$material->count_text,
                                'size'=>$material->size,
                                'selected'=> (count($materials)==11?$i==6?1:0:$i==0?1:0)
                            );
                            $i++;
                        }
                    }
                }
            }
        }
        die(json_encode($result));
    }

}