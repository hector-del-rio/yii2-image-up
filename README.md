# yii2-image-up
Simple and responsive image upload and preview for yii2 models using yii2-upload-behavior extension.

When using this extension in your ```ActiveForm``` an image preview of the specified attribute will be shown along with a button to change it.
When a new image is selected, the preview will show the new image.

![screen shot 2015-08-13 at 14 43 36](https://cloud.githubusercontent.com/assets/9391691/9249023/be77ec22-41c9-11e5-9571-7759438230c8.png)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist hector-del-rio/yii2-image-up "^1.0.0"
```

or add

```
"hector-del-rio/yii2-image-up": "^1.0.0"
```

to the require section of your `composer.json` file.

Requirements
------------

This extension builds up on top of [yii-dream-team/yii2-upload-behavior](https://github.com/yii-dream-team/yii2-upload-behavior)'s class ImageUploadBehavior.
You **must** follow the instructions on how to use this module, which can be [found here](http://yiidreamteam.com/yii2/upload-behavior).

Usage
-----

In your view:

```php
<?= $form->field($model, 'photo')->widget(hectordelrio\imageUp\ImageUp::className()); ?>
```

Options
-------
The following options are available to configure:

   * *thumbsEnabled*: whether thumbs should be shown instead of original size images. The widget will enable thumbs only if they can be found.
   * *thumbProfileName*: the thumb profile name as specified in ```ImageUploadBehavior``` configuration. Defaults to "thumb".
   * *options*: the options to be passed to the ```Html::activeFileInput()``` function. [More info can be found here](http://www.yiiframework.com/doc-2.0/yii-helpers-basehtml.html#activeFileInput()-detail)
   * *previewOptions*: the options to be passed to the ```Html::img()``` function. [More info can be found here](http://www.yiiframework.com/doc-2.0/yii-helpers-basehtml.html#img()-detail)
