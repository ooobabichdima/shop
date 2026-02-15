<!-- =========================
  HELP PICKER: "Помочь с подбором"
  Вставь в category.html
========================= -->
<section class="pick card" id="pick">
  <div class="pick-head">
    <div>
      <span class="pill">Подбор за 60 секунд</span>
      <h2 style="margin:10px 0 6px;">Помочь с подбором</h2>
      <p class="muted" style="margin:0; max-width:72ch;">
        Ответь на несколько вопросов — и мы подберём привод/комплект под твою площадку и бюджет.
        Можно сразу отправить заявку менеджеру.
      </p>
    </div>
    <div class="pick-actions">
      <button class="btn small" type="button" id="pickReset">Сброс</button>
      <button class="btn small primary" type="button" id="pickQuick">Заполнить пример (demo)</button>
    </div>
  </div>

  <div class="pick-grid">
    <!-- LEFT: form -->
    <div class="pick-form">
      <div class="pick-row">
        <label class="pick-label">Где играешь чаще?</label>
        <div class="pick-chips" data-name="place">
          <button type="button" class="chip" data-value="cqb">CQB (здания)</button>
          <button type="button" class="chip" data-value="forest">Лес/поле</button>
          <button type="button" class="chip" data-value="mix">50/50</button>
        </div>
        <div class="pick-hint muted2">От этого зависит желаемая дальность и удобство.</div>
      </div>

      <div class="pick-row">
        <label class="pick-label">Уровень игрока</label>
        <div class="pick-chips" data-name="level">
          <button type="button" class="chip" data-value="new">Новичок</button>
          <button type="button" class="chip" data-value="mid">Опытный</button>
          <button type="button" class="chip" data-value="pro">Хочу максимум</button>
        </div>
        <div class="pick-hint muted2">Новичкам — надежная база и простая эксплуатация.</div>
      </div>

      <div class="pick-row">
        <label class="pick-label">Бюджет на привод (грн)</label>
        <div class="pick-inline">
          <input class="inp" id="budget" placeholder="например 12000" inputmode="numeric" />
          <span class="pill" id="budgetBadge">—</span>
        </div>
        <div class="pick-hint muted2">Если не знаешь — оставь пустым, подберём оптимально.</div>
      </div>

      <div class="pick-row">
        <label class="pick-label">Что важнее?</label>
        <div class="pick-chips" data-name="priority">
          <button type="button" class="chip" data-value="range">Дальность</button>
          <button type="button" class="chip" data-value="response">Отклик/скорострельность</button>
          <button type="button" class="chip" data-value="reliable">Надёжность</button>
          <button type="button" class="chip" data-value="silent">Тише работа</button>
        </div>
        <div class="pick-hint muted2">Выбери 1–2 пункта.</div>
      </div>

      <div class="pick-row">
        <label class="pick-label">Платформа (если есть предпочтение)</label>
        <div class="pick-chips" data-name="platform">
          <button type="button" class="chip" data-value="m4">M4/AR</button>
          <button type="button" class="chip" data-value="ak">AK</button>
          <button type="button" class="chip" data-value="smg">SMG (MP5/MP7)</button>
          <button type="button" class="chip" data-value="any">Не важно</button>
        </div>
      </div>

      <div class="pick-row">
        <label class="pick-label">Нужен комплект “под ключ”?</label>
        <div class="pick-chips" data-name="bundle">
          <button type="button" class="chip" data-value="yes">Да, всё сразу</button>
          <button type="button" class="chip" data-value="no">Нет, только привод</button>
        </div>
        <div class="pick-hint muted2">Под ключ = привод + АКБ + зарядка + шары + 2 магазина.</div>
      </div>

      <div class="pick-row">
        <label class="pick-label">Контакт для связи</label>
        <div class="pick-inline">
          <input class="inp" id="contact" placeholder="Телефон или Telegram @username" />
          <button class="btn small primary" type="button" id="sendPick">Отправить</button>
        </div>
        <div class="pick-hint muted2">Мы не спамим. Уточним площадку/лимиты и подберём варианты.</div>
      </div>

      <div class="pick-note muted2" id="pickNote" style="display:none;"></div>
    </div>

    <!-- RIGHT: result -->
    <aside class="pick-result">
      <div class="pick-res-head">
        <b>Предварительная рекомендация</b>
        <span class="pill" id="resTag">—</span>
      </div>

      <div class="pick-res-box">
        <div class="pick-res-item">
          <div>
            <div class="pick-res-title" id="resTitle">Заполни ответы слева</div>
            <div class="muted" id="resText" style="margin-top:6px; font-size:13px;">
              Мы покажем 1–2 подходящих направления и комплект допов.
            </div>
          </div>
        </div>

        <div class="pick-res-list" id="resList" style="margin-top:12px; display:none;">
          <div class="mini">
            <div>
              <b id="mini1">—</b>
              <div class="muted2" id="mini1d">—</div>
            </div>
            <span class="pill" id="mini1p">—</span>
          </div>
          <div class="mini">
            <div>
              <b id="mini2">—</b>
              <div class="muted2" id="mini2d">—</div>
            </div>
            <span class="pill" id="mini2p">—</span>
          </div>
          <div class="mini" id="miniBundle" style="display:none;">
            <div>
              <b>Рекомендуемый комплект</b>
              <div class="muted2">2 магазина • LiPo 7.4V • smart зарядка • шары 0.25–0.28г</div>
            </div>
            <span class="pill">+ допы</span>
          </div>
        </div>

        <div class="pick-res-cta" style="margin-top:12px;">
          <button class="btn primary" type="button" id="showVariants">Показать подходящие товары</button>
          <button class="btn" type="button" id="copyPick">Скопировать ответы</button>
        </div>
      </div>

      <div class="muted2" style="margin-top:10px; font-size:12.5px;">
        Подбор учитывает площадку/лимиты. Финально согласуем перед покупкой.
      </div>
    </aside>
  </div>
