<?php
    $total = 0;
    $info = unserialize($model->user_info);
?>

<table class="table">
    <tbody>
    <tr>
        <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->user ? $model->user->getAttributeLabel('login') : $model->getAttributeLabel('email'); ?></td>
        <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->user ? $model->user->login : $info['email']; ?></div></td>
    </tr>
<?php
        if($info)
        {
            if(!empty($info['name']))
            {
?>
                <tr>
                    <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo Yii::t('app', 'User'); ?></td>
                    <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $info['name']; ?></div></td>
                </tr>
<?php
            }
            if(!empty($info['name']))
            {
?>
                <tr>
                    <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo Yii::t('app', 'Phone'); ?></td>
                    <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $info['phone']; ?></div></td>
                </tr>
<?php
            }
        }
?>
    <tr>
        <td style="text-align:right; width:110px; border:solid 1px #999999; padding: 4px 6px 4px 6px;">Товары</td>
        <td style="border:solid 1px #999999; padding: 4px 6px 4px 6px;">
            <div class="input-xlarge">
<?php
                foreach($model->orderItems as $item)
                {
                    $sale = 0;

                    if($item->discount)
                    {
                        $sale = $item->price - $item->discount;
                    }

                    $real_price = $item->price - $sale;

                    $item_price = $item->count * $real_price;

                    $total += $item_price;

                    echo  $item->product_id.': '.$item->title.' количество - '.$item->count.'шт. по цене - '. number_format($item->price, 2, ".", " ") .' со скидкой - '. number_format($sale, 2, ".", " ") .' итог: '. number_format($item_price, 2, ".", " ") .'<br>';
                }
?>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align:right; width:110px; border:solid 1px #999999; padding: 4px 6px 4px 6px;">Итоговая сумма</td>
        <td style="border:solid 1px #999999; padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo number_format($total, 2, ".", " ") ;?></div></td>
    </tr>
    </tbody>
</table>