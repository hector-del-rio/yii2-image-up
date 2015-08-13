<?php

namespace hectordelrio\imageUp;

use yiidreamteam\upload\ImageUploadBehavior;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use Yii;

class ImageUp extends InputWidget
{
    /**
     * @var array Options to be passed to the Html::img() function when generating the preview.
     */
    public $previewOptions = [];
    /**
     * @var bool Whether to use thumbs generated by yiidreamteam\upload\ImageUploadBehavior.
     * If set to false, full sized images will be used as preview.
     */
    public $thumbsEnabled;
    /**
     * @var string If thumbs are enabled, the name of the thumb profile to be used. More info [here](https://github.com/yii-dream-team/yii2-upload-behavior).
     */
    public $thumbProfileName = 'thumb';
    /**
     * @var After init() this is populated with the yiidreamteam\upload\ImageUploadBehavior instance for the given model and attribute values.
     */
    protected $behavior;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->behavior = ImageUploadBehavior::getInstance($this->model, $this->attribute);

        if (!isset($this->thumbsEnabled)) {
            $this->thumbsEnabled = isset($this->behavior->thumbs[$this->thumbProfileName]);

            if ($this->thumbsEnabled) {
                $thumbFilename = $this->behavior->getThumbFilePath(null, $this->thumbProfileName);

                if (!is_readable($thumbFilename)) {
                    Yii::warning("Unable to read thumb file: '{$thumbFilename}'");
                    $this->thumbsEnabled = false;
                }

            }

        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $width = null;

        if ($this->thumbsEnabled) {
            $filename = $this->behavior->getThumbFilePath(null, $this->thumbProfileName);
        } else {
            $filename = $this->behavior->getUploadedFilePath();
        }

        if (is_readable($filename)) {

            list($width) = getimagesize($filename);

        } else {
            Yii::warning("Unable to read file: '{$filename}' referenced by '{$this->attribute}' in model {$this->model->className()}");

            if (empty($this->previewOptions['style'])) {
                $this->previewOptions['style'] = '';
            }

            $this->previewOptions['style'] .= ';display: none;';
        }

        $previewOptions = ArrayHelper::merge([
            'id' => $this->id . '-thumb',
            'width' => $width,
            'class' => 'img-responsive img-thumbnail',
        ], $this->previewOptions);

        if (isset($this->model->attributeLabels()[$this->attribute])) {
            $previewOptions['alt'] = $this->model->attributeLabels()[$this->attribute];
        }

        if ($this->thumbsEnabled) {
            $url = $this->behavior->getThumbFileUrl(null, $this->thumbProfileName);
        } else {
            $url = $this->behavior->getImageFileUrl();
        }

        $image = Html::img($url, $previewOptions);
        $fileInput = Html::activeFileInput($this->model, $this->attribute, $this->options);

        echo $this->render('index', compact('image', 'fileInput'));

        $this->getView()->registerJs(
";(function($){
    var fileInput = $('#{$this->options['id']}');
    var preview = $('#{$previewOptions['id']}');
    var button = fileInput.closest('.fileinput-button');

    fileInput.on('change', function() {
        var selectedFile = this.files[0];

        if (selectedFile) {
            var reader = new FileReader();
            reader.readAsDataURL(selectedFile);
            reader.onload = function (e) {
                preview.attr('src', e.target.result);
            }

            preview.show();
        }
    });

    button.on('click', function() {
        fileInput[0].click();
    });

})(jQuery);"
        );

        $this->getView()->registerCss('.fileinput-button input { display: none; }');
    }
}