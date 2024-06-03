<?php $__env->startSection('title', config('setting')->software_name); ?>

<?php $__env->startSection('seo'); ?>
    <link rel="canonical" href="<?php echo e(url()->current()); ?>"/>
    <meta name="description" content="  ">
    <meta name="keywords" content="<?php echo e(config('setting')->software_description); ?>">

    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title"
          content="<?php echo e(config('setting')->software_name); ?> | <?php echo e(config('setting')->software_description); ?>"/>
    <meta property="og:description" content="<?php echo e(config('setting')->software_description); ?>"/>
    <meta property="og:url" content="<?php echo e(url()->current()); ?>"/>
    <meta property="og:site_name" content="<?php echo e(config('setting')->software_name); ?>"/>
    <meta property="og:image" content="<?php echo e(asset('storage/' . config('setting')->software_logo_white)); ?>"/>
    <meta property="og:image:secure_url" content="<?php echo e(asset('storage/' . config('setting')->software_logo_white)); ?>"/>
    <meta property="og:image:width" content="1024"/>
    <meta property="og:image:height" content="571"/>

    <meta name="twitter:title" content="<?php echo e(config('setting')->software_name); ?>">
    <meta name="twitter:description" content="<?php echo e(config('setting')->software_description); ?>">
    <meta name="twitter:image"
          content="<?php echo e(asset('storage/' . config('setting')->software_logo_white)); ?>"> <!-- Substitua pelo link da imagem que deseja exibir -->
    <meta name="twitter:url" content="<?php echo e(url('/')); ?>"> <!-- Substitua pelo link da sua página -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/splide-core.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo $__env->make('includes.navbar_left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="page__content">
            <?php echo $__env->make('includes.navbar_top', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <section class="modelo-destaque-jogos">
                <?php if(config('setting')->promo_banner): ?>
                    <section id="image-carousel" class="splide" aria-label="">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <a href="https://<?php echo e(config('setting')->promo_link); ?>">
                                        <img src="<?php echo e(asset('storage/' . config('setting')->promo_banner)); ?>"
                                             alt="Banner Promocional">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </section>
                <?php endif; ?>
                <?php if(count($gamesPopulars) > 0): ?>
                    <?php echo $__env->make('includes.title', ['link' => url('/games?tab=popular'), 'title' => 'Populares', 'icon' => 'fa-duotone fa-stars'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="row mt-3">
                        <?php $__currentLoopData = $gamesPopulars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 caixa-loop-elementos">
                                <a href="<?php echo e(route('web.game.index', ['slug' => $game->slug])); ?>"
                                   class="inner-loop-elementos">
                                    <img src="<?php echo e(asset('storage/'.$game->image)); ?>" alt="<?php echo e($game->name); ?>"
                                         class="img-fluid rounded-3">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>


                <?php if(count($gamesSuggestions) > 0): ?>
                    <?php echo $__env->make('includes.title', ['link' => '#', 'title' => 'Suggestões', 'icon' => 'fa-duotone fa-bolt'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="row mt-3">
                        <?php $__currentLoopData = $gamesSuggestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 caixa-loop-elementos">
                                <a href="<?php echo e(route('web.game.index', ['slug' => $game->slug])); ?>"
                                   class="inner-loop-elementos">
                                    <img src="<?php echo e(asset('storage/'.$game->image)); ?>" alt="<?php echo e($game->name); ?>"
                                         class="img-fluid rounded-3">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

                <?php if(count($games) > 0): ?>
                    <?php echo $__env->make('includes.title', ['link' => url('/games?tab=all'), 'title' => 'Todos os Jogos', 'icon' => 'fa-duotone fa-gamepad-modern'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="row mt-3">
                        <?php $__currentLoopData = $games; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $game): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6 caixa-loop-elementos">
                                <a href="<?php echo e(route('web.game.index', ['slug' => $game->slug])); ?>"
                                   class="inner-loop-elementos">
                                    <img src="<?php echo e(asset('storage/'.$game->image)); ?>" alt="<?php echo e($game->name); ?>"
                                         class="img-fluid rounded-3">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </section>

            <div class="mt-5">
                <?php echo $__env->make('includes.title', ['link' => url('painel/affiliates'), 'title' => 'Afiliados', 'icon' => 'fa-light fa-face-tongue-money', 'labelLink' => 'Menu'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <section class="affiliate-block">
                <div class="affiliate-block-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="<?php echo e(asset('/assets/images/business_afiliado.png')); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-8">
                            <div class="affiliate-info my-3">
                                <h1>SAIBA MAIS SOBRE NOSSO <span>PROGRAMA DE AFILIADOS</span></h1>
                                <p>
                                    Trabalhe conosco como afiliado e obtenha lucros significativos por meio de suas
                                    indicações.
                                    Oferecemos condições especiais exclusivas para nossos afiliados.
                                </p>
                                <form action="<?php echo e(route('panel.affiliates.join')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="input-group mb-3 mt-3">
                                        <input type="text" name="email" class="form-control"
                                               placeholder="Digite seu email" aria-label="Seu e-mail"
                                               aria-describedby="affiliate-mail">
                                        <button type="submit" class="input-group-text" id="affiliate-mail"><span
                                                class="mx-2">Enviar agora</span> <i class="fa-solid fa-envelope"></i>
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <div class="mt-5">
                <?php echo $__env->make('includes.title', ['link' => url('como-funciona'), 'title' => 'F.A.Q', 'icon' => 'fa-light fa-circle-info', 'labelLink' => 'Saiba mais'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <?php echo $__env->make('web.home.sections.faq', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/splide.min.js')); ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#image-carousel', {
                arrows: false,
                pagination: false,
                type: 'loop',
                autoplay: 'play',
            }).mount();
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.web', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /app/resources/views/web/home/index.blade.php ENDPATH**/ ?>