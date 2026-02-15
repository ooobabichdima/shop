<!-- =========================
  PRODUCT PAGE (product.html)
  Same style + gallery, specs, tabs, reviews, related
========================= -->
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="theme-color" content="#0b0f14" />
  <title>AEG M4 (CQB) — базовый комплект | Strikeball Shop</title>
  <meta name="description" content="AEG M4 (CQB): комплектация, характеристики, совместимость аккумуляторов, рекомендации по шарам и настройке hop-up. Доставка по Украине, гарантия." />

  <style>
    :root{
      --bg:#070a0f;--panel:rgba(255,255,255,.06);--panel2:rgba(255,255,255,.08);
      --text:rgba(255,255,255,.92);--muted:rgba(255,255,255,.65);--muted2:rgba(255,255,255,.45);
      --line:rgba(255,255,255,.12);--accent:#58ff7a;--accent2:#22c55e;--danger:#ff4d4d;--warn:#ffcc00;
      --shadow:0 18px 60px rgba(0,0,0,.55);--radius:18px;--radius2:24px;--max:1180px;
      --h1:clamp(24px,2.8vw,38px);--h2:clamp(20px,2.2vw,30px);--p:15px;
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
      border-color: rgba(88,255,122,.35); color:#031107; font-weight:900;
      box-shadow:0 16px 40px rgba(34,197,94,.22);
    }
    .btn.small{padding:10px 12px; border-radius:12px; font-size:14px}
    .pill{display:inline-flex; gap:8px; align-items:center; padding:8px 12px; border-radius:999px;
      background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.10); color:var(--muted); font-size:13px}
    .card{border-radius:var(--radius); border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05); box-shadow:0 10px 30px rgba(0,0,0,.30)}
    .muted{color:var(--muted)}
    .muted2{color:var(--muted2)}
    .star{color:rgba(255,204,0,.9)}
    .strike{color:rgba(255,255,255,.45); text-decoration:line-through; font-weight:700; margin-left:8px}
    .ico18{width:18px;height:18px}
    .ico20{width:20px;height:20px}

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

    /* breadcrumbs */
    .crumbs{padding:18px 0 10px; color:rgba(255,255,255,.62); font-size:13px}
    .crumbs a{color:rgba(255,255,255,.72)}
    .crumbs a:hover{color:var(--text)}

    /* product layout */
    .product-wrap{
      display:grid;
      grid-template-columns: 1.05fr .95fr;
      gap:16px;
      padding-bottom:18px;
    }
    .gallery{padding:14px}
    .main-shot{
      height:360px;
      border-radius:18px;
      border:1px solid rgba(255,255,255,.12);
      background:
        radial-gradient(160px 160px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
        linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
      display:grid; place-items:center;
      overflow:hidden;
    }
    .thumbs{display:grid; grid-template-columns: repeat(4, 1fr); gap:10px; margin-top:12px}
    .thumb{
      height:72px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.12);
      background: rgba(0,0,0,.18);
      cursor:pointer;
      display:grid; place-items:center;
      transition:.12s ease;
    }
    .thumb:hover{background:rgba(255,255,255,.06); border-color:rgba(255,255,255,.22); transform:translateY(-1px)}
    .thumb.active{border-color:rgba(88,255,122,.35); background:rgba(88,255,122,.10)}
    .info{padding:16px}
    .info h1{margin:8px 0 8px; font-size:var(--h1); line-height:1.08}
    .rate{display:flex; align-items:center; gap:10px; flex-wrap:wrap; color:var(--muted); font-size:13px}
    .sku{padding:6px 10px; border-radius:999px; border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05); color:rgba(255,255,255,.78)}
    .pricebox{
      margin-top:14px;
      padding:14px;
      border-radius:18px;
      border:1px solid rgba(255,255,255,.12);
      background: rgba(0,0,0,.18);
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
    }
    .price{font-weight:950; font-size:22px}
    .stock{color:rgba(255,255,255,.80); font-size:13px}
    .stock b{color:rgba(255,255,255,.95)}
    .qty{
      display:flex; align-items:center; gap:8px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(255,255,255,.06);
      padding:8px; border-radius:14px;
    }
    .qty button{width:34px;height:34px;border-radius:12px;border:1px solid rgba(255,255,255,.12);background:rgba(0,0,0,.18);color:var(--text);cursor:pointer}
    .qty input{width:52px;text-align:center;border:none;outline:none;background:transparent;color:var(--text);font-weight:800}
    .bullets{margin:12px 0 0; padding:0; list-style:none; display:grid; gap:8px}
    .bullets li{
      padding:10px 12px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.10);
      background:rgba(255,255,255,.05);
      color:rgba(255,255,255,.82);
      font-size:14px;
    }
    .bullets li small{display:block; color:var(--muted); margin-top:3px}

    /* tabs */
    .tabs{
      margin-top:16px;
      border-radius:var(--radius2);
      border:1px solid rgba(255,255,255,.12);
      background:rgba(255,255,255,.04);
      overflow:hidden;
    }
    .tabbar{
      display:flex; gap:8px; flex-wrap:wrap;
      padding:10px;
      border-bottom:1px solid rgba(255,255,255,.10);
      background: rgba(0,0,0,.14);
    }
    .tabbtn{
      padding:10px 12px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.05);
      color:rgba(255,255,255,.85);
      cursor:pointer;
      font-weight:800;
      font-size:14px;
    }
    .tabbtn.active{background:rgba(88,255,122,.12); border-color:rgba(88,255,122,.30)}
    .tabpanel{padding:14px}
    .specs{display:grid; grid-template-columns: 1fr 1fr; gap:10px}
    .spec{
      padding:12px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.10);
      background:rgba(255,255,255,.05);
      display:flex; justify-content:space-between; gap:10px;
      color:rgba(255,255,255,.85);
      font-size:14px;
    }
    .spec span{color:var(--muted)}
    .review{
      padding:12px;
      border-radius:14px;
      border:1px solid rgba(255,255,255,.10);
      background:rgba(255,255,255,.05);
      display:grid; gap:8px;
    }
    .review .head{display:flex; justify-content:space-between; gap:10px; flex-wrap:wrap}
    .review b{font-size:14px}
    .review p{margin:0; color:rgba(255,255,255,.80); font-size:14px}
    .qa{display:grid; gap:10px}
    details{border-radius:14px;border:1px solid rgba(255,255,255,.12);background:rgba(255,255,255,.05);padding:12px}
    summary{cursor:pointer; list-style:none; display:flex; justify-content:space-between; gap:12px; font-weight:900}
    summary::-webkit-details-marker{display:none}
    details p{margin:10px 0 0; color:var(--muted); font-size:14px}
    .chev{transition:transform .14s ease}
    details[open] .chev{transform:rotate(180deg)}

    /* related */
    .section-title{display:flex; align-items:flex-end; justify-content:space-between; gap:16px; margin:18px 0 10px}
    .section-title h2{margin:0; font-size:var(--h2)}
    .section-title p{margin:0; color:var(--muted); font-size:14px}
    .related{display:grid; grid-template-columns: repeat(4,1fr); gap:16px; padding-bottom:22px}
    .p{
      border-radius:var(--radius); border:1px solid rgba(255,255,255,.12);
      background:rgba(255,255,255,.05); overflow:hidden; display:flex; flex-direction:column;
      box-shadow:0 10px 30px rgba(0,0,0,.30); transition:.12s ease;
    }
    .p:hover{transform:translateY(-2px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.06)}
    .p .img{
      height:150px; display:grid; place-items:center;
      background: radial-gradient(120px 120px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
                  linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
      border-bottom:1px solid rgba(255,255,255,.10);
    }
    .p .body{padding:12px}
    .p .title{font-weight:850; font-size:14.5px}
    .p .meta{margin-top:6px; color:var(--muted); font-size:12.5px}
    .p .foot{margin-top:auto; padding:12px; border-top:1px solid rgba(255,255,255,.10); display:flex; justify-content:space-between; align-items:center; gap:10px}
    .footer{padding:22px 0 32px; border-top:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.10); margin-top:18px}
    .footer-grid{display:grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap:16px}
    .footer-grid h5{margin:0 0 10px; font-size:14px}
    .footer-grid a{color:var(--muted); display:block; padding:6px 0; font-size:13px}
    .footer-grid a:hover{color:var(--text)}
    .copyright{margin-top:18px; display:flex; justify-content:space-between; gap:10px; color:rgba(255,255,255,.55); font-size:12px; flex-wrap:wrap}

    @media (max-width: 980px){
      .nav{display:none}
      .burger{display:inline-flex}
      .search{min-width:0}
      .product-wrap{grid-template-columns: 1fr}
      .related{grid-template-columns: repeat(2,1fr)}
      .footer-grid{grid-template-columns:1.6fr 1fr 1fr}
    }
    @media (max-width: 560px){
      .search{display:none}
      .thumbs{grid-template-columns: repeat(3, 1fr)}
      .specs{grid-template-columns: 1fr}
      .related{grid-template-columns: 1fr}
      .footer-grid{grid-template-columns:1fr 1fr}
    }
  </style>
