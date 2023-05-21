<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package muslimsticino
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );

		$hijri = file_get_contents("http://api.aladhan.com/v1/gToH/" . date('d-m-Y'));

		$data = json_decode($hijri, true);

		$day = $data['data']['hijri']['day'];
		$month = $data['data']['hijri']['month']['en'];
		$year = $data['data']['hijri']['year'];
		$print = $day .' '. $month .', '. $year;

		echo '<h2>' . $print . '</h2>';

		//https://aladhan.com/prayer-times-api#GetTimingsByCity
		$solyat = file_get_contents('https://api.aladhan.com/v1/timingsByCity/21-05-2023?city=Lugano&country=Switzerland&method=2');
		$solyat_data = json_decode($solyat, true);

		$time = $solyat_data['data']['timings'];
		$delete_sunrise = $solyat_data['data']['timings']['Sunrise'];
		$delete_maghrib = $solyat_data['data']['timings']['Maghrib'];


		if ( ($key = array_search($delete_sunrise, $time) ) !== false ) {
			unset($time[$key]);
		}
		if (($key = array_search($delete_maghrib, $time) ) !== false){
			unset($time[$key]);
		}

		$remove = array_splice($time, 5);

		foreach ($time as $t => $v){
			echo '<div style="display: flex; width: 150px"><div style="width:100%; display: flex; justify-content: space-between; padding-bottom: 2px; border-bottom: 1px solid grey"><div>' .$t.'</div><div>' . $v . '</div></div></div>';
//			print_r($t .' '. $v);
		}

		echo '<pre/>';
		print_r($time);
		wp_die();

		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				muslimsticino_posted_on();
				muslimsticino_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php muslimsticino_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'muslimsticino' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'muslimsticino' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php muslimsticino_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
