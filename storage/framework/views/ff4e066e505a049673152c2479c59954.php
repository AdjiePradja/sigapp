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

<div class="auth-wrap">
  <div class="auth-mast">
    <div class="bar">
      <div class="b1">SIGAP</div>
      <div class="b2">Sistem Pelaporan Bahaya &amp; Tanggap Darurat – Site PPA</div>
    </div>
    <div class="auth-body">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </div>
  <div class="hint-cred">akun uji &nbsp;·&nbsp; admin/admin (Admin HSE) &nbsp;·&nbsp; jamal/jamal (Pekerja)</div>
</div>

<?php echo $__env->make('partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\sigap\resources\views/layouts/auth.blade.php ENDPATH**/ ?>