</section>

<style>
  /* --- Styles for help picker (в том же стиле) --- */
  .pick{padding:14px; margin:16px 0 22px}
  .pick-head{display:flex; justify-content:space-between; gap:14px; align-items:flex-start; flex-wrap:wrap}
  .pick-actions{display:flex; gap:10px; flex-wrap:wrap}
  .pick-grid{display:grid; grid-template-columns: 1.2fr .8fr; gap:12px; margin-top:12px}
  .pick-form{padding:12px; border-radius:18px; border:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.14)}
  .pick-result{padding:12px; border-radius:18px; border:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.14)}
  .pick-row{display:grid; gap:8px; padding:10px 0}
  .pick-row + .pick-row{border-top:1px solid rgba(255,255,255,.08)}
  .pick-label{font-size:13px; color:rgba(255,255,255,.82); font-weight:900}
  .pick-hint{font-size:12.5px}
  .pick-inline{display:flex; gap:10px; align-items:center; flex-wrap:wrap}
  .pick-chips{display:flex; gap:8px; flex-wrap:wrap}
  .chip{
    padding:10px 12px; border-radius:999px;
    border:1px solid rgba(255,255,255,.12);
    background:rgba(255,255,255,.05);
    color:rgba(255,255,255,.86);
    cursor:pointer;
    transition:.12s ease;
    font-weight:900;
    font-size:13px;
  }
  .chip:hover{transform:translateY(-1px); border-color:rgba(255,255,255,.22); background:rgba(255,255,255,.07)}
  .chip.active{border-color:rgba(88,255,122,.35); background:rgba(88,255,122,.10); color:rgba(255,255,255,.95)}
  .pick-res-head{display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap}
  .pick-res-box{margin-top:10px; padding:12px; border-radius:18px; border:1px solid rgba(255,255,255,.10); background:rgba(255,255,255,.04)}
  .pick-res-title{font-weight:950; font-size:15px}
  .pick-res-list{display:grid; gap:10px}
  .mini{
    display:flex; justify-content:space-between; gap:12px; align-items:flex-start;
    padding:10px 12px; border-radius:14px; border:1px solid rgba(255,255,255,.10); background:rgba(0,0,0,.14);
  }
  .pick-res-cta{display:flex; gap:10px; flex-wrap:wrap}
  .pick-note{
    margin-top:10px;
    padding:10px 12px; border-radius:14px;
    border:1px solid rgba(88,255,122,.25);
    background:rgba(88,255,122,.10);
  }
  @media (max-width: 980px){
    .pick-grid{grid-template-columns:1fr}
  }
</style>

