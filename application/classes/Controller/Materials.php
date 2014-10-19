<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Materials extends Controller_Core
{
    public function action_view()
    {
        $id = (int) $this->request->param('id');
        $material = ORM::factory('Material', $id);
        if (!$material->loaded()) {
            throw new HTTP_Exception_404;
        }
        if (in_array($material->category_id, array(46,47,48))) {
            $okna = DB::select('*')
                ->from('okna')
                ->order_by('id')
                ->execute()
                ->as_array();
            $wigth = $this->request->query('width');
            $height = $this->request->query('height');
            $type = $this->request->query('type')-1;
            $offset = $this->request->query('offset');
            
            $o3 = 0;
            $area = round($wigth * $height * 100);

            $stvorka1 = $okna[$type]['base_gluh'];
            $stvorka2 = $okna[$type]['stvorka2'];
            $stvorka3 = $okna[$type]['stvorka3'];

            $base_window = $okna[$type]['base_gluh'] + $area * $okna[$type]['price'];
            $base_povorot_window = $okna[$type]['base_povorot'] + $area * $okna[$type]['price'];
            $base_povorot_otk_window = $okna[$type]['base_povorot_otk'] + $area * $okna[$type]['price'];

            $podokonnik = $okna[$type]['podokonnik_otliv'] * $wigth * 10;
            $otkos_sht = $okna[$type]['otkos_shtuk'] * $area;
            $otkos_plast = $okna[$type]['otkos_plastik'] * $area;
            $montaj = $okna[$type]['montaj'] * $area;
            $setka = $okna[$type]['setka'] * $area;
            $framuga = $okna[$type]['framuga'];
            $woodColor = $okna[$type]['color_wood'];

            if ($wigth >= 0.4 && $wigth <= 1.0) {
                $base_window += $stvorka1;
                $base_povorot_window += $stvorka1;
                $base_povorot_otk_window += $stvorka1;
            }
            if ($wigth >= 1.001 && $wigth <= 1.7) {
                $base_window += $stvorka2;
                $base_povorot_window += $stvorka2;
                $base_povorot_otk_window += $stvorka2;
            }
            if ($wigth >= 1.701 && $wigth <= 2.7) {
                $base_window += $stvorka3;
                $base_povorot_window += $stvorka3;
                $base_povorot_otk_window += $stvorka3;
            }

            if ($height >= 1.601 && $height <= 2.3) {
                $base_window += $framuga;
                $base_povorot_window += $framuga;
                $base_povorot_otk_window += $framuga;
            }

            switch ($offset) {
                case 0:
                    $o3 = $base_window;
                    break;
                case 1:
                    $o3 = $base_window + $montaj;
                    break;
                case 2:
                    $o3 = $base_window + $montaj + $otkos_sht;
                    break;
                case 3:
                    $o3 = $base_window + $montaj + $otkos_plast;
                    break;
                case 4:
                    $o3 = $base_window + $montaj + $otkos_plast + $podokonnik;
                    break;
                case 5:
                    $o3 = $base_window + $montaj + $otkos_plast + $podokonnik + $setka;
                    break;
                case 6:
                    $o3 = $base_povorot_window;
                    break;
                case 7:
                    $o3 = $base_povorot_window + $podokonnik;
                    break;
                case 8:
                    $o3 = $base_povorot_window + $podokonnik + $otkos_sht;
                    break;
                case 9:
                    $o3 = $base_povorot_window + $podokonnik + $otkos_plast;
                    break;
                case 10:
                    $o3 = $base_povorot_window + $podokonnik + $otkos_plast + $montaj;
                    break;
                case 11:
                    $o3 = $base_povorot_window + $podokonnik + $otkos_plast + $montaj + $setka;
                    break;
                case 12:
                    $o3 = $base_povorot_otk_window;
                    break;
                case 13:
                    $o3 = $base_povorot_otk_window + $podokonnik;
                    break;
                case 14:
                    $o3 = $base_povorot_otk_window + $podokonnik + $otkos_sht;
                    break;
                case 15:
                    $o3 = $base_povorot_otk_window + $podokonnik + $otkos_plast;
                    break;
                case 16:
                    $o3 = $base_povorot_otk_window + $podokonnik + $otkos_plast + $montaj;
                    break;
                case 17:
                    $o3 = $base_povorot_otk_window + $podokonnik + $otkos_plast + $montaj + $setka;
                    break;
                case 18:
                    if ($height >= 0.9 && $height <= 1.6) {
                        $o3 = $base_povorot_otk_window + $podokonnik + $otkos_plast + $montaj + $setka + $framuga;
                    } else {
                        $o3 = $base_povorot_otk_window + $podokonnik + $otkos_plast + $montaj + $setka;
                    }
                    break;
                case 19:
                    $o3 = $base_povorot_otk_window + $podokonnik + $otkos_plast + $montaj + $setka + $woodColor;
                    if ($height >= 0.9 && $height <= 1.6) {
                        $o3 += $framuga;
                    }
                    break;
            }
            $material->price = $o3;
        }
        $this->set('material',$material);
    }
}