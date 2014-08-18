<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Works extends Controller
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

    public function action_load_categories_works()
    {
        $result = array();
        $work_categories = ORM::factory('Work_Categories')->find_all();
        foreach ($work_categories as $work_category){
            $result[] = array('id'=>$work_category->id, 'name'=>$work_category->name);
        }
        die(json_encode($result));
    }

    public function action_load_works()
    {
        $result = array();
        $works = ORM::factory('Work')->find_all();
        foreach ($works as $work){
                $result[] = array('id'=>$work->id, 'name'=>$work->name, 'count' => $work->count, 'repair_ids' => $work->repair_ids, 'cat_arr' => $work->cat_arr, 'category_id' => $work->category_id, 'watch' => $work->watch, 'types_apartment_ids' => $work->types_apartment_ids, 'room_type' => $work->room_type, 'type' => $work->type, 'price' => $work->price);
        }
        die(json_encode($result));
    }

}