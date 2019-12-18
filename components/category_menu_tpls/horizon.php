<?php if(!empty($this->model->categoriesChosen)): ?>
    <ul class="list-group list-group-horizontal">
        <?php foreach ($this->model->categoriesChosen as $key => $value): ?>
            <?php foreach ($this->data as $cat): ?>
                <?php if($cat->id == $value): ?>
                    <li class="list-group-item"><?php echo $cat->name; ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>