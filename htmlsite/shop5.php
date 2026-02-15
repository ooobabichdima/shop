<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="theme-color" content="#0b0f14" />
  <title>Корзина | Strikeball Shop</title>
  <meta name="description" content="Корзина товаров: количество, промокод, доставка и итоговая сумма." />

  <style>
    :root{
      --bg:#070a0f;--panel:rgba(255,255,255,.06);--panel2:rgba(255,255,255,.08);
      --text:rgba(255,255,255,.92);--muted:rgba(255,255,255,.65);--muted2:rgba(255,255,255,.45);
      --line:rgba(255,255,255,.12);--accent:#58ff7a;--accent2:#22c55e;--danger:#ff4d4d;--warn:#ffcc00;
      --shadow:0 18px 60px rgba(0,0,0,.55);--radius:18px;--radius2:24px;--max:1180px;
      --h1:clamp(24px,2.8vw,38px);--h2:clamp(20px,2.2vw,30px);
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
    .row{display:flex; align-items:center; gap:12px}
    .grid{display:grid; gap:16px}
    .card{border-radius:var(--radius); border:1px solid rgba(255,255,255,.12); background:rgba(255,255,255,.05); box-shadow:0 10px 30px rgba(0,0,0,.30)}
    .muted{color:var(--muted)} .muted2{color:var(--muted2)}
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

    .crumbs{padding:18px 0 10px; color:rgba(255,255,255,.62); font-size:13px}
    .crumbs a{color:rgba(255,255,255,.72)}
    .crumbs a:hover{color:var(--text)}

    /* cart layout */
    .page-title{display:flex; justify-content:space-between; align-items:flex-end; gap:14px; flex-wrap:wrap}
    .page-title h1{margin:0; font-size:var(--h1); line-height:1.08}
    .layout{display:grid; grid-template-columns: 1.35fr .65fr; gap:16px; padding:10px 0 22px}

    .cart-list{padding:14px}
    .cart-item{
      display:grid;
      grid-template-columns: 74px 1fr auto;
      gap:12px;
      padding:12px;
      border-radius:18px;
      border:1px solid rgba(255,255,255,.10);
      background:rgba(0,0,0,.16);
      align-items:center;
    }
    .cart-item + .cart-item{margin-top:10px}
    .thumb{
      width:74px;height:74px;border-radius:16px;
      border:1px solid rgba(255,255,255,.12);
      background:
        radial-gradient(40px 40px at 30% 30%, rgba(255,255,255,.10), transparent 60%),
        linear-gradient(135deg, rgba(88,255,122,.16), rgba(56,189,248,.10));
      display:grid;place-items:center;
    }
    .title{font-weight:950}
    .meta{margin-top:6px; color:var(--muted); font-size:13px}
    .right{display:grid; gap:10px; justify-items:end}
    .price{font-weight:950}
    .strike{color:rgba(255,255,255,.45); text-decoration:line-through; font-weight:700; margin-left:8px}

    .qty{
      display:flex; align-items:center; gap:6px;
      border:1px solid rgba(255,255,255,.14);
      background:rgba(255,255,255,.06);
      padding:6px; border-radius:12px;
    }
    .qty button{
      width:28px;height:28px;border-radius:10px;border:1px solid rgba(255,255,255,.12);
      background:rgba(0,0,0,.18);color:var(--text);cursor:pointer;
    }
    .qty input{
      width:44px;text-align:center;border:none;outline:none;background:transparent;color:var(--text);font-weight:950;
    }
    .link-danger{color:rgba(255,77,77,.92); font-weight:900; font-size:13px; cursor:pointer}
    .link-danger:hover{text-decoration:underline}

    /* summary */
    .summary{padding:14px}
    .sum-head{display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; align-items:flex-start}
    .sum-head b{font-size:16px}
    .box{
      margin-top:12px; padding:12px; border-radius:18px; border:1px solid rgba(255,255,255,.12);
      background:rgba(0,0,0,.16); display:grid; gap:10px;
    }
    .line{display:flex; justify-content:space-between; gap:10px; color:rgba(255,255,255,.84); font-size:14px}
    .line span{color:var(--muted)}
    .total{display:flex; justify-content:space-between; gap:10px; align-items:baseline}
    .total b{font-size:18px}
    .promo{display:flex; gap:10px; flex-wrap:wrap}
    .inp{
      flex:1; min-width:180px;
      padding:12px 12px; border-radius:14px;
      border:1px solid rgba(255,255,255,.12);
      background:rgba(255,255,255,.06);
      color:var(--text); outline:none;
    }
    .inp::placeholder{color:rgba(255,255,255,.45)}
    .notice{
      display:none;
      padding:10px 12px; border-radius:14px;
      border:1px solid rgba(88,255,122,.25);
      background:rgba(88,255,122,.10);
      color:rgba(255,255,255,.88);
      font-size:13px;
    }
    .notice.bad{
      border-color:rgba(255,77,77,.25);
      background:rgba(255,77,77,.10);
    }

    /* footer */
    .footer{padding:22px 0 32px; border-top:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.10)}
    .footer-grid{display:grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap:16px}
    .footer-grid h5{margin:0 0 10px; font-size:14px}
    .footer-grid a{color:var(--muted); display:block; padding:6px 0; font-size:13px}
    .footer-grid a:hover{color:var(--text)}
    .copyright{margin-top:18px; display:flex; justify-content:space-between; gap:10px; color:rgba(255,255,255,.55); font-size:12px; flex-wrap:wrap}

    @media (max-width: 980px){
      .nav{display:none}
      .burger{display:inline-flex}
      .search{min-width:0}
      .layout{grid-template-columns: 1fr}
      .footer-grid{grid-template-columns:1.6fr 1fr 1fr}
    }
    @media (max-width: 560px){
      .search{display:none}
      .cart-item{grid-template-columns: 64px 1fr; gap:10px}
      .right{grid-column: 1 / -1; justify-items:start}
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
          <span>Strikeball Shop<small>Корзина</small></span>
        </a>

        <nav class="nav" aria-label="Основное меню">
          <a href="#">Каталог</a><a href="#">Акции</a><a href="#">Гайды</a><a href="#">Контакты</a>
        </nav>

        <div class="search" role="search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="rgba(255,255,255,.75)" stroke-width="2"/>
            <path d="M16.5 16.5 21 21" stroke="rgba(255,255,255,.75)" stroke-width="2" stroke-linecap="round"/>
          </svg>
          <input type="search" placeholder="Поиск по магазину…" autocomplete="off" />
        </div>

        <div class="actions">
          <button class="iconbtn burger" id="burger" aria-label="Открыть меню">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h16" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round"/></svg>
          </button>
          <button class="iconbtn" aria-label="Корзина">
            <span class="badge" id="cartCount">3</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
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
      <a href="#">Главная</a> / <span>Корзина</span>
    </div>

    <div class="page-title">
      <div>
        <h1>Корзина</h1>
        <div class="muted" style="margin-top:6px; font-size:14px;">Проверь количество, промокод и доставку — итог пересчитается автоматически.</div>
      </div>
      <div class="row" style="flex-wrap:wrap;">
        <span class="pill" id="itemsPill">3 позиции</span>
        <a class="btn small" href="#">Продолжить покупки</a>
      </div>
    </div>

    <section class="layout">
      <!-- LEFT: items -->
      <div class="card cart-list">
        <div class="row" style="justify-content:space-between; align-items:flex-start; flex-wrap:wrap;">
          <div>
            <b>Товары в корзине</b><div class="muted2" style="font-size:13px; margin-top:4px;">Демо данные — заменишь из БД/сессии.</div>
          </div>
          <button class="btn small" type="button" id="clearCart">Очистить корзину</button>
        </div>

        <div id="cartItems" style="margin-top:12px;">
          <!-- item template is built by JS -->
        </div>

        <div class="box" style="margin-top:12px;">
          <b>Подсказка</b>
          <div class="muted" style="font-size:13px;">
            Обычно новичкам лучше: 2–3 магазина, LiPo 7.4V + smart-зарядка, шары 0.25–0.28г.
          </div>
        </div>
      </div>

      <!-- RIGHT: summary -->
      <aside class="card summary">
        <div class="sum-head">
          <div>
            <b>Итог по корзине</b>
            <div class="muted2" style="font-size:13px; margin-top:4px;">Сумма обновляется сразу.</div>
          </div>
          <span class="pill" id="deliveryBadge">Доставка: НП</span>
        </div>

        <div class="box">
          <div class="line"><span>Товары</span><b id="sumSubtotal">0 грн</b></div>
          <div class="line"><span>Скидка</span><b id="sumDiscount">0 грн</b></div>
          <div class="line"><span>Доставка</span><b id="sumShipping">0 грн</b></div>
          <div class="line" style="border-top:1px solid rgba(255,255,255,.10); padding-top:10px;">
            <span>К оплате</span><div class="total"><b id="sumTotal">0 грн</b></div>
          </div>
        </div>

        <div class="box">
          <b>Промокод</b>
          <div class="promo" style="margin-top:8px;">
            <input class="inp" id="promoInput" placeholder="Например: START10" />
            <button class="btn small" type="button" id="applyPromo">Применить</button>
          </div>
          <div class="notice" id="promoNotice"></div>
        </div>

        <div class="box">
          <b>Доставка</b>
          <div class="muted2" style="font-size:13px; margin-top:4px;">Демо: выбери способ — стоимость изменится.</div>
          <div class="grid" style="margin-top:10px; gap:10px;">
            <label class="row" style="justify-content:space-between; padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.14); cursor:pointer;">
              <span>Новая Почта (отделение)</span>
              <input type="radio" name="ship" value="np" checked style="accent-color: var(--accent)" />
            </label>
            <label class="row" style="justify-content:space-between; padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.14); cursor:pointer;">
              <span>Курьер по городу</span>
              <input type="radio" name="ship" value="courier" style="accent-color: var(--accent)" />
            </label>
            <label class="row" style="justify-content:space-between; padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.14); cursor:pointer;">
              <span>Самовывоз</span>
              <input type="radio" name="ship" value="pickup" style="accent-color: var(--accent)" />
            </label>
          </div>
        </div>

        <div class="grid" style="gap:10px;">
          <a class="btn primary" href="checkout.html" id="goCheckout">Перейти к оформлению</a>
          <button class="btn" type="button" id="saveCart">Сохранить корзину (demo)</button>
        </div>

        <div class="muted2" style="margin-top:10px; font-size:12.5px;">
          Нажимая “Оформление”, ты принимаешь условия оферты и политики конфиденциальности.
        </div>
      </aside>
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
            Корзина: изменение количества, промокод, выбор доставки, динамический итог.
          </p>
        </div>
        <div><h5>Каталог</h5><a href="#">Приводы</a><a href="#">Защита</a><a href="#">Тактика</a><a href="#">Оптика</a></div>
        <div><h5>Покупателям</h5><a href="#">Доставка</a><a href="#">Оплата</a><a href="#">Гарантия</a><a href="#">Возврат</a></div>
        <div><h5>Компания</h5><a href="#">О нас</a><a href="#">Контакты</a><a href="#">Оферта</a><a href="#">Политика</a></div>
      </div>
      <div class="copyright"><div>© <span id="year"></span> Strikeball Shop</div><div>cart.html</div></div>
    </div>
  </footer>

  <script>
    (function(){
      document.getElementById('year').textContent = new Date().getFullYear();

      // mobile menu
      const burger = document.getElementById('burger');
      const mobileMenu = document.getElementById('mobileMenu');
      burger && burger.addEventListener('click', ()=> {
        mobileMenu.style.display = (mobileMenu.style.display === 'block') ? 'none' : 'block';
      });

      // demo cart data
      let cart = [
        {id:'m4', title:'AEG M4 (CQB) — базовый комплект', sku:'M4-CQB-01', price:9990, old:10990, qty:1},
        {id:'mag', title:'Магазин M4 Mid-cap', sku:'MAG-M4-120', price:390, old:0, qty:2},
        {id:'bbs', title:'Шары 0.25г (1 кг)', sku:'BBS-025-1K', price:390, old:0, qty:1},
      ];

      // promo
      const PROMOS = {
        "START10": {type:"percent", value:10, label:"Скидка 10% на товары"},
        "BBS50": {type:"fixed", value:50, label:"−50 грн (на заказ)"},
      };
      let promo = null;

      // shipping
      const SHIPPING = {
        np: {label:"НП", cost:120},
        courier: {label:"Курьер", cost:180},
        pickup: {label:"Самовывоз", cost:0},
      };
      let ship = "np";

      const elItems = document.getElementById('cartItems');
      const elSubtotal = document.getElementById('sumSubtotal');
      const elDiscount = document.getElementById('sumDiscount');
      const elShipping = document.getElementById('sumShipping');
      const elTotal = document.getElementById('sumTotal');
      const elCount = document.getElementById('cartCount');
      const elPill = document.getElementById('itemsPill');
      const elDeliveryBadge = document.getElementById('deliveryBadge');

      const fmt = (n)=> (Math.round(n)).toString().replace(/\B(?=(\d{3})+(?!\d))/g,' ') + ' грн';
      const clamp = (v,min=1,max=99)=> Math.max(min, Math.min(max, v));
      const toInt = (v)=> {
        const n = parseInt(String(v).replace(/[^\d]/g,''), 10);
        return Number.isFinite(n) ? n : 1;
      };

      function countPositions(){
        return cart.length;
      }
      function countUnits(){
        return cart.reduce((a,x)=>a + x.qty, 0);
      }

      function calcSubtotal(){
        return cart.reduce((a,x)=>a + x.price * x.qty, 0);
      }
      function calcDiscount(subtotal){
        if(!promo) return 0;
        if(promo.type === "percent") return Math.round(subtotal * (promo.value/100));
        if(promo.type === "fixed") return Math.min(promo.value, subtotal);
        return 0;
      }

      function render(){
        if(!cart.length){
          elItems.innerHTML = `
            <div class="box" style="text-align:center; padding:18px;">
              <b>Корзина пустая</b>
              <div class="muted" style="margin-top:6px; font-size:13px;">Добавь товары из каталога или подборок.</div>
              <div class="row" style="justify-content:center; margin-top:12px; flex-wrap:wrap;">
                <a class="btn primary" href="#">В каталог</a>
                <a class="btn" href="#">Подборки новичка</a>
              </div>
            </div>
          `;
          promo = null;
        } else {
          elItems.innerHTML = cart.map(item => `
            <div class="cart-item" data-id="${item.id}">
              <div class="thumb" aria-hidden="true">
                <svg width="40" height="40" viewBox="0 0 120 120" fill="none">
                  <path d="M20 70c20-18 40-26 80-30l5 10-70 16-6 10-9 2Z" stroke="rgba(255,255,255,.9)" stroke-width="4" stroke-linejoin="round"/>
                </svg>
              </div>
              <div>
                <div class="title">${item.title}</div>
                <div class="meta">SKU: ${item.sku} • <span class="muted2">Цена за шт.</span> <b>${fmt(item.price)}</b>${item.old ? `<span class="strike">${fmt(item.old)}</span>` : ''}</div>
                <div class="row" style="margin-top:10px; flex-wrap:wrap;">
                  <div class="qty" aria-label="Количество">
                    <button type="button" class="minus">−</button>
                    <input type="text" class="q" value="${item.qty}" inputmode="numeric" />
                    <button type="button" class="plus">+</button>
                  </div>
                  <span class="muted2" style="font-size:13px;">Сумма: <b class="lineSum">${fmt(item.price * item.qty)}</b></span>
                </div>
              </div>
              <div class="right">
                <div class="price">${fmt(item.price * item.qty)}</div>
                <span class="link-danger remove">Удалить</span>
              </div>
            </div>
          `).join('');
        }

        // bind events
        elItems.querySelectorAll('.cart-item').forEach(row => {
          const id = row.getAttribute('data-id');
          const item = cart.find(x=>x.id===id);
          if(!item) return;

          const q = row.querySelector('.q');
          const plus = row.querySelector('.plus');
          const minus = row.querySelector('.minus');
          const remove = row.querySelector('.remove');

          const updateRow = ()=>{
            q.value = item.qty;
            row.querySelectorAll('.lineSum').forEach(s => s.textContent = fmt(item.price * item.qty));
            row.querySelector('.right .price').textContent = fmt(item.price * item.qty);
            recalc();
          };

          plus && plus.addEventListener('click', ()=>{ item.qty = clamp(item.qty + 1); updateRow(); });
          minus && minus.addEventListener('click', ()=>{ item.qty = clamp(item.qty - 1); updateRow(); });
          q && q.addEventListener('input', ()=>{ item.qty = clamp(toInt(q.value)); updateRow(); });

          remove && remove.addEventListener('click', ()=>{
            cart = cart.filter(x=>x.id!==id);
            render();
            recalc();
          });
        });

        // header pills
        elCount.textContent = String(countUnits());
        elPill.textContent = `${countPositions()} позиции`;
      }

      function recalc(){
        const subtotal = calcSubtotal();
        const discount = calcDiscount(subtotal);
        const shipCost = SHIPPING[ship].cost;
        const total = Math.max(0, subtotal - discount + shipCost);

        elSubtotal.textContent = fmt(subtotal);
        elDiscount.textContent = fmt(discount);
        elShipping.textContent = fmt(shipCost);
        elTotal.textContent = fmt(total);

        elCount.textContent = String(countUnits());
        elPill.textContent = `${countPositions()} позиции`;
        elDeliveryBadge.textContent = `Доставка: ${SHIPPING[ship].label}`;
      }

      // promo apply
      const promoInput = document.getElementById('promoInput');
      const promoNotice = document.getElementById('promoNotice');
      const applyPromo = document.getElementById('applyPromo');

      function showNotice(text, bad=false){
        promoNotice.style.display = 'block';
        promoNotice.classList.toggle('bad', bad);
        promoNotice.textContent = text;
      }

      applyPromo.addEventListener('click', ()=>{
        const code = String(promoInput.value||'').trim().toUpperCase();
        if(!code){
          promo = null;
          promoInput.value = '';
          promoNotice.style.display = 'none';
          recalc();
          return;
        }
        if(PROMOS[code]){
          promo = PROMOS[code];
          showNotice(`${code}: ${promo.label}`, false);
          recalc();
        }else{
          promo = null;
          showNotice(`Промокод "${code}" не найден`, true);
          recalc();
        }
      });

      // shipping change
      document.querySelectorAll('input[name="ship"]').forEach(r => {
        r.addEventListener('change', ()=>{
          ship = r.value;
          recalc();
        });
      });

      // clear cart
      document.getElementById('clearCart').addEventListener('click', ()=>{
        cart = [];
        render(); recalc();
      });

      // save demo
      document.getElementById('saveCart').addEventListener('click', ()=>{
        alert('Demo: корзина сохранена (в реале — localStorage/DB/сессия).');
      });

      // init
      render();
      recalc();
    })();
  </script>
</body>
</html>
