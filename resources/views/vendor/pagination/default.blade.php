@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" style="display:flex;align-items:center;justify-content:space-between;gap:16px;margin-top:32px;flex-wrap:wrap;">
        <div style="flex:1;display:flex;justify-content:flex-start;">
            @if ($paginator->onFirstPage())
                <span style="padding:10px 16px;border-radius:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:var(--muted);cursor:not-allowed;">
                    &laquo; Попередня
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="padding:10px 16px;border-radius:12px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);color:var(--text);text-decoration:none;transition:all .2s ease;">
                    &laquo; Попередня
                </a>
            @endif
        </div>

        <div style="flex:1;text-align:center;">
            <span style="color:var(--muted);font-size:14px;">
                Показано з <strong>{{ $paginator->firstItem() }}</strong> по <strong>{{ $paginator->lastItem() }}</strong> з <strong>{{ $paginator->total() }}</strong>
            </span>
        </div>

        <div style="flex:1;display:flex;justify-content:flex-end;">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="padding:10px 16px;border-radius:12px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);color:var(--text);text-decoration:none;transition:all .2s ease;">
                    Наступна &raquo;
                </a>
            @else
                <span style="padding:10px 16px;border-radius:12px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:var(--muted);cursor:not-allowed;">
                    Наступна &raquo;
                </span>
            @endif
        </div>
    </nav>

    @if ($paginator->lastPage() > 1)
    <div style="display:flex;align-items:center;justify-content:center;gap:8px;margin-top:16px;flex-wrap:wrap;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="width:40px;height:40px;display:grid;place-items:center;border-radius:10px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:var(--muted);cursor:not-allowed;">
                &lsaquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="width:40px;height:40px;display:grid;place-items:center;border-radius:10px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);color:var(--text);text-decoration:none;transition:all .2s ease;">
                &lsaquo;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="width:40px;height:40px;display:grid;place-items:center;color:var(--muted);">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" style="width:40px;height:40px;display:grid;place-items:center;border-radius:10px;background:var(--accent);border:1px solid var(--accent);color:#000;font-weight:700;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" style="width:40px;height:40px;display:grid;place-items:center;border-radius:10px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);color:var(--text);text-decoration:none;transition:all .2s ease;">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" style="width:40px;height:40px;display:grid;place-items:center;border-radius:10px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);color:var(--text);text-decoration:none;transition:all .2s ease;">
                &rsaquo;
            </a>
        @else
            <span style="width:40px;height:40px;display:grid;place-items:center;border-radius:10px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);color:var(--muted);cursor:not-allowed;">
                &rsaquo;
            </span>
        @endif
    </div>
    @endif
@endif
