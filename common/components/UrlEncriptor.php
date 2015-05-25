<?php

namespace common\components;
use common\models\Zips;
use common\models\Category;

class UrlEncriptor {
//    public  function safe_b64encode($string) {
//	
//        $data = base64_encode($string);
//        $data = str_replace(array('+','/','='),array('-','_',''),$data);
//        return $data;
//    }
 
//	public function safe_b64decode($string) {
//        $data = str_replace(array('-','_'),array('+','/'),$string);
//        $mod4 = strlen($data) % 4;
//        if ($mod4) {
//            $data .= substr('====', $mod4);
//        }
//        return base64_decode($data);
//}
    // used in migration seo fr. url in zips table
    public static function setupSeonamesForZips(){
        $zips = Zips::find()->all();
        echo 'Wait please near 3 minutes ...'.PHP_EOL;
        foreach($zips as $i=>$zip){
            $name = $zip->city;
            $seoname = str_replace([' ', '?', '/', '*', '(', ')', '.'], '-', $name);
            $zip->seoname = strtolower($seoname);
            $zip->save(false);
           // echo 'Record '.($i+1).' ->Ok'.PHP_EOL;
        }
        $records = $i + 1; 
        echo 'Records: '.$records;
    }
    public static function setupSeonamesForCategory(){
        $categories = Category::find()->where('level=1')->all();
        foreach($categories as $i=>$category){
            $name = $category->name;
            $seoname = str_replace([' ', '/', ' / ', '\\', ' \\ ', '&', ' & ', '(', '*', ')'],'-', $name);
            $seoname = str_replace('---', '-', $seoname);
            $category->seoname = strtolower($seoname);
            $category->save(false);
        }
        $records = $i+1;
        echo 'Records: ' . $records;
    }
}