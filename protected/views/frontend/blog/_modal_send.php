<!-- Modal OK-->
<div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Отправка завершена</h4>
            </div>
            <div class="modal-body send">
                <p class="text-uppercase"><b>Спасибо!</b></p>

                <p>
                    <?php echo $text; ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Готово</button>
            </div>
        </div>
    </div>
</div>