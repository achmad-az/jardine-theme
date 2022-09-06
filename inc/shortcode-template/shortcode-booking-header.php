<form action="#" method="post">
	<div class="availability">
		<span class="date">
			<label for="entrada" id="checkinVal">
				<span>14</span> Jun 2018
			</label>
			<input required type="text" data-id="checkinVal" class="datepicker-header" style="color: #333" name="entrada" id="checkinHeader">
		</span>
		<span class="date">
			<label for="salida" id="checkoutVal">
				<span>15</span> Jun 2018
			</label>
			<input type="text" data-id="checkoutVal" class="datepicker-header" style="color: #333" name="salida" id="checkoutHeader">
		</span>
		<span class="promo-code">
			<input type="text" class="form-control" placeholder="<?php echo __('PROMOTION CODE?') ?>" name="promo_code" style="text-transform:uppercase" value="">
		</span>
		<button type="submit" class="button-availability">Check Availability</button>
	</div>
	</form>