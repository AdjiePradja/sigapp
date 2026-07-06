<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e(route('lapor.store')); ?>" enctype="multipart/form-data" id="form-lapor">
  <?php echo csrf_field(); ?>
  <div class="sec"><span class="kode">A</span><span class="jdl">Kategori bahaya</span><span class="kanan">pilih satu</span></div>
  <div class="cat-grid" id="cats">
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <button type="button" class="cat" data-cat="<?php echo e($c); ?>"><?php echo e($c); ?></button>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <input type="hidden" name="category" id="f-category" value="<?php echo e(old('category')); ?>">

  <div class="sec"><span class="kode">B</span><span class="jdl">Lokasi</span></div>
  <label class="f" for="f-lok">Area kerja</label>
  <select id="f-lok" name="location">
    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option <?php if(old('location') === $l): echo 'selected'; endif; ?>><?php echo e($l); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>

  <label class="f">Koordinat GPS</label>
  <div class="gps-box" id="gps-box">
    <span class="st" id="gps-st">belum terkunci</span>
    <button class="btn btn-ghost btn-sm" type="button" style="margin-left:auto" onclick="lockGPS()">Kunci GPS</button>
  </div>
  <div class="gps-manual" id="gps-manual">
    <input type="text" id="mn-lat" placeholder="lat, mis. -1.2431" inputmode="decimal">
    <input type="text" id="mn-lng" placeholder="lng, mis. 116.8520" inputmode="decimal">
    <button class="btn btn-ghost btn-sm" type="button" onclick="manualGPS()">Pakai</button>
  </div>
  <input type="hidden" name="gps_lat" id="f-gps-lat">
  <input type="hidden" name="gps_lng" id="f-gps-lng">
  <input type="hidden" name="gps_acc" id="f-gps-acc">
  <input type="hidden" name="gps_manual" id="f-gps-manual" value="0">

  <div class="sec"><span class="kode">C</span><span class="jdl">Bukti &amp; uraian</span></div>
  <label class="f">Foto kondisi</label>
  <input type="file" id="f-photo" name="photo" accept="image/*" capture="environment" style="display:none" onchange="photoPicked(this)">
  <div class="photo-drop" id="photo-drop" onclick="document.getElementById('f-photo').click()">Ketuk untuk ambil foto – kamera</div>
  <label class="f" for="f-desc">Uraian singkat</label>
  <textarea id="f-desc" name="description" placeholder="Contoh: Tanggul jalan hauling KM 3 tergerus air, lebar efektif berkurang."><?php echo e(old('description')); ?></textarea>

  <?php if($errors->any()): ?>
    <div class="err-box"><?php echo e($errors->first()); ?></div>
  <?php endif; ?>

  <div style="margin-top:20px">
    <button class="btn btn-red" id="btn-kirim" type="submit">Kirim ke Admin HSE</button>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
  let selCat = document.getElementById('f-category').value || null;
  document.querySelectorAll('#cats .cat').forEach(b=>{
    if (b.dataset.cat === selCat) b.classList.add('sel');
    b.addEventListener('click', ()=>{
      selCat = b.dataset.cat;
      document.getElementById('f-category').value = selCat;
      document.querySelectorAll('#cats .cat').forEach(x=>x.classList.toggle('sel', x===b));
    });
  });

  function gpsFail(msg){
    const box=document.getElementById('gps-box');
    box.className='gps-box err';
    document.getElementById('gps-st').textContent=msg;
    document.getElementById('gps-manual').classList.add('show');
  }
  function lockGPS(){
    const box=document.getElementById('gps-box'), st=document.getElementById('gps-st');
    if(!('geolocation' in navigator)){ gpsFail('browser tidak mendukung geolokasi – isi manual di bawah'); return; }
    if(!window.isSecureContext){ gpsFail('halaman bukan HTTPS – GPS diblokir browser. Isi manual di bawah'); return; }
    box.className='gps-box'; st.textContent='mencari sinyal…';
    navigator.geolocation.getCurrentPosition(
      p=>{
        const lat=(+p.coords.latitude.toFixed(6)), lng=(+p.coords.longitude.toFixed(6)), acc=Math.round(p.coords.accuracy);
        box.className='gps-box ok'; st.textContent=`terkunci ${lat}, ${lng} (±${acc} m)`;
        document.getElementById('gps-manual').classList.remove('show');
        document.getElementById('f-gps-lat').value=lat;
        document.getElementById('f-gps-lng').value=lng;
        document.getElementById('f-gps-acc').value=acc;
        document.getElementById('f-gps-manual').value='0';
      },
      e=>{
        if(e.code===1) gpsFail('izin lokasi ditolak (atau diblokir sandbox pratinjau) – isi manual di bawah');
        else if(e.code===2) gpsFail('posisi tidak tersedia – coba di area terbuka, atau isi manual');
        else gpsFail('waktu habis mencari sinyal – coba lagi atau isi manual');
      },
      {enableHighAccuracy:true, timeout:12000}
    );
  }
  function manualGPS(){
    const lat=parseFloat(document.getElementById('mn-lat').value), lng=parseFloat(document.getElementById('mn-lng').value);
    if(isNaN(lat)||isNaN(lng)||lat<-90||lat>90||lng<-180||lng>180){ alert('Koordinat tidak valid'); return; }
    const box=document.getElementById('gps-box');
    box.className='gps-box ok';
    document.getElementById('gps-st').textContent=`manual ${lat}, ${lng}`;
    document.getElementById('gps-manual').classList.remove('show');
    document.getElementById('f-gps-lat').value=lat;
    document.getElementById('f-gps-lng').value=lng;
    document.getElementById('f-gps-acc').value='';
    document.getElementById('f-gps-manual').value='1';
  }

  function photoPicked(inp){
    const f=inp.files[0]; if(!f) return;
    const img=new Image();
    img.onload=()=>{
      document.getElementById('photo-drop').innerHTML=`<img src="${img.src}" alt="Foto kondisi">`;
    };
    img.src=URL.createObjectURL(f);
  }

  document.getElementById('form-lapor').addEventListener('submit', function(e){
    if(!selCat){ e.preventDefault(); alert('Pilih kategori bahaya dulu'); }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\sigap\resources\views/lapor.blade.php ENDPATH**/ ?>