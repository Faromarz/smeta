<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Company extends Controller_Core
{
    public function action_index()
    {
        if($this->partner){
            $company = $this->user->partner;
            $this->set('company', $company);
        }else throw new HTTP_Exception_404;
    }
}