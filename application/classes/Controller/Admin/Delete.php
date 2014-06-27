<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_User_Delete extends Controller_User {

    public function before() {
        parent::before();

        // проверяем авторизирован ли пользователь и является ли он владельцем странички
        if ($this->auth->logged_in()) {
            $login = $this->user->username;
            $name_user = $this->request->param('login'); /* получаем имя автора странички */
            if ($name_user != $login)
                HTTP::redirect('/');
        }
        else {
            HTTP::redirect('/');
        }
    }

    function action_index() {


        if (isset($_POST['delete'])) {
            $news = ORM::factory('new')->where('users_id', '=', $this->user->id)->where('id', '=', $_POST['id_new'])->find();
            
            if($news->loaded() && empty($_POST['id_categ'])){
                $imags = ORM::factory('image')->where('news_id', '=', $_POST['id_new'])->find_all();
                foreach ($imags as $imag){
                    if (is_file('media/upimages/'.$imag->name)){
                       if (unlink('media/upimages/'.$imag->name)){}
                   }
                }
                $imags_dell_col = ORM::factory('image')->where('news_id', '=', $_POST['id_new'])->count_all();
                    if($imags_dell_col > 0 ){
                        $imags_dell = ORM::factory('image')->where('news_id', '=', $_POST['id_new'])->find_all();
                        if(is_array($imags_dell)){
                            foreach ($imags_dell as $val){
                                $val->delete();
                            }
                        }
                       
                    }    
                $coment_dell_col = ORM::factory('comment')->where('new_id', '=', $_POST['id_new'])->count_all();
                    if($coment_dell_col >0){
                        $coment_dell = ORM::factory('comment')->where('new_id', '=', $_POST['id_new'])->find_all();
                        if(is_array($coment_dell)){
                            foreach ($coment_dell as $val){
                                $val->delete();
                            }
                        }
                    }
                $favor_dell_col = ORM::factory('favorit')->where('news_id', '=', $_POST['id_new'])->where('category', 'in', array('1' ,'2','3','4','5','6','7'))->count_all();
                    if($favor_dell_col >0){
                        $favor_dell = ORM::factory('favorit')->where('news_id', '=', $_POST['id_new'])->where('category', 'in', array('1' ,'2','3','4','5','6','7'))->count_all();
                        if(is_array($favor_dell)){
                            foreach ($favor_dell as $val){
                                $val->delete();
                            }
                       }
                    }
                $statisr_dell_col = ORM::factory('statistic')->where('new_id', '=', $_POST['id_new'])->count_all();
                    if($statisr_dell_col >0){
                        $statisr_dell = ORM::factory('statistic')->where('new_id', '=', $_POST['id_new'])->find_all();
                        if(is_array($statisr_dell)){
                            foreach ($statisr_dell as $val){
                                $val->delete();
                            }
                        }
                    }
                $video_dell_col = ORM::factory('videos')->where('news_id', '=', $_POST['id_new'])->count_all();
                    if($video_dell_col >0){
                        $video_dell = ORM::factory('videos')->where('news_id', '=', $_POST['id_new'])->find_all();
                        if(is_array($video_dell)){
                            foreach ($video_dell as $val){
                                $val->delete();
                            }
                        }
                    }
                
                $logo = $news->new_logo;
                if($news->categories_id == 1 || $news->categories_id == 3){
                    if (is_file('media/upimages/'.$logo)){
                        if (unlink('media/upimages/'.$logo)){}
                    }
                    if (is_file('media/upimages/155_116_'.$logo)){
                        if (unlink('media/upimages/155_116_'.$logo)){}
                    }
                    if (is_file('media/upimages/133_100_'.$logo)){
                        if (unlink('media/upimages/133_100_'.$logo)){}
                    }
                    if (is_file('media/upimages/400_400_'.$logo)){
                        if (unlink('media/upimages/400_400_'.$logo)){}
                    }
                }
                if($news->categories_id == 1){
                    $red_to = 'news';
                    foreach ($imags as $imag){
                        if ($news->typenews_id == 3){
                            if (is_file('media/video/'.$imag->name)){
                                if (unlink('media/video/'.$imag->name)){}
                            }
                        }
                    }
                } 
                if($news->categories_id == 3){
                    $red_to = 'photo';
                     if (is_file('media/upimages/200_150_'.$logo)){
                        if (unlink('media/upimages/200_150_'.$logo)){}
                    }
                     if (is_file('media/upimages/'.$logo)){
                        if (unlink('media/upimages/'.$logo)){}
                    }
                     if (is_file('media/upimages/original/'.$logo)){
                        if (unlink('media/upimages/original/'.$logo)){}
                    }
                    if (is_file('media/upimages/600_450_'.$logo)){
                        if (unlink('media/upimages/600_450_'.$logo)){}
                    }
                    if (is_file('media/upimages/400_400_'.$logo)){
                        if (unlink('media/upimages/400_400_'.$logo)){}
                    }
                    if (is_file('media/upimages/237_175_'.$logo)){
                        if (unlink('media/upimages/237_175_'.$logo)){}
                    }
                }
                if($news->categories_id == 2){
                    $red_to = 'video';
                    if (is_file('media/video/'.$logo)){
                       if (unlink('media/video/'.$logo)){}
                   }   
                    if (is_file('media/video/temp/'.$logo)){
                       if (unlink('media/video/temp/'.$logo)){}
                   }   
                    if (is_file('media/video/176_144/'.$logo)){
                       if (unlink('media/video/176_144/'.$logo)){}
                   }   
                    if (is_file('media/video/320_240/'.$logo)){
                       if (unlink('media/video/320_240/'.$logo)){}
                   }   
                    if (is_file('media/video/480_320/'.$logo)){
                       if (unlink('media/video/480_320/'.$logo)){}
                   }   
                    if (is_file('media/video/720_576/'.$logo)){
                       if (unlink('media/video/720_576/'.$logo)){}
                   }   
                    if (is_file('media/video/temp_old/'.$logo)){
                       if (unlink('media/video/temp_old/'.$logo)){}
                   }   
                }
                if($news->categories_id == 4){
                    $red_to = 'audio';
                    foreach ($imags as $imag){
                        if (is_file('media/audio/'.$imag->name)){
                           if (unlink('media/audio/'.$imag->name)){}
                        }
                    }
                }
                if($news->categories_id == 5){
                    $red_to = 'literature';
                    if (is_file('media/upimages/'.$logo)){
                       if (unlink('media/upimages/'.$logo)){}
                    }  
                    if (is_file('media/upimages/75_100_'.$logo)){
                       if (unlink('media/upimages/75_100_'.$logo)){}
                    }  
                    if (is_file('media/upimages/400_400_'.$logo)){
                       if (unlink('media/upimages/400_400_'.$logo)){}
                    }  
                    $chti = ORM::factory('chti')->where('news_id', '=', $_POST['id_new'])->find();
                 
                    if (is_file('media/doc/'.$chti->file)){
                       if (unlink('media/doc/'.$chti->file)){}
                    }
                    
                }
                 if($news->categories_id == 6){
                    $red_to = 'files';
                    if (is_file('media/upimages/'.$logo)){
                       if (unlink('media/upimages/'.$logo)){}
                    }    
                    if (is_file('media/upimages/75_100_'.$logo)){
                       if (unlink('media/upimages/75_100_'.$logo)){}
                    }    
                    if (is_file('media/upimages/400_400_'.$logo)){
                       if (unlink('media/upimages/400_400_'.$logo)){}
                    }    
                    foreach ($imags as $imag){
                        if (is_file('media/files/'.$imag->name)){
                           if (unlink('media/files/'.$imag->name)){}
                        }
                    }    
                 }
                 if($news->categories_id == 7){
                    $red_to = 'games';
                    if (is_file('media/upimages/'.$logo)){
                        if (unlink('media/upimages/'.$logo)){}
                    }  
                    if (is_file('media/upimages/75_100_'.$logo)){
                        if (unlink('media/upimages/75_100_'.$logo)){}
                    }  
                    $game_file = ORM::factory('gameorm')->where('news_id', '=', $_POST['id_new'])->find();
                    if (is_file('media/files/'.$game_file->game_file)){
                        if (unlink('media/files/'.$game_file->game_file)){}
                    }
                 }
                       
                $new = ORM::factory('new', (int)$_POST['id_new']);
                $new->del = 1;
                $new->save();
                
                HTTP::redirect($red_to);
            }else{
             $new = ORM::factory('competitionpart')
                     ->where('users_id', '=', $this->user->id)
                     ->where('id', '=', $_POST['id_new'])
                     ->find();
             if($new->loaded() && $_POST['id_categ'] == ''){
                $compi = ORM::factory('competition')->where('id', '=', $new->competitions_id)->find();
                if($compi->podcategories_id == 57){
                       if (is_file('media/competition/video/'.$new->file_name)){
                           if (unlink('media/competition/video/'.$new->file_name)){}
                       }
                }
                if($compi->podcategories_id == 58){
                       if (is_file('media/competition/photo/'.$new->file_name)){
                           if (unlink('media/competition/photo/'.$new->file_name)){}
                       }
                        if (is_file('media/competition/photo/160_160_'.$new->file_name)){
                           if (unlink('media/competition/photo/160_160_'.$new->file_name)){}
                       }
                        if (is_file('media/competition/photo/150_100_'.$new->file_name)){
                           if (unlink('media/competition/photo/150_100_'.$new->file_name)){}
                       }
                        if (is_file('media/competition/photo/160_120_'.$new->file_name)){
                           if (unlink('media/competition/photo/160_120_'.$new->file_name)){}
                       }
                        if (is_file('media/competition/photo/227_188_'.$new->file_name)){
                           if (unlink('media/competition/photo/227_188_'.$new->file_name)){}
                       }
                } 
                if($compi->podcategories_id == 62){
                    if (is_file('media/competition/photo/'.$new->file_name)){
                           if (unlink('media/competition/photo/'.$new->file_name)){}
                       }
                        if (is_file('media/competition/photo/160_120_'.$new->file_name)){
                           if (unlink('media/competition/photo/160_120_'.$new->file_name)){}
                       }
                        if (is_file('media/competition/photo/117_88_'.$new->file_name)){
                           if (unlink('media/competition/photo/117_88_'.$new->file_name)){}
                       }
                }
                if($compi->podcategories_id == 60){
                       if (is_file('media/competition/audio/'.$new->file_name)){
                           if (unlink('media/competition/audio/'.$new->file_name)){}
                       }
                }
                $compi = ORM::factory('competition')->where('id', '=', $new->competitions_id)->find();
                $compi->participonts -= 1 ;
                $compi->save();
                        
                $neww = ORM::factory('competitionpart', $_POST['id_new']);
                if($neww->loaded())$neww->delete();
                HTTP::redirect($_SERVER['HTTP_REFERER']);
            }else{
                $com = ORM::factory('competition')
                     ->where('users_id', '=', $this->user->id)
                     ->where('id', '=', $_POST['id_new'])
                     ->where('moderat', '=', 0)   
                     ->find();
                 if($com->loaded() && $_POST['id_categ'] == 8){
                        $this->user->money = bcadd($this->user->money,$com->price,10);
                        $this->user->save();
                        
                        $com->delete();
                        HTTP::redirect($_SERVER['HTTP_REFERER']);
                 }
            }
            }
            
    }
//    if(isset($_SERVER['HTTP_REFERER']))
//        HTTP::redirect($_SERVER['HTTP_REFERER']);
}

function action_confirm(){
   if (isset($_POST['confirm']))  {
    $new_conf = ORM::factory('new')->where('id', '=', $_POST['id_conf'])->find();
    if($new_conf->categories_id == 1) {$red_to = 'news';}
    if($new_conf->categories_id == 2) {$red_to = 'video';}
    if($new_conf->categories_id == 3) {$red_to = 'photo';}
    if($new_conf->categories_id == 4) {$red_to = 'audio';}
    if($new_conf->categories_id == 5) {$red_to = 'literature';}
    if($new_conf->categories_id == 6) {$red_to = 'files';}
    if($new_conf->categories_id == 7) {$red_to = 'games';}
    $new_conf->moderation = 1;   
    $new_conf->save();   
    HTTP::redirect('http://' .$this->domain_name. '/' .$red_to);   
       
   }
    
    
    
}


}