<?php

class Controller_Admin_Partners extends Controller_Admin_Index
{
    /**
     * @var  View  page template
     */
    public function before() {
        parent::before();
        
         $this->template->scripts[] = '/resources/js/admin/partners.js';

        $this->template->v_body->v_left_menu->links = array(
            '/admin/partner/create'	=> 'Добавить категорию',
            '/admin/partner/index'	=> 'Список категорий',
            '/admin/work/usl'           => 'Группы материалов',
        );
    }


    public function action_index()
    {
        $object = ORM::factory('Partners');

        $pagination = $object->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/partners/index');
        $this->template->v_body->v_page->objects	= $object->get_objects($pagination);
        $this->template->v_body->v_page->pagination = $pagination;
        
//        echo View::factory('profiler/stats');
    }
 public function action_chenge(){
    
         $par = ORM::factory('Partnersparam', 1);
         $par->update_article($_POST);
 }
 public function action_all(){
     
         $this->template->styles[] = '/resources/css/admin/partners.css';
     
        $object = ORM::factory('Partners');
        if(isset($_GET['group']) && !empty($_GET['group']))$object->where('group', '=', $_GET['group']);
        if(isset($_GET['patrner']) && !empty($_GET['patrner']))$object->where('patrner_id', '=', $_GET['patrner']);
        if(isset($_GET['country']) && !empty($_GET['country']))$object->where('country', '=', $_GET['country']);
        if(isset($_GET['region']) && !empty($_GET['region']))$object->where('region', '=', $_GET['region']);
        if(isset($_GET['city']) && !empty($_GET['city']))$object->where('city', '=', $_GET['city']);
        $pagination = $object->get_pagination();
               
        $groups = ORM::factory('Group')->find_all();
        $groups_filtr = ORM::factory('Group')
                ->join('partners')->on('group.id', '=', 'partners.group')->group_by('partners.group')->find_all();
        $partner_groups = ORM::factory('Partner')->find_all();
        $partner_groups_filtr = ORM::factory('Partner')
                ->join('partners')->on('partner.id', '=', 'partners.patrner_id')->group_by('partners.patrner_id')->find_all();
//        $counties = ORM::factory('country')->find_all();
//        $counties_filtr = ORM::factory('country')
//                ->join('partners')->on('country.id', '=', 'partners.country')->group_by('partners.country')->find_all();
        $counties = ORM::factory('Geo')->select(array('geo.name', 'country'))->where('country_id', 'is', NULL)->find_all();
        $counties_filtr = ORM::factory('Geo')->select(array('geo.name', 'country'))->where('geo.country_id', 'is', NULL)
                ->join('partners')->on('geo.id', '=', 'partners.country')->group_by('partners.country')->find_all();
//        $regions = ORM::factory('region')->find_all();
//        $regions_filtr = ORM::factory('region')
//                ->join('partners')->on('region.id', '=', 'partners.region')->group_by('partners.region')->find_all();
        $regions = ORM::factory('Geo')->select(array('geo.name', 'region'))->where('geo.country_id', 'is not', NULL)->where('geo.region_id', 'is', NULL)->find_all();
        $regions_filtr = ORM::factory('Geo')->select(array('geo.name', 'region'))->where('geo.country_id', 'is not', NULL)->where('geo.region_id', 'is', NULL)
                ->join('partners')->on('geo.id', '=', 'partners.region')->group_by('partners.region')->find_all();
//        $cities = ORM::factory('city')->find_all();
//        $cities_filtr = ORM::factory('city')
//                ->join('partners')->on('city.id', '=', 'partners.city')->group_by('partners.city')->find_all();
        $cities = ORM::factory('Geo')->select(array('geo.name', 'city'))->where('geo.country_id', 'is not', NULL)->where('geo.region_id', 'is not', NULL)->find_all();
        $cities_filtr = ORM::factory('Geo')->select(array('geo.name', 'city'))->where('geo.country_id', 'is not', NULL)->where('geo.region_id', 'is not', NULL)
                ->join('partners')->on('geo.id', '=', 'partners.city')->group_by('partners.city')->find_all();
        $work_dem = ORM::factory('Work')->where('type', '=', 0)->find_all();
        $work_mont = ORM::factory('Work')->where('type', '=', 1)->find_all();
        
        $categories = ORM::factory('Producttype')->find_all();
        $count_char = ORM::factory('Partnersparam', 1);
        $object = $object->get_objects($pagination);
        $content = View::factory('admin/blocks/partners/all')
                ->bind("count_char", $count_char)
                ->bind("categories", $categories)
                ->bind("work_mont", $work_mont)
                ->bind("work_dem", $work_dem)
                ->bind("groups", $groups)
                ->bind("groups_filtr", $groups_filtr)
                ->bind("partner_groups", $partner_groups)
                ->bind("partner_groups_filtr", $partner_groups_filtr)
                ->bind("counties", $counties)
                ->bind("counties_filtr", $counties_filtr)
                ->bind("regions", $regions)
                ->bind("regions_filtr", $regions_filtr)
                ->bind("cities", $cities)
                ->bind("cities_filtr", $cities_filtr)
                ->bind("pagination", $pagination)
                ->bind("objects", $object);

        $this->template->v_body->v_page = $content;
        
//        echo View::factory('profiler/stats');
    }
    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
       $this->template->styles[] = '/resources/css/admin/partners.css';
        $region_obj = new Model_Geo();
                
