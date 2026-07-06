<?php $__env->startSection('content'); ?>
<div class="sec"><span class="kode">A</span><span class="jdl">Menunggu persetujuan</span></div>
<div class="card">
  <?php $__empty_1 = true; $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="userline">
      <div style="flex:1">
        <div class="nm"><?php echo e($u->name); ?></div>
        <div class="un">{{ $u->username }} · <?php echo e($u->dept); ?></div>
      </div>
      <form method="POST" action="<?php echo e(route('approve.approve', $u)); ?>">
        <?php echo csrf_field(); ?>
        <button class="btn btn-green btn-sm" type="submit">Setujui</button>
      </form>
      <form method="POST" action="<?php echo e(route('approve.reject', $u)); ?>">
        <?php echo csrf_field(); ?>
        <button class="btn btn-ghost btn-sm" type="submit">Tolak</button>
      </form>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="empty" style="border:none">Tidak ada pendaftaran baru.</div>
  <?php endif; ?>
</div>

<div class="sec"><span class="kode">B</span><span class="jdl">Pengguna aktif</span></div>
<div class="card">
  <?php $__currentLoopData = $active; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="userline">
      <div style="flex:1">
        <div class="nm"><?php echo e($u->name); ?></div>
        <div class="un">{{ $u->username }} · <?php echo e($u->dept); ?></div>
      </div>
      <span class="tag <?php echo e($u->role === 'admin' ? 't-emg' : 't-done'); ?>"><?php echo e($u->role); ?></span>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sigap\resources\views/approve.blade.php ENDPATH**/ ?>