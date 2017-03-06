<style>
    .lessons_list .element{
        display:inline-block;
        margin-right:10px;
    }
</style>
<div class="container">
    <div class="lessons_list">
        <?php foreach($this->m->data as $item){ ?>
            <div class="element">
                <a href="/lesson/show/<?=$item->id?>">Lesson <?=$item->order?></a>
            </div>
        <?php } ?>
    </div>
</div>