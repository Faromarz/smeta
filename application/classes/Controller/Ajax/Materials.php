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


    public function action_load_materials()
    {
        $url = $this->request->uri();

		$cache_key = md5($url);

        $result = Cache::instance()->get($cache_key);
		if ($result){
			die(json_encode($result));
		}else{
        
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
                        'calc'=>$materials_category->calculation,
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
                } else {
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
        Cache::instance()->set($cache_key, $result, Date::DAY);
        die(json_encode($result));
        }
    }

    public function action_load_materials_smeta()
    {
        $result = array();
        $id = (int) Arr::get($_POST, 'smetaId', 0);
        $rooms_smeta = ORM::factory('Smeta_Room')->where('smeta_id','=',$id)->find_all();
        foreach ($rooms_smeta as $room){
            $smeta_categories = $room->smeta_categories->find_all();
            foreach ($smeta_categories as $smeta_category){
                $category = $smeta_category->children_id>0 ? $smeta_category->children_id : $smeta_category->material_categories_id;
                $materials = ORM::factory('Material')
                    ->where('category_id','=',$category)
                    ->and_where('price', '<=', $smeta_category->material->price)
                    ->and_where('id', '<>', $smeta_category->material->id)
                    ->limit(5)
                    ->order_by('price','DESC')
                    ->order_by('id','ASC')
                    ->find_all();
                $add_materials = $materials->as_array(NULL, 'id');
                foreach (array_reverse($materials->as_array()) as $material){
                    $result[] = array(
                        'category_id'=>$material->category_id,
                        'calc'=>$material->category->calculation,
                        'room_id'=>$room->room_id,
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
                $result[] = array(
                    'category_id'=>$smeta_category->material->category_id,
                    'calc'=>$smeta_category->material->category->calculation,
                    'room_id'=> (int) $room->room_id,
                    'id'=>$smeta_category->material->id,
                    'name'=>$smeta_category->material->name,
                    'price'=>$smeta_category->material->price,
                    'img'=>$smeta_category->material->img,
                    'country'=>$smeta_category->material->country->name,
                    'count_text'=>$smeta_category->material->count_text,
                    'size'=>$smeta_category->material->size,
                    'selected'=> 1
                );
                $materials = ORM::factory('Material')
                    ->where('category_id','=',$category)
                    ->and_where('price', '>=', $smeta_category->material->price)
                    ->and_where('id', '<>', $smeta_category->material->id);
                if (!empty($add_materials)) $materials = $materials->and_where('id', 'NOT IN', $add_materials);
                $materials = $materials->limit(5)
                    ->order_by('price','ASC')
                    ->order_by('id','ASC')
                    ->find_all()->as_array();
                foreach ($materials as $material){
                    $result[] = array(
                        'category_id'=>$material->category_id,
                        'calc'=>$material->category->calculation,
                        'room_id'=> (int) $room->room_id,
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
                if($smeta_category->children_id>0){
                    $categories = ORM::factory('Material_Categories')->where('parent_id','=',$smeta_category->material_categories_id)->and_where('id','<>',$smeta_category->children_id)->find_all();
                    foreach ($categories as $category){
                        $materials = ORM::factory('Material')->where('category_id','=',$category->id)->order_by('price','ASC')->limit(11)->find_all();
                        $i=0;
                        foreach ($materials as $material){
                            $result[] = array(
                                'category_id'=>$material->category_id,
                                'calc'=>$material->category->calculation,
                                'room_id'=> (int) $room->room_id,
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


//    public function action_load_categories()
//    {
//        $smetaId = (int) Arr::get($this->request->post(), 'smetaId', null);
//
//        $result = array();
//        $categories = ORM::factory('Material_Categories')->roots();
//        foreach ($categories as $category){
//            if ($category->has_materials() || $category->has_children()){
//                $cat = $category->as_array();
//                if($category->has_children()) {
//                    $cat['childrens'] = array();
//                    $childrens = $category->children();
//                    foreach ($childrens as $children){
//                        $cat['childrens'][] = $children->as_array();
//                    }
//                } else {
//                    if($smetaId){
//                        $cat['materials'] = $this->getMaterialsForCatSmeta($cat['id'], $smetaId);
//                    }else{
//                        $cat['materials'] = $this->getMaterialsForCat($cat['id']);
//                    }
//                }
//                $result[] = $cat;
//            }
//        }
//        die(json_encode($result));
//    }

//    public static function getMaterialsForCatSmeta($catId, $smetaId)
//    {
//        $result = array();
//        $rooms_smeta = ORM::factory('Smeta_Room')->where('smeta_id','=',$smetaId)->find_all();
//        foreach ($rooms_smeta as $room){
//            $smeta_materials = ORM::factory('Smeta_Material')->where('smeta_id','=',$smetaId)->where('room_id','=',$room->room_id)->find_all();
//            foreach ($smeta_materials as $smeta_material){
//                $cat = $smeta_material->materials->category->category_parent;
//                $under_cat = $smeta_material->materials->category;
//                $min_price = $smeta_material->materials->min_price();
//                $max_price = $smeta_material->materials->max_price();
//                $materials = ORM::factory('Material')
//                    ->where('category_id','=',$smeta_material->materials->category_id)
//                    ->and_where('price', 'between', DB::expr($min_price.' AND '.$max_price))
//                    ->order_by('price','ASC')
//                    ->find_all()->as_array();
//                if(count($materials)==0 && $min_price==$max_price) {
//                    $materials=ORM::factory('Material')->where('category_id','=',$smeta_material->materials->category_id)->order_by('price','ASC')->find_all()->as_array();
//                }
//                foreach ($materials as $material){
//                    $result[] = array(
//                        'category_id'=>$material->category_id,
//                        'room_id'=>$room->room_id,
//                        'id'=>$material->id,
//                        'name'=>$material->name,
//                        'price'=>$material->price,
//                        'img'=>$material->img,
//                        'country'=>$material->country->name,
//                        'count_text'=>$material->count_text,
//                        'size'=>$material->size,
//                        'selected'=> ($smeta_material->material_id==$material->id?1:0)
//                    );
//                }
//                if($cat->loaded()){
//                    $categories = ORM::factory('Material_Categories')->where('parent_id','=',$cat->id)->and_where('id','<>',$under_cat)->find_all();
//                    foreach ($categories as $category){
//                        $materials = ORM::factory('Material')->where('category_id','=',$category->id)->order_by('price','ASC')->limit(11)->find_all();
//                        $i=0;
//                        foreach ($materials as $material){
//                            $result[] = array(
//                                'category_id'=>$material->category_id,
//                                'room_id'=>$room->room_id,
//                                'id'=>$material->id,
//                                'name'=>$material->name,
//                                'price'=>$material->price,
//                                'img'=>$material->img,
//                                'country'=>$material->country->name,
//                                'count_text'=>$material->count_text,
//                                'size'=>$material->size,
//                                'selected'=> (count($materials)==11?$i==6?1:0:$i==0?1:0)
//                            );
//                            $i++;
//                        }
//                    }
//                }
//            }
//        }
//        return $result;
//    }
   
}