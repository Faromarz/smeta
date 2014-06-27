<?php

class Controller_Admin_Work extends Controller_Admin_Index
{
    /**
     * @var  View  page template
     */

    public function before() {
        parent::before();     
 
    }

    public function action_index()
    {
       $this->template->styles[] = '/resources/css/admin/work.css';
       
        $object = ORM::factory('Work');
        $object->order_by('type');
        $categories = ORM::factory('Producttype')->find_all();

        $pagination = $object->get_pagination();

//        $this->template->v_body->v_page                = View::factory('admin/blocks/work/demont/index');
        $this->template->v_body->v_page                = View::factory('admin/blocks/work/index');
        $this->template->v_body->v_page->categories    = $categories;
        $this->template->v_body->v_page->objects       = $object->get_objects();
        $this->template->v_body->v_page->pagination    = $pagination;
    }
    public function action_create()
    {
      
        $this->template->v_body->v_page =  View::factory('admin/blocks/work/edit');
        $object = ORM::factory('Work');
        $categories = ORM::factory('Producttype')->find_all();
        $errors = array();

        if ($_POST && !empty($_POST['name'])){
            try{
                $post = $_POST;
                $post['categor_arr'] = implode(',',$_POST['categor_arr']);
                $object = $object->create_group($post);
                HTTP::redirect("/admin/work");
                
            }catch (ORM_Validation_Exception $e){
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->v_body->v_page->errors = $errors;
        $this->template->v_body->v_page->object = $object;
        $this->template->v_body->v_page->categories = $categories;
    }
      public function action_edit()
    {
        $this->template->styles[] = '/resources/css/admin/work.css';
        
        $categories = ORM::factory('Producttype')->find_all();
        $content = View::factory('admin/blocks/work/demont/edit');
        $errors = array();
        
        if($this->request->param('param') != 0){
            $object = ORM::factory('Work')->where('work.id', '=', $this->request->param('param'))->find();
            if ( !$object->loaded() ) 
                throw new Kohana_HTTP_Exception_404("Работа не найдена");
        }else{
            $object = ORM::factory('Work')->where('name', '=', htmlspecialchars($_POST['name']))->find();
            if(!$object->loaded()){
                 $object = ORM::factory('Work');
            }
        }

        if ( $_POST && !empty($_POST['name']))
        {
            try
            {
                $post = $_POST;
                if($_POST['nv_vt']==''){
                    $post['nv_vt'] = NULL;
                }
                if(!is_array($_POST['categor_arr'])){ $_POST['categor_arr'] = array($POST['categor_arr']);}
                if(is_array($_POST['categor_arr']) && in_array('32',$_POST['categor_arr'])
                        &&
                        (in_array('Линолеум',$_POST['categor_arr']) 
                        || in_array('Ламинат',$_POST['categor_arr'])
                        || in_array('Пробка',$_POST['categor_arr'])
                        || in_array('Паркет',$_POST['categor_arr'])
                        || in_array('Массив',$_POST['categor_arr'])
                        || in_array('Модули',$_POST['categor_arr'])
                        || in_array('Плитка напольная',$_POST['categor_arr'])
                        )
                        ){
                    $post['categor_arr'] = 32;
                    foreach ($_POST['categor_arr'] as $val){
                        if(is_string($val)){
                            if(in_array('Линолеум',$_POST['categor_arr'])){$pod = 1;}
                            if(in_array('Ламинат',$_POST['categor_arr'])){$pod = 2;}
                            if(in_array('Пробка',$_POST['categor_arr'])){$pod = 4;}
                            if(in_array('Паркет',$_POST['categor_arr'])){$pod = 5;}
                            if(in_array('Массив',$_POST['categor_arr'])){$pod = 6;}
                            if(in_array('Модули',$_POST['categor_arr'])){$pod = 7;}
                            if(in_array('Плитка напольная',$_POST['categor_arr'])){$pod = 3;}
                            $post['podceteg_arr'] = $pod;
                        }
                        
                    }
                        }else if(is_array($_POST['categor_arr']) &&  in_array('13',$_POST['categor_arr'])
                        &&
                        (in_array('Виниловые',$_POST['categor_arr']) 
                        || in_array('Флизелиновые',$_POST['categor_arr'])
                        || in_array('Текстильные',$_POST['categor_arr'])
                        || in_array('Флоковые',$_POST['categor_arr'])
                        || in_array('Натуральные',$_POST['categor_arr'])
                        || in_array('Бумажные',$_POST['categor_arr'])
                        || in_array('Плитка настенна',$_POST['categor_arr'])
                        )
                        ){
                    $post['categor_arr'] = 13;
                    foreach ($_POST['categor_arr'] as $val){
                        if(is_string($val)){
                            if(in_array('Виниловые',$_POST['categor_arr'])){$pod = 2;}
                            if(in_array('Флизелиновые',$_POST['categor_arr'])){$pod = 1;}
                            if(in_array('Текстильные',$_POST['categor_arr'])){$pod = 3;}
                            if(in_array('Флоковые',$_POST['categor_arr'])){$pod = 4;}
                            if(in_array('Натуральные',$_POST['categor_arr'])){$pod = 5;}
                            if(in_array('Бумажные',$_POST['categor_arr'])){$pod = 6;}
                            if(in_array('Плитка настенна',$_POST['categor_arr'])){$pod = 7;}
                            $post['podceteg_arr'] = $pod;
                        }
                    }
                    
                }else{ 
                    if(is_array($_POST['categor_arr'])){
                        $post['categor_arr'] = implode(',',$_POST['categor_arr']);
                    }else{
                        $post['categor_arr'] = array($_POST['categor_arr']);
                    }
                }
                if(!empty($_POST['remontTypeDef']) && $_POST['remontTypeDef'] != 'calc-remont-group-capital'){
                    if(is_array($_POST['remontTypeDef'])){
                        $post['remontTypeDef'] = implode(',',$_POST['remontTypeDef']);
                    }else{
                        $post['remontTypeDef'] = array($_POST['remontTypeDef']);
                    }
                }else{ 
                    $post['remontTypeDef']=NULL;
                }
                if(!empty($_POST['remontType']) && $_POST['remontType'] != 'calc-remont-group-cosmetic')if(is_array($_POST['remontType']))$post['remontType'] = implode(',',$_POST['remontType']);else{array($_POST['remontType']);}else $post['remontType']=NULL;
                if(!empty($_POST['room_id']))$post['room_id'] = implode(',',$_POST['room_id']);else $post['room_id'] = 'none';
                $object->update_article( $post );
               
                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }else{
                    HTTP::redirect("/admin/work/");
                }
            }
            catch (ORM_Validation_Exception $e)
            {
                if(isset($_POST['ajax'])){
                    die (Arr::flatten($e->errors("")));
                }else{
                $errors = Arr::flatten($e->errors(""));
                }
            }
        }

        $this->template->v_body->v_page 	= $content;
        $this->template->v_body->v_page->object = $object;
        $this->template->v_body->v_page->categories = $categories;
        $this->template->v_body->v_page->errors = $errors;
    }
     public function action_delete()
    {
        $object = ORM::factory('Work', $this->request->param('param'));
        if ( $object->loaded() ) {
            $object->delete();
            HTTP::redirect('/admin/work/');
        } else {
            throw new Kohana_HTTP_Exception_404("Работа не найдена");
        }
    }
    public function action_exelout(){
    // выгрузка работ в Exel
        $typ = 0;
        $title = 'Демонтажные работы';

         $ws = new Spreadsheet(array(
        'author'       => 'Smeta',
        'title'        => 'Работы',
        'subject'      => 'Subject',
        'description'  => 'Description',
    ));

        $ws->set_active_sheet(0);
        $as = $ws->get_active_sheet();
        $as->setTitle('Работы');
        // шрифт
        $as->getDefaultStyle()->getFont()->setName('Inherit')->setSize(10);

        // выравнивание 
        $as->getStyle('2')
                ->getAlignment()
                ->setWrapText(true)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   
        $as->getRowDimension(1)->setRowHeight(15);
        $as->getRowDimension(2)->setRowHeight(15);
        $as->getRowDimension(3)->setRowHeight(25);
        $as->getRowDimension(4)->setRowHeight(30);
        $as->mergeCells('A1:V1');
        $as->getStyle('A1')
                ->getAlignment()
                ->setWrapText(true)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $as->getStyle('A6')
                ->getAlignment()
                ->setWrapText(true)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // размеры
        $as->getColumnDimension('A')->setWidth(4)->setCollapsed(5);
        $as->mergeCells('A2:A4');
//       $as->getAlignment()->setWrapText(true)->setRowHeight(-1);
        $as->getColumnDimension('B')->setWidth(29);
        $as->mergeCells('B2:B4');
        
        $as->getColumnDimension('C')->setWidth(5);
        $as->mergeCells('C2:C4');
        
        $as->getColumnDimension('D')->setWidth(6);
        $as->mergeCells('D2:D4');
        
        $as->getColumnDimension('E')->setWidth(11);
        $as->mergeCells('E2:E4');
        
        $as->getColumnDimension('F')->setWidth(13);
        $as->mergeCells('F2:F4');
        
        $as->getColumnDimension('G')->setWidth(10);
        $as->getColumnDimension('H')->setWidth(9);
        $as->getColumnDimension('I')->setWidth(9);
        $as->mergeCells('G2:I3');
        $as->getColumnDimension('J')->setWidth(7);
        $as->getStyle('J2')->getAlignment()->setTextRotation(90)->setWrapText(true)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $as->mergeCells('J2:J4');
        $as->getColumnDimension('K')->setWidth(14);
        $as->mergeCells('K2:K4');
        $as->getColumnDimension('L')->setWidth(8);
        $as->getColumnDimension('M')->setWidth(8);
        $as->getColumnDimension('N')->setWidth(8);
        $as->getColumnDimension('O')->setWidth(8);
        $as->getColumnDimension('K')->setWidth(8);
        $as->mergeCells('L2:P3');
        $as->getColumnDimension('Q')->setWidth(9);
        $as->getColumnDimension('R')->setWidth(9);
        $as->getColumnDimension('S')->setWidth(9);
        $as->getColumnDimension('T')->setWidth(9);
        $as->getColumnDimension('U')->setWidth(9);
        $as->getColumnDimension('V')->setWidth(9);
        $as->mergeCells('Q2:V2');
        $as->mergeCells('Q3:S3');
        $as->mergeCells('T3:V3');
        $as->mergeCells('A6:V6');
    
        $as->getStyle('Q3')
               ->getAlignment()
               ->setWrapText(true)
               ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
               ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $as->getStyle('T3')
               ->getAlignment()
               ->setWrapText(true)
               ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
               ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $as->getStyle('J4:V4')
               ->getAlignment()
               ->setWrapText(true)
               ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
               ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $as->getStyle('A5:V5')
               ->getAlignment()
               ->setWrapText(true)
               ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
               ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
               ;
        $as->getStyle('A5:V5')->getFont()->setSize(8);
        $as->getStyle('A6')->getActiveSheet()->freezePane('A6');

        $sh = array(
            1 => array("Ремонтно-отделочные работы Mastersmeta.ru"),
            2 => array(
                '№ п/п',
                'Наименование работ',
                'Ед. изм.',
                'Нормо/час',
                'Новостройка/вторичка',
                'От какого материала зависит?',
                'Стоимость работ за м.п./м2/ед., руб.',
                '',
                '',
                'далее для информации:',
                'Формулы',
                'Где делаем ремонт?',
                '',
                '',
                '',
                '',
                'Классификация ремонтов'),
            3 => array(
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                'Косметический',
                '',
                '',
                'Капитальный',
                '',
                '',
                ),
            4 => array(
                '',
                '',
                '',
                '',
                '',
                '',
                'Эконом',
                'Стандарт',
                'Премиум',
                '',
                '',
                'Комната',
                'Кухня',
                'Коридор',
                'Ванна',
                'Туалет',
                'Эконом',
                'Стандарт',
                'Премиум',
                'Эконом',
                'Стандарт',
                'Премиум',
                ),
            5 => array(
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
                'G',
                'H',
                'I',
                'J',
                'K',
                'L',
                'M',
                'N',
                'O',
                'P',
                'Q',
                'R',
                'S',
                'T',
                'U',
                'V'
                ),
             6 => array(
                 $title,
             ),

        );
        $object = ORM::factory('Work')
                ->where('type', '=', $typ)
               ->select('type_name',DB::expr('GROUP_CONCAT(DISTINCT type_name ORDER BY type_name ASC SEPARATOR ", ") AS mater'))
                ->join('product_types', 'left')->on(DB::expr('FIND_IN_SET(product_types.id, categor_arr)'), '!=', DB::expr('0'))
                ->group_by('work.id')
                ->find_all();
        $i = 1;
        foreach ($object as $val){
            $room = '-';if(in_array('1', explode(',', ','.$val->room_id)))$room = '+';
            $room1 = '-';if(in_array('2', explode(',', ','.$val->room_id)))$room1 = '+';
            $room2 = '-';if(in_array('3', explode(',', ','.$val->room_id)))$room2 = '+';
            $room3 = '-';if(in_array('4', explode(',', ','.$val->room_id)))$room3 = '+';
            $room4 = '-';if(in_array('5', explode(',', ','.$val->room_id)))$room4 = '+';
            $econom1 = '-';if(in_array('calc-price-group-econom', explode(',', ','.$val->remontType)))$econom1 = '+';
            $business1 = '-';if(in_array('calc-price-group-business', explode(',', ','.$val->remontType)))$business1 = '+';
            $premium1 = '-';if(in_array('calc-price-group-premium', explode(',', ','.$val->remontType)))$premium1 = '+';
            $econom2 = '-';if(in_array('calc-price-group-econom', explode(',', ','.$val->remontTypeDef)))$econom2 = '+';
            $business2 = '-';if(in_array('calc-price-group-business', explode(',', ','.$val->remontTypeDef)))$business2 = '+';
            $premium2 = '-';if(in_array('calc-price-group-premium', explode(',', ','.$val->remontTypeDef)))$premium2 = '+';
            
            $count = str_replace('S','Площадь пола',$val->count);
            $count = str_replace('PW','Площадь стен',$count);
            $count = str_replace('CD','Количество дверей',$count);
            $count = str_replace('CW','Количество окон',$count);
            $count = str_replace('C','Количество комнат',$count);
            $count = str_replace('P','Периметр',$count);
            if(empty($val->podceteg_arr))
                $mater = $val->mater;
            else{
                $mater = $val->podceteg_arr;                
            }
            $nv_vt = 3;
            if($val->nv_vt === '0')$nv_vt = 1;
            if($val->nv_vt === '1')$nv_vt = 2;
            
            $unit = '';
            $unit = str_replace(array('<sup>','</sup>'), '', $val->unit);
            $sh[] = array(
                $i,
                $val->name,
                $unit,
                $val->watch,
                $nv_vt,
                $mater,
                $val->price,
                $val->price,
                $val->price,
                '',
                $count,
                $room,
                $room1,
                $room2,
                $room3,
                $room4,
                $econom1,
                $business1,
                $premium1,
                $econom2,
                $business2,
                $premium2,
            );
            ++$i;
        }
        $typ = 1;
        $title = 'Монтажные работы';
        $as->mergeCells('A'.($i+6).':V'.($i+6));
          $as->getStyle('A'.($i+6))
                ->getAlignment()
                ->setWrapText(true)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $sh[] = array(
            $title,
        );
        
        $object = ORM::factory('Work')
                ->where('type', '=', $typ)
               ->select('type_name',DB::expr('GROUP_CONCAT(DISTINCT type_name ORDER BY type_name ASC SEPARATOR ", ") AS mater'))
                ->join('product_types', 'left')->on(DB::expr('FIND_IN_SET(product_types.id, categor_arr)'), '!=', DB::expr('0'))
                ->group_by('work.id')
                ->find_all();
        $i = 1;
        foreach ($object as $val){
            $room = '-';if(in_array('1', explode(',', ','.$val->room_id)))$room = '+';
            $room1 = '-';if(in_array('2', explode(',', ','.$val->room_id)))$room1 = '+';
            $room2 = '-';if(in_array('3', explode(',', ','.$val->room_id)))$room2 = '+';
            $room3 = '-';if(in_array('4', explode(',', ','.$val->room_id)))$room3 = '+';
            $room4 = '-';if(in_array('5', explode(',', ','.$val->room_id)))$room4 = '+';
            $econom1 = '-';if(in_array('calc-price-group-econom', explode(',', ','.$val->remontType)))$econom1 = '+';
            $business1 = '-';if(in_array('calc-price-group-business', explode(',', ','.$val->remontType)))$business1 = '+';
            $premium1 = '-';if(in_array('calc-price-group-premium', explode(',', ','.$val->remontType)))$premium1 = '+';
            $econom2 = '-';if(in_array('calc-price-group-econom', explode(',', ','.$val->remontTypeDef)))$econom2 = '+';
            $business2 = '-';if(in_array('calc-price-group-business', explode(',', ','.$val->remontTypeDef)))$business2 = '+';
            $premium2 = '-';if(in_array('calc-price-group-premium', explode(',', ','.$val->remontTypeDef)))$premium2 = '+';
            
            $count = str_replace('S','Площадь пола',$val->count);
            $count = str_replace('PW','Площадь стен',$count);
            $count = str_replace('CD','Количество дверей',$count);
            $count = str_replace('CW','Количество окон',$count);
            $count = str_replace('C','Количество комнат',$count);
            $count = str_replace('P','Периметр',$count);
            if(empty($val->podceteg_arr))
                $mater = $val->mater;
            else{
                $mater = $val->podceteg_arr;                
            }
            $nv_vt = 3;
            if($val->nv_vt === '0')$nv_vt = 1;
            if($val->nv_vt === '1')$nv_vt = 2;
            
            $unit = '';
            $unit = str_replace(array('<sup>','</sup>'), '', $val->unit);
            $sh[] = array(
                $i,
                $val->name,
                $unit,
                $val->watch,
                $nv_vt,
                $mater,
                $val->price,
                $val->price,
                $val->price,
                '',
                $count,
                $room,
                $room1,
                $room2,
                $room3,
                $room4,
                $econom1,
                $business1,
                $premium1,
                $econom2,
                $business2,
                $premium2,
            );
            ++$i;
        }
        
        $count = count($sh);

       $as->getStyle('A2:V'.$count)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $as->getStyle('J6:V'.$count)
               ->getAlignment()
               ->setWrapText(true)
               ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
               ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $as->getStyle("B6:B".$count)->getAlignment()->setWrapText(true);

       $ws->set_data($sh, false);
       $ws->send(array('name'=>'Ремонтные работы', 'format'=>'Excel5'));
    }
    

  
    public function action_usledit()
    {
        $this->template->styles[] = '/resources/css/admin/work.css';
        
        $object = ORM::factory('Producttype')->where('id', '=', $this->request->param('param'))->find();
        
        $content = View::factory('admin/blocks/work/usl/edit');
      
        $errors = array();

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST)
        {
            try
            {
                $post = $_POST;
                $object->update_article( $post );
               
                HTTP::redirect("/admin/work/usl");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->v_body->v_page 	= $content;
        $this->template->v_body->v_page->object = $object;
        $this->template->v_body->v_page->errors = $errors;
    }
  
    public function action_esldelete()
    {
        $object = ORM::factory('Producttype', $this->request->param('param'));

        if ( $object->loaded() ) {
            
            $object->delete();
            HTTP::redirect('/admin/work');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    public function after() {
//            if(empty($this->template->left_menu->links))
//                $this->template->v_body->v_page->class = ' full-content';
            parent::after();
    }
        
}
