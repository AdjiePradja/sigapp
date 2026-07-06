<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('login.attempt')); ?>">
  <?php echo csrf_field(); ?>
  <label class="f" for="li-user">Username / NIK</label>
  <input type="text" id="li-user" name="username" value="<?php echo e(old('username', session('registered_username'))); ?>" autocomplete="username" autocapitalize="none">
  <label class="f" for="li-pass">Kata sandi</label>
  <input type="password" id="li-pass" name="password" autocomplete="current-password">

  <?php if($errors->has('login')): ?>
    <div class="err-box"><?php echo e($errors->first('login')); ?></div>
  <?php endif; ?>

  <div style="margin-top:18px"><button class="btn btn-red" type="submit">Masuk</button></div>
  <div class="auth-switch">Belum punya akun? <a href="<?php echo e(route('register')); ?>">Ajukan pendaftaran</a></div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sigap\resources\views/auth/login.blade.php ENDPATH**/ ?>