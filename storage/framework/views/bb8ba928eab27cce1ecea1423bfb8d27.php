<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#C41E17">
<title>SIGAP – Site PPA</title>
<?php echo $__env->make('partials.style', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>
<body>

<div id="app" style="display:flex;flex-direction:column;min-height:100dvh">
<header>
  <div>
    <div class="t1">SIGAP</div>
    <div class="t2"><?php echo e(auth()->user()->isAdmin() ? 'Panel Admin HSE – Site PPA' : 'Site PPA'); ?></div>
  </div>
  <div class="who"><b><?php echo e(auth()->user()->name); ?></b><br><?php echo e(auth()->user()->isAdmin() ? 'ADMIN HSE' : 'PEKERJA'); ?></div>
</header>
<div class="tape"></div>

<main>
  <section class="screen active">
    <?php echo $__env->yieldContent('content'); ?>
  </section>
</main>

<?php echo $__env->make('partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

<?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<script>
document.querySelectorAll('form[data-confirm]').forEach(f=>{
  f.addEventListener('submit', e=>{ if(!confirm(f.dataset.confirm)) e.preventDefault(); });
});
</script>
<?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\sigap\resources\views/layouts/app.blade.php ENDPATH**/ ?>