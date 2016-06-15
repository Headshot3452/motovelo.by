<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerPackage('elasticgallery');
    $cs->registerPackage('lightbox');
    $images = $product->getFiles();
    $li = '';
    $count = 0;
    foreach ($images as $image)
    {
        if (!empty($image))
        {
            $path_small = '/' . $image['path'] . 'small/' . $image['name'];
            $path_big = '/' . $image['path'] . 'origin/' . $image['name'];
            $li .=
                '<li>
                    <a href="#"><img src="' . $path_small . '" data-large="' . $path_big . '" alt=""/></a>
                </li>';
            $active = '';
            $count++;
        }
    }
?>

<div id="rg-gallery" class="rg-gallery">
    <div class="rg-thumbs">
        <div class="es-carousel-wrapper">
            <div class="es-carousel">
                <ul>
                    <?php echo $li ;?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">
    <div class="rg-image-wrapper">
        {{if itemsCount > 1}}
        {{/if}}
        <div class="rg-image text-center"></div>
        <div class="rg-loading"></div>
        <div class="rg-caption-wrapper">
            <div class="rg-caption" style="display:none;">
                <p></p>
            </div>
        </div>
    </div>
</script>