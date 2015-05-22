<?php

namespace common\components;

use Yii;
use common\models\Ticket;
use common\models\Zips;
use common\models\UserLanguage;
use common\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use common\components\UrlEncriptor;

class SeoHelper {
   // addition component
   private $urlEncriptor;
    
   public static function FooterIndexStructure(){
       $main = new SeoHelper;
       $referencesBlock = [];
       $categories = $main->makeCategoryModelList();
       $cityes = $main->makeCityModelList();
       foreach($categories as $category){
           foreach($cityes as $city){
               $referencesBlock[] = [
                   'content' => $category->name,
                   'reference' => Url::to(['ticket/index',
                       'category'=>Html::encode($category->name),
                       'city'=>html::encode($city->city),
                       ],true),
               ];
           }
       }
       return $referencesBlock;       
   }
   
   
   /*
    * special addition methods
    */
   // Category first level Getter
   private function makeCategoryModelList(){
       $categories = Category::find()
               ->where('level = :level', [':level'=>1])
               ->all();
       return $categories;
   }
   // Cities on goal auditiry controll getter
   private function makeCityModelList(){
       $cityes = Zips::find()
               ->where('target = 1')
               ->all();
       return $cityes;
   }
   
   // test
   public static function Test(){
       
   }
}