<nav id="navbarContent" class="page__navbar">
    <div class="page__navbar__logo">
        <a class="page__navbar__logo" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(asset('storage/' . config('setting')->software_logo_white)); ?>" alt="" style="max-width:100%">
        </a>

        <button class="navbar-toggler-close close-button" type="button">
            <i class="fa-regular fa-circle-xmark"></i>
        </button>
    </div>
    <div class="navbar_menu_list">
        <ul class="navbar_list">
            <li class="navbar_list_links">
                <a href="<?php echo e(url('/')); ?>" title="Como funciona?">
                    <i class="fa-solid fa-house fa-xl mr-2"></i>
                    Visão geral
                </a>
            </li>
            <li class="navbar_list_links">
                <a href="<?php echo e(url('painel/affiliates')); ?>" title="Menu de Afiliado">
                    <i class="fa-solid fa-bullhorn fa-xl mr-2"></i>
                    Menu de Afiliado
                </a>
            </li>

            <div class="mt-5 navbar_menu_title">
                <h4>CATEGORIAS</h4>
            </div>

            <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="navbar_list_links">
                    <a href="<?php echo e(route('web.category.index', ['slug' => $category->slug])); ?>" title="<?php echo e($category->name); ?>">
                        <i class="<?php echo e($category->image); ?> fa-xl mr-2"></i>
                        <?php echo e($category->name); ?>

                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="mt-5 navbar_menu_title">
                <h4>INFORMAÇÕES</h4>
            </div>

            <li class="navbar_list_links">
                <a href="<?php echo e(url('/como-funciona')); ?>" title="Como funciona?">
                    <i class="fa-solid fa-circle-question fa-xl mr-2"></i>
                    Como funciona?
                </a>
            </li>
            <li class="navbar_list_links">
                <a href="<?php echo e(url('/sobre-nos')); ?>" title="Sobre Nós">
                    <i class="fa-solid fa-circle-info fa-xl mr-2"></i>
                    Sobre Nós
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH /app/resources/views/includes/navbar_left.blade.php ENDPATH**/ ?>