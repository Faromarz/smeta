<?php

class Controller_Admin_Migration extends Controller_Admin_Index
{

    /**
     * @var  View  page template
     */
    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $this->default_template = 'admin/migration';
        
        $objects = DB::select('materials.name')
                ->select(array('products.id', 'id_p'))
                ->select('materials.id')
                ->select('materials.img')
                ->select('products.image')
                ->select('products.price')
                ->from('materials')
                ->join('products')
                ->on('materials.name', '=', 'products.name')
                ->on('materials.price', '=', 'products.price')
                ->on('materials.img', '=', 'products.image')
                ->order_by('materials.id')
//                ->limit(10)
                ->execute()
                ->as_array();
        
        $this->set('_result', $objects);
        echo count($objects);
        foreach ($objects as $obj){
            DB::update('material_params')
                    ->set(array('material_params.material_id' => $obj['id']))
                    ->where('material_params.products_id', '=', $obj['id_p'])->execute();
        }
        
        echo View::factory('profiler/stats');
    }
}
