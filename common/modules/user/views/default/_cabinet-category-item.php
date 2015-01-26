<!--<div class="category-item">
    <a href="#" class="specialty-item">
        <div class="icon-items">
            <img src="/images/categories/moving.png" alt="Moving"/>                                            
        </div>
        <p>Moving</p>                     
    </a>
    <a class="delete" href="#"><img src="/images/icon-delete.png"/></a>
</div>-->
<?php if(!is_null($categories)) { ?>
    <?php foreach($categories as $category) {
        var_dump($category);
    } ?>
<?php } ?>
