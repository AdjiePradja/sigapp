<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('register.attempt')); ?>">
  <?php echo csrf_field(); ?>
  <label class="f" for="rg-nama">Nama lengkap</label>
  <input type="text" id="rg-nama" name="nama" value="<?php echo e(old('nama')); ?>">
  <label class="f" for="rg-dept">Departemen</label>
  <select id="rg-dept" name="dept">
    <?php $__currentLoopData = ['Produksi','Plant / Workshop','HSE','Logistik','HRGA']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option <?php if(old('dept') === $d): echo 'selected'; endif; ?>><?php echo e($d); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <label class="f" for="rg-user">Username</label>
  <input type="text" id="rg-user" name="username" value="<?php echo e(old('username')); ?>" autocomplete="username" autocapitalize="none">
  <label class="f" for="rg-pass">Kata sandi</label>
  <input type="password" id="rg-pass" name="password" autocomplete="new-password">

  <?php if($errors->any()): ?>
    <div class="err-box"><?php echo e($errors->first()); ?></div>
  <?php endif; ?>

  <div style="margin-top:18px"><button class="btn btn-red" type="submit">Ajukan – menunggu persetujuan admin</button></div>
  <div class="auth-switch">Sudah punya akun? <a href="<?php echo e(route('login')); ?>">Masuk</a></div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sigap\resources\views/auth/register.blade.php ENDPATH**/ ?>