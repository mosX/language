<style>
    .levelss_list .element{
        display:inline-block;
        margin-right:10px;
    }
</style>
<div class="container">
    <div class="levels_list">
        <?php foreach($this->m->data as $item){ ?>
            <div class="element">
                <a href="/level/show/<?=$item->id?>">Level <?=$item->order?></a>
            </div>
        <?php } ?>
    </div>
</div>