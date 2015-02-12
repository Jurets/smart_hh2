<?php


namespace common\modules\user\widgets;

class JobsListView extends \yii\widgets\ListView{
    public $layout = "{items} \n {pager}";
    public $showMoreBeginTemplate = "<a class='btn btn-width'>SHOW MORE</a>\n<div class='collapse'>";
    public $showMoreEndTemplate = '</div>';
    public $initialItemsCount = 3;
    protected $isRenderShowMoreEnd = false;
    
    public function renderItems() {
        $models = $this->dataProvider->getModels();
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach (array_values($models) as $index => $model) {
            if($index == $this->initialItemsCount
                    && $this->dataProvider->getPagination()->getPage() === 0){
                $rows[] = $this->showMoreBeginTemplate;
                $this->isRenderShowMoreEnd = true;
            }
            $rows[] = $this->renderItem($model, $keys[$index], $index);
        }
        return implode($this->separator, $rows);
    }
    
    public function renderPager() {
        $pager = parent::renderPager();
        if($this->isRenderShowMoreEnd){
            $pager = $pager . $this->showMoreEndTemplate;
        }
        return $pager;
    }
}
