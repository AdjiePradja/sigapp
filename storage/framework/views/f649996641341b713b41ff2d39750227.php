<?php
  $items = auth()->user()->isAdmin()
    ? [['dash','Laporan'], ['approve','Persetujuan'], ['profil','Profil']]
    : [['home','Beranda'], ['lapor','Lapor'], ['darurat','Darurat','emg'], ['dash','Riwayat'], ['profil','Profil']];
?>
<nav class="nav">
  <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <button type="button" class="<?php echo e(($item[2] ?? null) === 'emg' ? 'emg-tab' : ''); ?> <?php echo e(request()->routeIs($item[0]) ? 'on' : ''); ?>"
      onclick="window.location='<?php echo e(route($item[0])); ?>'"><?php echo e($item[1]); ?></button>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</nav>
<?php /**PATH C:\xampp\htdocs\sigap\resources\views/partials/nav.blade.php ENDPATH**/ ?>