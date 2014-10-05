<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material_Categories extends ORM_MPTT 
{
    protected $_table_name = 'material_categories';

    protected $_has_many = array(
        'materials' => array(
            'model'   => 'Material',
            'foreign_key'   => 'category_id',
        )

    );

    protected $_belongs_to = array();

    public function count_materials()
    {
        return $this->materials->count_all();
    }

    public function has_materials()
    {
        return $this->materials->count_all() > 0;
    }

    public function getEmptyLvl()
    {
        return str_repeat(
            html_entity_decode('&nbsp;', ENT_QUOTES, 'UTF-8'), ($this->lvl + 1) * 3
        );
    }
    public function getCategoriesForRoom($roomType, $roomId, $smetaId = NULL)
    {
        $categories = ORM::factory('Material_Categories')
            ->where_open()
                ->where('rooms_type', 'LIKE', '%,'.$roomType.',%')
                ->or_where('rooms_type', 'LIKE', $roomType.',%')
                ->or_where('rooms_type', 'LIKE', '%,'.$roomType)
                ->or_where('rooms_type', '=', $roomType)
            ->where_close()
            ->where('lvl', '=', 1);
        if($smetaId) {
            $categories
                    ->select('smeta_categories.enable')
                    ->join('smeta', 'INNER')
                    ->on('smeta.id', '=', DB::expr($smetaId))
                    ->join('smeta_room', 'INNER')
                    ->on('smeta_rooms.smeta_id', '=', 'smeta.id')
                    ->on('smeta_rooms.room_id', '=', DB::expr($roomId))
                    ->join('smeta_categories', 'INNER')
                    ->on('smeta_categories.smeta_rooms_id', '=', 'smeta_rooms.id')
                    ->on('smeta_categories.material_categories_id', '=', 'material_categories.id');
        }
        return $categories->find_all();
    }
    public function getCategoriesForRoomId($roomId, $smetaId = NULL)
    {
        $room = ORM::factory('Room', $roomId);
        $result = array();
        if ($room->loaded()){
            $categories = $this->getCategoriesForRoom($room->type, $room->id, $smetaId = NULL);
            foreach ($categories as $category){
                if ($category->has_materials() || $category->has_children()){
                    $cat = $category->as_array();
                    if(!$smetaId){
                       $cat['enable'] = false; 
                    }
                    if($category->has_children()) {
                        $cat['childrens'] = array();
                        $childrens = $category->children();
                        foreach ($childrens as $children){
                            if (in_array($room->type, explode(',', $children->rooms_type))){
                                $cat['children'] = $children->as_array();
                            }
                            $cat['childrens'][] = $children->as_array();
                        }
                    } else {
                        if($smetaId){
                            $cat['materials'] = Array();
//                            $cat['materials'] = ORM::factory('Material')->getMaterialsForCatSmeta($cat['id'], $smetaId);
                        }else{
                            $cat['materials'] = Array();
//                            $cat['materials'] = ORM::factory('Material')->getMaterialsForCat($cat['id']);
                        }
                    }
                    $result[] = $cat;
                }
            }
        }
        return $result;
    }
    
    
//    public function get_products($filters)
//	{
//		$limit   = min( (int)Arr::get($filters, 'limit'), 21);
//		$type_id = (int) Arr::get($filters, 'type_id', -1);
//		$type = (int) Arr::get($filters, 'type', 1);
//		$room = (int) Arr::get($filters, 'room', null);
//		
//		// Выборка товаров
//		$products = DB::select()->from($this->_table_name)->order_by('products.price', 'ASC');
//
//                    if(
//                           $type_id == 41
//                        || $type_id == 40
//                        || $type_id == 32
//                        || $type_id == 19
//                        || ($type_id >= 17  && $type_id <= 23)
//                        || $type_id == 13
//                        || $type_id == 1
//                        ){
//                    
//                    if($room != NULL || $type_id == 41){
//                        if($type_id == 41){
//                            $type_id = 13;
//                            $type = 7;
//                            $room = 'Кухня';
//                        }
//                        
//                            $products
//                           ->select(array('c1.name', 'country1'),
//                                   array('c2.name', 'country2'),
//                                   array('c3.name', 'country3'),
//                                   'products.*',
//                                   'laminat.*',
//                                   array('products.id','id'),
//                                   array('products.type_id','type_id'),
//                                   'laminat.type')
//                            ->join('laminat')
//                                ->on('products.id', '=', 'laminat.products_id')
//                                ->on('laminat.type', '=', DB::expr($type))
//                            ->join(array('countru', 'c1'), 'left')
//                                ->on('laminat.countru_manuf_id', '=', 'c1.id')
//                            ->join(array('countru', 'c2'), 'left')
//                                ->on('laminat.countru_id', '=', 'c2.id')
//                            ->join(array('countru', 'c3'), 'left')
//                                ->on('laminat.countru_br', '=', 'c3.id')
//                            ->where('products.type_id', '=', $type_id)
//                            ->where('laminat.room', '=',$room);
//                    }else{
//                          if($type_id == 23){
//                            $room_S = (int) Arr::get($filters, 'room_S', null);
//                            $room_vt_min = $room_S*110;
//                            $room_vt_max = $room_S*130;
//                            $products->where("vt", '>=', $room_vt_min)
//                                    ->where("vt", '<=', $room_vt_max);
//                          }elseif($type_id == 22){
//                            $room_S = (int) Arr::get($filters, 'room_S', null);
//                            $room_vt_min = $room_S*1.1;
//                            $room_vt_max = $room_S*1.3;
//                            $products->where("pl_p", '>=', $room_vt_min)
//                                    ->where("pl_p", '<=', $room_vt_max);
//                              
//                          }
//                         $products
//                           ->select(array('c1.name', 'country1'),array('c2.name', 'country2'),array('c3.name', 'country3'), 'products.*','laminat.*', array('products.id','id'),array('products.type_id','type_id'),'laminat.type')
//                            ->join('laminat')
//                                ->on('products.id', '=', 'laminat.products_id')
//                                ->on('laminat.type', '=', DB::expr($type))
//                            ->join(array('countru', 'c1'), 'left')
//                                ->on('laminat.countru_manuf_id', '=', 'c1.id')
//                            ->join(array('countru', 'c2'), 'left')
//                                ->on('laminat.countru_id', '=', 'c2.id')
//                            ->join(array('countru', 'c3'), 'left')
//                                ->on('laminat.countru_br', '=', 'c3.id')
//                            ->where('products.type_id', '=', DB::expr($type_id));
//                    }
//                }elseif($type_id == 31){
//                    $products->where('type_id', '=', $type_id)
//                        ->select('work_timpl.*','products.*')->join('work_timpl')->on('products.id', '=', 'work_timpl.product_id');
//                }else{
//			$products->where('type_id', '=', $type_id);
//                }
//		// Делаем запрос
//		$products = $products->execute($this->_db)->as_array();
//
//		if (count($products) <= $limit) 
//			return $products;
//
//		$products = array_chunk($products, (int)(count($products) / $limit));
//
//		array_walk($products, create_function('&$p', '$p = $p[array_rand($p, 1)];'));
//
//		foreach ($products as $key => $value) 
//		{
//			$products[$key]['description'] = strip_tags($products[$key]['description']);
//		}
//
//		return array_slice($products, 0, $limit);
//	}
}