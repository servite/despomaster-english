<div class="small">
    <div title="{{ $order->client->name }}">
        {{ Str::limit($order->client->name, 11) }}
    </div>
    <div class="margin-t-10">
        @if($order->status == 'canceled')
            <strong>Storno</strong>
        @else
            <i class="fa fa-clock-o"></i> {{ Date::format($order->start_time, 'time') }} Uhr
        @endif
        @if($order->pivot->sent)
            <i style="position:absolute;top:10px;right:10px;" class="fa fa-paper-plane" title="Versandt am  {{ Date::format($order->pivot->sent) }} Uhr von {{ $order->pivot->sent_by }}"></i>
        @endif
    </div>
</div>