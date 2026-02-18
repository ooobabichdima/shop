@extends('layouts.admin')

@section('title', 'SEO налаштування сторінок')

@section('content')
<div style="padding:20px 0;">
    <div style="margin-bottom:30px;">
        <h1 style="margin:0;">🔍 SEO налаштування сторінок</h1>
        <p style="color:var(--muted);margin-top:8px;">Керування мета-тегами для головних сторінок сайту</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="card" style="padding:0;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:rgba(255,255,255,.04);border-bottom:1px solid rgba(255,255,255,.12);">
                    <th style="padding:14px 16px;text-align:left;font-weight:700;font-size:13px;color:var(--muted);">Сторінка</th>
                    <th style="padding:14px 16px;text-align:left;font-weight:700;font-size:13px;color:var(--muted);">Meta Title</th>
                    <th style="padding:14px 16px;text-align:left;font-weight:700;font-size:13px;color:var(--muted);">Meta Description</th>
                    <th style="padding:14px 16px;text-align:left;font-weight:700;font-size:13px;color:var(--muted);">Статус</th>
                    <th style="padding:14px 16px;text-align:right;font-weight:700;font-size:13px;color:var(--muted);">Дії</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
                    <td style="padding:14px 16px;">
                        <div style="font-weight:700;">{{ $page->page_name }}</div>
                        <div style="color:var(--muted);font-size:12px;margin-top:2px;">/{{ $page->page_key }}</div>
                    </td>
                    <td style="padding:14px 16px;">
                        <div style="font-size:13px;max-width:300px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $page->meta_title ?: '—' }}
                        </div>
                    </td>
                    <td style="padding:14px 16px;">
                        <div style="font-size:13px;color:var(--muted);max-width:350px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $page->meta_description ? Str::limit($page->meta_description, 80) : '—' }}
                        </div>
                    </td>
                    <td style="padding:14px 16px;">
                        @if($page->is_active)
                        <span style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:999px;
                            background:rgba(88,255,122,.14);border:1px solid rgba(88,255,122,.24);color:rgba(255,255,255,.92);font-size:11px;font-weight:700;">
                            ● Активна
                        </span>
                        @else
                        <span style="display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border-radius:999px;
                            background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.14);color:var(--muted);font-size:11px;font-weight:700;">
                            ● Неактивна
                        </span>
                        @endif
                    </td>
                    <td style="padding:14px 16px;text-align:right;">
                        <a href="{{ route('admin.seo.edit', $page) }}" class="btn small">
                            ✏️ Редагувати
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:40px;text-align:center;color:var(--muted);">
                        SEO сторінок не знайдено
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;padding:16px;border-radius:14px;background:rgba(56,189,248,.1);border:1px solid rgba(56,189,248,.3);">
        <div style="color:rgba(56,189,248,.95);font-weight:700;margin-bottom:6px;">💡 Про SEO налаштування</div>
        <div style="color:rgba(255,255,255,.85);font-size:13px;line-height:1.6;">
            Тут ви можете налаштувати мета-теги для головних сторінок сайту.
            Для категорій та товарів SEO налаштування знаходяться в їх формах редагування.
        </div>
    </div>
</div>
@endsection
