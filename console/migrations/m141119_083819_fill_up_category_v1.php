<?php

use yii\db\Schema;
use yii\db\Migration;

class m141119_083819_fill_up_category_v1 extends Migration
{
    public function up()
    {
//        Categories
        $this->insert('category', array(
                'id'=>1,
                'name'=>'Home/Office repairs',
                'level'=>1,
                'picture'=>'HomeOffice.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>2,
                'name'=>'Courier Services',
                'level'=>1,
                'picture'=>'CourierServices.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>3,
                'name'=>'Electronic',
                'level'=>1,
                'picture'=>'Electronic.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>4,
                'name'=>'Appliances',
                'level'=>1,
                'picture'=>'Appliances.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>5,
                'name'=>'Photo & Video',
                'level'=>1,
                'picture'=>'photo.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>6,
                'name'=>'Cleaning',
                'level'=>1,
                'picture'=>'Cleaning.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>7,
                'name'=>'Virtual Assistant',
                'level'=>1,
                'picture'=>'VirtualAssistant.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>8,
                'name'=>'Health & Beauty',
                'level'=>1,
                'picture'=>'healthBeauty.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>9,
                'name'=>'Moving',
                'level'=>1,
                'picture'=>'moving.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>10,
                'name'=>'Events',
                'level'=>1,
                'picture'=>'events.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>11,
                'name'=>'Webdisign & Internet',
                'level'=>1,
                'picture'=>'webDisignInternet.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>12,
                'name'=>'Cooking',
                'level'=>1,
                'picture'=>'cooking.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>13,
                'name'=>'Pet',
                'level'=>1,
                'picture'=>'pet.png',
                'active'=>1,
                'weight'=>1
            ));

        $this->insert('category', array(
                'id'=>14,
                'name'=>'Miscellaneous',
                'level'=>1,
                'picture'=>'Miscellaneous.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>15,
                'name'=>'Run Errands',
                'level'=>1,
                'picture'=>'RunErrands.png',
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>16,
                'name'=>'Education/Tutoring',
                'level'=>1,
                'picture'=>'EducationTutoring.png',
                'active'=>1,
                'weight'=>1
            ));

//        Subcategories id 1
        $this->insert('category', array(
                'id'=>20,
                'name'=>'painting',
                'parent_id'=>1,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>21,
                'name'=>'furniture assembly',
                'parent_id'=>1,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>22,
                'name'=>'plumbing',
                'parent_id'=>1,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>23,
                'name'=>'electrical',
                'parent_id'=>1,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>24,
                'name'=>'handyman',
                'parent_id'=>1,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 2
        $this->insert('category', array(
                'id'=>30,
                'name'=>'by foot',
                'parent_id'=>2,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>31,
                'name'=>'by public transportation',
                'parent_id'=>2,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>32,
                'name'=>'by car',
                'parent_id'=>2,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>33,
                'name'=>'by SUV/Van',
                'parent_id'=>2,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>34,
                'name'=>'by truck',
                'parent_id'=>2,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>35,
                'name'=>'by air (*) someone legal to travel (say, bring something from my granny from Columbia)',
                'parent_id'=>2,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 3
        $this->insert('category', array(
                'id'=>40,
                'name'=>'install/repair',
                'parent_id'=>3,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>41,
                'name'=>'TV',
                'parent_id'=>3,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>42,
                'name'=>'phones',
                'parent_id'=>3,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>43,
                'name'=>'computer',
                'parent_id'=>3,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>44,
                'name'=>'networking',
                'parent_id'=>3,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>45,
                'name'=>'photo & videocam',
                'parent_id'=>3,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>46,
                'name'=>'other',
                'parent_id'=>3,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 4
        $this->insert('category', array(
                'id'=>50,
                'name'=>'install/repair',
                'parent_id'=>4,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
                $this->insert('category', array(
                'id'=>51,
                'name'=>'dishwater',
                'parent_id'=>4,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
                $this->insert('category', array(
                'id'=>52,
                'name'=>'dryer & washer',
                'parent_id'=>4,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
                $this->insert('category', array(
                'id'=>53,
                'name'=>'refrigerator',
                'parent_id'=>4,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
                $this->insert('category', array(
                'id'=>54,
                'name'=>'air condition',
                'parent_id'=>4,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
                $this->insert('category', array(
                'id'=>55,
                'name'=>'stove/micro',
                'parent_id'=>4,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
                $this->insert('category', array(
                'id'=>56,
                'name'=>'other',
                'parent_id'=>4,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 5
        $this->insert('category', array(
                'id'=>60,
                'name'=>'photo',
                'parent_id'=>5,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>61,
                'name'=>'video',
                'parent_id'=>5,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>62,
                'name'=>'editing',
                'parent_id'=>5,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 6
        $this->insert('category', array(
                'id'=>70,
                'name'=>'photo',
                'parent_id'=>6,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>71,
                'name'=>'photo',
                'parent_id'=>6,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 8
        $this->insert('category', array(
                'id'=>80,
                'name'=>'mani/pedi',
                'parent_id'=>8,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>81,
                'name'=>'massage',
                'parent_id'=>8,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>82,
                'name'=>'hair services',
                'parent_id'=>8,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>83,
                'name'=>'make up',
                'parent_id'=>8,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>84,
                'name'=>'fitness & nutrition',
                'parent_id'=>8,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>85,
                'name'=>'fashion',
                'parent_id'=>8,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>86,
                'name'=>'other',
                'parent_id'=>8,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 9
        $this->insert('category', array(
                'id'=>90,
                'name'=>'packing',
                'parent_id'=>9,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>91,
                'name'=>'carrying',
                'parent_id'=>9,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>92,
                'name'=>'driving: -VAN/SUV –Track –Pickup',
                'parent_id'=>9,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 10
        $this->insert('category', array(
                'id'=>100,
                'name'=>'bartender',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
        ));
        $this->insert('category', array(
                'id'=>101,
                'name'=>'security staff',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>102,
                'name'=>'lifeguard',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>103,
                'name'=>'valet',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>104,
                'name'=>'waiter',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>105,
                'name'=>'chef',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>106,
                'name'=>'event planner',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>107,
                'name'=>'other',
                'parent_id'=>10,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 11
        $this->insert('category', array(
                'id'=>110,
                'name'=>'sites, building & editing',
                'parent_id'=>11,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>111,
                'name'=>'SMM',
                'parent_id'=>11,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>112,
                'name'=>'SEO',
                'parent_id'=>11,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>113,
                'name'=>'content writing',
                'parent_id'=>11,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>114,
                'name'=>'other',
                'parent_id'=>11,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 12
        $this->insert('category', array(
                'id'=>120,
                'name'=>'cooking',
                'parent_id'=>12,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>121,
                'name'=>'baking',
                'parent_id'=>12,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>122,
                'name'=>'catering',
                'parent_id'=>12,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));

        //        Subcategories id 13
        $this->insert('category', array(
                'id'=>130,
                'name'=>'grooming',
                'parent_id'=>13,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>131,
                'name'=>'walking',
                'parent_id'=>13,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
        $this->insert('category', array(
                'id'=>132,
                'name'=>'petsitting',
                'parent_id'=>13,
                'level'=>2,
                'active'=>1,
                'weight'=>1
            ));
    }

    public function down()
    {
        echo "m141119_083819_fill_up_category_v1 cannot be reverted.\n";

        return false;
    }
}
