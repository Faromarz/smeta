<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Core {

    public function action_index() {
        $types_rate = ORM::factory('Types_Rate')->find_all();
        $types_repair = ORM::factory('Types_Repair')->find_all();
        $types_apartment = ORM::factory('Types_Apartment')->find_all();

        $this->set('types_rate',$types_rate);
        $this->set('types_repair',$types_repair);
        $this->set('types_apartment',$types_apartment);
    }

}
