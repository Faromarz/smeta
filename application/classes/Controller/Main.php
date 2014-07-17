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

      /*  $materials_old = ORM::factory('Matoldtypes')->where('parent_id','=','0')->find_all();

        foreach ($materials_old as $types_p){
            $material_type = ORM::factory('Material_Type');
            $material_type -> name = $types_p->name;
            $material_type ->save();
            $materials_old_species = ORM::factory('Matoldtypes')->where('parent_id','=',$types_p->id)->find_all();
            if (ORM::factory('Matoldtypes')->where('parent_id','=',$types_p->id)->count_all()>0){
                foreach ($materials_old_species as $species_p){
                    $material_species = ORM::factory('Material_Species');
                    $material_species -> type_id = $material_type->id;
                    $material_species -> name = $species_p->name;
                    $material_species ->save();

                    $materials_old = ORM::factory('Materialold')->where('category_id','=',$species_p->id)->find_all();
                    foreach ($materials_old as $material_old){
                        $material = ORM::factory('Material');
                        $material -> species_id = $material_species->id;
                        $material -> name = $material_old->name;
                        $material -> country_id = $material_old->country_id;
                        $material -> description = $material_old->description;
                        $material -> img = $material_old->img;
                        $material -> price = $material_old->price;
                        $material -> count_text = $material_old->count_text;
                        $material -> create_date = $material_old->create_date;
                        $material ->save();
                    }
                }
            }
            else{
                $material_species = ORM::factory('Material_Species');
                $material_species -> type_id = $material_type->id;
                $material_species -> name = '';
                $material_species ->save();

                $materials_old = ORM::factory('Materialold')->where('category_id','=',$types_p->id)->find_all();
                foreach ($materials_old as $material_old){
                    $material = ORM::factory('Material');
                    $material -> species_id = $material_species->id;
                    $material -> name = $material_old->name;
                    $material -> country_id = $material_old->country_id;
                    $material -> description = $material_old->description;
                    $material -> img = $material_old->img;
                    $material -> price = $material_old->price;
                    $material -> count_text = $material_old->count_text;
                    $material -> create_date = $material_old->create_date;
                    $material ->save();
                }

            }


        }*/


    }

}
