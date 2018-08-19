
<div class="row">
    <div class="col-12">
        <?php if((isset($errors) && count($errors)) || \App\Classes\Session::has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>
                    <?php if(\App\Classes\Session::has('error')): ?>
                        <?php echo e(\App\Classes\Session::flash('error')); ?>

                    <?php else: ?>
                        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($error); ?> <br />
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if(isset($success) || \App\Classes\Session::has('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    <?php if(isset($success)): ?>
                            <?php echo e($success); ?>

                    <?php elseif(\App\Classes\Session::has('success')): ?>
                        <?php echo e(\App\Classes\Session::flash('success')); ?>

                    <?php endif; ?>
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
    </div>

</div>