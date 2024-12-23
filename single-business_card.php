<?php

global $post;
global $wp;

$id = $post->ID;
$card_style = get_field( 'card_style', $id );
$first_wave_color = get_field( '1_wave_color', $id );
$second_wave_color = get_field( '2_wave_color', $id );
$third_wave_color = get_field( '3_wave_color', $id );
$card_color = get_field( 'card_color', $id );
$show_bottom_bar = get_field( 'show_bottom_bar', $id );
$bar_text_direction = get_field( 'text_direction', $id );
$share_text = get_field( 'share_text', $id );
$download_text = get_field( 'download_text', $id );
$link_copied_text = get_field( 'link_copied_text', $id );
$linkk = home_url( $wp->request );
$phone_text = get_field( 'phone_text', $id );
$phone_number = get_field( 'phone_number', $id );
$upper_section = get_field( 'upper_section', $id );
$phone_number_top = get_field( 'phone_number_top', $id );
$accessibility_color = get_field( 'accessibility_color', $id );
$phone_link = preg_replace( '/\D+/', '', $phone_number );
$image_data = get_post_meta( $id, '_card_image_data', true );
$floating_menu_icon = get_field( 'floating_menu_icon', $id );


$top_logo_image = null;
if ( have_rows( 'business_card', $id ) ) {
	while ( have_rows( 'business_card', $id ) ) {
		the_row();
		if ( get_row_layout() == 'top_logo' ) {
			$top_logo_image = get_sub_field( 'image' );
			break;
		}
	}
}

?>
<?php get_header(); ?>

<style>
	header,
	footer,
	.whatsapp-float {
		display: none;
	}

	#pojo-a11y-toolbar .pojo-a11y-toolbar-toggle a {
		background:
			<?= $accessibility_color ?>
		;
	}
</style>

