<?php

class Controller_Admin_Windows extends Controller_Admin_Index
{
    /**
     * @var  View  page template
     */

    public function before() {
        parent::before();

        
//        $this->template->left_menu->links = array(
//            '/admin/windows/create'	=> 'Добавить окна',
//        );
        $this->template->styles[] = '/resources/css/admin/windows.css';
        
    }
    public function action_index()
    {
        $object = ORM::factory('Window');
        
        $pagination = $object->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/windows/index');
        $this->template->v_body->v_page->objects	 = $object->order_by('price')->get_objects($pagination);
        $this->template->v_body->v_page->pagination = $pagination;
        
    }

    /*
      Новая работа в портфолио
     */
    public function action_create()
    {
        $this->template->v_body->v_page =  View::factory('admin/blocks/windows/edit');
        $object = ORM::factory('Window');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->create_window($_POST);
                HTTP::redirect("/admin/windows/");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->v_body->v_page->title = 'Добавить окно';
        $this->template->v_body->v_page->errors = $errors;
        $this->template->v_body->v_page->object = $object;
    }

    /**
     * Редактирование основних параметров работи в портфолио
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_edit(){
        $object = ORM::factory('Window', $this->request->param('param'));
        $this->template->v_body->v_page =  View::factory('admin/blocks/windows/edit');
        $errors = array();

        if($this->request->param('param') != 0){
            $object = ORM::factory('Window')->where('window.id', '=', $this->request->param('param'))->find();
            // Если рабр\оти нет, тогда 404 ошибка
            if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Работа не найдена");
        }else{
            $object = ORM::factory('Window')->where('profil_name', '=', htmlspecialchars($_POST['profil_name']))->find();
            if(!$object->loaded()){
                $object = ORM::factory('Window');
            }
        }
        
        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_article( $_POST );
                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }else{
                    HTTP::redirect("/admin/windows/");
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

        $this->template->title 	= 'Редактирование';
        $this->template->v_body->v_page 	= View::factory('admin/blocks/windows/edit');
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
        $object = ORM::factory('Window', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect('/admin/windows');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    public function action_exelout()
    {
        $title = 'Окна';
        $ws = new Spreadsheet(array(
        'author'       => 'Smeta',
        'title'        => $title,
        'subject'      => 'Subject',
        'description'  => 'Description',
    ));

    $ws->set_active_sheet(0);
    $as = $ws->get_active_sheet();
    $as->setTitle($title);

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
    $as->mergeCells('A1:S1');
    $as->getStyle('A1')
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
    $as->getColumnDimension('C')->setWidth(13);
    $as->mergeCells('C2:C4');
    $as->getColumnDimension('D')->setWidth(10);
    $as->getColumnDimension('E')->setWidth(9);
    $as->getColumnDimension('F')->setWidth(9);
    $as->mergeCells('D2:F3');
    $as->getColumnDimension('G')->setWidth(7);
    $as->getStyle('G2')->getAlignment()->setTextRotation(90)->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $as->mergeCells('G2:G4');
    $as->getColumnDimension('H')->setWidth(14);
    $as->mergeCells('H2:H4');
    $as->getColumnDimension('I')->setWidth(8);
    $as->getColumnDimension('J')->setWidth(8);
    $as->getColumnDimension('K')->setWidth(8);
    $as->getColumnDimension('L')->setWidth(8);
    $as->getColumnDimension('M')->setWidth(8);
    $as->mergeCells('I2:M3');
    $as->getColumnDimension('N')->setWidth(9);
    $as->getColumnDimension('O')->setWidth(9);
    $as->getColumnDimension('P')->setWidth(9);
    $as->getColumnDimension('Q')->setWidth(9);
    $as->getColumnDimension('R')->setWidth(9);
    $as->getColumnDimension('S')->setWidth(9);
    $as->mergeCells('N2:S2');
    $as->mergeCells('N3:P3');
    $as->mergeCells('Q3:S3');
    
     $as->getStyle('N3')
            ->getAlignment()
            ->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
     $as->getStyle('Q3')
            ->getAlignment()
            ->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
     $as->getStyle('D4:S4')
            ->getAlignment()
            ->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
     $as->getStyle('A5:S5')
            ->getAlignment()
            ->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
            ;
     $as->getStyle('A5:S5')->getFont()->setSize(8);
     $as->getStyle('A6')->getActiveSheet()->freezePane('A6');

    $sh = array(
        1 => array("Ремонтно-отделочные работы Mastersmeta.ru"),
        2 => array(
            '№ п/п',
            'Наименование работ',
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
            'S'
            ),
        
    );
    $object = ORM::factory('Window')->find_all();
    
    for ($i = 6;$i <= 24; $i++){
         $room = '+';
         $room1 = '+';
         $room2 = '-';
         $room3 = '-';
         $room4 = '-';
         $econom1 = '-';
         $business1 = '-';
         $premium1 = '-';
         $econom2 = '+';
         $business2 = '+';
         $premium2 = '+';
         $name = '';
         $econom = '';
         $standart = '';
         $premium = '';
         switch ($i){
            case 6:
                $name = 'Имя профиля';
                $econom = $object[0]->profil_name;
                $standart = $object[1]->profil_name;
                $premium = $object[2]->profil_name;
                break;
            case 7:
                $name = 'Цена 100 см';
                $econom = $object[0]->price;
                $standart = $object[1]->price;
                $premium = $object[2]->price;
                break;
            case 8:
                $name = 'База глухая';
                $econom = $object[0]->base_gluh;
                $standart = $object[1]->base_gluh;
                $premium = $object[2]->base_gluh;
                break;
            case 9:
                $name = 'База поворотная';
                $econom = $object[0]->base_povorot;
                $standart = $object[1]->base_povorot;
                $premium = $object[2]->base_povorot;
                break;
            case 10:
                $name = 'База поворотно-откидная';
                $econom = $object[0]->base_povorot_otk;
                $standart = $object[1]->base_povorot_otk;
                $premium = $object[2]->base_povorot_otk;
                break;
            case 11:
                $name = 'Подокони + отлив';
                $econom = $object[0]->podokonnik_otliv;
                $standart = $object[1]->podokonnik_otliv;
                $premium = $object[2]->podokonnik_otliv;
                break;
            case 12:
                $name = 'Откос штукатурка';
                $econom = $object[0]->otkos_shtuk;
                $standart = $object[1]->otkos_shtuk;
                $premium = $object[2]->otkos_shtuk;
                break;
            case 13:
                $name = 'Откос пластик';
                $econom = $object[0]->otkos_plastik;
                $standart = $object[1]->otkos_plastik;
                $premium = $object[2]->otkos_plastik;
                break;
            case 14:
                $name = 'Монтаж';
                $econom = $object[0]->montaj;
                $standart = $object[1]->montaj;
                $premium = $object[2]->montaj;
                break;
            case 15:
                $name = 'Сетка';
                $econom = $object[0]->setka;
                $standart = $object[1]->setka;
                $premium = $object[2]->setka;
                break;
            case 16:
                $name = 'Створка 2';
                $econom = $object[0]->stvorka2;
                $standart = $object[1]->stvorka2;
                $premium = $object[2]->stvorka2;
                break;
            case 17:
                $name = 'Створка 3';
                $econom = $object[0]->stvorka3;
                $standart = $object[1]->stvorka3;
                $premium = $object[2]->stvorka3;
                break;
            case 18:
                $name = 'Фрамуга';
                $econom = $object[0]->framuga;
                $standart = $object[1]->framuga;
                $premium = $object[2]->framuga;
                break;
            case 19:
                $name = 'Цвет под дерево1';
                $econom = $object[0]->color_wood;
                $standart = $object[1]->color_wood;
                $premium = $object[2]->color_wood;
                break;
            case 20:
                $name = 'Сайт';
                $econom = $object[0]->site;
                $standart = $object[1]->site;
                $premium = $object[2]->site;
                break;
            case 21:
                $name = 'Телефон';
                $econom = $object[0]->tel;
                $standart = $object[1]->tel;
                $premium = $object[2]->tel;
                break;
            case 22:
                $name = 'Адрес';
                $econom = $object[0]->address;
                $standart = $object[1]->address;
                $premium = $object[2]->address;
                break;
            case 23:
                $name = 'Доп. Инфа.1';
                $econom = $object[0]->dop_info1;
                $standart = $object[1]->dop_info1;
                $premium = $object[2]->dop_info1;
                break;
            case 24:
                $name = 'Доп. Инфа.2';
                $econom = $object[0]->dop_info2;
                $standart = $object[1]->dop_info2;
                $premium = $object[2]->dop_info2;
                break;
         }
        $sh[] = array(
             $i-5,
             $name,
             'Окна',
             $econom,
             $standart,
             $premium,
             '',
             '1',
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
    }
     $count = count($sh);
     $count;
     
    $as->getStyle('A2:S'.$count)
         ->getBorders()
         ->getAllBorders()
         ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
     $as->getStyle('I6:S'.$count)
            ->getAlignment()
            ->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
     $as->getStyle('D6:F'.$count)
            ->getAlignment()
            ->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
     $as->getStyle("B6:B".$count)->getAlignment()->setWrapText(true);

    $ws->set_data($sh, false);
    $ws->send(array('name'=>$title, 'format'=>'Excel5'));
    
     $this->template->v_body->v_page = View::factory('admin/blocks/work/exel/out');
    }
     public function after() {
		
            $this->template->v_body->v_page->class = ' full-content';
            parent::after();
    }
}
