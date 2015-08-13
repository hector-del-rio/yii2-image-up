<?php

/** @var \hectordelrio\imageUp\ImageUp $this */
/** @var string $image */
/** @var string $fileInput */

$context = $this->context;

?>

<p><?= $image ?></p>

<span class="btn btn-success fileinput-button">
    <i class="glyphicon glyphicon-file"></i>
    <span><?= Yii::t('app', 'Select file...') ?></span>
    <?= $fileInput ?>
</span>