        $region_obj->define_region();
        $select_country = $region_obj->generate_select_c();
        $select_regions = $region_obj->generate_select_r();
        $select_cities = $region_obj->generate_city();
        
        $Partner_obj = new Model_Partner();
        $select_partner = $Partner_obj->generate_select_cat();
                
                
        $this->template->v_body->v_page =  View::factory('admin/blocks/partners/edit')
                ->bind("select_partner", $select_partner)
                ->bind("select_cities", $select_cities)
                ->bind("select_country", $select_country)
                ->bind("select_regions", $select_regions);
        $object = ORM::factory('Partners');
        $errors = array();

        if ($_POST && $_FILES['img'])
        {
            try
            {
                $file = $_FILES['img']['tmp_name'];
                $name = $_FILES['img']['name'];
                $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                $filename = $this->_upload_img($file, $type);
                $post = $_POST;
                $post['img'] = $filename;
                if(!$post['city'])$post['city'] = '';
                $object = $object->create_group($post);

                HTTP::redirect("/admin/partners/");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->v_body->v_page->errors = $errors;
        $this->template->v_body->v_page->object = $object;
 
                
    }

    /**
     * Редактирование основних параметров работи в портфолио
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_edit()
    {
        $this->template->styles[] = '/resources/css/admin/partners.css';
        
        $object = ORM::factory('Partners')->where('partners.id', '=', $this->request->param('param'))->find();
        
        $region_obj = new Model_Geo();
        $select_country = $region_obj->generate_select_c($object->country);
        $select_regions = $region_obj->generate_select_r($object->country,$object->region);
        $select_cities = $region_obj->generate_city($object->region,$object->city);
        
        $Partner_obj = new Model_Partner();
        $select_partner = $Partner_obj->generate_select_cat($object->patrner_id);
        
        $content = View::factory('admin/blocks/partners/edit')
                ->bind("select_partner", $select_partner)
                ->bind("select_country", $select_country)
                ->bind("select_cities", $select_cities)
                ->bind("select_regions", $select_regions);
      
        $errors = array();

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");
        if($_POST['dell'] && !isset($_POST['ajax'])){
            if (is_file('resources/logotype/'.$_POST['img_dell'])){
                       if (unlink('resources/logotype/'.$_POST['img_dell'])){$object->img = "";$object->save();}
            }
            if(isset($_GET['all']))
                    HTTP::redirect("/admin/partners/all");
        }

        if ( $_POST && (!$_POST['dell'] || isset($_POST['ajax'])))
        {
            try
            {
                $post = $_POST;
                if($_FILES['img']['tmp_name']){
                    $file = $_FILES['img']['tmp_name'];
                    $name = $_FILES['img']['name'];
                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                    $filename = $this->_upload_img($file, $type);
                    $post['img'] = $filename;
                }
                if(!$post['city'])$post['city'] = '';
                    $object->update_article( $post );
               
                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }else{
                    if(isset($_GET['all']))
                        HTTP::redirect("/admin/partners/all");
                    else
                        HTTP::redirect("/admin/partners/");
                }
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
                if(isset($_POST['ajax'])){
                    die ($errors);
                }
            }
        }

        $this->template->v_body->v_page 	= $content;
        $this->template->v_body->v_page->object = $object;
        $this->template->v_body->v_page->errors = $errors;
    }

    /**
     * Удаление работу
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
        $object = ORM::factory('Partners', $this->request->param('param'));

        if ( $object->loaded() ) {
            if (is_file('resources/logotype/'.$object->img)){
                    if (unlink('resources/logotype/'.$object->img)){}
            }
            $object->delete();
            if(isset($_GET['all']))
                    HTTP::redirect("/admin/partners/all");
            else
                HTTP::redirect('/admin/partners');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
     public function _upload_img($file,$ext) {

        $directory = 'resources/logotype/';

        // генерируем название
        $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';

        $filename = '';
        for ($i = 0; $i < 10; $i++) {
            $filename .= rand(1, strlen($symbols));
        }
        // изменяем размер изобржаения и загружаем
                  
        copy($file, $directory . $filename . '.' . $ext);
       
        return "$filename.$ext";
    }
    public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}
}
