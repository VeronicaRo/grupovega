<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package consultivo
 */
$back_totop_on = consultivo_get_opt('back_totop_on', true);?>
	</div><!-- #content inner -->
</div><!-- #content -->

<?php consultivo_footer(); ?>

<?php if (isset($back_totop_on) && $back_totop_on) : ?>
    <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
<?php endif; ?>

<?php consultivo_contact_form(); ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
