<div class="footer">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="footer-info">
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">

            <div class="footer-right">

                <div class="footer-social">
                    <div class="row">
                        <div class="col">
                            <a href="https://www.instagram.com/<?php echo e($instagram); ?>" target="_blank">
                                <img src="<?php echo e(asset('/assets/images/social/instagram.png')); ?>" alt="Instagram">
                            </a>
                        </div>
                        <div class="col">
                            <a href="https://api.whatsapp.com/send?phone=<?php echo e($whatsapp); ?>" target="_blank">
                                <img src="<?php echo e(asset('/assets/images/social/whats.png')); ?>" alt="Whatsapp ">
                            </a>
                        </div>
                    </div>
                </div>
                ©<?php echo e(date('Y')); ?> <?php echo e(env('APP_NAME')); ?> TODOS OS DIREITOS RESERVADOS
            </div>
        </div>
    </div>

</div>



<?php /**PATH /Users/hlspablo/code/cassino/resources/views/includes/footer.blade.php ENDPATH**/ ?>