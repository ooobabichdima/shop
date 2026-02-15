<!-- =========================
  CATEGORY PAGE (catalog-category.html)
  Same style as homepage: full HTML + inline CSS + tiny JS
========================= -->
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="theme-color" content="#0b0f14" />
  <title>Приводы AEG — купить страйкбольный привод | Strikeball Shop</title>
  <meta name="description" content="Категория: приводы AEG. Фильтры по платформе, мощности, цене, бренду. Доставка по Украине, гарантия, помощь с подбором." />
  <style>
    :root{
      --bg:#070a0f;--panel:rgba(255,255,255,.06);--panel2:rgba(255,255,255,.08);
      --text:rgba(255,255,255,.92);--muted:rgba(255,255,255,.65);--muted2:rgba(255,255,255,.45);
      --line:rgba(255,255,255,.12);--accent:#58ff7a;--accent2:#22c55e;--danger:#ff4d4d;--warn:#ffcc00;
      --shadow:0 18px 60px rgba(0,0,0,.55);--radius:18px;--radius2:24px;--max:1180px;
      --h1:clamp(26px,3vw,40px);--h2:clamp(20px,2.2vw,30px);--p:15px;
    }
    *{box-sizing:border-box} html,body{height:100%}
    body{
      margin:0; font-family: ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,"Noto Sans","Helvetica Neue",sans-serif;
      background:
        radial-gradient(1200px 600px at 12% -10%, rgba(88,255,122,.22), transparent 60%),
        radial-gradient(900px 500px at 90% 0%, rgba(56,189,248,.18), transparent 60%),
        radial-gradient(900px 500px at 20% 110%, rgba(168,85,247,.14), transparent 65%),
        linear-gradient(180deg, #05070b, #070a0f 20%, #060912);
      color:var(--text); line-height:1.45; overflow-x:hidden;
    }
    a{color:inherit; text-decoration:none}
    button,input,select{font:inherit}
    .container{width:min(var(--max), calc(100% - 32px)); margin:0 auto}
    .grid{display:grid; gap:16px}
    .row{display:flex; align-items:center; gap:12px}
    .btn{
      display:inline-flex; align-items:center; justify-content:center; gap:10px;
      padding:12px 14px; border-radius:14px; border:1px solid rgba(255,255,255,.14);
      background:rgba(255,255,255,.06); color:var(--text); cursor:pointer;
      transition:transform .12s ease, background .12s ease, border-color .12s ease;
      white-space:nowrap;
    }
    .btn:hover{transform:translateY(-1px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.08)}
    .btn.primary{
      background:linear-gradient(180deg, rgba(88,255,122,.95), rgba(34,197,94,.92));
      border-color: rgba(88,255,122,.35); color:#031107; font-weight:800;
      box-shadow:0 16px 40px rgba(34,197,94,.22);
    }
    .btn.small{padding:10px 12px; border-radius:12px; font-size:14px}
    .pill{display:inline-flex; gap:8px; align-items:center; padding:8px 12px; border-radius:999px;
      background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.10); color:var(--muted); font-size:13px}
    .card{
      border-radius:var(--radius); border:1px solid rgba(255,255,255,.12);
      background:rgba(255,255,255,.05); box-shadow:0 10px 30px rgba(0,0,0,.30);
    }

    /* header */
    .topbar{position:sticky; top:0; z-index:50; backdrop-filter:blur(14px); background:rgba(6,9,18,.55); border-bottom:1px solid rgba(255,255,255,.10)}
    .topbar-inner{display:flex; align-items:center; justify-content:space-between; padding:12px 0; gap:16px}
    .brand{display:flex; align-items:center; gap:10px; font-weight:900; letter-spacing:.3px}
    .logo{
      width:34px;height:34px;border-radius:12px; display:grid;place-items:center;color:#04140a;
      background:radial-gradient(16px 16px at 30% 30%, rgba(255,255,255,.20), transparent 60%),
               linear-gradient(180deg, rgba(88,255,122,.95), rgba(34,197,94,.85));
      box-shadow:0 10px 24px rgba(34,197,94,.22); border:1px solid rgba(255,255,255,.22);
    }
    .brand small{display:block; color:var(--muted); font-weight:600; letter-spacing:0}
    .nav{display:flex; align-items:center; gap:10px; color:var(--muted); font-size:14px}
    .nav a{padding:10px 10px;border-radius:12px;border:1px solid transparent}
    .nav a:hover{background:rgba(255,255,255,.06);border-color:rgba(255,255,255,.10);color:var(--text)}
    .search{
      flex:1; display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:16px;
      background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.12); min-width:240px;
    }
    .search input{width:100%; background:transparent; border:none; outline:none; color:var(--text); font-size:14px}
    .search input::placeholder{color:rgba(255,255,255,.45)}
    .actions{display:flex; align-items:center; gap:10px}
    .iconbtn{
      width:42px; height:42px; border-radius:14px; background:rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.12); display:grid; place-items:center; cursor:pointer;
      transition:background .12s ease, transform .12s ease, border-color .12s ease; position:relative;
    }
    .iconbtn:hover{background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.22); transform:translateY(-1px)}
    .badge{position:absolute; top:8px; right:8px; background:linear-gradient(180deg, rgba(255,77,77,.95), rgba(239,68,68,.9));
      border:1px solid rgba(255,255,255,.18); color:#120202; font-weight:900; border-radius:999px; padding:2px 6px; font-size:11px; line-height:1}
    .burger{display:none}
    #mobileMenu{display:none; padding:0 0 14px}

    /* breadcrumbs + header block */
    .crumbs{padding:18px 0 8px; color:rgba(255,255,255,.62); font-size:13px}
    .crumbs a{color:rgba(255,255,255,.72)}
    .crumbs a:hover{color:var(--text)}
    .cat-head{
      padding:16px; border-radius:var(--radius2); border:1px solid rgba(255,255,255,.12);
      background:radial-gradient(700px 240px at 20% 0%, rgba(88,255,122,.18), transparent 60%),
               radial-gradient(520px 220px at 86% 10%, rgba(56,189,248,.14), transparent 55%),
               linear-gradient(180deg, rgba(255,255,255,.06), rgba(255,255,255,.03));
      box-shadow:var(--shadow);
    }
    .cat-head h1{margin:6px 0 6px; font-size:var(--h1); line-height:1.08}
    .cat-head p{margin:0; color:var(--muted); font-size:var(--p); max-width:72ch}
    .cat-head .bar{margin-top:12px; display:flex; gap:10px; flex-wrap:wrap; align-items:center; justify-content:space-between}
    .count{color:rgba(255,255,255,.70); font-size:13px}
    .select{
      padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.14);
      background:rgba(0,0,0,.18); color:var(--text); outline:none;
    }

    /* layout */
    .layout{display:grid; grid-template-columns: 320px 1fr; gap:16px; padding:16px 0 28px}
    .filters{padding:14px}
    .filters h3{margin:0 0 12px; font-size:16px}
    .filters .sec{padding:12px 0; border-top:1px solid rgba(255,255,255,.10)}
    .filters .sec:first-of-type{border-top:none; padding-top:0}
    .filters label{display:flex; gap:10px; align-items:center; color:rgba(255,255,255,.80); font-size:14px; padding:6px 0; cursor:pointer}
    .filters input[type="checkbox"]{width:16px; height:16px; accent-color: var(--accent)}
    .filters .hint{color:var(--muted); font-size:12.5px; margin-top:6px}
    .range{
      display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-top:8px;
    }
    .in{
      width:100%; padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.14);
      background:rgba(0,0,0,.18); color:var(--text); outline:none;
    }
    .chips{display:flex; flex-wrap:wrap; gap:8px; margin-top:8px}
    .chip{
      padding:8px 10px; border-radius:999px; border:1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.05); color:var(--muted); font-size:13px;
    }
    .chip b{color:rgba(255,255,255,.86)}
    .chip button{
      margin-left:6px; border:none; background:transparent; color:rgba(255,255,255,.65); cursor:pointer;
    }
    .chip button:hover{color:var(--text)}
    .toolbar{display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; margin-bottom:10px}
    .view{display:flex; gap:8px}
    .view .iconbtn{width:40px;height:40px;border-radius:14px}

    /* product cards */
    .products{display:grid; grid-template-columns: repeat(3, 1fr); gap:16px}
    .product{
      border-radius:var(--radius); border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05);
      overflow:hidden; display:flex; flex-direction:column; box-shadow:0 10px 30px rgba(0,0,0,.30);
      transition: transform .12s ease, border-color .12s ease, background .12s ease;
    }
    .product:hover{transform:translateY(-2px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.06)}
    .p-top{padding:12px; position:relative}
    .p-badge{
      position:absolute; top:12px; left:12px; display:inline-flex; align-items:center; gap:6px;
      padding:6px 10px; border-radius:999px; font-size:12px; font-weight:900;
      border:1px solid rgba(255,255,255,.16); background:rgba(0,0,0,.35); backdrop-filter:blur(10px);
    }
    .p-badge.sale{border-color:rgba(88,255,122,.25)}
    .p-badge.hot{border-color:rgba(255,204,0,.20)}
    .p-img{
      height:170px; border-radius:14px; border:1px solid rgba(255,255,255,.10);
      background: radial-gradient(120px 120px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                  linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
      display:grid; place-items:center;
    }
    .p-mid{padding:0 12px 12px}
    .p-title{margin:10px 0 6px; font-size:15px; font-weight:780}
    .p-meta{display:flex; gap:10px; flex-wrap:wrap; color:var(--muted); font-size:12.5px}
    .p-bottom{
      margin-top:auto; padding:12px; border-top:1px solid rgba(255,255,255,.10);
      display:flex; align-items:center; justify-content:space-between; gap:10px
    }
    .price{font-weight:950}
    .strike{color:rgba(255,255,255,.45); text-decoration:line-through; font-weight:700; margin-left:8px}
    .star{color:rgba(255,204,0,.9)}
    .pagination{display:flex; gap:8px; justify-content:center; margin-top:14px; flex-wrap:wrap}
    .page{min-width:42px; height:42px; display:grid; place-items:center; border-radius:14px; border:1px solid rgba(255,255,255,.12);
      background:rgba(255,255,255,.05); color:rgba(255,255,255,.85)}
    .page.active{background:rgba(88,255,122,.18); border-color:rgba(88,255,122,.28); color:rgba(255,255,255,.92); font-weight:900}
    .page:hover{background:rgba(255,255,255,.07); border-color:rgba(255,255,255,.20)}
    .footer{
      padding:22px 0 32px; border-top:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.10); margin-top:18px
    }
    .footer-grid{display:grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap:16px}
    .footer-grid h5{margin:0 0 10px; font-size:14px}
    .footer-grid a{color:var(--muted); display:block; padding:6px 0; font-size:13px}
    .footer-grid a:hover{color:var(--text)}
    .copyright{margin-top:18px; display:flex; justify-content:space-between; gap:10px; color:rgba(255,255,255,.55); font-size:12px; flex-wrap:wrap}

    /* responsive */
    @media (max-width: 1040px){
      .layout{grid-template-columns: 1fr}
      .products{grid-template-columns: repeat(2, 1fr)}
    }
    @media (max-width: 980px){
      .nav{display:none}
      .burger{display:inline-flex}
      .search{min-width:0}
      .footer-grid{grid-template-columns:1.6fr 1fr 1fr}
    }
    @media (max-width: 560px){
      .search{display:none}
      .products{grid-template-columns: 1fr}
      .footer-grid{grid-template-columns:1fr 1fr}
    }
    .ico18{width:18px;height:18px}
    .ico20{width:20px;height:20px}
  </style>
