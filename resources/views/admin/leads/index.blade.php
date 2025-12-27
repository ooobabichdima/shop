@extends('layouts.app')

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
                            <div style="font-weight:900;">{{ $lead->name }}</div>
                            <div style="color:rgba(255,255,255,.65);font-size:14px;">{{ $lead->phone }}</div>
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
