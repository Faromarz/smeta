<?php
    require_once ('modules/excel/Classes/PHPExcel.php');

class Controller_Admin_Workload extends Controller
{
    /**
     * @var  View  page template
     */


    public function before() {
        parent::before();
     
 
    }

    public function action_exelget(){
        
        $param = $this->request->param('param');
        if(!in_array($param, array(0,1,2))){
            throw new HTTP_Exception_404('Page not found');
        }
        $typ = 1;
        $title = 'Монтажные работы';
        if($param == 0 ){
            $title = 'Демонтажные работы';
            $typ = 0;
        }else if($param == 2){
            $title = 'Окна';
            $typ = 0;
        }
        
        if(!empty($_FILES['work']['name'])){
           $file = $_FILES['work']['tmp_name'];

           $ar=array(); // инициализируем массив
            $objReader = PHPExcel_IOFactory::createReader('Excel5'); // создаем объект для чтения файла
            $objPHPExcel = $objReader->load($file); // загружаем данные файла в объект
            $ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
            $highestRow = count($ar);
            $i = 0;
            $add_work = Array();
            for ($row = 5; $row <= $highestRow; $row++){
                if(empty($ar[$row][0]))
                    continue;
                 if($ar[$row][0] == 'Демонтажные работы'){
                    $typ = 0;               
                }else  if($ar[$row][0] == 'Монтажные работы'){
                    $typ = 1;               
                } else{
                    $fin = ORM::factory('work')->where('name', '=', mysql_escape_string($ar[$row][1]))->find();
                    if($fin->loaded()){
                            $add_work[$i]['id'] = $fin->id;
                            $add_work[$i]['color'] = 'f60';
                    }else{
                             $add_work[$i]['id'] = 0;
                            $add_work[$i]['color'] = '060';
                    }

                    $add_work[$i]['name'] = $ar[$row][1];
                    $add_work[$i]['unit'] = '';
                    if(!empty($ar[$row][2])){
                        $add_work[$i]['unit'] = $ar[$row][2];                        
                    }
                    $add_work[$i]['type']  = $typ;
                    $add_work[$i]['watch']  = $ar[$row][3];
                    $add_work[$i]['nv_vt']  = $ar[$row][4];

                    $cat_id = '';
                    if(in_array($ar[$row][5], array('Виниловые','Флизелиновые','Текстильные','Флоковые','Натуральные','Бумажные'))){
                        $add_work[$i]['podceteg_arr'] = $this->HardCheckQuery($ar[$row][5]);
                        $cat_id = '13,';
                    }else if(in_array($ar[$row][5], array('Обои/Плитка'))){
                        $add_work[$i]['podceteg_arr'] = 'Плитка';
                        $cat_id = '13,';
                    }else if(in_array($ar[$row][5], array('Линолеум','Ламинат','Пробка','Паркет','Массив','Модули'))){
                        $add_work[$i]['podceteg_arr'] = $this->HardCheckQuery($ar[$row][5]);
                        $cat_id = '32,';
                    }else if(in_array($ar[$row][5], array('Пол/Плитка'))){
                        $add_work[$i]['podceteg_arr'] = 'Плитка';
                        $cat_id = '32,';
                    }else if(!empty($ar[$row][5])){
                        $categ = ucwords(mb_strtolower($this->HardCheckQuery($ar[$row][5])));
                        $categ = str_replace('Ванна/кабина', 'Ванна/Кабина', $categ);
                        $categ = explode(',', str_replace(', ', ',',$categ));
                        $cat = ORM::factory('producttype')->where('type_name', 'in', $categ)->find_all();
                        if(isset($cat[0]->id)){
                            foreach ($cat as $val){
                                if($val->id == 33)
                                    $cat_id .= $val->id.',34,35,36,37,38,';
                                else
                                    $cat_id .= $val->id.',';
                            }
                        }
                    }
                    $add_work[$i]['categor_arr'] = $cat_id;
                    $add_work[$i]['price'] = str_replace(',', '.', $this->HardCheckQuery($ar[$row][7]));
                    $str_count = $this->HardCheckQuery($ar[$row][10]);

                    $str_count = mb_strtolower($str_count);

                    $count = str_replace('Площадь пола','S',$str_count);
                    $count = str_replace('Площадь стен','PW',$count);
                    $count = str_replace('Количество дверей','CD',$count);
                    $count = str_replace('Количество окон','CW',$count);
                    $count = str_replace('Количество комнат','C',$count);
                    $count = str_replace('Периметр','P',$count);
                    $count = str_replace('площадь пола','S',$count);
                    $count = str_replace('площадь стен','PW',$count);
                    $count = str_replace('количество дверей','CD',$count);
                    $count = str_replace('количество окон','CW',$count);
                    $count = str_replace('количество комнат','C',$count);
                    $count = str_replace('периметр','P',$count);
                    $count = str_replace('s','S',$count);
                    $count = str_replace('pw','PW',$count);
                    $count = str_replace('cd','CD',$count);
                    $count = str_replace('cw','CW',$count);
                    $count = str_replace('Сw','CW',$count);
                    $count = str_replace('сw','CW',$count);
                    $count = str_replace('c','C',$count);
                    $count = str_replace('С','C',$count);
                    $count = str_replace('с','C',$count);
                    $count = str_replace('p','P',$count);
                    $count = str_replace('р','P',$count);
                    $count = str_replace('Р','P',$count);
                    $add_work[$i]['count'] = $count;

                    if(in_array($ar[$row][11],array('+',1,'1')))$add_work[$i]['room_id'] .= '1';
                    if(in_array($ar[$row][12],array('+',1,'1')))$add_work[$i]['room_id'] .= ',2';
                    if(in_array($ar[$row][13],array('+',1,'1')))$add_work[$i]['room_id'] .= ',3';
                    if(in_array($ar[$row][14],array('+',1,'1')))$add_work[$i]['room_id'] .= ',4';
                    if(in_array($ar[$row][15],array('+',1,'1')))$add_work[$i]['room_id'] .= ',5';

                    $add_work[$i]['remontType'] = 'calc-remont-group-cosmetic';
                    if(in_array($ar[$row][16],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-econom,w_d_calc-price-group-econom';
                    if(in_array($ar[$row][17],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-business,w_d_calc-price-group-business';
                    if(in_array($ar[$row][18],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-premium,w_d_calc-price-group-premium';

                    $add_work[$i]['remontTypeDef'] = 'calc-remont-group-capital';
                    if(in_array($ar[$row][19],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-econom,w_d_calc-price-group-econom';
                    if(in_array($ar[$row][20],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-business,w_d_calc-price-group-business';
                    if(in_array($ar[$row][21],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-premium,w_d_calc-price-group-premium';
                    ++$i;
                }
                
                $categories = ORM::factory('producttype')->find_all();
            }
            echo View::factory('admin/blocks/work/index')->bind('objects', $add_work)->bind('categories', $categories);
        }else if(!empty($_FILES['windows']['name'])){
            $file = $_FILES['windows']['tmp_name'];
//            $file = $_FILES['windows']['type'];
//            die($file);
//            application/vnd.ms-excel
            $ar=array(); // инициализируем массив
//            $inputFileType = PHPExcel_IOFactory::identify($file);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
//            die($inputFileType);
            $objReader = PHPExcel_IOFactory::createReader('Excel5'); // создаем объект для чтения файла
            $objPHPExcel = $objReader->load($file); // загружаем данные файла в объект
            $ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив

//            $highestRow = count($ar);
//            $i = 0;
            $add_work = Array();
//            for ($row = 5; $row <= $highestRow; ++ $row){
//                if(empty($ar[$row][1]))
//                    continue;
       
        for($i = 5;$i<=23;$i++){
            switch ($i){
                case 5:
                    $name = 'profil_name';
                    break;
                case 6:
                    $name = 'price';
                    break;
                case 7:
                    $name = 'base_gluh';
                    break;
                case 8:
                    $name = 'base_povorot';
                    break;
                case 9:
                    $name = 'base_povorot_otk';
                    break;
                case 10:
                    $name = 'podokonnik_otliv';
                    break;
                case 11:
                    $name = 'otkos_shtuk';
                    break;
                case 12:
                    $name = 'otkos_plastik';
                    break;
                case 13:
                    $name = 'montaj';
                    break;
                case 14:
                    $name = 'setka';
                    break;
                case 15:
                    $name = 'stvorka2';
                    break;
                case 16:
                    $name = 'stvorka3';
                    break;
                case 17:
                    $name = 'framuga';
                    break;
                case 18:
                    $name = 'color_wood';
                    break;
                case 19:
                    $name = 'site';
                    break;
                case 20:
                    $name = 'tel';
                    break;
                case 21:
                    $name = 'address';
                    break;
                case 22:
                    $name = 'dop_info1';
                    break;
                case 23:
                    $name = 'dop_info2';
                    break;
            }
            
            if($i == 5){
                if(ORM::factory('window')->where('profil_name', '=', mysql_escape_string($ar[$i][3]))->find()->loaded())
                        $add_work[0]['color'] = 'f60';
                else
                        $add_work[0]['color'] = '060';
                if(ORM::factory('window')->where('profil_name', '=', mysql_escape_string($ar[$i][4]))->find()->loaded())
                        $add_work[1]['color'] = 'f60';
                else
                        $add_work[1]['color'] = '060';
                if(ORM::factory('window')->where('profil_name', '=', mysql_escape_string($ar[$i][5]))->find()->loaded())
                        $add_work[2]['color'] = 'f60';
                else
                        $add_work[2]['color'] = '060';                    
            }
            $add_work[0][$name] = $ar[$i][3];
            $add_work[1][$name] = $ar[$i][4];
            $add_work[2][$name] = $ar[$i][5];
            
            
        }
       
               

//                if(!empty($ar[$row][2])){
//                    $categ = explode(',', str_replace(', ', ',', $this->HardCheckQuery($ar[$row][2])));
//                    $cat_id = '';
//                    $cat = ORM::factory('producttype')->where('type_name', 'in', $categ)->find_all();
//                    foreach ($cat as $val){
//                        if($val->id == 33)$cat_id .= $val->id.',34,35,36,37,38,';
//                        else  $cat_id .= $val->id.',';
//                    }
//                    $add_work[$i]['categor_arr'] = $cat_id;
//                }
//                $add_work[$i]['price'] = $this->HardCheckQuery($ar[$row][4]);
//                $add_work[$i]['count'] = $this->HardCheckQuery($ar[$row][7]);
//
//                if(in_array($ar[$row][8],array('+',1,'1')))$add_work[$i]['room_id'] .= '1';
//                if(in_array($ar[$row][9],array('+',1,'1')))$add_work[$i]['room_id'] .= ',2';
//                if(in_array($ar[$row][10],array('+',1,'1')))$add_work[$i]['room_id'] .= ',3';
//                if(in_array($ar[$row][11],array('+',1,'1')))$add_work[$i]['room_id'] .= ',4';
//                if(in_array($ar[$row][12],array('+',1,'1')))$add_work[$i]['room_id'] .= ',5';
//
//                $add_work[$i]['remontType'] = 'calc-remont-group-cosmetic';
//                if(in_array($ar[$row][13],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-econom,w_d_calc-price-group-econom';
//                if(in_array($ar[$row][14],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-business,w_d_calc-price-group-business';
//                if(in_array($ar[$row][15],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-premium,w_d_calc-price-group-premium';
//
//                $add_work[$i]['remontTypeDef'] = 'calc-remont-group-capital';
//                if(in_array($ar[$row][16],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-econom,w_d_calc-price-group-econom';
//                if(in_array($ar[$row][17],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-business,w_d_calc-price-group-business';
//                if(in_array($ar[$row][18],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-premium,w_d_calc-price-group-premium';
//                ++$i;
//            }
//            $sql = "  
//                    select  
//                       product_types.*
//                    from product_types
//                    ";
//                $categ = DB::query(Database::SELECT, $sql)->execute()->as_array();
             echo json_encode( array(
                 'work'=>$add_work,
//                 'cat'=>$categ,
                 'title'=>$title,
                     ));
           
        }
    }

     protected function HardCheckQuery($query){
            if(is_array($query)){
                
                foreach ($query as $value) {
                   $value = strip_tags($value);
                   $value = trim($value);
                }
            }else if(is_string($query)){
                $query = strip_tags($query);
                $query = trim($query);
            }
            return $query;
        }
}
