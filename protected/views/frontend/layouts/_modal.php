<div class="modal fade in" id="how_to_order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-close"></span></button>
				<h4 class="modal-title text-uppercase" id="myModalLabel">Где купить?</h4>
			</div>
			<div class="modal-body">
				<div class="product_contacts">
					<div class="address">
						<span>Адрес</span>
						<?php echo $this->address[0]->text ;?>
					</div>
					<div class="phones">
						<span>Телефоны для связи</span>
<?php
						foreach($this->phones as $value)
						{
							echo '<div>'. $value->number .' '. $value->operator .'</div>';
						}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>