<script>
  (function(){
    const state = {
      place: null,
      level: null,
      budget: null,
      priority: [], // multi
      platform: null,
      bundle: null,
    };

    const chipsGroups = Array.from(document.querySelectorAll('.pick-chips'));
    const budgetInput = document.getElementById('budget');
    const budgetBadge = document.getElementById('budgetBadge');
    const contact = document.getElementById('contact');

    const resTag = document.getElementById('resTag');
    const resTitle = document.getElementById('resTitle');
    const resText = document.getElementById('resText');
    const resList = document.getElementById('resList');
    const mini1 = document.getElementById('mini1');
    const mini1d = document.getElementById('mini1d');
    const mini1p = document.getElementById('mini1p');
    const mini2 = document.getElementById('mini2');
    const mini2d = document.getElementById('mini2d');
    const mini2p = document.getElementById('mini2p');
    const miniBundle = document.getElementById('miniBundle');
    const pickNote = document.getElementById('pickNote');

    const pickReset = document.getElementById('pickReset');
    const pickQuick = document.getElementById('pickQuick');
    const sendPick = document.getElementById('sendPick');
    const showVariants = document.getElementById('showVariants');
    const copyPick = document.getElementById('copyPick');

    const fmt = (n) => (Math.round(n)).toString().replace(/\B(?=(\d{3})+(?!\d))/g,' ');

    function setChipActive(btn, on){
      btn.classList.toggle('active', !!on);
    }

    function updateBudget(){
      const raw = String(budgetInput.value || '').replace(/[^\d]/g,'');
      state.budget = raw ? Math.max(0, parseInt(raw,10)) : null;
      budgetBadge.textContent = state.budget ? (fmt(state.budget) + ' грн') : 'без бюджета';
    }

    function selectSingle(groupEl, value){
      const name = groupEl.dataset.name;

      // priority is multi
      if(name === 'priority'){
        const idx = state.priority.indexOf(value);
        if(idx >= 0) state.priority.splice(idx,1);
        else{
          // limit to 2 to keep clean
          if(state.priority.length >= 2) state.priority.shift();
          state.priority.push(value);
        }
        groupEl.querySelectorAll('.chip').forEach(b=>{
          setChipActive(b, state.priority.includes(b.dataset.value));
        });
        return;
      }

      // single selection
      state[name] = value;
      groupEl.querySelectorAll('.chip').forEach(b=>{
        setChipActive(b, b.dataset.value === value);
      });
    }

    function buildRecommendation(){
      // Minimal heuristic (demo) — потом можешь заменить на подбор из БД/по правилам
      const place = state.place;
      const level = state.level;
      const budget = state.budget;
      const priority = state.priority;
      const platform = state.platform;

      const isCQB = place === 'cqb';
      const isForest = place === 'forest';
      const wantRange = priority.includes('range');
      const wantResponse = priority.includes('response');
      const wantReliable = priority.includes('reliable');
      const wantSilent = priority.includes('silent');

      // tag
      let tag = 'Подбор';
      if(isCQB) tag = 'CQB';
      if(isForest) tag = 'Лес/поле';
      if(place === 'mix') tag = 'Универсал';

      // title
      let title = 'Подбор по твоим ответам';
      if(isCQB && (wantResponse || level==='pro')) title = 'CQB: быстрый отклик + компакт';
      else if(isForest && wantRange) title = 'Лес: упор на дальность и кучность';
      else if(wantReliable || level==='new') title = 'Надёжная база без сюрпризов';
      else if(wantSilent) title = 'Тише работа: обслуживание + шимминг';

      // price bands demo
      let band = 'до 12 000';
      if(budget && budget >= 20000) band = '20 000+';
      else if(budget && budget >= 15000) band = '15 000–20 000';
      else if(budget && budget >= 12000) band = '12 000–15 000';
      else if(budget && budget > 0) band = 'до 12 000';

      // platform text
      const plat = (platform && platform !== 'any') ? platform.toUpperCase() : 'любая';

      resTag.textContent = tag;
      resTitle.textContent = title;
      resText.textContent =
        `Ориентир по бюджету: ${band}. Платформа: ${plat}. Ниже — 2 направления (demo), а менеджер даст точные позиции и совместимость.`;

      // variants
      resList.style.display = 'grid';
      miniBundle.style.display = (state.bundle === 'yes') ? 'flex' : 'none';

      // mini 1
      let v1 = 'AEG M4 (CQB) — надежная база';
      let v1d = 'Для новичка/универсала: стабильность, простое обслуживание';
      let v1p = '12–15k';

      // mini 2
      let v2 = 'AEG AK — универсальный вариант';
      let v2d = 'Хорошая дальность при правильных шарах и настройке';
      let v2p = '12–18k';

      if(isCQB && wantResponse){
        v1 = 'AEG CQB + “пакет Реакция”';
        v1d = 'Отклик, комфортная очередь, настройка hop-up';
        v1p = '15–20k';
        v2 = 'SMG (MP5/MP7) компакт';
        v2d = 'Короткий корпус, удобно в помещениях';
        v2p = '12–18k';
      }
      if(isForest && wantRange){
        v1 = 'AEG универсал + “пакет Дальность”';
        v1d = 'Резинка/нуб + компрессия + точная настройка';
        v1p = '15–22k';
        v2 = 'AEG DMR-base (в рамках лимитов)';
        v2d = 'Упор на кучность, подбор шаров 0.28–0.32г';
        v2p = '18–28k';
      }
      if(wantSilent){
        v2 = '“Пакет Стабильность/Тише”';
        v2d = 'Обслуживание + шимминг + демпферы (по необходимости)';
        v2p = '1.5–3.5k';
      }
      if(platform === 'ak'){ v1 = v1.replace('M4','AK'); }
      if(platform === 'm4'){ v2 = v2.replace('AK','M4'); }

      mini1.textContent = v1;
      mini1d.textContent = v1d;
      mini1p.textContent = v1p;

      mini2.textContent = v2;
      mini2d.textContent = v2d;
      mini2p.textContent = v2p;
    }

    function getSummaryText(){
      const map = (v)=> v ? v : '—';
      const pr = state.priority.length ? state.priority.join(', ') : '—';
      const b = state.budget ? (fmt(state.budget) + ' грн') : '—';
      return [
        `Площадка: ${map(state.place)}`,
        `Уровень: ${map(state.level)}`,
        `Бюджет: ${b}`,
        `Приоритет: ${pr}`,
        `Платформа: ${map(state.platform)}`,
        `Комплект под ключ: ${map(state.bundle)}`,
      ].join('\n');
    }

    function maybeRecalc(){
      // show recommendation when main fields exist
      if(state.place || state.level || state.priority.length || state.platform || state.bundle || state.budget){
        buildRecommendation();
      }
    }

    // bind chips
    chipsGroups.forEach(g=>{
      g.querySelectorAll('.chip').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          selectSingle(g, btn.dataset.value);
          maybeRecalc();
        });
      });
    });

    // budget
    budgetInput.addEventListener('input', ()=>{
      updateBudget();
      maybeRecalc();
    });
    updateBudget();

    // reset
    pickReset.addEventListener('click', ()=>{
      state.place = null;
      state.level = null;
      state.budget = null;
      state.priority = [];
      state.platform = null;
      state.bundle = null;

      budgetInput.value = '';
      contact.value = '';
      updateBudget();

      chipsGroups.forEach(g=>{
        g.querySelectorAll('.chip').forEach(btn=> setChipActive(btn,false));
      });

      resTag.textContent = '—';
      resTitle.textContent = 'Заполни ответы слева';
      resText.textContent = 'Мы покажем 1–2 подходящих направления и комплект допов.';
      resList.style.display = 'none';
      miniBundle.style.display = 'none';
      pickNote.style.display = 'none';
      pickNote.textContent = '';
    });

    // demo fill
    pickQuick.addEventListener('click', ()=>{
      // set some defaults
      // place
      selectSingle(document.querySelector('.pick-chips[data-name="place"]'), 'cqb');
      selectSingle(document.querySelector('.pick-chips[data-name="level"]'), 'new');
      budgetInput.value = '12000';
      updateBudget();
      selectSingle(document.querySelector('.pick-chips[data-name="priority"]'), 'reliable');
      selectSingle(document.querySelector('.pick-chips[data-name="priority"]'), 'response');
      selectSingle(document.querySelector('.pick-chips[data-name="platform"]'), 'm4');
      selectSingle(document.querySelector('.pick-chips[data-name="bundle"]'), 'yes');
      contact.value = '@username';
      maybeRecalc();
    });

    // copy
    copyPick.addEventListener('click', async ()=>{
      const txt = getSummaryText();
      try{
        await navigator.clipboard.writeText(txt);
        pickNote.style.display = 'block';
        pickNote.textContent = 'Скопировано ✅';
      }catch(e){
        pickNote.style.display = 'block';
        pickNote.textContent = 'Не удалось скопировать (браузер запретил). Можно выделить и копировать вручную.';
      }
    });

    // show variants (demo)
    showVariants.addEventListener('click', ()=>{
      // In real: build query string and reload category with params
      const params = new URLSearchParams();
      if(state.place) params.set('place', state.place);
      if(state.level) params.set('level', state.level);
      if(state.platform) params.set('platform', state.platform);
      if(state.bundle) params.set('bundle', state.bundle);
      if(state.priority.length) params.set('priority', state.priority.join(','));
      if(state.budget) params.set('budget', String(state.budget));
      pickNote.style.display = 'block';
      pickNote.textContent = 'Demo: тут можно перезагрузить категорию с фильтрами: ?' + params.toString();
    });

    // send pick (demo)
    sendPick.addEventListener('click', ()=>{
      const c = String(contact.value||'').trim();
      if(!c){
        pickNote.style.display = 'block';
        pickNote.textContent = 'Укажи контакт (телефон или Telegram).';
        return;
      }
      const payload = {
        ...state,
        budget: state.budget || null,
        priority: state.priority,
        contact: c,
        created_at: new Date().toISOString()
      };
      pickNote.style.display = 'block';
      pickNote.textContent = 'Заявка отправлена (demo). В реале: POST на PHP / Telegram.';

      // TODO: заменить на fetch('/api/pick.php', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(payload)})
      console.log('pick payload', payload);
    });
  })();
</script>
