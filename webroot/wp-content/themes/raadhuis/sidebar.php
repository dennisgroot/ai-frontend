<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<aside id="sidebar" class="sidebar">

	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar' ); ?>

	<?php endif; ?>

</aside>