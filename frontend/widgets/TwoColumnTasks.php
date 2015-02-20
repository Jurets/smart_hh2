<?php
namespace frontend\widgets;

class TwoColumnTasks extends \yii\base\Widget{

    private $_columns = [];
    
    public $caption = 'Some Tasks';
    public $tasks;
    public $moreButtonText = 'MORE JOBS';
    public $moreButtonLink;
    
    public function init() {
        parent::init();
        if(!is_array($this->tasks)){
            $this->tasks = [];
        }
        if($this->moreButtonLink === null){
            $this->moreButtonLink = \yii\helpers\Url::to(['/ticket/index']);
        }
        $size = count($this->tasks);
        if($size === 0){
            return;
        }
        if($size === 1){
            $this->_columns[] = $this->tasks;
            return;
        }
        $this->_columns = array_chunk($this->tasks, ceil($size/2));
    }
    
    public function run() {
        return $this->render('two-column-tasks', [
            'caption' => $this->caption,
            'columns' => $this->_columns,
            'moreButtonText' => $this->moreButtonText,
            'moreButtonLink' => $this->moreButtonLink,
        ]);
    }
}
