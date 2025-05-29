<!DOCTYPE html>
<html lang="ar">

<head>
    <!-- Meta Tags -->
    <meta name="title" content="<?php echo esc_attr((is_front_page() || is_home() ? get_bloginfo('name') : get_the_title()) . ' | ' . get_bloginfo('name')); ?>">
    <meta name="description" content="<?php
                                        if (is_singular()) {
                                            // For single posts or pages, use the excerpt
                                            echo esc_attr(get_the_excerpt(). ' | ' . get_bloginfo('name'));
                                        } else {
                                            // For other pages (e.g., homepage), use the site description
                                            echo esc_attr(get_bloginfo('description'));
                                        }
                                        ?>">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta property="og:title" content="<?php echo esc_attr((is_front_page() || is_home() ? get_bloginfo('name') : get_the_title()) . ' | ' . get_bloginfo('name')); ?>">
    <meta property="og:description" content="<?php echo esc_attr(get_the_excerpt() . ' | ' . get_bloginfo('name')); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url(null, 'full')); ?>">
    <?php if ($image_data = wp_get_attachment_metadata(get_post_thumbnail_id())) : ?>
        <meta property="og:image:width" content="<?php echo esc_attr($image_data['width']); ?>">
        <meta property="og:image:height" content="<?php echo esc_attr($image_data['height']); ?>">
    <?php endif; ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- End Meta Tags -->


    <title><?php echo esc_html((is_front_page() || is_home() ? get_bloginfo('name') : get_the_title()) . ' | ' . get_bloginfo('name')); ?></title>
    <link rel="shortcut icon" href="<?php echo get_option('icon') ?>" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --light-color: <?php echo get_option('light_color') ?>;
            --dark-color: <?php echo get_option('dark_color') ?>;
            --primary-color: <?php echo get_option('primary_color') ?>;
            --main-back: linear-gradient(42deg, var(--primary-color), var(--dark-color))
        }
    </style>
    <?php wp_head(); ?>
</head>

<body>
    <div style="background: linear-gradient(var(--dark-color), transparent, var(--dark-color)), url(<?php echo get_option('wallpaper') ?>)" class="cover">
    </div>
    <div class="header container">
        <div class="Button_small_menu">
            <i class="far fa-bars"></i>
        </div>
        <div class="small_menu">
            <?php wp_nav_menu(array("container" => false)); ?>
        </div>
        <div class="logo_menu">
            <div class="logo">
                <a title="مسلسلي" href="<?php echo get_home_url(); ?>">
                    <h1><?php bloginfo() ?></h1>
                </a>
            </div>

            <div class="menu">
                <?php wp_nav_menu(array("menu" => "Menu 2", "container" => false)); ?>
            </div>

        </div>

        <div class="search">
            <form action="<?php echo get_home_url(); ?>" method="GET">
                <input placeholder="ابحث عن اسم مسلسل او فيلم هنا..." name="s" type="text" class="field">
                <button type="submit">
                    <i class="far fa-search"></i>
                </button>
            </form>
        </div>
    </div>