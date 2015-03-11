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

class FooterContentManager {
    protected $modelsList;
    protected $normalizeStruct;
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
    public function partialOutput($section){
        if(isset($this->normalizeStruct[$section])){
            return $this->normalizeStruct[$section];
        }
        return [];
    }    
    public function testOutput(){
        var_dump($this->normalizeStruct);
    }
}