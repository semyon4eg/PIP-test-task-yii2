<ul class="list-group">
    <?php foreach ($this->data as $cat): ?>
        <a href="<?= yii\helpers\Url::to(['site/index', 'category' => $cat->id])?>" class="list-group-item list-group-item-action"><?= $cat->name ?></a>
    <?php endforeach; ?>
</ul>