<?php
/* временная документация */
/*
 * 1. создаем в нужной корневой вьюшке объект : $fcontentManager = new FooterContentManager('en');
 *      не забываем подключить пространство имен компонента.
 *  передаем в конструктор язык (по умолчанию передается английский)
 * 2. отдельные участки корневой вьюшки разбиваем на партиалы, передавая в них нужные секции созданной структуры:
 * по ключам renderVarriants (см. модель footer_content)
 * 3. В партиалах выводим все нужные данные в цикле из отдельных секций, реализуя логику ссылок и оберток, как нужно.
 * 4. Если указанная секция в общей структуре отсутствует, то на партиал будет передан пустой массив.
 * 
 * Структура выглядет так: http://savepic.su/5367029.png (срок жизни ссылки - полгода : 11.03.2015)
 */
namespace common\components;

use common\models\FooterContent;
use common\models\Language;
use Yii;

class FooterContentManager {
    protected $modelsList;
    protected $normalizeStruct;
    protected $categoryStruct;
    
    public function  __construct($language="en"){
        $language = Language::findOne(['name' => $language]);
        $languageId = (!is_null($language)) ? $language->id : NULL;
        unset($language);
        if(is_null($languageId)){
            $this->normalizeStruct = FALSE;
        }else{
            $dump = FooterContent::findAll(['lang' => $languageId]);
            if(is_null($dump)){
                $this->normalizeStruct = FALSE;
            }else{
                $this->normalizeStruct = $this->dataNormalize($dump);
            }
        }
        $this->categoryStruct = NULL;
    }
    
    protected function dataNormalize($dump){
        $normalize = [];
        foreach($dump as $elem){
            $normalize[$elem->renderVarriants[(int)$elem->title]][] = [
                'title' => $elem->renderVarriants[(int)$elem->title],
                'reference' => $elem->reference,
                'img' => $elem->img0->image,
            ];
        }
        return $normalize;
    }
    /* 
     * Note: in the view
     * if you sure that rendered just one content element, you may echo $obj->partialOutput('section_name')
     * otherwise - join received data as on array:
     * for example
     * foreach($obj->partialOutput('section_name' as $element)){
     *      echo '<div>'.$element['title'].'</div>';
     * }
     *  */
    public function partialOutput($section){
        if(isset($this->normalizeStruct[$section])){
            if(count($this->normalizeStruct[$section])>1){
              return $this->normalizeStruct[$section]; // return section to view as array  of elements  
            }else{
                return $this->normalizeStruct[$section][0]; // return section to view as string in a case of section must be an single element. 
            }
        }
       // throw new \yii\web\HttpException('500', 'Page content section '.$section.' not set.');
        return NULL;
    }    
    
    public function getCategoryStruct(){
        $this->prepareCategoryStruct();
        return $this->categoryStruct;
    }
    protected function prepareCategoryStruct(){
        $db = Yii::$app->db;
        $sql = 'SELECT * FROM category ' .
                 'order by parent_id, weight';
        $structure = $db->createCommand($sql)->queryAll();
        if(empty($structure)){
            return [];
        }
        foreach($structure as $elem){
            if(is_null($elem['parent_id'])){
                $this->categoryStruct[$elem['id']] = [
                    'title' => $elem['name'],
                    'cid' => $elem['id'],
                    'subcat' => []
                ];
            }else{
                $this->categoryStruct[$elem['parent_id']]['subcat'][] = [
                    'title' => $elem['name'],
                    'cid' => $elem['id']
                ];
            }
        }
    }
}