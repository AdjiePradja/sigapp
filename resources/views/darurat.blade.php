@extends('layouts.app')

@section('content')
<div class="estop-wrap">
  <button type="button" class="estop" onclick="askEmergency()" aria-label="Kirim sinyal darurat">
    <span class="big">DARURAT</span>
    <span class="small">TEKAN &amp; KONFIRMASI</span>
  </button>
  <p class="estop-hint">Koordinat GPS dan identitas pelapor dikirim seketika ke Admin / Tim Tanggap Darurat.</p>
</div>

<div class="sec"><span class="kode">K</span><span class="jdl">Kontak darurat site</span></div>
<div class="card">
  <div class="kv"><span>ERT / Klinik Site</span><b class="mono">Radio ch. 3 · ext. 911</b></div>
  <div class="kv"><span>Pengawas HSE Shift</span><b class="mono">Radio ch. 1 · ext. 100</b></div>
</div>

<form method="POST" action="{{ route('darurat.store') }}" id="form-emg">
  @csrf
  <input type="hidden" name="gps_lat" id="e-gps-lat">
  <input type="hidden" name="gps_lng" id="e-gps-lng">
  <input type="hidden" name="gps_acc" id="e-gps-acc">
</form>

<div class="overlay" id="emg-modal">
  <div class="modal">
    <h3>Kirim sinyal darurat?</h3>
    <p>Koordinat GPS dan identitasmu akan dikirim ke Admin / ERT sekarang juga.</p>
    <button class="btn btn-red" id="btn-emg" type="button" onclick="fireEmergency()">Ya, kirim sekarang</button>
    <button class="btn btn-ghost" type="button" onclick="closeModal()">Batal</button>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function askEmergency(){ document.getElementById('emg-modal').classList.add('show'); }
  function closeModal(){ document.getElementById('emg-modal').classList.remove('show'); }
  function fireEmergency(){
    const b=document.getElementById('btn-emg'); b.innerHTML='<span class="spin"></span>Mengambil GPS'; b.disabled=true;
    const send=(g)=>{
      if(g){
        document.getElementById('e-gps-lat').value=g.lat;
        document.getElementById('e-gps-lng').value=g.lng;
        document.getElementById('e-gps-acc').value=g.acc;
      }
      document.getElementById('form-emg').submit();
    };
    if(('geolocation' in navigator) && window.isSecureContext){
      navigator.geolocation.getCurrentPosition(
        p=>send({lat:+p.coords.latitude.toFixed(6),lng:+p.coords.longitude.toFixed(6),acc:Math.round(p.coords.accuracy)}),
        ()=>send(null), {enableHighAccuracy:true, timeout:8000});
    } else send(null);
  }
</script>
@endsection