<?php if ( have_rows( 'business_card', $id ) ) :

	$style = '';
	$upper_section_image = $upper_section['upper_section_image'] ?? [];
	if ( ! empty( $upper_section_image ) ) {
		$style = "background: url('" . $upper_section_image['url'] . "') center center / cover no-repeat;";
	} else {
		$gradient_color_1 = $upper_section['gradient_color_1'];
		$gradient_color_2 = $upper_section['gradient_color_2'];
		$style = "background: linear-gradient(25.28deg, " . $gradient_color_1 . " 36.02%, " . $gradient_color_2 . " 117.66%);";
	}
	?>
	<div id="screenshot-area" data-encode="<?php echo $image_data ?>"
		class="shadow business-card__container <?php echo $show_bottom_bar ? " bottom_bar" : "" ?>">

		<div class="business-card<?php echo " " . $card_style ?><?php echo " " . ( $top_logo_image ? "logo" : "" ) ?>">
			<?php
			if ( $phone_number_top ) :
				$phone_color = get_field( 'phone_color', $id );
				?>
				<a class="floating-circle-top shadow" href="tel:<?= $phone_number_top ?>">
					<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path style="fill:<?= $phone_color ?>"
							d="M23.9776 21.2377C23.6814 20.9406 23.3296 20.7048 22.9421 20.5439C22.5547 20.3831 22.1393 20.3002 21.7198 20.3002C21.3003 20.3002 20.8849 20.3831 20.4975 20.5439C20.11 20.7048 19.7582 20.9406 19.462 21.2377L17.9215 22.7783C16.1869 21.6774 14.5798 20.3875 13.1297 18.9322C11.6744 17.4821 10.3844 15.875 9.28353 14.1404L10.8241 12.5998C11.1213 12.3037 11.357 11.9518 11.5179 11.5644C11.6788 11.1769 11.7616 10.7616 11.7616 10.342C11.7616 9.92254 11.6788 9.50715 11.5179 9.11971C11.357 8.73228 11.1213 8.38041 10.8241 8.08429L7.81731 5.0881C7.52537 4.78997 7.17647 4.55356 6.79135 4.39295C6.40623 4.23233 5.99275 4.15077 5.57549 4.15313C5.15526 4.1521 4.73898 4.23417 4.35059 4.39463C3.9622 4.55509 3.60938 4.79077 3.31241 5.0881L1.86745 6.52245C1.17872 7.26296 0.664695 8.1484 0.363158 9.11369C0.0616204 10.079 -0.0197637 11.0996 0.124988 12.1004C0.46498 16.0847 3.07867 20.8765 7.10545 24.9139C11.1322 28.9513 15.9771 31.5544 19.9614 31.9369C20.2587 31.9528 20.5566 31.9528 20.8539 31.9369C21.7115 31.9729 22.5678 31.8373 23.3723 31.5381C24.1769 31.2389 24.9137 30.7821 25.5394 30.1944L26.9737 28.7494C27.2711 28.4525 27.5068 28.0997 27.6672 27.7113C27.8277 27.3229 27.9098 26.9066 27.9087 26.4864C27.9111 26.0691 27.8295 25.6556 27.6689 25.2705C27.5083 24.8854 27.2719 24.5365 26.9737 24.2445L23.9776 21.2377Z"
							fill="#4D739A" />
						<path style="fill:<?= $phone_color ?>"
							d="M27.3244 4.7268C25.8478 3.24462 24.0925 2.06938 22.1595 1.26885C20.2266 0.468318 18.1543 0.0583334 16.0621 0.0625319C15.7804 0.0625319 15.5101 0.174471 15.3109 0.373724C15.1116 0.572977 14.9997 0.843222 14.9997 1.12501C14.9997 1.40679 15.1116 1.67704 15.3109 1.87629C15.5101 2.07554 15.7804 2.18748 16.0621 2.18748C17.8859 2.18742 19.6915 2.54852 21.375 3.24994C23.0584 3.95136 24.5863 4.97923 25.8704 6.27421C27.1545 7.5692 28.1695 9.10566 28.8567 10.7949C29.5439 12.4842 29.8898 14.2929 29.8743 16.1165C29.8743 16.3983 29.9863 16.6686 30.1855 16.8678C30.3848 17.0671 30.655 17.179 30.9368 17.179C31.2186 17.179 31.4888 17.0671 31.6881 16.8678C31.8873 16.6686 31.9993 16.3983 31.9993 16.1165C32.0196 14.0021 31.6165 11.9051 30.8136 9.94894C30.0107 7.9928 28.8243 6.2172 27.3244 4.7268Z"
							fill="#4D739A" />
						<path style="fill:<?= $phone_color ?>"
							d="M21.2789 10.8042C21.8819 11.4036 22.3589 12.1175 22.6819 12.9039C23.0048 13.6903 23.1672 14.5334 23.1595 15.3835C23.1595 15.6653 23.2714 15.9355 23.4707 16.1348C23.6699 16.3341 23.9402 16.446 24.222 16.446C24.5038 16.446 24.774 16.3341 24.9733 16.1348C25.1725 15.9355 25.2844 15.6653 25.2844 15.3835C25.2985 14.2584 25.089 13.1417 24.6682 12.0981C24.2473 11.0546 23.6235 10.105 22.8328 9.30445C22.0421 8.50388 21.1003 7.86827 20.0621 7.43449C19.0239 7.0007 17.9099 6.77738 16.7846 6.77747C16.5029 6.77747 16.2326 6.8894 16.0334 7.08866C15.8341 7.28791 15.7222 7.55815 15.7222 7.83994C15.7222 8.12173 15.8341 8.39197 16.0334 8.59123C16.2326 8.79048 16.5029 8.90242 16.7846 8.90242C17.622 8.90872 18.4498 9.07993 19.221 9.40625C19.9921 9.73257 20.6914 10.2076 21.2789 10.8042Z"
							fill="#4D739A" />
					</svg>

				</a>
			<?php endif; ?>
			<div class="card-bg-image" style="<?= $style ?>"></div>
			<span style="background: <?php echo $card_color ?>" class="business-card__btm"></span>
			<span style="background: #fff" class="business-card__wr"></span>
			<?php if ( $top_logo_image !== null ) : ?>
				<?php echo wp_get_attachment_image( $top_logo_image, 'full', false, [ 'alt' => 'logo', 'loading' => 'lazy', 'class' => 'top_logo_image', 'data-aos' => 'fade-in' ] ) ?>
			<?php endif ?>
			<?php while ( have_rows( 'business_card', $id ) ) :
				the_row();
				?>
				<?php if ( get_row_layout() == 'background_image_color' ) :
					$image = get_sub_field( 'image' );
					$color = get_sub_field( 'color' );
					if ( ! empty( $image ) ) : ?>
						<div data-aos="fade-in" class="business-card__top"
							style="background: url('<?php echo wp_get_attachment_image_url( $image, 'full', false ) ?>') center/cover no-repeat">
							<?php if ( ! empty( $color ) ) : ?>
								<span style="background: <?php echo $color ?>"></span>
							<?php endif ?>
						</div>
					<?php endif ?>

				<?php elseif ( get_row_layout() == 'main_logo_centered' ) :
					$image = get_sub_field( 'image' );
					$size = get_sub_field( 'size' );
					?>
					<div data-aos="fade-in" class="business-card__center-logo <?php echo $size ?>">
						<?php echo wp_get_attachment_image( $image, 'full', false, [ 'alt' => 'image', 'loading' => 'lazy', 'data-aos' => 'fade-in' ] ) ?>
					</div>

				<?php elseif ( get_row_layout() == 'under_logo_text' ) :
					$direction = get_sub_field( 'text_direction' );
					$text = get_sub_field( 'text' );
					$words = explode( ' ', $text );
					$word_limit = 36;

					if ( count( $words ) > $word_limit ) {
						$truncated_text = implode( ' ', array_slice( $words, 0, $word_limit ) );
						$remaining_text = implode( ' ', array_slice( $words, $word_limit ) );
						?>
						<div class="text-container">
							<div data-aos="fade-in" class="business-card__under-logo-text truncated-text <?php echo $direction ?>">
								<span><?php echo $truncated_text; ?> <span class="read-more">עוד..</span></span>
							</div>
							<div data-aos="fade-in" class="business-card__under-logo-text full-text <?php echo $direction ?>">
								<?php echo get_sub_field( 'text' ) ?>
							</div>
						</div>
						<?php
					} else {
						?>
						<div data-aos="fade-in" class="business-card__under-logo-text <?php echo $direction ?>">
							<?php echo $text; ?>
						</div>
						<?php
					}
					?>


				<?php elseif ( get_row_layout() == 'social' ) :

					if ( have_rows( 'social' ) ) : ?>
						<div class="business-card__socials">
							<?php while ( have_rows( 'social' ) ) :
								the_row();
								$logo_svg = get_sub_field( 'logo_svg' );
								$link = get_sub_field( 'link' );
								$color = get_sub_field( 'color' );
								$with_border = get_sub_field( 'with_border' );
								$svg_file_path = get_attached_file( $logo_svg );
								?>

								<a data-aos="fade-in"
									style="fill: <?php echo $color ?>; <?php echo $with_border ? 'border: 2px solid ' . $color . ';' : '' ?>"
									class="business-card__social <?php echo $with_border ? 'bordered' : '' ?>" href="<?php echo $link ?>">
									<?php echo file_get_contents( $svg_file_path ) ?>
								</a>

								<?php
							endwhile; ?>
						</div>

					<?php endif; ?>

				<?php elseif ( get_row_layout() == 'additional_logo_left' ) :
					$image = get_sub_field( 'image' );

					echo '<div data-aos="fade-in" class="sublogo" id="lightgallery1" >';
					echo '<a  href="' . esc_url( wp_get_attachment_image_url( $image, 'full', false ) ) . '" >';
					echo wp_get_attachment_image( $image, 'full', false, [ 'alt' => 'sublogo', 'loading' => 'lazy' ] );
					echo '</a>';
					echo '</div>';

					?>
				<?php elseif ( get_row_layout() == 'card_menu' ) :
					$card_image = get_sub_field( 'card_menu_image' );
					$menu_items_color = get_sub_field( 'menu_items_color' );
					$menu_items_price_color = get_sub_field( 'menu_items_price_color' );
					$accordion_color = get_sub_field( 'accordion_color_' );
					?>
					<div class="card-menu-item w-100 business-card__text-under-social">
						<h3 class="text-center bold m-0" style="color:<?= $menu_items_color ?>; background:<?= $accordion_color ?>">
							<?= __( "תפריט" ); ?>
						</h3>
						<?php
						if ( ! empty( $card_image ) ) {
							$card_menu_image = wp_get_attachment_image_url( $card_image, 'full', false );
							echo '<a data-aos="fade-in" class="card_menu" href="' . esc_url( $card_menu_image ) . '" data-lightbox="card_menu">';
							echo wp_get_attachment_image( $card_image, 'full', false, [ 'alt' => 'card_menu', 'loading' => 'lazy' ] );
							echo '</a>';
						} else {
							$menu_items_repeater = get_sub_field( 'menu_items_repeater' );
							if ( ! empty( $menu_items_repeater ) ) : ?>
								<div class="accordion business-card__menu" id="menuAccordion">
									<?php foreach ( $menu_items_repeater as $index => $menu_item ) :
										$menu_title = $menu_item['menu_title'];
										$menu_items_loop = $menu_item['menu_items_loop'];
										?>
										<div class="accordion-item">
											<h2 class="accordion-header" id="heading<?= $index ?>">
												<button style="background:<?= $accordion_color ?>" class="accordion-button collapsed title-container"
													type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false"
													aria-controls="collapse<?= $index ?>">
													<h3 class="title-text title-with-shadow" style="color:<?= $menu_items_color ?>"><?= $menu_title ?></h3>
													<div class="dashed-line"></div>
													<span class="plus bold" style="color:<?= $menu_items_color ?>">+</span>
												</button>
											</h2>
											<div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>"
												data-bs-parent="#menuAccordion">
												<div class="accordion-body" style="background:<?= $accordion_color ?>">
													<?php if ( ! empty( $menu_items_loop ) ) : ?>
														<?php foreach ( $menu_items_loop as $single_menu_item ) :
															$name = $single_menu_item['name'] ?? '';
															$price = $single_menu_item['price'] ?? '';
															$add_background_to_price = $single_menu_item['add_background_to_price'] ?? '';
															?>
															<div class="d-flex justify-content-between mb-3 align-items-baseline">
																<div style="color:<?= $menu_items_color ?>" class="card-menu-item-name"><?= $name ?></div>
																<div class="dashed-line mx-2"></div>
																<div
																	style="color:<?= $menu_items_price_color ?>; <?= $add_background_to_price ? 'color:white;background-color:' . $menu_items_color : ''; ?>"
																	class="card-single-menu-item <?= $add_background_to_price ? 'circle-with-bg' : ''; ?>">
																	<?= $price ?>₪
																</div>
															</div>
														<?php endforeach; ?>
													<?php endif; ?>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								</div>

							<?php endif;
						}
						?>
					</div>
				<?php elseif ( get_row_layout() == 'text_under_social' ) :
					$direction = get_sub_field( 'text_direction' )
						?>
					<div data-aos="fade-in" class="business-card__text-under-social <?php echo $direction ?>">
						<?php echo get_sub_field( 'text' ) ?>
					</div>

				<?php elseif ( get_row_layout() == 'gallery' ) :
					$title = get_sub_field( 'title' );
					$gallery = get_sub_field( 'gallery' );
					$direction = get_sub_field( 'text_direction' )
						?>
					<div data-aos="fade-in" class="business-card__gallery">
						<h6 class="<?php echo $direction ?>"><?php echo $title ?></h6>
						<?php if ( ! empty( $gallery ) ) : ?>
							<div class="business-card__gallery-images" id="lightgallery2">
								<?php foreach ( $gallery as $image_id ) : ?>
									<?php
									$image_url = wp_get_attachment_image_url( $image_id, 'full' );
									echo '<a data-aos="fade-in" href="' . esc_url( $image_url ) . '">';
									echo wp_get_attachment_image( $image_id, 'full', false, [ 'alt' => 'gallery_image', 'loading' => 'lazy' ] );
									echo '</a>';
									?>
								<?php endforeach; ?>
							</div>
						<?php endif ?>

					</div>
				<?php endif ?>

			<?php endwhile; ?>

			<?php if ( $show_bottom_bar ) : ?>

				<div data-aos="fade-in" class="business-card__bottom">
					<span style="background: <?php echo $card_color ?>" class="business-card__bottom-additional"></span>
					<div class="business-card__bottom_left">
						<img src="<?= $floating_menu_icon ?>" ;>
					</div>
					<ul class="business-card__bottom_right">
						<li>
							<a data-url="<?php echo $linkk ?>" class="share_card">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path
										d="M19.8905 15.6411C18.7183 15.6411 17.6639 16.1426 16.9153 16.9431L8.16817 12.5876C8.19825 12.3829 8.21896 12.1758 8.21896 11.9626C8.21896 11.755 8.19924 11.5524 8.17063 11.3532L16.9049 7.04537C17.6541 7.85238 18.7134 8.35895 19.8905 8.35895C22.16 8.35895 24 6.48764 24 4.17947C24 1.87081 22.16 0 19.8905 0C17.621 0 15.781 1.87081 15.781 4.17947C15.781 4.38712 15.8008 4.58925 15.8294 4.78887L7.09506 9.09674C6.34595 8.28973 5.28714 7.78316 4.10948 7.78316C1.83948 7.78316 0 9.65447 0 11.9626C0 14.2713 1.83948 16.1421 4.10948 16.1421C5.28172 16.1421 6.33609 15.6405 7.0847 14.8401L15.8318 19.1956C15.8018 19.3997 15.781 19.6074 15.781 19.8205C15.781 22.1292 17.621 24 19.8905 24C22.16 24 24 22.1292 24 19.8205C24 17.5119 22.16 15.6411 19.8905 15.6411Z"
										fill="white" />
								</svg>
								<h6 class="<?php echo $bar_text_direction ?>"><span class="main"><?php echo $share_text ?></span><span
										class="copied"><?php echo $link_copied_text ?></span></h6>
							</a>
						</li>
						<li>
							<a id="capture-btn">
								<svg xmlns="http://www.w3.org/2000/svg" width="27" height="25" viewBox="0 0 27 25" fill="none">
									<path
										d="M20.7692 21.875C20.7692 21.5929 20.6665 21.3487 20.4609 21.1426C20.2554 20.9364 20.012 20.8333 19.7308 20.8333C19.4495 20.8333 19.2061 20.9364 19.0006 21.1426C18.7951 21.3487 18.6923 21.5929 18.6923 21.875C18.6923 22.1571 18.7951 22.4013 19.0006 22.6074C19.2061 22.8136 19.4495 22.9167 19.7308 22.9167C20.012 22.9167 20.2554 22.8136 20.4609 22.6074C20.6665 22.4013 20.7692 22.1571 20.7692 21.875ZM24.9231 21.875C24.9231 21.5929 24.8203 21.3487 24.6148 21.1426C24.4093 20.9364 24.1659 20.8333 23.8846 20.8333C23.6034 20.8333 23.36 20.9364 23.1544 21.1426C22.9489 21.3487 22.8462 21.5929 22.8462 21.875C22.8462 22.1571 22.9489 22.4013 23.1544 22.6074C23.36 22.8136 23.6034 22.9167 23.8846 22.9167C24.1659 22.9167 24.4093 22.8136 24.6148 22.6074C24.8203 22.4013 24.9231 22.1571 24.9231 21.875ZM27 18.2292V23.4375C27 23.8715 26.8486 24.2404 26.5457 24.5443C26.2428 24.8481 25.875 25 25.4423 25H1.55769C1.125 25 0.757212 24.8481 0.454327 24.5443C0.151442 24.2404 0 23.8715 0 23.4375V18.2292C0 17.7951 0.151442 17.4262 0.454327 17.1224C0.757212 16.8186 1.125 16.6667 1.55769 16.6667H9.10277L11.2933 18.8802C11.9207 19.4878 12.6562 19.7917 13.5 19.7917C14.3438 19.7917 15.0793 19.4878 15.7067 18.8802L17.9135 16.6667H25.4423C25.875 16.6667 26.2428 16.8186 26.5457 17.1224C26.8486 17.4262 27 17.7951 27 18.2292ZM21.7266 8.9681C21.9105 9.41298 21.8347 9.79275 21.4994 10.1074L14.2302 17.3991C14.0355 17.6053 13.7921 17.7083 13.5 17.7083C13.2079 17.7083 12.9645 17.6053 12.7698 17.3991L5.5006 10.1074C5.16526 9.79275 5.08954 9.41298 5.27344 8.9681C5.45733 8.54492 5.77644 8.33333 6.23077 8.33333H10.3846V1.04167C10.3846 0.759549 10.4874 0.515408 10.6929 0.309245C10.8984 0.103082 11.1418 0 11.4231 0H15.5769C15.8582 0 16.1016 0.103082 16.3071 0.309245C16.5126 0.515408 16.6154 0.759549 16.6154 1.04167V8.33333H20.7692C21.2236 8.33333 21.5427 8.54492 21.7266 8.9681Z"
										fill="white" />
								</svg>
								<span class="loader"></span>
								<h6 class="<?php echo $bar_text_direction ?>"><?php echo $download_text ?></h6>
							</a>
						</li>
						<li>
							<a href="tel:+<?php echo $phone_link ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
									<path
										d="M18.0142 15.9456C17.7912 15.7218 17.5262 15.5443 17.2345 15.4231C16.9427 15.302 16.6299 15.2396 16.314 15.2396C15.9981 15.2396 15.6853 15.302 15.3935 15.4231C15.1018 15.5443 14.8368 15.7218 14.6138 15.9456L13.4537 17.1057C12.1475 16.2767 10.9373 15.3053 9.8454 14.2094C8.74948 13.1174 7.77812 11.9073 6.94912 10.6011L8.10923 9.44096C8.333 9.21797 8.51054 8.953 8.63169 8.66125C8.75283 8.36949 8.81519 8.0567 8.81519 7.7408C8.81519 7.42489 8.75283 7.1121 8.63169 6.82034C8.51054 6.52859 8.333 6.26363 8.10923 6.04064L5.84502 3.78443C5.62518 3.55992 5.36245 3.3819 5.07244 3.26095C4.78244 3.14 4.47108 3.07859 4.15686 3.08036C3.84042 3.07958 3.52695 3.14139 3.23448 3.26222C2.94201 3.38305 2.67632 3.56053 2.4527 3.78443L1.3646 4.86453C0.84597 5.42215 0.458894 6.08892 0.231827 6.81581C0.00476102 7.5427 -0.0565235 8.31123 0.0524786 9.06492C0.308503 12.0652 2.27669 15.6735 5.30897 18.7138C8.34125 21.7541 11.9896 23.7143 14.9899 24.0023C15.2137 24.0143 15.4381 24.0143 15.6619 24.0023C16.3078 24.0294 16.9525 23.9273 17.5584 23.702C18.1643 23.4767 18.7191 23.1327 19.1903 22.6902L20.2704 21.6021C20.4943 21.3785 20.6717 21.1128 20.7926 20.8203C20.9134 20.5279 20.9752 20.2144 20.9744 19.8979C20.9762 19.5837 20.9148 19.2724 20.7938 18.9824C20.6729 18.6923 20.4949 18.4296 20.2704 18.2098L18.0142 15.9456Z"
										fill="white" />
									<path
										d="M20.5344 3.51235C19.4225 2.39622 18.1007 1.51124 16.6451 0.908415C15.1896 0.305593 13.6291 -0.0031376 12.0536 2.40394e-05C11.8414 2.40394e-05 11.6379 0.0843174 11.4879 0.234361C11.3378 0.384404 11.2535 0.587906 11.2535 0.800099C11.2535 1.01229 11.3378 1.21579 11.4879 1.36584C11.6379 1.51588 11.8414 1.60017 12.0536 1.60017C13.4269 1.60012 14.7867 1.87204 16.0543 2.40023C17.322 2.92843 18.4725 3.70244 19.4395 4.6776C20.4065 5.65276 21.1708 6.80976 21.6883 8.08184C22.2058 9.35392 22.4662 10.7159 22.4546 12.0892C22.4546 12.3014 22.5389 12.5049 22.6889 12.6549C22.839 12.8049 23.0425 12.8892 23.2547 12.8892C23.4669 12.8892 23.6704 12.8049 23.8204 12.6549C23.9704 12.5049 24.0547 12.3014 24.0547 12.0892C24.0701 10.497 23.7665 8.9178 23.1619 7.44477C22.5573 5.97175 21.6639 4.63467 20.5344 3.51235Z"
										fill="white" />
									<path
										d="M15.982 8.0888C16.4361 8.54011 16.7953 9.07769 17.0385 9.66989C17.2817 10.2621 17.4039 10.897 17.3981 11.5371C17.3981 11.7493 17.4824 11.9528 17.6325 12.1029C17.7825 12.2529 17.986 12.3372 18.1982 12.3372C18.4104 12.3372 18.6139 12.2529 18.7639 12.1029C18.914 11.9528 18.9983 11.7493 18.9983 11.5371C19.0089 10.6899 18.8511 9.84896 18.5342 9.06314C18.2173 8.27733 17.7475 7.56226 17.1521 6.95941C16.5567 6.35656 15.8475 5.87793 15.0657 5.55127C14.2839 5.22462 13.445 5.05645 12.5977 5.05652C12.3855 5.05652 12.182 5.14081 12.0319 5.29085C11.8819 5.4409 11.7976 5.6444 11.7976 5.85659C11.7976 6.06879 11.8819 6.27229 12.0319 6.42233C12.182 6.57238 12.3855 6.65667 12.5977 6.65667C13.2282 6.66142 13.8516 6.79034 14.4323 7.03607C15.013 7.2818 15.5396 7.63952 15.982 8.0888Z"
										fill="white" />
								</svg>
								<h6 class="<?php echo $bar_text_direction ?>"><?php echo $phone_text ?></h6>
							</a>
						</li>
					</ul>
				</div>
			<?php endif ?>

			<div class="business_card__bg business_card__fs">
				<span class="first_c" style="background: <?php echo $first_wave_color ?>"></span>
				<span class="second_c" style="background: <?php echo $second_wave_color ?>"></span>
				<span class="third_c" style="background: <?php echo $third_wave_color ?>"></span>
				<span class="fourth_c" style="background: <?php echo $card_color ?>"></span>
			</div>
			<div class="business_card__bg business_card__cs">
				<svg class="first_c" xmlns="http://www.w3.org/2000/svg" width="429" height="566" viewBox="0 0 429 566"
					fill="none">
					<path d="M428.5 0C249.7 223.6 68.3333 93.1667 0 0V565.5H428.5V0Z" fill="<?php echo $first_wave_color ?>" />
				</svg>
				<svg class="second_c" xmlns="http://www.w3.org/2000/svg" width="429" height="566" viewBox="0 0 429 566"
					fill="none">
					<path d="M428.5 0C249.7 223.6 68.3333 93.1667 0 0V565.5H428.5V0Z" fill="<?php echo $second_wave_color ?>" />
				</svg>
				<svg class="third_c" xmlns="http://www.w3.org/2000/svg" width="429" height="566" viewBox="0 0 429 566"
					fill="none">
					<path d="M428.5 0C249.7 223.6 68.3333 93.1667 0 0V565.5H428.5V0Z" fill="<?php echo $third_wave_color ?>" />
				</svg>
				<svg class="fourth_c" xmlns="http://www.w3.org/2000/svg" width="429" height="566" viewBox="0 0 429 566"
					fill="none">
					<path d="M428.5 0C249.7 223.6 68.3333 93.1667 0 0V565.5H428.5V0Z" fill="<?php echo $card_color ?>" />
				</svg>
			</div>
			<div class="business_card__bg business_card__ws">
				<svg class="first_c" xmlns="http://www.w3.org/2000/svg" width="430" height="262" viewBox="0 0 430 262"
					fill="none">
					<g filter="url(#filter0_d_1_621)">
						<path fill-rule="evenodd" clip-rule="evenodd"
							d="M269.846 114.717C324.925 62.6651 385.978 9.61594 456.48 7V99.5288C416.639 115.496 359.943 145.564 282.922 198.657C176.952 271.705 74.3869 268.942 0 245.29V156.976C64.9048 203.784 146.627 231.165 269.846 114.717Z"
							fill="<?php echo $first_wave_color ?>" />
					</g>
				</svg>
				<svg class="second_c" xmlns="http://www.w3.org/2000/svg" width="430" height="262" viewBox="0 0 430 262"
					fill="none">
					<g filter="url(#filter0_d_1_626)">
						<path fill-rule="evenodd" clip-rule="evenodd"
							d="M268.657 116.023C324.045 63.6789 385.476 10.3261 456.48 8.26683V100.361C416.581 116.203 359.524 146.34 281.734 199.963C176.327 272.623 74.2888 270.275 0 246.971V159.136C64.7139 205.419 146.19 231.761 268.657 116.023Z"
							fill="<?php echo $second_wave_color ?>" />
					</g>
				</svg>
				<svg class="third_c" xmlns="http://www.w3.org/2000/svg" width="430" height="578" viewBox="0 0 430 578"
					fill="none">
					<g filter="url(#filter0_d_1_631)">
						<path fill-rule="evenodd" clip-rule="evenodd"
							d="M456.48 578L456.48 7.0318C391.18 1.80058 338.288 35.2803 284.111 85.4216C160.689 199.651 70.5908 164.636 0 113.283L0 578H456.48Z"
							fill="<?php echo $card_color ?>" />
					</g>
				</svg>
			</div>
			<div class="business_card__bg business_card__wa">
				<svg class="first_c" xmlns="http://www.w3.org/2000/svg" width="430" height="254" viewBox="0 0 430 254"
					fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M256.846 107.717C311.925 55.6651 372.978 2.61594 443.48 0V92.5288C403.639 108.496 346.943 138.564 269.922 191.657C163.952 264.705 61.3869 261.942 -13 238.29V149.976C51.9048 196.784 133.627 224.165 256.846 107.717Z"
						fill="<?php echo $first_wave_color ?>" />
				</svg>
				<svg class="second_c" xmlns="http://www.w3.org/2000/svg" width="430" height="254" viewBox="0 0 430 254"
					fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M255.657 108.023C311.045 55.6789 372.476 2.32613 443.48 0.266815V92.3607C403.581 108.203 346.524 138.34 268.734 191.963C163.327 264.623 61.2888 262.275 -13 238.971V151.136C51.7139 197.419 133.19 223.761 255.657 108.023Z"
						fill="<?php echo $second_wave_color ?>" />
				</svg>
				<svg class="third_c" xmlns="http://www.w3.org/2000/svg" width="430" height="572" viewBox="0 0 430 572"
					fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M443.48 572L443.48 1.0318C378.18 -4.19942 325.288 29.2803 271.111 79.4216C147.689 193.651 57.5908 158.636 -13 107.283L-13 572H443.48Z"
						fill="<?php echo $third_wave_color ?>" />
				</svg>
				<svg class="fourth_c" xmlns="http://www.w3.org/2000/svg" width="430" height="548" viewBox="0 0 430 548"
					fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd"
						d="M443.48 548L443.48 0.515104C378.18 -4.50096 325.288 27.6017 271.111 75.6808C147.689 185.212 57.5908 151.637 -13 102.397L-13 548H443.48Z"
						fill="<?php echo $card_color ?>" />
				</svg>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>