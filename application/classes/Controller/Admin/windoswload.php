<?php
    require_once ('modules/excel/Classes/PHPExcel.php');

class Controller_Admin_Windoswload extends Controller
{
    /**
     * @var  View  page template
     */


    public function before() {
        parent::before();
     
 
    }

    public function action_exelget(){
        
       
        if(!empty($_FILES['work']['name'])){
           $file = $_FILES['work']['tmp_name'];

           $ar=array(); // инициализируем массив
            $inputFileType = PHPExcel_IOFactory::identify($file);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
            $objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
            $objPHPExcel = $objReader->load($file); // загружаем данные файла в объект
            $ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
            $highestRow = count($ar);
            $i = 0;
            $add_work = Array();
            for ($row = 5; $row <= $highestRow; ++ $row){
                if(empty($ar[$row][1]))
                    continue;
                $add_work[$i]['name'] = $ar[$row][1];
                $add_work[$i]['type']  = $typ;

                if(!empty($ar[$row][2])){
                    $categ = explode(',', str_replace(', ', ',', $this->HardCheckQuery($ar[$row][2])));
                    $cat_id = '';
                    $cat = ORM::factory('producttype')->where('type_name', 'in', $categ)->find_all();
                    foreach ($cat as $val){
                        if($val->id == 33)$cat_id .= $val->id.',34,35,36,37,38,';
                        else  $cat_id .= $val->id.',';
                    }
                    $add_work[$i]['categor_arr'] = $cat_id;
                }
                $add_work[$i]['price'] = $this->HardCheckQuery($ar[$row][4]);
                $add_work[$i]['count'] = $this->HardCheckQuery($ar[$row][7]);

                if(in_array($ar[$row][8],array('+',1,'1')))$add_work[$i]['room_id'] .= '1';
                if(in_array($ar[$row][9],array('+',1,'1')))$add_work[$i]['room_id'] .= ',2';
                if(in_array($ar[$row][10],array('+',1,'1')))$add_work[$i]['room_id'] .= ',3';
                if(in_array($ar[$row][11],array('+',1,'1')))$add_work[$i]['room_id'] .= ',4';
                if(in_array($ar[$row][12],array('+',1,'1')))$add_work[$i]['room_id'] .= ',5';

                $add_work[$i]['remontType'] = 'calc-remont-group-cosmetic';
                if(in_array($ar[$row][13],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-econom,w_d_calc-price-group-econom';
                if(in_array($ar[$row][14],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-business,w_d_calc-price-group-business';
                if(in_array($ar[$row][15],array('+',1,'1')))$add_work[$i]['remontType'] .= ',calc-price-group-premium,w_d_calc-price-group-premium';

                $add_work[$i]['remontTypeDef'] = 'calc-remont-group-capital';
                if(in_array($ar[$row][16],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-econom,w_d_calc-price-group-econom';
                if(in_array($ar[$row][17],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-business,w_d_calc-price-group-business';
                if(in_array($ar[$row][18],array('+',1,'1')))$add_work[$i]['remontTypeDef'] .= ',calc-price-group-premium,w_d_calc-price-group-premium';
                ++$i;
//                $add_work->save();
//                $add_work = ORM::factory('work');
//                $add_work->name = $ar[$row][1];
//                $add_work->type  = $typ;
//
//                if(!empty($ar[$row][2])){
//                    $categ = explode(',', str_replace(', ', ',', $this->HardCheckQuery($ar[$row][2])));
//                    $cat_id = '';
//                    $cat = ORM::factory('producttype')->where('type_name', 'in', $categ)->find_all();
//                    foreach ($cat as $val){
//                        if($val->id == 33)$cat_id .= $val->id.',34,35,36,37,38,';
//                        else  $cat_id .= $val->id.',';
//                    }
//                    $add_work->categor_arr = $cat_id;
//                }
//                $add_work->price = $this->HardCheckQuery($ar[$row][4]);
//                $add_work->count = $this->HardCheckQuery($ar[$row][7]);
//
//                if(in_array($ar[$row][8],array('+',1,'1')))$add_work->room_id .= '1';
//                if(in_array($ar[$row][9],array('+',1,'1')))$add_work->room_id .= ',2';
//                if(in_array($ar[$row][10],array('+',1,'1')))$add_work->room_id .= ',3';
//                if(in_array($ar[$row][11],array('+',1,'1')))$add_work->room_id .= ',4';
//                if(in_array($ar[$row][12],array('+',1,'1')))$add_work->room_id .= ',5';
//
//                $add_work->remontType = 'calc-remont-group-cosmetic';
//                if(in_array($ar[$row][13],array('+',1,'1')))$add_work->remontType .= ',calc-price-group-econom,w_d_calc-price-group-econom';
//                if(in_array($ar[$row][14],array('+',1,'1')))$add_work->remontType .= ',calc-price-group-business,w_d_calc-price-group-business';
//                if(in_array($ar[$row][15],array('+',1,'1')))$add_work->remontType .= ',calc-price-group-premium,w_d_calc-price-group-premium';
//
//                $add_work->remontTypeDef = 'calc-remont-group-capital';
//                if(in_array($ar[$row][16],array('+',1,'1')))$add_work->remontTypeDef .= ',calc-price-group-econom,w_d_calc-price-group-econom';
//                if(in_array($ar[$row][17],array('+',1,'1')))$add_work->remontTypeDef .= ',calc-price-group-business,w_d_calc-price-group-business';
//                if(in_array($ar[$row][18],array('+',1,'1')))$add_work->remontTypeDef .= ',calc-price-group-premium,w_d_calc-price-group-premium';
//                $add_work->save();
            }
            $sql = "  
                    select  
                       product_types.*
                    from product_types
                    ";
                $categ = DB::query(Database::SELECT, $sql)->execute()->as_array();
             echo json_encode( array('work'=>$add_work,'cat'=>$categ));
        }else{
           
        }
//            $this->template->content = View::factory('admin/blocks/work/exel/out')->bind('typ', $typ);
    }
   
//    public function after() {
//            if(empty($this->template->left_menu->links))
//                $this->template->content->class = ' full-content';
//            parent::after();
//    }
//        
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
