<section id="footer-wrapper">
	<footer class="footer-footer">
		<nav class="footer-nav-wrapper">
			<h4 class="footer-header">Menu</h4>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 1) ); ?>
		</nav>
		<address class="footer-address-wrapper">
			<h4 class="footer-header">Contact</h4>
			<p class="footer-text"><abbr title="phone">P</abbr>: <a class="footer-link" href="tel:3124210030" title="Kehoe Designs phone number">773.277.1888</a></p>
			<p class="footer-text"><abbr title="fax">F</abbr>: 773.277.1919</p>
			<p class="footer-text"><abbr title="email">E</abbr>: <a class="footer-link" href="mailto:info@floralexhibits.com" title="Kehoe Designs email address">info@floralexhibits.com</a></p>
			<p class="footer-text">1420 S Rockwell St</p>
			<p class="footer-text">Chicago, <abbr title="Illinois">IL</abbr> 60608</p>
		</address>
		<section class="footer-company-wrapper">
			<a class="footer-company-link" href="http://www.kehoedesigns.com" target="_blank" title="A Kehoe Designs Company">A Kehoe Designs Company</a>
			<p class="footer-text-company">A Kehoe Designs Company</p>
			<p class="footer-text-company"><abbr title="Copyright">&copy;</abbr> All rights reserved 2013</p>
		</section>
		<section class="footer-order-wrapper">
			<h4 class="footer-order-header">Order Online</h4>
			<a class="footer-order-link transition-2" href="http://shop.floralexhibits.com">Order Now</a>
		</section>
	</footer>
</section>
<?php wp_footer(); ?>
</body>
</html>