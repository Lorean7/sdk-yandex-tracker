<html <?php language_attributes() ?>>
    <head>
        <title><?= wp_get_document_title(); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <?php wp_head() ?>
    </head>
    <body <?php body_class() ?>>
        <?php wp_body_open(); ?>
        <?php wib_theme_components_render('header', [
            //...
        ]);?>