</head>

<body>
  <div class="topbar">
    <div class="container">
      <div class="topbar-inner">
        <a class="brand" href="#">
          <span class="logo" aria-hidden="true"></span>
          <span>Strikeball Shop<small>Карточка товара</small></span>
        </a>

        <nav class="nav" aria-label="Основное меню">
          <a href="#">Каталог</a><a href="#">Акции</a><a href="#">Гайды</a><a href="#">Контакты</a>
        </nav>

        <div class="search" role="search">
          <svg class="ico18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="rgba(255,255,255,.75)" stroke-width="2"/>
            <path d="M16.5 16.5 21 21" stroke="rgba(255,255,255,.75)" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input id="q" type="search" placeholder="Поиск по магазину…" autocomplete="off" />
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
          <a class="btn" href="#">Гайды</a>
          <a class="btn" href="#">Контакты</a>
        </div>
      </div>
    </div>
  </div>

  <main class="container">
    <div class="crumbs">
      <a href="#">Главная</a> / <a href="#">Каталог</a> / <a href="#">Приводы AEG</a> / <span>AEG M4 (CQB)</span>
    </div>

    <section class="product-wrap">
      <!-- Gallery -->
      <div class="card gallery" aria-label="Галерея товара">
        <div class="row" style="justify-content:space-between; flex-wrap:wrap;">
          <span class="pill">★ Хит • В наличии</span>
          <span class="pill" title="Можно вывести из БД">Гарантия: 6 мес</span>
        </div>

        <div class="main-shot" id="mainShot" aria-label="Основное изображение (заглушка)">
          <svg width="160" height="160" viewBox="0 0 120 120" fill="none" aria-hidden="true">
            <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="rgba(255,255,255,.92)" stroke-width="3" stroke-linejoin="round"/>
            <path d="M52 66l-7 18" stroke="rgba(255,255,255,.8)" stroke-width="3" stroke-linecap="round"/>
            <path d="M72 60l-4 18" stroke="rgba(255,255,255,.8)" stroke-width="3" stroke-linecap="round"/>
          </svg>
        </div>

        <div class="thumbs" role="list" aria-label="Миниатюры">
          <button class="thumb active" data-shot="1" type="button" aria-label="Фото 1">1</button>
          <button class="thumb" data-shot="2" type="button" aria-label="Фото 2">2</button>
          <button class="thumb" data-shot="3" type="button" aria-label="Фото 3">3</button>
          <button class="thumb" data-shot="4" type="button" aria-label="Фото 4">4</button>
        </div>

        <ul class="bullets" style="margin-top:12px;">
          <li><b>Под CQB</b> <small>Компакт, удобный приклад, комфортный баланс.</small></li>
          <li><b>Совместимость</b> <small>Рекомендуем LiPo 11.1V (если электроника позволяет) или LiPo 7.4V для спокойной игры.</small></li>
          <li><b>Расходники</b> <small>Шары 0.25–0.28г для стабильности; чистка стволика — регулярно.</small></li>
        </ul>
      </div>

      <!-- Info -->
      <div class="card info" aria-label="Информация о товаре">
        <span class="pill">Привод AEG</span>
        <h1>AEG M4 (CQB) — базовый комплект</h1>

        <div class="rate">
          <span><span class="star">★★★★★</span> <b>4.8</b> (126)</span>
          <span class="muted2">•</span>
          <span class="sku">SKU: M4-CQB-01</span>
          <span class="muted2">•</span>
          <span class="muted">Доставка 1–3 дня</span>
        </div>

        <div class="pricebox">
          <div>
            <div class="price">9 990 грн <span class="strike">10 990</span></div>
            <div class="stock">Наличие: <b>в наличии</b> • Осталось: <b>9</b></div>
            <div class="muted2" style="margin-top:6px; font-size:13px;">Цена пример — подставишь из БД.</div>
          </div>

          <div class="row" style="flex-wrap:wrap; justify-content:flex-end;">
            <div class="qty" aria-label="Количество">
              <button type="button" id="minus" aria-label="Минус">−</button>
              <input id="qty" type="text" value="1" inputmode="numeric" />
              <button type="button" id="plus" aria-label="Плюс">+</button>
            </div>
            <button class="btn primary" type="button">В корзину</button>
            <button class="btn" type="button">В избранное</button>
          </div>
        </div>

        <div class="row" style="flex-wrap:wrap; margin-top:12px;">
          <a class="btn small" href="#tabs">Описание</a>
          <a class="btn small" href="#tabs">Характеристики</a>
          <a class="btn small" href="#tabs">Отзывы</a>
          <a class="btn small" href="#tabs">FAQ</a>
        </div>

        <div class="tabs" id="tabs">
          <div class="tabbar" role="tablist" aria-label="Вкладки">
            <button class="tabbtn active" data-tab="desc" type="button" role="tab">Описание</button>
            <button class="tabbtn" data-tab="specs" type="button" role="tab">Характеристики</button>
            <button class="tabbtn" data-tab="reviews" type="button" role="tab">Отзывы</button>
            <button class="tabbtn" data-tab="faq" type="button" role="tab">FAQ</button>
          </div>

          <div class="tabpanel" data-panel="desc">
            <p style="margin:0 0 10px; color:rgba(255,255,255,.84);">
              Надёжная база под CQB: удобный корпус, предсказуемая работа, понятный потенциал апгрейда.
              Если хочешь “тише/быстрее/дальше” — есть готовые пакеты тюнинга.
            </p>
            <div class="grid" style="grid-template-columns:1fr 1fr; gap:10px;">
              <div class="card" style="padding:12px;">
                <b>Рекомендуем сразу</b>
                <div class="muted" style="font-size:13px; margin-top:6px;">Очки/маска, 2 магазина, шары 0.25–0.28г, батарея + зарядка.</div>
              </div>
              <div class="card" style="padding:12px;">
                <b>Совместимость</b>
                <div class="muted" style="font-size:13px; margin-top:6px;">Укажи тип разъёма (T-Dean/Tamiya), место АКБ, ограничения по габаритам.</div>
              </div>
            </div>
          </div>

          <div class="tabpanel" data-panel="specs" hidden>
            <div class="specs">
              <div class="spec"><b>Платформа</b><span>M4 / AR</span></div>
              <div class="spec"><b>Назначение</b><span>CQB</span></div>
              <div class="spec"><b>Скорость</b><span>~ 100–110 м/с</span></div>
              <div class="spec"><b>Магазины</b><span>M4 AEG</span></div>
              <div class="spec"><b>Питание</b><span>LiPo 7.4V / 11.1V*</span></div>
              <div class="spec"><b>Разъём</b><span>T-Dean / Tamiya*</span></div>
              <div class="spec"><b>Материал</b><span>металл/полимер*</span></div>
              <div class="spec"><b>Вес</b><span>~ 2.6 кг</span></div>
            </div>
            <p class="muted2" style="margin:10px 0 0; font-size:13px;">*— параметры зависят от модели/партии. На проде подтягиваешь из БД.</p>
          </div>

          <div class="tabpanel" data-panel="reviews" hidden>
            <div class="row" style="justify-content:space-between; align-items:flex-start; flex-wrap:wrap;">
              <div>
                <b style="display:block;">Отзывы покупателей</b>
                <span class="muted" style="font-size:13px;">Средняя оценка: <span class="star">★★★★★</span> 4.8</span>
              </div>
              <button class="btn small primary" type="button">Оставить отзыв</button>
            </div>

            <div class="grid" style="margin-top:10px;">
              <div class="review">
                <div class="head"><div><b>Артём</b> <span class="muted2">• Киев</span></div><div class="muted"><span class="star">★★★★★</span> 5.0</div></div>
                <p>Приехал настроенный, для CQB идеально. Подбор по батарее — четко.</p>
              </div>
              <div class="review">
                <div class="head"><div><b>Влад</b> <span class="muted2">• Днепр</span></div><div class="muted"><span class="star">★★★★☆</span> 4.6</div></div>
                <p>Хорошая база под апгрейд. Хотел бы комплект “2 магазина + батарея”.</p>
              </div>
            </div>
          </div>

          <div class="tabpanel" data-panel="faq" hidden>
            <div class="qa">
              <details>
                <summary>Какие шары лучше? <span class="chev" aria-hidden="true">
                  <svg class="ico18" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span></summary>
                <p>Для CQB обычно 0.25–0.28г — стабильнее траектория и меньше “парусит”.</p>
              </details>
              <details>
                <summary>Можно ли LiPo 11.1V? <span class="chev" aria-hidden="true">
                  <svg class="ico18" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span></summary>
                <p>Если модель с корректной электроникой/проводкой — да. Иначе лучше 7.4V для ресурса.</p>
              </details>
              <details>
                <summary>Есть ли апгрейд “тише и дальше”? <span class="chev" aria-hidden="true">
                  <svg class="ico18" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span></summary>
                <p>Да: компрессия + hop-up + резинка/нуб + настройка. Для “тише” — шимминг и демпферы.</p>
              </details>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="section-title">
      <div>
        <h2>Похожие товары</h2>
        <p>Кросс-селл: батареи/зарядки, шары, оптика — лучше всего конвертят рядом с товаром.</p>
      </div>
      <a class="btn small" href="#">Смотреть все</a>
    </div>

    <section class="related" aria-label="Рекомендованные товары">
      <article class="p">
        <a class="img" href="#" aria-label="Товар 1">
          <svg width="90" height="90" viewBox="0 0 120 120" fill="none" aria-hidden="true">
            <path d="M30 58h60v34H30V58Z" stroke="rgba(255,255,255,.9)" stroke-width="3" stroke-linejoin="round"/>
            <path d="M42 58V44h36v14" stroke="rgba(255,255,255,.75)" stroke-width="3" stroke-linejoin="round"/>
          </svg>
        </a>
        <div class="body">
          <div class="title">Smart-зарядка LiPo/Li-Ion</div>
          <div class="meta"><span class="star">★★★★★</span> 4.9 • В наличии</div>
        </div>
        <div class="foot">
          <b>1 290 грн</b>
          <button class="btn small primary" type="button">В корзину</button>
        </div>
      </article>

      <article class="p">
        <a class="img" href="#" aria-label="Товар 2">
          <svg width="90" height="90" viewBox="0 0 120 120" fill="none" aria-hidden="true">
            <path d="M35 45h50v30H35V45Z" stroke="rgba(255,255,255,.9)" stroke-width="3" stroke-linejoin="round"/>
            <path d="M60 75v18" stroke="rgba(255,255,255,.75)" stroke-width="3" stroke-linecap="round"/>
          </svg>
        </a>
        <div class="body">
          <div class="title">Коллиматор micro</div>
          <div class="meta"><span class="star">★★★★☆</span> 4.6 • В наличии</div>
        </div>
        <div class="foot">
          <b>1 990 грн</b>
          <button class="btn small primary" type="button">В корзину</button>
        </div>
      </article>

      <article class="p">
        <a class="img" href="#" aria-label="Товар 3">
          <svg width="90" height="90" viewBox="0 0 120 120" fill="none" aria-hidden="true">
            <path d="M28 66h64l-6 18H34l-6-18Z" stroke="rgba(255,255,255,.9)" stroke-width="3" stroke-linejoin="round"/>
            <path d="M45 66V48h30v18" stroke="rgba(255,255,255,.75)" stroke-width="3" stroke-linejoin="round"/>
          </svg>
        </a>
        <div class="body">
          <div class="title">Плитоноска (универсальная)</div>
          <div class="meta"><span class="star">★★★★☆</span> 4.4 • Осталось: 7</div>
        </div>
        <div class="foot">
          <b>2 790 грн</b>
          <button class="btn small primary" type="button">В корзину</button>
        </div>
      </article>

      <article class="p">
        <a class="img" href="#" aria-label="Товар 4">
          <svg width="90" height="90" viewBox="0 0 120 120" fill="none" aria-hidden="true">
            <path d="M36 40h48v52H36V40Z" stroke="rgba(255,255,255,.9)" stroke-width="3" stroke-linejoin="round"/>
            <path d="M42 56h36" stroke="rgba(255,255,255,.75)" stroke-width="3" stroke-linecap="round"/>
          </svg>
        </a>
        <div class="body">
          <div class="title">Шары 0.25г (1кг)</div>
          <div class="meta"><span class="star">★★★★★</span> 4.8 • В наличии</div>
        </div>
        <div class="foot">
          <b>390 грн</b>
          <button class="btn small primary" type="button">В корзину</button>
        </div>
      </article>
    </section>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="row" style="gap:10px; margin-bottom:10px;">
            <span class="logo" aria-hidden="true" style="width:38px;height:38px;border-radius:14px;"></span>
            <div><b>Strikeball Shop</b><br/><small class="muted">Доставка • Гарантия • Сервис</small></div>
          </div>
          <p style="margin:0; color:var(--muted); font-size:13px; max-width:60ch;">
            Карточка товара: галерея, цена, количество, табы, отзывы, FAQ, блок похожих товаров.
          </p>
        </div>
        <div><h5>Каталог</h5><a href="#">Приводы</a><a href="#">Защита</a><a href="#">Тактика</a><a href="#">Оптика</a></div>
        <div><h5>Покупателям</h5><a href="#">Доставка</a><a href="#">Оплата</a><a href="#">Гарантия</a><a href="#">Возврат</a></div>
        <div><h5>Компания</h5><a href="#">О нас</a><a href="#">Контакты</a><a href="#">Партнёрам</a><a href="#">Оферта</a></div>
      </div>
      <div class="copyright"><div>© <span id="year"></span> Strikeball Shop</div><div>Product template</div></div>
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

      // qty
      const qty = document.getElementById('qty');
      const plus = document.getElementById('plus');
      const minus = document.getElementById('minus');
      const clamp = (n) => Math.max(1, Math.min(99, n));
      const toInt = (v) => {
        const n = parseInt(String(v).replace(/[^\d]/g,''), 10);
        return Number.isFinite(n) ? n : 1;
      };
      plus && plus.addEventListener('click', ()=> qty.value = clamp(toInt(qty.value) + 1));
      minus && minus.addEventListener('click', ()=> qty.value = clamp(toInt(qty.value) - 1));
      qty && qty.addEventListener('input', ()=> qty.value = clamp(toInt(qty.value)));

      // tabs
      const btns = Array.from(document.querySelectorAll('.tabbtn'));
      const panels = Array.from(document.querySelectorAll('.tabpanel'));
      btns.forEach(b => b.addEventListener('click', ()=> {
        btns.forEach(x => x.classList.remove('active'));
        b.classList.add('active');
        const t = b.dataset.tab;
        panels.forEach(p => {
          const on = p.dataset.panel === t;
          p.hidden = !on;
        });
      }));

      // gallery thumbs (demo: change SVG color-ish via opacity swap)
      const thumbs = Array.from(document.querySelectorAll('.thumb'));
      const main = document.getElementById('mainShot');
      thumbs.forEach(th => th.addEventListener('click', ()=> {
        thumbs.forEach(x => x.classList.remove('active'));
        th.classList.add('active');
        const n = th.dataset.shot;
        // demo content switch (on prod: swap image src)
        main.innerHTML = `<div style="text-align:center">
          <div class="pill" style="margin-bottom:10px;">Фото ${n}</div>
          <svg width="160" height="160" viewBox="0 0 120 120" fill="none" aria-hidden="true" style="opacity:.95">
            <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="rgba(255,255,255,.92)" stroke-width="3" stroke-linejoin="round"/>
            <path d="M52 66l-7 18" stroke="rgba(255,255,255,.8)" stroke-width="3" stroke-linecap="round"/>
            <path d="M72 60l-4 18" stroke="rgba(255,255,255,.8)" stroke-width="3" stroke-linecap="round"/>
          </svg>
        </div>`;
      }));
    })();
  </script>
</body>
</html>
