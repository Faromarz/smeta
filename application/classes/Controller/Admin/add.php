<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Main calculator class
 *
 * @author 	Andrew Fedyk
 * @version 1.0
 */
class Controller_Admin_Add extends Template_Admin 
{
	public $template = 'admin/add';

	public function action_add()
	{
         
//            $oss= ORM::factory('laminat')->where('id', '>=', 3011)->where('id', '<=', 7626)->find_all();
//            foreach ($oss as $val){
//                $val->type = 3;
//                $val->save();
//            }
//            
//            DB::query(Database::DELETE, "DELETE FROM `laminat` where id >= 18372 and id <= 22862")->execute();
//            DB::query(Database::DELETE, "DELETE FROM `products` where id>= 41701 and id <= 46191")->execute();
//            
             if(isset($_POST['dell'])){
                  DB::query(Database::DELETE, "TRUNCATE TABLE `products_temp`")->execute();
             }
            if(isset($_POST['start']) && isset($_POST['stop']) && isset($_POST['type_id']) && isset($_POST['type'])  && is_numeric($_POST['type'])&& is_numeric($_POST['type_id']) && is_numeric($_POST['start']) && is_numeric($_POST['stop'])){
                
            
            $old = ORM::factory('producttest')->where('id', '>=', (int)$_POST['start'])->where('id', '<=', (int)$_POST['stop'])->find_all();
//            exit();
            
            foreach ($old as $val){

                
                $type_id = $_POST['type_id'];
                $type = $_POST['type'];
                Cookie::set('type', $_POST['type']);
                Cookie::set('type_id', $_POST['type_id']);
                
                
//                // отопление 
//                if($type_id == 23){
//                    if(!strstr($val->name, 'Global') && !strstr($val->name, 'Zehnder')){
//                        continue;
//                    }
//                    
//                }
                
               
//                
//                
//                
//                // это исправление вносить
////                $ee =  ORM::factory('product')->where('name', '=', $val->name)->find();
////                if($ee->loaded()){
////                    
////                    $ees =  ORM::factory('laminat')->where('type_len', 'is', null)->where('products_id', '=', $ee->id)->find();
////                    if($ees->loaded()){
////                        
////    //                 ленолиум
////                    $str = strstr ($val->attr, 'Тип:');
////                    if($str){
////                        $str1 = explode('<br>',nl2br($str, false));
////                        $art = trim($str1[1]);
////    //                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
////    //                        $art = trim($str1[1]).' '.trim($str1[2]);
////    //                    }
////                         $ees->type_len = $art;
////                        $ees->save();
////                    }
////
////                    }
////                }
//                        
//                  
//                 // удаляем старую запись
                 $new_old = ORM::factory('product')->where('type_id', '=', $type_id)->where('name', '=', $val->name)->where('attr', '=', $val->attr)->find();
                if($new_old->loaded()){
                    $old_lami = ORM::factory('laminat')->where('products_id', '=', $new_old->id)->find();
                    if($old_lami->loaded()){
                        $new_old->delete();
                        $old_lami->delete();
                    }else{
                        $new_old->delete();
                    }
                }
               
                // для сантехники
                if($type_id == 40){
                    if(strstr($val->name, 'для раковины') || strstr($val->name, 'для умывальника')){
                       
                    }else{
                        continue;
                    }
                }
                //5. если в названии есть слово "унитаз", "то поместить в категорию "Унитаз"
                if($type_id == 18){
                    if(strstr($val->name, 'Унитаз') && !strstr($val->name, 'Горфа') && !strstr($val->name, 'Сиденье')){
                       
                    }else{
                        continue;
                    }
                }
                //4. если в названии есть слово "умывальник", "раковина", "рукомойник", "база под раковину", "тумба" то поместить в категорию "Умывальник"
                if($type_id == 19){
                    if(!strstr($val->name, 'Cмеситель') && (strstr($val->name, 'Умывальник') || strstr($val->name, 'Раковина')||strstr($val->name, 'Рукомойник')||strstr($val->name, 'База под раковину')||strstr($val->name, 'Тумба'))){
                        echo $val->name.'<br>';
                    }else{
                        continue;
                    }
                }
                //3. если в названии есть слово "полотенцесушитель", то поместить в категорию "Полотенцесушитель"
                if($type_id == 21){
                    if(strstr($val->name, 'полотенцесушитель')){
                       
                    }else{
                        continue;
                    }
                }
                //если в названии есть слово "ванна", "душевая кабина", "душевой уголок", то поместить в категорию "Ванна/кабина"
                if($type_id == 17){
                    if(strstr($val->name, 'ванна')||strstr($val->name, 'душевая кабина')||strstr($val->name, 'душевой уголок')){
                       
                    }else{
                        continue;
                    }
                }
                

                
                $new = ORM::factory('product');
                $laminat = ORM::factory('laminat');
                
                // Записываем плитку
                if($type_id == 32){
                    $str = strstr($val->attr, 'Элементы:');
                    $str_1 = strstr($val->attr, 'Вид плитки:');
                    if($str && $str_1){
                        $str1 = explode('<br>',nl2br($str, false));
                        $str_11 = explode('<br>',nl2br($str_1, false));

                        // Записываем только напольнаю плитку
                        if((strstr($str1[1], 'Напольная') || strstr($str1[1], 'облицовочная')) && strstr($str_11[1], 'Напольная')){
                            $type = 3;
                             if($str = strstr($val->attr, 'Назначение:')){ 
                                 $str1 = explode('<br>',nl2br($str, false));
                                if($str1[1] == 'Кухня'){
                                    $laminat->room = 'Кухня';
                                }
                             }
                        }else continue;

                    }
                }
                // Записываем плитку
                if($type_id == 13){
                    $str = strstr($val->attr, 'Элементы:');
                    $str_1 = strstr($val->attr, 'Вид плитки:');
                    if($str && $str_1){
                        $str1 = explode('<br>',nl2br($str, false));
                        $str_11 = explode('<br>',nl2br($str_1, false));

                        // Записываем только напольнаю плитку
                       if((strstr($str1[1], 'Настенная') || strstr($str1[1], 'облицовочная'))&& strstr($str_11[1], 'Настенная')){
                              $type = 7;
                             if($str = strstr($val->attr, 'Назначение:')){   
                                $str1 = explode('<br>',nl2br($str, false));
                                
                               if(strstr($str1[1], 'Кухня')){
                                   $laminat->room = 'Кухня';
                               }
                             }
                        }else continue;

                    }
                
                // записываем обои
                $str = strstr($val->attr, 'Тип материала:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    
                        if(strstr($str1[1], 'Флизелиновые')){    $type = 1; }
                    elseif(strstr($str1[1], 'Виниловые'))   {    $type = 2; }
                    elseif(strstr($str1[1], 'Текстильные')) {    $type = 3; }
                    elseif(strstr($str1[1], 'Флоковые'))    {    $type = 4; }
                    elseif(strstr($str1[1], 'Натуральные')) {    $type = 5; }
                    elseif(strstr($str1[1], 'Бумажные'))    {    $type = 6; }

                }else{
                     $str = strstr($val->attr, "Материал:");
                     if($str){
                         $str1 = explode('<br>',nl2br($str, false));
                     
                            if(strstr($str1[1], 'Флизелин')){    $type = 1;    }
                        elseif(strstr($str1[1], 'Винил'))   {    $type = 2;    }
                        elseif(strstr($str1[1], 'Текстиль')){    $type = 3;    }
                        elseif(strstr($str1[1], 'Флок'))    {    $type = 4;    }
                        elseif(strstr($str1[1], 'Бумага'))  {    $type = 6;    }
             
                     }
                }
                }
                
//              
                
                $new->name = $val->name;
                $new->description = $val->description;
                $new->type_id = $type_id;
                $new->image = $val->image;
                $p = str_replace('руб.', '', $val->price);
                $p = str_replace(' руб.', '', $val->price);
                $p1 = str_replace(' ', '', $p);
                $new->price = $p1;
                $new->create_date = $val->create_date;
                $new->attr = $val->attr;
                
                $laminat->type = $type;
                
                //Артикул
                $str = strstr ($val->attr, 'Артикул:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->art = $art;
                }
                //код товара
                $str = strstr ($val->attr, 'Код товара:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->cod = $art;
                }
                //пробка
                $str = strstr ($val->attr, 'Тип укладки:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->type_prob = $art;
                    
                }
                //Плитка
                $str = strstr ($val->attr, 'Материал:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->materia = $art;
                    
                }
                 //ленолиум
                $str = strstr ($val->attr, 'Тип:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->type_len = $art;
                    
                }
                 //ленолиум
                $str = strstr ($val->attr, 'Режимы работы:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->r_w = $art;
                    
                }
                $str = strstr ($val->attr, 'Мощность охлаждения (кВт):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->m_oh = $art;
                    
                }
                $str = strstr ($val->attr, 'Мощность обогрева (кВт):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->m_ob = $art;
                    
                }
                $str = strstr ($val->attr, 'Серия:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->ser = $art;
                    
                }
                $str = strstr ($val->attr, 'Площадь помещения (до кв.м.):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->pl_p = $art;
                    
                }
                $str = strstr ($val->attr, 'Уровень шума (внутр. блок), дБ:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->u_csh = $art;
                    
                }
                $str = strstr ($val->attr, 'Уровень шума (внешн. блок), дБ:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->u_csh_v = $art;
                }
                $str = strstr ($val->attr, 'Потребляемая мощность, кВт:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->kvt = $art;
                }
                $str = strstr ($val->attr, 'Производительность по воздуху, м3/ч:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->p_vz = $art;
                }
                $str = strstr ($val->attr, 'Напряжение питания, В:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->v_t = $art;
                }
                $str = strstr ($val->attr, 'Габариты, Ш?В?Г (внутр. блок), мм:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->grt_vn = $art;
                }
                $str = strstr ($val->attr, 'Габариты, Ш?В?Г (внешн. блок), мм:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->grt_n = $art;
                }
                $str = strstr ($val->attr, 'Масса (внутр. блок), кг:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->m_v_b = $art;
                }
                $str = strstr ($val->attr, 'Масса (внешн. блок), кг:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->m_n_b = $art;
                }
                $str = strstr ($val->attr, 'Комплектация:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->compl = $art;
                }
                $str = strstr ($val->attr, 'Длина (мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->long = $art;
                }
                $str = strstr ($val->attr, 'Ширина (мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->widh = $art;
                }
                $str = strstr ($val->attr, 'Ширина, мм:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->widh_ = $art;
                }
                $str = strstr ($val->attr, 'Высота (мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->hid = $art;
                }
                $str = strstr ($val->attr, 'Высота, мм:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->hid_ = $art;
                }
                $str = strstr ($val->attr, 'Объем (л):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->val = $art;
                }
                $str = strstr ($val->attr, 'Глубина, мм:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->gl = $art;
                }
                $str = strstr ($val->attr, 'Вид монтажа:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->view_m = $art;
                }
                $str = strstr ($val->attr, 'Отверстие под смеситель:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->otv = $art;
                }
                $str = strstr ($val->attr, 'Форма:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->form = $art;
                }
                $str = strstr ($val->attr, 'Вид установки:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->vid_u = $art;
                }
                 //обои
                $str = strstr ($val->attr, 'Помещение:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->pom = $art;
                    
                }
                 //обои
                $str = strstr ($val->attr, 'Фактура:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->fac = $art;
                    
                }
                 //обои
                $str = strstr ($val->attr, 'Размер рисунка:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $art = trim($str1[1]);
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $art = trim($str1[1]).' '.trim($str1[2]);
                    }
                     $laminat->r_img = $art;
                    
                }
                // Производитель:
                 $str = strstr ($val->attr, 'Производитель:');
                if($str){
                     $str1 = explode('<br>',nl2br($str, false));
                    $proiz = ORM::factory('manuf')->where('name', '=', $str1[1])->find();
                    if(!$proiz->loaded()){
                        $proiz = ORM::factory('manuf');
                        $proiz->name = $str1[1];
                        $proiz->save();
                    }
                    $laminat->manuf_id = $proiz->id;
                }
                
                // коллекция
                $str = strstr($val->attr, 'Коллекция:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $text = $str1[1].' '.$str1[2];
                    }
                    if(!empty($text)){
                        $obj = ORM::factory('colection')->where('name', '=', trim($text))->find();
                        if(!$obj->loaded()){
                            $obj = ORM::factory('colection');
                            $obj->name = trim($text);
                            $obj->save();
                        }
                        $laminat->colection_id = $obj->id;
                    }
                 
                }
                
                // Страна производства:
                if(!empty($val->co)){
                    $count_proiz = ORM::factory('countru')->where('name', '=', $val->co)->find();
                    if(!$count_proiz->loaded()){
                        $count_proiz = ORM::factory('countru');
                        $count_proiz->name = $val->co;
                        $count_proiz->save();
                    }
                    $laminat->countru_manuf_id = $count_proiz->id;
                }

                 // страна
                $str = strstr($val->attr, 'Страна:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $counry = $str1[1];
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $counry = $str1[1].' '.$str1[2];
                    }
                    if(!empty($counry)){
                        $count_proiz = ORM::factory('countru')->where('name', '=', trim($counry))->find();
                        if(!$count_proiz->loaded()){
                            $count_proiz = ORM::factory('countru');
                            $count_proiz->name = trim($counry);
                            $count_proiz->save();
                        }
                        $laminat->countru_id = $count_proiz->id;
                    }
                 
                }
                 // страна
                $str = strstr($val->attr, 'Страна бренда:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $counry = $str1[1];
                    if(!strstr ($str1[2], ':') && !empty($str1[2])){
                        $counry = $str1[1].' '.$str1[2];
                    }
                    if(!empty($counry)){
                        $count_proiz = ORM::factory('countru')->where('name', '=', trim($counry))->find();
                        if(!$count_proiz->loaded()){
                            $count_proiz = ORM::factory('countru');
                            $count_proiz->name = trim($counry);
                            $count_proiz->save();
                        }
                        $laminat->countru_br = $count_proiz->id;
                    }
                 
                }
                
