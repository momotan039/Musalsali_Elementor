<!-- 
Template Name: Maintenance Mode
-->
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri().'/assets/images/logo.png'?>" type="image/x-icon">
    <title><?php bloginfo(); ?></title>

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #fff;
            font-family: Arial, sans-serif;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-container {
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #f8f9fa;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2);
        }

        p {
            font-size: 1.3rem;
            line-height: 1.8;
            margin-bottom: 20px;
            color: #e0e0e0;
        }

        .social-links a {
            margin: 0 10px;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-links i {
            font-size: 2rem;
            color: #ffffff;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-links a:hover i {
            transform: scale(1.2);
            color: #f39c12;
        }

        footer {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #b3b3b3;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Header -->
        <header>
            <h1><?php bloginfo(); ?></h1>
        </header>

        <!-- Maintenance Image -->
        <img src="<?php echo get_option('image_maintenance') ?>" alt="Maintenance Image">
        
        <!-- Maintenance Description -->
        <p>
            <?php echo get_option('description_maintenance') ?: 'نعتذر عن الإزعاج، موقعنا في صيانة حالياً. شكراً لتفهمكم!'; ?>
        </p>

        <!-- Social Media Links -->
        <div class="social-links">
            <a href="<?php echo get_option('facebook_link') ?: '#'; ?>" aria-label="Facebook">
                <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="<?php echo get_option('instagram_link') ?: '#'; ?>" aria-label="Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="<?php echo get_option('twitter_link') ?: '#'; ?>" aria-label="Twitter">
                <i class="fa-brands fa-twitter"></i>
            </a>
        </div>

        <!-- Footer -->
        <footer>
        <?php echo bloginfo(); ?> © <?php echo date('Y'); ?> جميع الحقوق محفوظة.
        </footer>
    </div>
</body>

</html>
