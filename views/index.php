<?php

/** @var \hectordelrio\imageUp\ImageUp $this */
/** @var string $image */
/** @var string $fileInput */

$context = $this->context;

?>
<div id="<?= $context->id ?>">

    <p><?= $image ?></p>

    <div class="btn btn-success btn-file image-up-input-button">
        <i class="glyphicon glyphicon-file"></i>
        <span><?= Yii::t('app', 'Select an image...') ?></span>
        <?= $fileInput ?>
    </div>
    <!--<div class="btn btn-danger btn-file">-->
    <!--    <i class="glyphicon glyphicon-trash"></i>-->
    <!--    <span>--><? //= Yii::t('app', 'Remove image') ?><!--</span>-->
    <!--</div>-->


</div>