</head>
<body>
  <div class="topbar">
    <div class="container">
      <div class="topbar-inner">
        <a class="brand" href="#">
          <span class="logo" aria-hidden="true">
            <svg class="ico18" viewBox="0 0 24 24" fill="none">
              <path d="M12 3c4.8 0 9 3.6 9 9s-4.2 9-9 9-9-3.6-9-9 4.2-9 9-9Z" stroke="#04140a" stroke-width="2"/>
              <path d="M12 7c2.8 0 5 2.2 5 5s-2.2 5-5 5-5-2.2-5-5 2.2-5 5-5Z" stroke="#04140a" stroke-width="2"/>
            </svg>
          </span>
          <span>
            Strikeball Shop
            <small>Каталог • Доставка • Сервис</small>
          </span>
        </a>

        <nav class="nav" aria-label="Основное меню">
          <a href="#">Каталог</a><a href="#">Акции</a><a href="#">Новинки</a><a href="#">Гайды</a><a href="#">Контакты</a>
        </nav>

        <div class="search" role="search" aria-label="Поиск по магазину">
          <svg class="ico18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="rgba(255,255,255,.75)" stroke-width="2"/>
            <path d="M16.5 16.5 21 21" stroke="rgba(255,255,255,.75)" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input id="q" type="search" placeholder="Найти: M4, hop-up, коллиматор…" autocomplete="off" />
        </div>

        <div class="actions">
          <button class="iconbtn burger" id="burger" aria-label="Открыть меню">
            <svg class="ico20" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round"/></svg>
          </button>
          <button class="iconbtn" aria-label="Корзина">
            <span class="badge">2</span>
            <svg class="ico20" viewBox="0 0 24 24" fill="none">
              <path d="M6 7h15l-2 10H7L6 7Z" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linejoin="round"/>
              <path d="M6 7 5 4H2" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
          <a class="btn small" href="#">Войти</a>
        </div>
      </div>

      <div id="mobileMenu">
        <div class="grid" style="gap:10px;">
          <a class="btn" href="#">Каталог</a>
          <a class="btn" href="#">Акции</a>
          <a class="btn" href="#">Новинки</a>
          <a class="btn" href="#">Гайды</a>
          <a class="btn" href="#">Контакты</a>
        </div>
      </div>
    </div>
  </div>

  <main class="container">
    <div class="crumbs">
      <a href="#">Главная</a> / <a href="#">Каталог</a> / <span>Приводы AEG</span>
    </div>

    <div class="cat-head">
      <span class="pill">Категория</span>
      <h1>Приводы AEG</h1>
      <p>Автоматические приводы для CQB/леса: M4, AK, SMG. Фильтруй по платформе, мощности, бренду и бюджету — и сразу увидишь подходящие варианты.</p>

      <div class="bar">
        <div class="count">Найдено: <b>128</b> товаров</div>
        <div class="row" style="flex-wrap:wrap; justify-content:flex-end;">
          <select class="select" aria-label="Сортировка">
            <option>Сортировка: популярные</option>
            <option>Сначала дешевле</option>
            <option>Сначала дороже</option>
            <option>По рейтингу</option>
            <option>Новинки</option>
          </select>
          <a class="btn small primary" href="#">Помочь с подбором</a>
        </div>
      </div>
    </div>

    <div class="layout">
      <!-- FILTERS -->
      <aside class="card filters" aria-label="Фильтры">
        <div class="row" style="justify-content:space-between; align-items:flex-start;">
          <div>
            <h3>Фильтры</h3>
            <div class="hint">Отмечай параметры — листинг обновишь на PHP.</div>
          </div>
          <button class="btn small" id="clearFilters" type="button">Сброс</button>
        </div>

        <div class="sec">
          <b style="display:block; margin-bottom:6px;">Цена, грн</b>
          <div class="range">
            <input class="in" type="number" placeholder="от 3000" />
            <input class="in" type="number" placeholder="до 25000" />
          </div>
          <div class="hint">Подсказка: добавь слайдер позже.</div>
        </div>

        <div class="sec">
          <b style="display:block; margin-bottom:6px;">Платформа</b>
          <label><input type="checkbox" /> M4 / AR</label>
          <label><input type="checkbox" /> AK</label>
          <label><input type="checkbox" /> SMG (MP5/PP-19)</label>
          <label><input type="checkbox" /> DMR / Marksman</label>
        </div>

        <div class="sec">
          <b style="display:block; margin-bottom:6px;">Скорость, м/с</b>
          <label><input type="checkbox" /> до 110 (CQB)</label>
          <label><input type="checkbox" /> 110–130</label>
          <label><input type="checkbox" /> 130+</label>
          <div class="hint">Важно: ориентируйся на лимиты площадок.</div>
        </div>

        <div class="sec">
          <b style="display:block; margin-bottom:6px;">Бренд</b>
          <label><input type="checkbox" /> Specna Arms</label>
          <label><input type="checkbox" /> CYMA</label>
          <label><input type="checkbox" /> G&G</label>
          <label><input type="checkbox" /> E&L / LCT</label>
          <label><input type="checkbox" /> Другие</label>
        </div>

        <div class="sec">
          <b style="display:block; margin-bottom:6px;">Наличие</b>
          <label><input type="checkbox" checked /> В наличии</label>
          <label><input type="checkbox" /> Под заказ</label>
        </div>

        <div class="sec">
          <b style="display:block; margin-bottom:6px;">Активные фильтры</b>
          <div class="chips" id="chips">
            <span class="chip"><b>В наличии</b><button type="button" aria-label="Удалить">×</button></span>
            <span class="chip"><b>M4 / AR</b><button type="button" aria-label="Удалить">×</button></span>
            <span class="chip"><b>до 110</b><button type="button" aria-label="Удалить">×</button></span>
          </div>
        </div>

        <div class="sec">
          <button class="btn primary" style="width:100%;" type="button">Применить</button>
          <div class="hint" style="margin-top:8px;">На проде фильтры работают через GET-параметры.</div>
        </div>
      </aside>

      <!-- LISTING -->
      <section aria-label="Список товаров">
        <div class="toolbar">
          <div class="row" style="flex-wrap:wrap;">
            <span class="pill">Быстрые подборки</span>
            <a class="btn small" href="#">Новичку</a>
            <a class="btn small" href="#">CQB</a>
            <a class="btn small" href="#">Лес</a>
            <a class="btn small" href="#">DMR</a>
          </div>
          <div class="view" aria-label="Вид списка">
            <button class="iconbtn" type="button" aria-label="Сетка (активно)">
              <svg class="ico20" viewBox="0 0 24 24" fill="none"><path d="M4 4h7v7H4V4Zm9 0h7v7h-7V4ZM4 13h7v7H4v-7Zm9 0h7v7h-7v-7Z" stroke="rgba(255,255,255,.85)" stroke-width="2"/></svg>
            </button>
            <button class="iconbtn" type="button" aria-label="Список">
              <svg class="ico20" viewBox="0 0 24 24" fill="none"><path d="M8 6h13M8 12h13M8 18h13" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round"/><path d="M4 6h.01M4 12h.01M4 18h.01" stroke="rgba(255,255,255,.85)" stroke-width="4" stroke-linecap="round"/></svg>
            </button>
          </div>
        </div>

        <div class="products">
          <!-- 1 -->
          <article class="product">
            <div class="p-top">
              <span class="p-badge hot">★ Хит</span>
              <a class="p-img" href="product.html" aria-label="Открыть товар">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" aria-hidden="true">
                  <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="rgba(255,255,255,.92)" stroke-width="3" stroke-linejoin="round"/>
                  <path d="M52 66l-7 18" stroke="rgba(255,255,255,.8)" stroke-width="3" stroke-linecap="round"/>
                  <path d="M72 60l-4 18" stroke="rgba(255,255,255,.8)" stroke-width="3" stroke-linecap="round"/>
                </svg>
              </a>
            </div>
            <div class="p-mid">
              <a class="p-title" href="product.html">AEG M4 (CQB) — базовый комплект</a>
              <div class="p-meta"><span class="star">★★★★★</span> 4.8 • В наличии • SKU: M4-CQB-01</div>
            </div>
            <div class="p-bottom">
              <div class="price">9 990 грн</div>
              <button class="btn small primary" type="button">В корзину</button>
            </div>
          </article>

          <!-- 2 -->
          <article class="product">
            <div class="p-top">
              <span class="p-badge sale">-12%</span>
              <a class="p-img" href="product.html" aria-label="Открыть товар">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" aria-hidden="true">
                  <path d="M18 62h84l-8 22H26l-8-22Z" stroke="rgba(255,255,255,.92)" stroke-width="3" stroke-linejoin="round"/>
                  <path d="M40 62V44h40v18" stroke="rgba(255,255,255,.75)" stroke-width="3" stroke-linejoin="round"/>
                </svg>
              </a>
            </div>
            <div class="p-mid">
              <a class="p-title" href="product.html">AEG AK — усиленная база (лес)</a>
              <div class="p-meta"><span class="star">★★★★☆</span> 4.5 • Осталось: 5 • SKU: AK-FOREST-05</div>
            </div>
            <div class="p-bottom">
              <div class="price">10 490 грн <span class="strike">11 990</span></div>
              <button class="btn small primary" type="button">В корзину</button>
            </div>
          </article>

          <!-- 3 -->
          <article class="product">
            <div class="p-top">
              <span class="p-badge">Новинка</span>
              <a class="p-img" href="product.html" aria-label="Открыть товар">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" aria-hidden="true">
                  <path d="M30 48h60v44H30V48Z" stroke="rgba(255,255,255,.9)" stroke-width="3" stroke-linejoin="round"/>
                  <path d="M45 48V36h30v12" stroke="rgba(255,255,255,.75)" stroke-width="3" stroke-linejoin="round"/>
                </svg>
              </a>
            </div>
            <div class="p-mid">
              <a class="p-title" href="product.html">AEG SMG MP5 — компакт для CQB</a>
              <div class="p-meta"><span class="star">★★★★★</span> 4.9 • В наличии • SKU: MP5-CQB-02</div>
            </div>
            <div class="p-bottom">
              <div class="price">8 990 грн</div>
              <button class="btn small primary" type="button">В корзину</button>
            </div>
          </article>

          <!-- 4 -->
          <article class="product">
            <div class="p-top">
              <span class="p-badge">Рекомендуем</span>
              <a class="p-img" href="product.html" aria-label="Открыть товар">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" aria-hidden="true">
                  <path d="M22 70c16-14 46-22 86-26l4 8-76 18-6 10-8 2Z" stroke="rgba(255,255,255,.92)" stroke-width="3" stroke-linejoin="round"/>
                </svg>
              </a>
            </div>
            <div class="p-mid">
              <a class="p-title" href="product.html">AEG M4 — платформа под апгрейд</a>
              <div class="p-meta"><span class="star">★★★★☆</span> 4.6 • Под заказ • SKU: M4-UPG-10</div>
            </div>
            <div class="p-bottom">
              <div class="price">12 990 грн</div>
              <button class="btn small primary" type="button">В корзину</button>
            </div>
          </article>

          <!-- 5 -->
          <article class="product">
            <div class="p-top">
              <span class="p-badge hot">★ Топ</span>
              <a class="p-img" href="product.html" aria-label="Открыть товар">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" aria-hidden="true">
                  <path d="M24 68c18-16 44-24 82-28l4 8-72 18-6 10-8 2Z" stroke="rgba(255,255,255,.92)" stroke-width="3" stroke-linejoin="round"/>
                  <path d="M60 58l-6 22" stroke="rgba(255,255,255,.8)" stroke-width="3" stroke-linecap="round"/>
                </svg>
              </a>
            </div>
            <div class="p-mid">
              <a class="p-title" href="product.html">AEG DMR — стабильность и дальность</a>
              <div class="p-meta"><span class="star">★★★★☆</span> 4.7 • В наличии • SKU: DMR-SET-03</div>
            </div>
            <div class="p-bottom">
              <div class="price">17 990 грн</div>
              <button class="btn small primary" type="button">В корзину</button>
            </div>
          </article>

          <!-- 6 -->
          <article class="product">
            <div class="p-top">
              <span class="p-badge sale">-8%</span>
              <a class="p-img" href="product.html" aria-label="Открыть товар">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" aria-hidden="true">
                  <path d="M18 62h84l-8 22H26l-8-22Z" stroke="rgba(255,255,255,.92)" stroke-width="3" stroke-linejoin="round"/>
                  <path d="M38 62V46h44v16" stroke="rgba(255,255,255,.75)" stroke-width="3" stroke-linejoin="round"/>
                </svg>
              </a>
            </div>
            <div class="p-mid">
              <a class="p-title" href="product.html">AEG AK — “рабочая лошадка”</a>
              <div class="p-meta"><span class="star">★★★★☆</span> 4.3 • В наличии • SKU: AK-BASE-01</div>
            </div>
            <div class="p-bottom">
              <div class="price">7 990 грн <span class="strike">8 690</span></div>
              <button class="btn small primary" type="button">В корзину</button>
            </div>
          </article>
        </div>

        <div class="pagination" aria-label="Пагинация">
          <a class="page" href="#" aria-label="Предыдущая">←</a>
          <a class="page active" href="#">1</a>
          <a class="page" href="#">2</a>
          <a class="page" href="#">3</a>
          <a class="page" href="#">4</a>
          <a class="page" href="#" aria-label="Следующая">→</a>
        </div>
      </section>
    </div>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="row" style="gap:10px; margin-bottom:10px;">
            <span class="logo" aria-hidden="true" style="width:38px;height:38px;border-radius:14px;"></span>
            <div><b>Strikeball Shop</b><br/><small style="color:var(--muted)">Доставка • Гарантия • Сервис</small></div>
          </div>
          <p style="margin:0; color:var(--muted); font-size:13px; max-width:60ch;">
            Страница категории: фильтры/сортировка/пагинация — готовая основа под PHP + MySQL.
          </p>
        </div>
        <div><h5>Каталог</h5><a href="#">Приводы</a><a href="#">Защита</a><a href="#">Тактика</a><a href="#">Оптика</a></div>
        <div><h5>Покупателям</h5><a href="#">Доставка</a><a href="#">Оплата</a><a href="#">Гарантия</a><a href="#">Возврат</a></div>
        <div><h5>Компания</h5><a href="#">О нас</a><a href="#">Контакты</a><a href="#">Партнёрам</a><a href="#">Оферта</a></div>
      </div>
      <div class="copyright"><div>© <span id="year"></span> Strikeball Shop</div><div>Category template</div></div>
    </div>
  </footer>

  <script>
    (function(){
      document.getElementById('year').textContent = new Date().getFullYear();
      const burger = document.getElementById('burger');
      const mobileMenu = document.getElementById('mobileMenu');
      burger && burger.addEventListener('click', ()=> {
        const isOpen = mobileMenu.style.display === 'block';
        mobileMenu.style.display = isOpen ? 'none' : 'block';
      });

      const chips = document.getElementById('chips');
      chips && chips.addEventListener('click', (e)=> {
        const btn = e.target.closest('button');
        if (!btn) return;
        const chip = btn.closest('.chip');
        chip && chip.remove();
      });

      const clear = document.getElementById('clearFilters');
      clear && clear.addEventListener('click', ()=> {
        document.querySelectorAll('input[type="checkbox"]').forEach(i => i.checked = false);
        document.querySelectorAll('input[type="number"]').forEach(i => i.value = '');
        if (chips) chips.innerHTML = '';
      });
    })();
  </script>
</body>
</html>
