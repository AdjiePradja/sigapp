<?php $toast = session('toast'); ?>
<div class="toast <?php if($toast): ?> show <?php endif; ?>" id="toast"><?php echo e($toast); ?></div>
<?php if($toast): ?>
<script>
  setTimeout(()=>{ const t=document.getElementById('toast'); if(t) t.classList.remove('show'); }, 2800);
</script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sigap\resources\views/partials/toast.blade.php ENDPATH**/ ?>