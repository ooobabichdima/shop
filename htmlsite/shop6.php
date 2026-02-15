<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="theme-color" content="#0b0f14" />
  <title>Оформление заказа | Strikeball Shop</title>
  <meta name="description" content="Оформление заказа: контакты, доставка, оплата, итог. Быстро и без лишних шагов." />

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
    button,input,select,textarea{font:inherit}
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
    .actions{display:flex; align-items:center; gap:10px}
    .iconbtn{
      width:42px; height:42px; border-radius:14px; background:rgba(255,255,255,.06);
      border:1px solid rgba(255,255,255,.12); display:grid; place-items:center; cursor:pointer;
      transition:background .12s ease, transform .12s ease, border-color .12s ease; position:relative;
    }
    .iconbtn:hover{background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.22); transform:translateY(-1px)}
    .badge{position:absolute; top:8px; right:8px; background:linear-gradient(180deg, rgba(255,77,77,.95), rgba(239,68,68,.9));
      border:1px solid rgba(255,255,255,.18); color:#120202; font-weight:900; border-radius:999px; padding:2px 6px; font-size:11px; line-height:1}

    .crumbs{padding:18px 0 10px; color:rgba(255,255,255,.62); font-size:13px}
    .crumbs a{color:rgba(255,255,255,.72)}
    .crumbs a:hover{color:var(--text)}

    .page-title{display:flex; justify-content:space-between; align-items:flex-end; gap:14px; flex-wrap:wrap}
    .page-title h1{margin:0; font-size:var(--h1); line-height:1.08}

    .layout{display:grid; grid-template-columns: 1.15fr .85fr; gap:16px; padding:10px 0 24px}

    /* forms */
    .section{padding:14px}
    .section + .section{margin-top:12px}
    .section h2{margin:0; font-size:var(--h2)}
    .fields{display:grid; grid-template-columns: 1fr 1fr; gap:10px; margin-top:12px}
    .field{display:grid; gap:6px}
    label{font-size:13px; color:rgba(255,255,255,.78); font-weight:800}
    .inp{
      padding:12px 12px; border-radius:14px;
      border:1px solid rgba(255,255,255,.12);
      background:rgba(255,255,255,.06);
      color:var(--text); outline:none;
    }
    .inp::placeholder{color:rgba(255,255,255,.45)}
    textarea.inp{min-height:92px; resize:vertical}

    .choice{
      margin-top:10px;
      display:grid; gap:10px;
    }
    .opt{
      display:flex; justify-content:space-between; gap:12px; align-items:flex-start;
      padding:12px; border-radius:16px;
      border:1px solid rgba(255,255,255,.10);
      background:rgba(0,0,0,.14);
      cursor:pointer;
    }
    .opt:hover{border-color:rgba(255,255,255,.18); background:rgba(255,255,255,.04)}
    .opt input{accent-color: var(--accent); margin-top:2px}

    /* order summary */
    .summary{padding:14px}
    .box{
      margin-top:12px; padding:12px; border-radius:18px; border:1px solid rgba(255,255,255,.12);
      background:rgba(0,0,0,.16); display:grid; gap:10px;
    }
    .line{display:flex; justify-content:space-between; gap:10px; color:rgba(255,255,255,.84); font-size:14px}
    .line span{color:var(--muted)}
    .total{display:flex; justify-content:space-between; gap:10px; align-items:baseline}
    .total b{font-size:18px}
    .mini{
      display:flex; justify-content:space-between; gap:12px; align-items:flex-start;
      padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.10); background:rgba(255,255,255,.05);
    }
    .mini b{font-size:13.5px}
    .mini .muted2{font-size:12.5px}

    .notice{
      display:none;
      padding:10px 12px; border-radius:14px;
      border:1px solid rgba(255,77,77,.25);
      background:rgba(255,77,77,.10);
      color:rgba(255,255,255,.88);
      font-size:13px;
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
      .layout{grid-template-columns: 1fr}
      .footer-grid{grid-template-columns:1.6fr 1fr 1fr}
    }
    @media (max-width: 560px){
      .fields{grid-template-columns: 1fr}
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
          <span>Strikeball Shop<small>Оформление</small></span>
        </a>

        <nav class="nav" aria-label="Основное меню">
          <a href="#">Каталог</a><a href="#">Акции</a><a href="#">Гайды</a><a href="#">Контакты</a>
        </nav>

        <div class="actions">
          <a class="btn small" href="cart.html">← В корзину</a>
          <button class="iconbtn" aria-label="Корзина">
            <span class="badge" id="cartCount">3</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M6 7h15l-2 10H7L6 7Z" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linejoin="round"/>
              <path d="M6 7 5 4H2" stroke="rgba(255,255,255,.85)" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <main class="container">
    <div class="crumbs">
      <a href="#">Главная</a> / <a href="cart.html">Корзина</a> / <span>Оформление</span>
    </div>

    <div class="page-title">
      <div>
        <h1>Оформление заказа</h1>
        <div class="muted" style="margin-top:6px; font-size:14px;">Заполни контакты, выбери доставку и оплату — и подтверждай заказ.</div>
      </div>
      <span class="pill" id="deliveryPill">Доставка: НП</span>
    </div>

    <section class="layout">
      <!-- LEFT: form -->
      <div>
        <div class="card section">
          <h2>Контактные данные</h2>
          <div class="fields">
            <div class="field">
              <label for="name">Имя и фамилия *</label>
              <input class="inp" id="name" placeholder="Например: Дмитрий Бабич" />
            </div>
            <div class="field">
              <label for="phone">Телефон *</label>
              <input class="inp" id="phone" placeholder="+38 (0__) ___ __ __" inputmode="tel" />
            </div>
            <div class="field">
              <label for="email">Email</label>
              <input class="inp" id="email" placeholder="you@mail.com" inputmode="email" />
            </div>
            <div class="field">
              <label for="comment">Комментарий</label>
              <input class="inp" id="comment" placeholder="Например: перезвонить после 18:00" />
            </div>
          </div>
        </div>

        <div class="card section" style="margin-top:12px;">
          <h2>Доставка</h2>
          <div class="muted2" style="margin-top:6px; font-size:13px;">Демо варианты. В реале подставишь города/отделения НП из API.</div>

          <div class="choice" style="margin-top:12px;">
            <label class="opt">
              <div>
                <b>Новая Почта (отделение)</b>
                <div class="muted2">120 грн • 1–3 дня</div>
              </div>
              <input type="radio" name="ship" value="np" checked />
            </label>

            <label class="opt">
              <div>
                <b>Курьер по городу</b>
                <div class="muted2">180 грн • в течение дня</div>
              </div>
              <input type="radio" name="ship" value="courier" />
            </label>

            <label class="opt">
              <div>
                <b>Самовывоз</b>
                <div class="muted2">0 грн • сегодня</div>
              </div>
              <input type="radio" name="ship" value="pickup" />
            </label>
          </div>

          <div class="fields" style="margin-top:12px;">
            <div class="field">
              <label for="city">Город *</label>
              <input class="inp" id="city" placeholder="Киев" />
            </div>
            <div class="field">
              <label for="address">Адрес / отделение *</label>
              <input class="inp" id="address" placeholder="НП отделение №__ или улица, дом" />
            </div>
            <div class="field" style="grid-column:1/-1;">
              <label for="deliveryNote">Примечание к доставке</label>
              <textarea class="inp" id="deliveryNote" placeholder="Код двери, этаж, ориентир (если курьер)"></textarea>
            </div>
          </div>
        </div>

        <div class="card section" style="margin-top:12px;">
          <h2>Оплата</h2>
          <div class="choice" style="margin-top:12px;">
            <label class="opt">
              <div>
                <b>Картой онлайн</b>
                <div class="muted2">LiqPay / WayForPay (пример)</div>
              </div>
              <input type="radio" name="pay" value="card" checked />
            </label>

            <label class="opt">
              <div>
                <b>Наложенный платеж</b>
                <div class="muted2">Оплата при получении</div>
              </div>
              <input type="radio" name="pay" value="cod" />
            </label>

            <label class="opt">
              <div>
                <b>Безнал для юр. лиц</b>
                <div class="muted2">Счет + реквизиты</div>
              </div>
              <input type="radio" name="pay" value="invoice" />
            </label>
          </div>
        </div>

        <div class="notice" id="formNotice" style="margin-top:12px;"></div>
      </div>

      <!-- RIGHT: summary -->
      <aside class="card summary">
        <div class="row" style="justify-content:space-between; align-items:flex-start; flex-wrap:wrap;">
          <div>
            <b>Ваш заказ</b>
            <div class="muted2" style="font-size:13px; margin-top:4px;">Проверь позиции и итог.</div>
          </div>
          <span class="pill" id="itemsPill">3 позиции</span>
        </div>

        <div class="box" id="miniItems">
          <!-- filled by JS -->
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
          <div class="row" style="margin-top:8px; flex-wrap:wrap;">
            <input class="inp" id="promoInput" placeholder="START10" style="flex:1; min-width:180px;" />
            <button class="btn small" type="button" id="applyPromo">Применить</button>
          </div>
          <div class="muted2" id="promoHint" style="margin-top:8px; font-size:12.5px;">Если пусто — скидка не применяется.</div>
        </div>

        <div class="grid" style="gap:10px;">
          <button class="btn primary" type="button" id="placeOrder">Подтвердить заказ</button>
          <button class="btn" type="button" id="saveDraft">Сохранить как черновик (demo)</button>
        </div>

        <div class="muted2" style="margin-top:10px; font-size:12.5px;">
          Нажимая “Подтвердить заказ”, вы соглашаетесь с офертой и политикой конфиденциальности.
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
            Checkout: контакты, доставка, оплата, валидация обязательных полей и динамический итог.
          </p>
        </div>
        <div><h5>Каталог</h5><a href="#">Приводы</a><a href="#">Защита</a><a href="#">Тактика</a><a href="#">Оптика</a></div>
        <div><h5>Покупателям</h5><a href="#">Доставка</a><a href="#">Оплата</a><a href="#">Гарантия</a><a href="#">Возврат</a></div>
        <div><h5>Компания</h5><a href="#">О нас</a><a href="#">Контакты</a><a href="#">Оферта</a><a href="#">Политика</a></div>
      </div>
      <div class="copyright"><div>© <span id="year"></span> Strikeball Shop</div><div>checkout.html</div></div>
    </div>
  </footer>

  <script>
    (function(){
      document.getElementById('year').textContent = new Date().getFullYear();

      // demo cart same as cart.html (потом заменишь на данные из сессии)
      let cart = [
        {id:'m4', title:'AEG M4 (CQB) — базовый комплект', price:9990, qty:1},
        {id:'mag', title:'Магазин M4 Mid-cap', price:390, qty:2},
        {id:'bbs', title:'Шары 0.25г (1 кг)', price:390, qty:1},
      ];

      // promos
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

      const fmt = (n)=> (Math.round(n)).toString().replace(/\B(?=(\d{3})+(?!\d))/g,' ') + ' грн';

      const elMini = document.getElementById('miniItems');
      const elSubtotal = document.getElementById('sumSubtotal');
      const elDiscount = document.getElementById('sumDiscount');
      const elShipping = document.getElementById('sumShipping');
      const elTotal = document.getElementById('sumTotal');
      const elItemsPill = document.getElementById('itemsPill');
      const elDeliveryPill = document.getElementById('deliveryPill');
      const elCartCount = document.getElementById('cartCount');

      function countPositions(){ return cart.length; }
      function countUnits(){ return cart.reduce((a,x)=>a+x.qty,0); }

      function calcSubtotal(){ return cart.reduce((a,x)=>a + x.price*x.qty, 0); }
      function calcDiscount(subtotal){
        if(!promo) return 0;
        if(promo.type==="percent") return Math.round(subtotal*(promo.value/100));
        if(promo.type==="fixed") return Math.min(promo.value, subtotal);
        return 0;
      }

      function renderMini(){
        elMini.innerHTML = cart.map(x => `
          <div class="mini">
            <div>
              <b>${x.title}</b>
              <div class="muted2">${x.qty} шт • ${fmt(x.price)} / шт</div>
            </div>
            <b>${fmt(x.price*x.qty)}</b>
          </div>
        `).join('');
        elItemsPill.textContent = `${countPositions()} позиции`;
        elCartCount.textContent = String(countUnits());
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

        elDeliveryPill.textContent = `Доставка: ${SHIPPING[ship].label}`;
      }

      // shipping change
      document.querySelectorAll('input[name="ship"]').forEach(r => {
        r.addEventListener('change', ()=>{
          ship = r.value;
          recalc();
        });
      });

      // promo
      const promoInput = document.getElementById('promoInput');
      const promoHint = document.getElementById('promoHint');
      document.getElementById('applyPromo').addEventListener('click', ()=>{
        const code = String(promoInput.value||'').trim().toUpperCase();
        if(!code){
          promo = null;
          promoHint.textContent = 'Промокод не указан — скидка не применяется.';
          recalc();
          return;
        }
        if(PROMOS[code]){
          promo = PROMOS[code];
          promoHint.textContent = `${code}: ${promo.label}`;
          recalc();
        } else {
          promo = null;
          promoHint.textContent = `Промокод "${code}" не найден.`;
          recalc();
        }
      });

      // validation + submit demo
      const notice = document.getElementById('formNotice');
      function showError(msg){
        notice.style.display = 'block';
        notice.textContent = msg;
        window.scrollTo({top:0, behavior:'smooth'});
      }
      function clearError(){
        notice.style.display = 'none';
        notice.textContent = '';
      }

      function isEmpty(v){ return !String(v||'').trim(); }

      document.getElementById('placeOrder').addEventListener('click', ()=>{
        clearError();

        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;
        const city = document.getElementById('city').value;
        const address = document.getElementById('address').value;

        if(!cart.length) return showError('Корзина пустая. Вернитесь в корзину и добавьте товары.');
        if(isEmpty(name)) return showError('Заполните поле: Имя и фамилия.');
        if(isEmpty(phone)) return showError('Заполните поле: Телефон.');
        if(isEmpty(city)) return showError('Заполните поле: Город.');
        if(isEmpty(address)) return showError('Заполните поле: Адрес / отделение.');

        const pay = document.querySelector('input[name="pay"]:checked')?.value || 'card';

        // DEMO: тут ты отправляешь POST на PHP: /api/order.php
        const payload = {
          customer:{name, phone, email:document.getElementById('email').value, comment:document.getElementById('comment').value},
          shipping:{type:ship, city, address, note:document.getElementById('deliveryNote').value},
          payment:{type:pay},
          promo: promoInput.value.trim().toUpperCase() || null,
          items: cart.map(x=>({id:x.id, qty:x.qty, price:x.price})),
        };

        alert('Заказ создан (demo).\n\n' + JSON.stringify(payload, null, 2));
        // window.location.href = 'thanks.html';
      });

      document.getElementById('saveDraft').addEventListener('click', ()=>{
        alert('Demo: черновик сохранен (в реале — localStorage/DB/сессия).');
      });

      // init
      renderMini();
      recalc();
    })();
  </script>
</body>
</html>
