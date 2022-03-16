@php
    use App\Models\Broker;
    /** @var Broker $broker */
@endphp
<div class="broker">
    <p style="font-weight: bold">{{ $broker->name }}</p>
    <div>Overall score: <span style="font-weight: bold">{{ $broker->overallScore }}</span></div>
    <div>InActivity Fee: <span style="font-weight: bold">{{ $broker->hasInactivityFee ? 'True' : 'False' }}</span></div>
    <div>Last reviewed: {{ $broker->reviewDate->format('Y-M-d') }}</div>
</div>
