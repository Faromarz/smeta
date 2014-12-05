<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Company extends Controller_Core
{
    public function action_index()
    {
        if($this->partner){
            $company = $this->user->partner;
            if($this->request->post()){
                $company->name = (string) Arr::get($_POST, 'copmany_name', '');
                $company->descript = (string) Arr::get($_POST, 'copmany_desc', '');
                $company->spec_id = (int) Arr::get($_POST, 'spec', 0);
                $company->site = (string) Arr::get($_POST, 'site', '');
                $company->experience = (float) Arr::get($_POST, 'site', '');
                $company->date = date('Y-m-d', Arr::get($_POST, 'site', ''));
                $company->success_works = (int) Arr::get($_POST, 'site', '');
                $company->workers = (int) Arr::get($_POST, 'site', '');
                $company->save();

                $user=$company->user;
                $user->email = (string) Arr::get($_POST, 'email', '');
                $user->save();

                $city = (int) Arr::get($_POST, 'rus_country', 0)>0?(int) Arr::get($_POST, 'rus_country', 0):
                    (int) Arr::get($_POST, 'uk_country', 0)>0?(int) Arr::get($_POST, 'uk_country', 0):
                    (int) Arr::get($_POST, 'by_country', 0)>0?(int) Arr::get($_POST, 'by_country', 0):
                    (int) Arr::get($_POST, 'kaz_country', 0)>0?(int) Arr::get($_POST, 'kaz_country', 0):0;

                $partner_cities = ORM::factory('Partner_City')->where('partner_id','=',$company->id)->find_all();
                foreach($partner_cities as $item){
                    $item->delete();
                }
                $partner_city = ORM::factory('Partner_City');
                $partner_city->partner_id = $company->id;
                $partner_city->city_id = $city;
                $partner_city->save();
            }
            $cities = ORM::factory('City')->where('country_id','in',array(1,2,3,4))->and_where('biggest_city','=',1)->order_by('city','ASC')->find_all();
            $spec = ORM::factory('Partner_Spec')->find_all();
            $this->set('company', $company)->set('cities', $cities)->set('spec', $spec);
        }else throw new HTTP_Exception_404;
    }

    public function action_load()
    {
        if($this->partner){
            if($_FILES['file']) {
                if ($_FILES["file"]["type"] == "application/vnd.ms-excel"){
                    if($_FILES["file"]["size"] < 500000){
                        $sourcePath = $_FILES['file']['tmp_name'];
                        $targetPath = 'media/upload/'.uniqid().'.xls';
                        move_uploaded_file($sourcePath,$targetPath) ;
                        $spreadsheet = Spreadsheet::factory(
                            array(
                                'filename' => $targetPath
                            ), FALSE)
                            ->load()
                            ->read();
                        $partner_works = ORM::factory('Partner_work')->where('partner_id','=',$this->user->partner->id)->find_all();
                        if(count($partner_works)>0){
                            foreach ($partner_works as $partner_work) {
                                $partner_work->delete();
                            }
                        }
                        $type = 0; //0 - демонтажные, 1 - монтажные
                        foreach ($spreadsheet as $string) {
                            if (isset($string['A']) && $string['A'] == 'Демонтажные работы') $type = 0;
                            if (isset($string['A']) && $string['A'] == 'Монтажные работы') $type = 1;
                            if (isset($string['A']) && (int)$string['A'] > 0) {
                                if (isset($string['B'])) {
                                    $work = ORM::factory('Work')->where('type', '=', $type)->and_where('name', '=', $string['B'])->find();
                                    if ($work->loaded()) {
                                        $partner_work = ORM::factory('Partner_work');
                                        $partner_work->partner_id = $this->user->partner->id;
                                        $partner_work->work_id = $work->id;
                                        $partner_work->price_econom = isset($string['D']) ? (float)$string['D'] : 0;
                                        $partner_work->price_standart = isset($string['E']) ? (float)$string['E'] : 0;
                                        $partner_work->price_premium = isset($string['F']) ? (float)$string['F'] : 0;
                                        $partner_work->save();
                                    }
                                }
                            }
                        }
                        unlink($targetPath);
                        die(json_encode(array('message'=>'Ваши цены успешно сохранены!')));
                    }else die(json_encode(array('message'=>'Размер файла превышает 500kb!')));
                }else die(json_encode(array('message'=>'Неправильный формат файла!')));
            }
        }else throw new HTTP_Exception_404;
    }
}