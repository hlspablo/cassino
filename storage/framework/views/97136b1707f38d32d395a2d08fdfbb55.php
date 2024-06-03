
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $__env->yieldContent('title'); ?></title>

        <!-- SEO -->
        <?php echo $__env->yieldContent('seo'); ?>

        <meta name="robots" content="index, follow">
        <meta name="Version" content="v1.0.0" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- favicon -->
        <link rel="icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>" type="image/x-icon">

        <!-- Bootstrap -->
        <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- iziModal -->
        <link href="<?php echo e(asset('assets/css/iziModal.min.css')); ?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo e(asset('assets/css/iziToast.min.css')); ?>" rel="stylesheet" type="text/css" />

        <!-- Fontawesome -->
        <link href="<?php echo e(asset('assets/css/fontawesome.min.css')); ?>" rel="stylesheet" type="text/css" />


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css" id="theme-opt" />

        <?php echo $__env->yieldPushContent('styles'); ?>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-');
        </script>
    </head>

    <body>







        <main class="page">
            <?php echo $__env->yieldContent('content'); ?>
        </main>


        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/iziModal.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/iziToast.min.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <?php echo $__env->yieldPushContent('scripts'); ?>
        <?php if (isset($component)) { $__componentOriginal19a4003522af0aaeb04e6cc0d5d57e65 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal19a4003522af0aaeb04e6cc0d5d57e65 = $attributes; } ?>
<?php $component = App\View\Components\Flash::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Flash::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal19a4003522af0aaeb04e6cc0d5d57e65)): ?>
<?php $attributes = $__attributesOriginal19a4003522af0aaeb04e6cc0d5d57e65; ?>
<?php unset($__attributesOriginal19a4003522af0aaeb04e6cc0d5d57e65); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal19a4003522af0aaeb04e6cc0d5d57e65)): ?>
<?php $component = $__componentOriginal19a4003522af0aaeb04e6cc0d5d57e65; ?>
<?php unset($__componentOriginal19a4003522af0aaeb04e6cc0d5d57e65); ?>
<?php endif; ?>
    </body>

</html>
<?php /**PATH /app/resources/views/layouts/web.blade.php ENDPATH**/ ?>