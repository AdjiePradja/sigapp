<?php $__env->startSection('content'); ?>
<?php $u = auth()->user(); ?>
<div class="sec"><span class="kode">A</span><span class="jdl">Identitas</span></div>
<div class="card">
  <div class="kv"><span>Nama</span><b><?php echo e($u->name); ?></b></div>
  <div class="kv"><span>Username</span><b class="mono">{{ $u->username }}</b></div>
  <div class="kv"><span>Departemen</span><b><?php echo e($u->dept); ?></b></div>
  <div class="kv"><span>Peran</span><b><?php echo e($u->isAdmin() ? 'Admin HSE' : 'Pekerja'); ?></b></div>
</div>

<div class="sec"><span class="kode">B</span><span class="jdl">Kontribusi K3</span></div>
<div class="stats">
  <div class="stat"><div class="n"><?php echo e($total); ?></div><div class="l">Laporan</div></div>
  <div class="stat done"><div class="n"><?php echo e($closed); ?></div><div class="l">Selesai</div></div>
  <div class="stat"><div class="n"><?php echo e($poin); ?></div><div class="l">Poin K3</div></div>
</div>

<form method="POST" action="<?php echo e(route('logout')); ?>" style="margin-top:22px">
  <?php echo csrf_field(); ?>
  <button class="btn btn-ghost" type="submit">Keluar dari akun</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sigap\resources\views/profil.blade.php ENDPATH**/ ?>