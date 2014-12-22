
<div class="task-item info-border">
    <div class="task-info-price">
        <p class="price">&dollar;<?=$model->price?></p>
        <p class="measurement">week</p>
        <a href="#" class="btn-small">APPLY</a>
    </div>
    <div class="task-info-meta">
        <a  href="#" class="title"><?=$model->title?></a>
        <p class="text"><?=$model->description?></p>
    </div>
    <div class="clearfix"></div>
    <div class="autor left">
        <img class="left" style="width:45px;" src="<?=$model->user->profile->Photo?>" alt="avatar">
        <p>Alex B.<img src="/images/star5.png"/><span class="vote">(3.5 based on 40 votes)</span></p>
        <p>Active 35 jobs</p>
    </div>
    <div class="date-time right">
        <?=$model->finish_day?> <br/>      
        Moscow, RU
    </div>
    <div class="clearfix"></div>
</div>