                 // класс
                $str = strstr($val->attr, 'Класс:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->class = trim($text);
                    }
                 
                }
                 // обои
                $str = strstr($val->attr, 'Ширина (м):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->wid = trim($text);
                    }
                 
                }
                 // обои
                $str = strstr($val->attr, 'Длина (м):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->lon = trim($text);
                    }
                 
                }
                 // обои
                $str = strstr($val->attr, 'Площадь (м.кв.):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->pl= trim($text);
                    }
                 
                }
                 // обои
                $str = strstr($val->attr, 'Тип материала:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->t_m= trim($text);
                    }
                 
                }
                // пробка
                $str = strstr($val->attr, 'Покрытие:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->pocr = trim($text);
                    }
                 
                }
                // пробка
                $str = strstr($val->attr, 'Поверхность:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->pov = trim($text);
                    }
                 
                }
                // пробка
                $str = strstr($val->attr, 'Декор:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->dec = trim($text);
                    }
                 
                }
                 // Плитка
                $str = strstr($val->attr, 'Элементы:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->element = trim($text);
                    }
                 
                }
                 // Плитка
                $str = strstr($val->attr, 'Назначение:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->finct = trim($text);
                    }
                 
                }
                 // Плитка
                $str = strstr($val->attr, 'Вид плитки:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];

                    if(!empty($text)){
                        $laminat->view = trim($text);
                    }
                 
                }
                
                 // толщина
                $str = strstr($val->attr, 'Толщина(мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->thic = trim($text);
                    }
                }
                 // Плитка
                $str = strstr($val->attr, 'Размер (см):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->thic_cm = trim($text);
                    }
                }
                 // Плитка
                $str = strstr($val->attr, 'Размер, мм:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->thic_mm = trim($text);
                    }
                }
                 // Плитка
                $str = strstr($val->attr, 'Структура поверхности:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->struct = trim($text);
                    }
                }
                 // Плитка
                $str = strstr($val->attr, 'Стиль:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->styl = trim($text);
                    }
                }
                 // ленолиум
                $str = strstr($val->attr, 'Общая толщина:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->thic_all = trim($text);
                    }
                }
                 // ленолиум
                $str = strstr($val->attr, 'Толщина защитного слоя:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->thic_zad = trim($text);
                    }
                }
                 // ленолиум
                $str = strstr($val->attr, 'Ширина рулона (м):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->roll_width = trim($text);
                    }
                }
                 // ленолиум
                $str = strstr($val->attr, 'Длина рулона (м):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->roll_long = trim($text);
                    }
                }
                
                 // дизайн
                $str = strstr($val->attr, 'Дизайн:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $i = 0;
                    foreach ($str1 as $key => $str_val){
                        if($key > 1 && $i == 0){
                            if(!strstr ($str_val, ':')){
                                $text .= ', '.trim($str_val);
                            }else $i++;
                        }
                    }
                   // 
                    if(!empty($text)){
                        $obj = ORM::factory('design')->where('name', '=', $text)->find();
                        if(!$obj->loaded()){
                            $obj = ORM::factory('design');
                            $obj->name = $text;
                            $obj->save();
                        }
                        $laminat->design_id = $obj->id;
                    }
                }
                
                 // ленолиум
                $str = strstr($val->attr, 'Норма отпуска:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->rate = trim($text);
                    }
                }
                 // обои
                $str = strstr($val->attr, 'Кол-во в упаковке:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->coun_yp = trim($text);
                    }
                }
                 // обои
                $str = strstr($val->attr, 'Рисунок:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->im = trim($text);
                    }
                }
                  // ленолиум
                $str = strstr($val->attr, 'Тип дизайна:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = $str1[1];
                    if(!empty($text)){
                        $laminat->type_diz = trim($text);
                    }
                }
                
                // Порода дерева
                $str = strstr($val->attr, 'Порода дерева:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $i = 0;
                    foreach ($str1 as $key => $str_val){
                        if($key > 1 && $i == 0){
                            if(!strstr ($str_val, ':')){
                                $text .= ', '.trim($str_val);
                            }else $i++;
                        }
                    }
                    
                    if(!empty($text)){
                        $obj = ORM::factory('typewood')->where('name', '=', $text)->find();
                        if(!$obj->loaded()){
                            $obj = ORM::factory('typewood');
                            $obj->name = $text;
                            $obj->save();
                        }
                        $laminat->type_id = $obj->id;
                    }
                }
                
                 // Цвет оттенок
                $str = strstr($val->attr, 'ЦветОттенок:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $i = 0;
                    foreach ($str1 as $key => $str_val){
                        if($key > 1 && $i == 0){
                            if(!strstr ($str_val, ':')){
                                $text .= ', '.trim($str_val);
                            }else $i++;
                        }
                    }
                    
                    if(!empty($text)){
                        $obj = ORM::factory('color')->where('name', '=', $text)->find();
                        if(!$obj->loaded()){
                            $obj = ORM::factory('color');
                            $obj->name = $text;
                            $obj->save();
                        }
                        $laminat->color_id = $obj->id;
                    }
                }
                 // Цвет оттенок
                $str = strstr($val->attr, 'Цвет/оттенок:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $i = 0;
                    foreach ($str1 as $key => $str_val){
                        if($key > 1 && $i == 0){
                            if(!strstr ($str_val, ':')){
                                $text .= ', '.trim($str_val);
                            }else $i++;
                        }
                    }
                    
                    if(!empty($text)){
                        $obj = ORM::factory('color')->where('name', '=', $text)->find();
                        if(!$obj->loaded()){
                            $obj = ORM::factory('color');
                            $obj->name = $text;
                            $obj->save();
                        }
                        $laminat->color_id = $obj->id;
                    }
                }
                 // Цвет оттенок
                $str = strstr($val->attr, 'Цвет:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $i = 0;
                    foreach ($str1 as $key => $str_val){
                        if($key > 1 && $i == 0){
                            if(!strstr ($str_val, ':')){
                                $text .= ', '.trim($str_val);
                            }else $i++;
                        }
                    }
                    
                    if(!empty($text)){
                        $obj = ORM::factory('color')->where('name', '=', $text)->find();
                        if(!$obj->loaded()){
                            $obj = ORM::factory('color');
                            $obj->name = $text;
                            $obj->save();
                        }
                        $laminat->color_id = $obj->id;
                    }
                }
                
                // Плитка
                $str = strstr ($val->attr, 'Цветовая гамма:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                     $laminat->gama = $text;
                }
                // Колличесто полос
                $str = strstr ($val->attr, 'Количество полос:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                     $laminat->count_line = $text;
                }
                
                // Фаска :
                $str = strstr ($val->attr, 'Фаска:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->fasca = $text;
                }
                // Фаска :
                $str = strstr ($val->attr, 'Фаска :');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->fasca = $text;
                }
          
                // паркет :
                $str = strstr ($val->attr, 'Селекция:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->selekc = $text;
                }
                // паркет :
                $str = strstr ($val->attr, 'Твердость по Бринеллю:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->tver = $text;
                }
                // паркет :
                $str = strstr ($val->attr, 'Вид обработки:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->view_ob = $text;
                }
                // паркет :
                $str = strstr ($val->attr, 'Толщина верхнего слоя (мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->pol_top = $text;
                }
                // паркет :
                $str = strstr ($val->attr, 'Размер доски (мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->dress = $text;
                }
                // Модулей в упаковке: :
                $str = strstr ($val->attr, 'Модулей в упаковке:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->modul_in = $text;
                }
                // Размер модуля (мм):
                $str = strstr ($val->attr, 'Размер модуля (мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->modul_siz = $text;
                }
                // паркет :
                $str = strstr ($val->attr, 'Досок в упаковке :');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->dress_count = $text;
                }
                // ленолиум
                $str = strstr ($val->attr, 'Класс горючести:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $laminat->flam = $text;
                }
                
                 // Габариты (Д х Ш х В): :
                $str = strstr ($val->attr, 'Габариты (Д х Ш х В):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $text = trim(str_replace('мм', '', $text));
                    $laminat->dimens = $text;
                }
                 // Размер (Д х Ш х В):
                $str = strstr ($val->attr, 'Размер (Д х Ш х В):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $text = trim(str_replace('мм', '', $text));
                    $laminat->dimens_1 = $text;
                }
                 // По толщине (мм):
                $str = strstr ($val->attr, 'По толщине (мм):');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    $text = trim(str_replace('мм', '', $text));
                    $laminat->tolsch = $text;
                }
                
                // В упаковке, м.кв:
                $str = strstr ($val->attr, 'В упаковке, м.кв:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        if(strstr ($text, 'х')){
                            $text = trim(str_replace('мм', '', $text));
                            $x = explode('х',nl2br($text));
                            $text = $x[0]*$x[1]/100000;
                        }
                      $laminat->pasc = $text;
                    }
                }
                // вес упаковки:
                $str = strstr ($val->attr, 'Вес упаковки, кг.:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){ 
                        if(strstr ($text, '/')){
                            $text = trim(str_replace(' кг', '', $text));
                            $text = trim(str_replace('кг', '', $text));
                            $x = explode('/',nl2br($text));
                            $text = $x[0];
                        }
                        $laminat->tara_mass = $text;
                    }
                }
                
                 // Влагостойкость:
                $str = strstr ($val->attr, 'Влагостойкость:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->moise = $text;
                    }
                }
                 // Вес упаковки, кг.:
                $str = strstr ($val->attr, 'Вес упаковки, кг.:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        if(strstr ($text, '/')){
                            $text = trim(str_replace(' кг', '', $text));
                            $x = explode('/',nl2br($text));
                            $text = $x[0];
                        }
                        $laminat->tara_vol = $text;
                    }
                }
                
                 // Паллета, м.кв.:
                $str = strstr ($val->attr, 'Паллета, м.кв.:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->palleta = $text;
                    }
                }
                 // пробка
                $str = strstr ($val->attr, 'Досок в упаковке:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->dres = $text;
                    }
                }
            
                 //паркет
                $str = strstr ($val->attr, 'Размер:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->siz = $text;
                    }
                }
                 //отопление
                $str = strstr ($val->attr, 'Мощность, Вт:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->vt = $text;
                    }
                }
                 //отопление
                $str = strstr ($val->attr, 'Кол-во секций:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->sekc = $text;
                    }
                }
                 //паркет
                $str = strstr ($val->attr, 'Кол-во:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->cou = $text;
                    }
                }
                 //паркет
                $str = strstr ($val->attr, 'Объем упаковки, м.куб.:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->ob_yp = $text;
                    }
                }
                 //паркет
                $str = strstr ($val->attr, 'Тип соединения:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->pyt_s = $text;
                    }
                }
            
                 // Плотность, кг/м.куб:
                $str = strstr ($val->attr, 'Плотность, кг/м.куб:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->density = $text;
                    }
                }
                 // Новинка:
                $str = strstr ($val->attr, 'Новинка:');
                if($str){
                    $str1 = explode('<br>',nl2br($str, false));
                    $text = trim($str1[1]);
                    if(!empty($text)){
                        $laminat->new = $text;
                    }
                }
                
                $new->tmat = '';
                if($new->save()){
                    $laminat->products_id = $new->pk();
                     if(!$laminat->save()) echo 'Error laminat'.'<br>';
                }else echo 'Error products'.'<br>';
                
            }
            }
//                        echo $obj->id.' '.$text.'<br>';
            
            $min = ORM::factory('producttest')->find();
            $max = ORM::factory('producttest')->order_by('id', 'desc')->find();
            $max_est = ORM::factory('product')->order_by('id', 'desc')->find();
            $max_t = ORM::factory('producttest')->where('name', '=', $max_est->name)->where('attr', '=', $max_est->attr)->find();
            
            $this->template->min = $min;
            $this->template->max = $max;
            $this->template->max_t = $max_t;
            $this->template->content = $old;
		
	}
        public function after() {
		if(empty($this->template->left_menu->links))
                    $this->template->content->class = ' full-content';
		parent::after();
	}

}