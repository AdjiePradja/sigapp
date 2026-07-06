<?php $__env->startSection('content'); ?>
<div class="sec"><span class="kode">A</span><span class="jdl">Ringkasan</span><span class="kanan"><?php echo e(now()->translatedFormat('d/m/Y')); ?></span></div>
<div class="stats">
  <div class="stat open"><div class="n"><?php echo e($stats['open']); ?></div><div class="l">Terbuka</div></div>
  <div class="stat prog"><div class="n"><?php echo e($stats['prog']); ?></div><div class="l">Ditangani</div></div>
  <div class="stat done"><div class="n"><?php echo e($stats['done']); ?></div><div class="l">Selesai</div></div>
</div>

<div class="sec"><span class="kode">B</span><span class="jdl">Aksi cepat</span></div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:9px">
  <a class="btn btn-red" href="<?php echo e(route('lapor')); ?>">Lapor hazard</a>
  <a class="btn btn-ghost" href="<?php echo e(route('darurat')); ?>">Darurat</a>
</div>

<div class="sec"><span class="kode">C</span><span class="jdl">Laporan saya</span></div>
<?php $__empty_1 = true; $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <?php echo $__env->make('partials.report-card', ['report' => $r, 'admin' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <div class="empty">Belum ada laporan. Jadilah mata K3 pertama hari ini.</div>
<?php endif; ?>

<div class="note"><b>Pasang di layar utama.</b> Android: Chrome, menu, "Install aplikasi". iPhone: Safari, Bagikan, "Add to Home Screen".</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sigap\resources\views/home.blade.php ENDPATH**/ ?>