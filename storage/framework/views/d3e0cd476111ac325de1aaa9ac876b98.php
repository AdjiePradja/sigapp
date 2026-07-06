<?php
  $tags = ['open' => 't-open', 'prog' => 't-prog', 'done' => 't-done'];
  $labels = ['open' => 'Terbuka', 'prog' => 'Ditangani', 'done' => 'Selesai'];
?>
<div class="report <?php echo e($report->type === 'emg' ? 'emg' : ''); ?>">
  <div class="head">
    <span class="rid"><?php echo e($report->no); ?></span>
    <?php if($report->type === 'emg'): ?>
      <span class="tag t-emg">Darurat</span>
    <?php else: ?>
      <span class="tag <?php echo e($tags[$report->status]); ?>"><?php echo e($labels[$report->status]); ?></span>
    <?php endif; ?>
  </div>
  <div class="body">
    <div class="cat-t"><?php echo e($report->category); ?></div>
    <div class="meta"><?php echo e($report->location); ?> · <?php echo e($report->user->name); ?> · <?php echo e($report->created_at->translatedFormat('d/m H:i')); ?></div>
    <div class="desc"><?php echo e($report->description); ?></div>
    <?php if($report->photo): ?>
      <img class="ph" src="<?php echo e(\Illuminate\Support\Facades\Storage::url($report->photo)); ?>" alt="Foto laporan">
    <?php endif; ?>
    <?php if($report->gps_lat && $report->gps_lng): ?>
      <div class="gps">GPS <?php echo e($report->gps_lat); ?>, <?php echo e($report->gps_lng); ?><?php echo e($report->gps_acc ? ' (±'.$report->gps_acc.' m)' : ''); ?><?php echo e($report->gps_manual ? ' [manual]' : ''); ?> ·
        <a href="https://maps.google.com/?q=<?php echo e($report->gps_lat); ?>,<?php echo e($report->gps_lng); ?>" target="_blank" rel="noopener">buka di Maps</a>
      </div>
    <?php endif; ?>
    <?php if($admin && $report->status !== 'done'): ?>
      <div class="actions">
        <?php if($report->status === 'open'): ?>
          <form method="POST" action="<?php echo e(route('reports.status', $report)); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="status" value="prog">
            <button class="btn btn-amber btn-sm" type="submit">Tangani</button>
          </form>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('reports.status', $report)); ?>">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="status" value="done">
          <button class="btn btn-green btn-sm" type="submit">Tandai selesai</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php /**PATH C:\xampp\htdocs\sigap\resources\views/partials/report-card.blade.php ENDPATH**/ ?>