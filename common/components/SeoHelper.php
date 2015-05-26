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

    public static function FooterIndexStructure() {
        $main = new SeoHelper;
        $referencesBlock = [];
        $categories = $main->makeCategoryModelList();
        $cityes = $main->makeCityModelList();
        if(is_null($categories) || is_null($cityes)){
            return NULL;
        }
        $cityBuff = '';
        foreach ($categories as $category) {
            foreach ($cityes as $ind => $city) {
                if ($ind == 0) { // first record in the filtered buffer
                    $cityBuff = $city->city;
                } else { // check the unicue and continued
                    if ($city->city == $cityBuff) {
                        continue;
                    } else {
                        $cityBuff = $city->city;
                    }
                }
                $referencesBlock[] = [
                    'content_left' => $category->name,
                    'content_right' => $city->city,
                    'reference' => Url::to(['/ticket/index',
                        'category' => Html::encode($category->seoname),
                        'city' => html::encode($city->seoname),
                            ], true),
                ];
            }
        }
        return $referencesBlock;
    }
    
    public static function FooterZipCodesStructure($city_seoname) {
        $main = new SeoHelper;
        $referencesBlock = [];
        $zipsInTown = $main->makeZipStructure(Html::encode($city_seoname));
        if(is_null($zipsInTown)){
            return NULL;
        }
        foreach ($zipsInTown as $elem) {
            $referencesBlock[] = [
                'content' => $elem->zip,
                'reference' => Url::to(['#']),
            ];
        }
        return $referencesBlock;
    }

    public static function getCategoryIdBySeoname($name) {
        $model = Category::find()->where(['seoname' => Html::encode($name)])->one();
        if (is_null($model)) { // category is not exists
            return NULL;
        }
        return $model->id;
    }

    /*
     * special addition methods
     */

// Category first level Getter
    private function makeCategoryModelList() {
        $categories = Category::find()
                ->where('level = :level', [':level' => 1])
                ->all();
        return $categories;
    }

// Cities on goal auditiry controll getter
    private function makeCityModelList() {
        $cityesQuery = Zips::find()
                ->where('target = 1')
                ->orderBy(['city' => SORT_ASC]);
        $cityes = $cityesQuery->all();
        return $cityes;
    }
    private function makeZipStructure($city_seoname){
        $zips = Zips::find()->where(['seoname' => $city_seoname, 'target' => 1])->all();
        if(is_null($zips)){
            return NULL;
        }
        return $zips;
    }

// test
    public static function Test() {
        
    }

}
