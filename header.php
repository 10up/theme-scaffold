<?php
/**
 * The template for displaying the header.
 *
 * @package ThemeScaffold
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open() ?>
		<h1><?php bloginfo( 'name' ); ?></h1>
