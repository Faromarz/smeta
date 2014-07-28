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
            if ($materials_category->count_categories()==0 && $materials_category->count_materials()>0 || $materials_category->count_categories()>0){
                $a = array();
                $materials_under = ORM::factory('Material_Categories')->where('parent_id','=',$materials_category->id)->find_all();
                $i=0;
                foreach ($materials_under as $material_under){
                    if ($material_under->count_materials()>0)
                        $a[] = array('id'=>$material_under->id, 'name'=>$material_under->name, 'repair_id_rate_id'=>$materials_category->repair_id_rate_id, 'rooms_type'=>$materials_category->rooms_type, 'selected'=> ($i==0? 1: 0));
                    $i++;
                }
                $result[] = array('id'=>$materials_category->id, 'name'=>$materials_category->name, 'repair_id_rate_id'=>$materials_category->repair_id_rate_id, 'rooms_type'=>$materials_category->rooms_type, 'under' => $a);
            }
        }
        die(json_encode($result));
    }

    public function action_load_materials()
    {
        $result = array();
        $materials_categories = ORM::factory('Material_Categories')->find_all();
        foreach ($materials_categories as $materials_category){
            if ($materials_category->count_materials()>0){
                $materials = ORM::factory('Material')->where('category_id','=',$materials_category->id)->limit(10)->find_all();
                $i=0;
                foreach ($materials as $material){
                    $result[] = array('category_id'=>$material->category_id, 'id'=>$material->id, 'name'=>$material->name, 'price'=>$material->price,'img'=>$material->img, 'country'=>$material->country->name, 'selected'=> ($i==0? 1: 0));
                    $i++;
                }
            }
        }
        die(json_encode($result));
    }
}