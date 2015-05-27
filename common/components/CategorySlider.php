<?php
namespace common\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Category;

class CategorySlider extends Widget
{
    protected $dataset; // data set of categories
    protected $layout; // complete html-slider
    
    public $multiplicity; // external feature: step of multiplicity
    
    public function init() {
        parent::init();
        if($this->multiplicity === NULL){
            $this->multiplicity = 8; // default step
        }
        
    }
    
    public function run() {
        $this->dataSet();
        $this->createLayout();
        return $this->layout;
    }
    
    /* prepare category records */
    protected function dataSet(){
        $category = Category::find()
                ->where(['level' => 1])
                ->orderBy(['weight' => SORT_DESC])
                ->all();
        if(!empty($category)){
            $this->dataset = $category;
        }else{
           $this->dataset = NULL;
        }
    }
    protected function createLayout(){
        $this->layout = '<ul class="bxslider">'.PHP_EOL;
        if(is_array($this->dataset)){
            $catArrSize = count($this->dataset);
            $this->layout .= '<li class="">'.PHP_EOL;
            $this->layout .= '<div class="category-holder">'.PHP_EOL;
            foreach($this->dataset as $it => $category){
                // standalone element
                
                $this->layout .= Html::a(
                        '<div class="icon-items">' .
                        Html::img(Yii::$app->params['url.categories'].'/'.$category->picture, ['alt' => Yii::t('app',$category->name) ]) .
                        '</div>' .
                        '<p>'.Yii::t('app', $category->name) .'</p>',
                        Url::to(['ticket/', 'cid' => $category->id], true),
                        ['class' => 'specialty-item']
                        );
                
                $this->multiplicitySwitch($catArrSize, $it, $category);
            }
            //$this->layout .= '</div>'.PHP_EOL;
            //$this->layout .= '</li>' . PHP_EOL;
            $this->layout .= '</ul>'.PHP_EOL;
        }else{
            // init empty slider
            $this->layout .= '<ul class="bxslider">'.PHP_EOL . '</ul>'.PHP_EOL;
        }
    }
    /* endocontroller:
     * it deside when old category-holder must be closed and new - opened
     * integer $arrSize - categories count
     * integer $this->multiplicity - multiplicity of division between holders
     * integer $currIt - number of current iteration in categoryes recordset
     * object $category - one current category
     *  */
    protected function multiplicitySwitch($arrSize, $currIt, $category){
        if( (($currIt+1) % $this->multiplicity) == 0 ){
            $this->layout .= '</div>'.PHP_EOL;
            $this->layout .= '</li>';
            if($currIt == ($arrSize - 1)){
                // last iteration sign - last holder must be closed
                return TRUE;
            }else{
                // make a new holder
                $this->layout .= '<li class="">'.PHP_EOL;
                $this->layout .= '<div class="category-holder">'.PHP_EOL;
            }
        }
    }
}