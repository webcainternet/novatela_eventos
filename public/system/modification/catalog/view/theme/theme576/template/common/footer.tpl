<footer>
	<?php if ($footer_top) { ?>
	<div class="footer">
		<?php if ($maintenance == 0){ ?>
				<?php echo $footer_top; ?>
			<?php } ?>
	</div>
	<?php } ?>
  <div class="container">
	<div class="row">
		<div class="col-sm-4 col-md-2">
		<?php if ($informations) { ?>
			<div class="footer_box">
				<h5><?php echo $text_information; ?></h5>
				<ul class="list-unstyled">
				<?php foreach ($informations as $information) { ?>
				<li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
				<?php } ?>
				</ul>
			</div>
			<?php } ?>
		</div>
		<div class="col-sm-4 col-md-2">
			<div class="footer_box">
				<h5><?php echo $text_service; ?></h5>
				<ul class="list-unstyled">
				<li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
				<li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
				</ul>
			</div>
		</div>
		<div class="col-sm-4 col-md-2">
			<div class="footer_box">
				<h5><?php echo $text_account; ?></h5>
				<ul class="list-unstyled">
				<li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
				<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
				</ul>
			</div>
		</div>
        <div class="col-sm-4">

			<?php if ($data['maintenance']==0) { ?>
			<?php echo $footer_top; ?>
			<?php } ?>
			
            <div class="footer_box">
	            <h5><?php echo $text_contact; ?></h5>
	            <address>
	            	<span>Av. Dr. Dante Pazzanese, 500 - Vila Mariana<br>São Paulo - SP - CEP: 04012-909</span>
	            	<a href="callto:#">(11) 5085-6000</a><br/>
	            </address>
	            <?php // echo $tm_social_list;?>
            </div>
        </div>

        <img src="/image/logo_faj.png" style="width: 180px;" width="180">
	</div>
	
  </div>
	<div class="copyright">
		<div class="container">
			<div style="float: left; width: 50%;">
				<?php echo $powered; ?><!-- [[%FOOTER_LINK]] -->
			</div>
			<div style="float: left; width: 50%; text-align: right;">
				<img src="/image/logo_boleto.png" style="width: 70px; margin-right: 10px;" width="70">
				<img src="/image/logo_pagseguro.png" style="width: 120px;" width="120">
			</div>
		</div> 		
	</div>
</footer>
<script src="catalog/view/theme/<?php echo $theme_path; ?>/js/livesearch.js" type="text/javascript"></script>
<script src="catalog/view/theme/<?php echo $theme_path; ?>/js/script.js" type="text/javascript"></script>
</div>

</body></html>