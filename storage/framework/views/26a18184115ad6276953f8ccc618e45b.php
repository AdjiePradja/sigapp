<?php $__env->startSection('content'); ?>
<?php $admin = auth()->user()->isAdmin(); ?>
<div class="sec">
  <span class="kode">A</span>
  <span class="jdl"><?php echo e($admin ? 'Laporan masuk' : 'Riwayat laporan saya'); ?></span>
  <span class="kanan"><?php echo e(now()->translatedFormat('d/m/Y')); ?></span>
</div>

<?php if($admin): ?>
<div class="stats" style="margin-bottom:16px">
  <div class="stat open"><div class="n"><?php echo e($stats['open']); ?></div><div class="l">Terbuka</div></div>
  <div class="stat prog"><div class="n"><?php echo e($stats['prog']); ?></div><div class="l">Ditangani</div></div>
  <div class="stat done"><div class="n"><?php echo e($stats['done']); ?></div><div class="l">Selesai</div></div>
</div>
<?php endif; ?>

<?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <?php echo $__env->make('partials.report-card', ['report' => $r, 'admin' => $admin], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <div class="empty"><?php echo e($admin ? 'Belum ada laporan masuk.' : 'Riwayat laporanmu akan tercatat di sini.'); ?></div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sigap\resources\views/dash.blade.php ENDPATH**/ ?>