@php $toast = session('toast'); @endphp
<div class="toast @if($toast) show @endif" id="toast">{{ $toast }}</div>
@if($toast)
<script>
  setTimeout(()=>{ const t=document.getElementById('toast'); if(t) t.classList.remove('show'); }, 2800);
</script>
@endif
