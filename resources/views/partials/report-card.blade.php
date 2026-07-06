@php
  $tags = ['open' => 't-open', 'prog' => 't-prog', 'done' => 't-done'];
  $labels = ['open' => 'Terbuka', 'prog' => 'Ditangani', 'done' => 'Selesai'];
@endphp
<div class="report {{ $report->type === 'emg' ? 'emg' : '' }}">
  <div class="head">
    <span class="rid">{{ $report->no }}</span>
    @if($report->type === 'emg')
      <span class="tag t-emg">Darurat</span>
    @else
      <span class="tag {{ $tags[$report->status] }}">{{ $labels[$report->status] }}</span>
    @endif
  </div>
  <div class="body">
    <div class="cat-t">{{ $report->category }}</div>
    <div class="meta">{{ $report->location }} · {{ $report->user->name }} · {{ $report->created_at->translatedFormat('d/m H:i') }}</div>
    <div class="desc">{{ $report->description }}</div>
    @if($report->photo)
      <img class="ph" src="{{ \Illuminate\Support\Facades\Storage::url($report->photo) }}" alt="Foto laporan">
    @endif
    @if($report->gps_lat && $report->gps_lng)
      <div class="gps">GPS {{ $report->gps_lat }}, {{ $report->gps_lng }}{{ $report->gps_acc ? ' (±'.$report->gps_acc.' m)' : '' }}{{ $report->gps_manual ? ' [manual]' : '' }} ·
        <a href="https://maps.google.com/?q={{ $report->gps_lat }},{{ $report->gps_lng }}" target="_blank" rel="noopener">buka di Maps</a>
      </div>
    @endif
    @if($admin && $report->status !== 'done')
      <div class="actions">
        @if($report->status === 'open')
          <form method="POST" action="{{ route('reports.status', $report) }}">
            @csrf
            <input type="hidden" name="status" value="prog">
            <button class="btn btn-amber btn-sm" type="submit">Tangani</button>
          </form>
        @endif
        <form method="POST" action="{{ route('reports.status', $report) }}">
          @csrf
          <input type="hidden" name="status" value="done">
          <button class="btn btn-green btn-sm" type="submit">Tandai selesai</button>
        </form>
      </div>
    @endif
  </div>
</div>
