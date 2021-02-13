<?php include('includes/header.php'); ?>


<div class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-text">
					<h2>Our Hotels</h2>
					<div class="bt-option">
						<a href="home.html">Home</a>
						<span>Hotels</span>
					</div>
				</div>
			</div>
			</div>
	</div>
</div>


<section class="rooms-section spad">
	<div class="container">
		<div class="row" id="all">
			<?php
			if(isset($hotels))
			{
				foreach($hotels as $ho)
				{
			?>
			<div class="col-lg-4 col-md-6">
				<div class="room-item">
					<img src="<?=base_url().$ho['photo']?>" alt="<?=$ho['hotel_name']?>">
					<div class="ri-text">
						<h4><?=$ho['hotel_name']?></h4>
						<h3><?=$ho['price']?> <?=$ho['hotel_currency_code']?><span>/Pernight</span></h3>
						<table>
							<tbody>
								<tr>
									<td class="r-o">Stars:</td>
									<td><?=$ho['stars']?>
										<div class="rating" style="color:#F5B917"><?php
											for( $x = 0; $x < 5; $x++ )
										{
										    if( floor( $ho['stars'] )-$x >= 1 )
										    { echo '<i class="fa fa-star"></i>'; }
										    elseif( $ho['stars']-$x > 0 )
										    { echo '<i class="fa fa-star-half-o"></i>'; }
										    else
										    { echo '<i class="fa fa-star-o"></i>'; }
										}
										?></div>
									</td>
								</tr>
								<tr>
									<td class="r-o">Address:</td>
									<td><?=$ho['address']?></td>
								</tr>
							</tbody>
						</table>
						<input type="hidden" name="hotel_id" value="<?=$ho['hotel_id']?>">
						<a href="<?=base_url('book_hotel/').$ho['hotel_id']?>" class="primary-btn">Book Now</a>
					</div>
				</div>
			</div>
			<?php
				}
			}
			?>
			
			
		</div>
	</div>
</section>

<?php include('includes/footer.php'); ?>
