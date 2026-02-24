@extends('layouts.admin')

@section('title', 'Заявки - Адмін')

@section('content')
<div style="padding:20px 0;">
    <h1 style="margin-bottom:30px;">Заявки на підбір</h1>

    <div class="card">
        @if($leads->count() > 0)
            @foreach($leads as $lead)
                <div style="padding:16px 0;border-bottom:1px solid rgba(255,255,255,.1);">
                    <div style="display:flex;justify-content:space-between;">
                        <div>
                            <div style="font-weight:900;">
                                {{ $lead->name }}
                                @if(is_array($lead->answers) && ($lead->answers['type'] ?? '') === 'quick_order')
                                    <span style="background:#c8a355;color:#111;padding:2px 8px;border-radius:4px;font-size:12px;margin-left:8px;">⚡ Швидке замовлення</span>
                                @endif
                            </div>
                            <div style="color:rgba(255,255,255,.65);font-size:14px;">{{ $lead->phone }}</div>
                            @if(is_array($lead->answers) && ($lead->answers['type'] ?? '') === 'quick_order')
                                <div style="color:#c8a355;font-size:13px;margin-top:4px;">
                                    {{ $lead->answers['product_name'] ?? '' }} — {{ number_format($lead->answers['product_price'] ?? 0, 0, '.', ' ') }} грн
                                </div>
                            @endif
                        </div>
                        <div style="text-align:right;">
                            <div>{{ $lead->status }}</div>
                            <div style="font-size:14px;color:rgba(255,255,255,.65);">{{ $lead->created_at->format('d.m.Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align:center;padding:40px;color:rgba(255,255,255,.65);">Заявок поки немає</p>
        @endif

        <div style="margin-top:20px;">
            {{ $leads->links() }}
        </div>
    </div>
</div>
@endsection
