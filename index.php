<?php
// index.php - Página inicial do site de pontos turísticos de Ourinhos
// Estrutura: PHP (dados), HTML, CSS (interno) e JavaScript (inline)

$attractions = [
    [
        'title' => 'Parque Ecológico (Parque Olavo Ferreira de Sá)',
        'slug' => 'parque-ecologico',
        'desc' => 'Grande área verde com trilhas, lago e espaço para lazer em família.',
        'img' => 'assets/img/parque-ecologico.jpg',
        'info' => 'Horário: 6h - 18h | Entrada gratuita'
    ],
    [
        'title' => 'Museu Municipal Histórico e Pedagógico',
        'slug' => 'museu-municipal',
        'desc' => 'Acervo sobre a história de Ourinhos, exposições e Casinha da Memória.',
        'img' => 'assets/img/museu.jpg',
        'info' => 'Horário: consulte o museu antes de visitar'
    ],
    [
        'title' => 'Jardim Oriental',
        'slug' => 'jardim-oriental',
        'desc' => 'Espaço paisagístico com plantas exóticas e elementos da cultura oriental.',
        'img' => 'assets/img/jardim-oriental.jpg',
        'info' => 'Local ideal para passeios e fotos.'
    ],
    [
        'title' => 'Praça Melo Peixoto',
        'slug' => 'praca-melo-peixoto',
        'desc' => 'Praça central com espaços culturais, feiras e eventos ao ar livre.',
        'img' => 'assets/img/praca.jpg',
        'info' => 'Eventos sazonais e feira livre.'
    ]
];

// Seções extras (placeholders)
$restaurants = [
    ['name'=>'Restaurante A', 'desc'=>'Culinária típica da região', 'img'=>'assets/img/restauranteA.jpg', 'link'=>'#'],
    ['name'=>'Bistrô B', 'desc'=>'Comida contemporânea com toque regional', 'img'=>'assets/img/bistroB.jpg', 'link'=>'#']
];

$hotels = [
    ['name'=>'Hotel X', 'desc'=>'Conforto no centro da cidade', 'img'=>'assets/img/hotelX.jpg', 'link'=>'#'],
    ['name'=>'Pousada Y', 'desc'=>'Ambiente acolhedor para famílias', 'img'=>'assets/img/pousadaY.jpg', 'link'=>'#']
];

$fitness = [
    ['name'=>'Academia FitLife','desc'=>'Treinos modernos e equipamentos completos','img'=>'assets/img/fitness1.jpg','link'=>'#'],
    ['name'=>'Parque para Corrida','desc'=>'Trilhas e pistas para corrida','img'=>'assets/img/fitness2.jpg','link'=>'#']
];

$cultura = [
    ['name'=>'Teatro Municipal','desc'=>'Espetáculos e apresentações culturais','img'=>'assets/img/cultura1.jpg','link'=>'#'],
    ['name'=>'Centro Cultural','desc'=>'Exposições e oficinas de arte','img'=>'assets/img/cultura2.jpg','link'=>'#']
];

$eventos = [
    ['name'=>'Feira de Artesanato','desc'=>'Produtos locais e eventos temáticos','img'=>'assets/img/evento1.jpg','link'=>'#'],
    ['name'=>'Festival de Música','desc'=>'Shows e apresentações ao vivo','img'=>'assets/img/evento2.jpg','link'=>'#']
];

// Função para previsão do tempo (placeholder - insira sua chave se desejar)
function getWeatherForecast() {
    $apiKey = 'SUA_CHAVE_OPENWEATHER'; // insira sua chave de API aqui
    if($apiKey === 'SUA_CHAVE_OPENWEATHER') return null; // evita tentativas sem chave
    $city = 'Ourinhos,BR';
    $url = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&lang=pt&appid={$apiKey}";
    $json = @file_get_contents($url);
    if(!$json) return null;
    return json_decode($json, true);
}

$weather = getWeatherForecast();

?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ourinhos — Pontos Turísticos</title>
  <meta name="description" content="Guia rápido dos principais pontos turísticos de Ourinhos: parques, museus, praças e atrações culturais.">

  <style>
    :root{
      --blue:#004aad;
      --blue-600:#1e40af;
      --yellow:#facc15;
      --white:#ffffff;
      --muted:#6b7280;
      --card-bg:#ffffff;
      --glass: rgba(255,255,255,0.12);
    }
    *{box-sizing:border-box}
    body{font-family:Inter,system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;margin:0;background:#f0f6ff;color:#0b1220}
    header{background:linear-gradient(90deg,var(--blue),var(--blue-600));color:var(--white);padding:28px 20px}
    .container{max-width:1100px;margin:0 auto;padding:20px}
    .brand{display:flex;align-items:center;gap:14px}
    .brand h1{font-size:22px;margin:0;color:var(--yellow)}
    nav{margin-top:12px}
    nav a{color:var(--white);text-decoration:none;margin-right:14px;font-weight:600;transition:.25s}
    nav a:hover{color:var(--yellow)}

    .hero{display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:center;margin-top:22px}
    .hero-card{background:linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));padding:18px;border-radius:12px;color:var(--white);backdrop-filter:blur(4px)}
    .search{display:flex;gap:8px;margin-top:12px}
    .search input{flex:1;padding:12px;border-radius:10px;border:none;font-size:14px}
    .search button{padding:10px 14px;border-radius:10px;border:none;background:var(--yellow);color:var(--blue);font-weight:700;cursor:pointer;transition:.2s}
    .search button:hover{background:#fde047}

    .grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px;margin-top:22px}
    .card{background:var(--card-bg);border-radius:12px;box-shadow:0 8px 24px rgba(2,6,23,0.06);overflow:hidden;display:flex;flex-direction:column;transition:transform .25s, box-shadow .25s;}
    .card:hover{transform:translateY(-6px);box-shadow:0 14px 40px rgba(2,6,23,0.10)}
    .card img{width:100%;height:180px;object-fit:cover}
    .card .card-body{padding:16px;flex:1}
    .card h3{margin:0 0 8px 0;font-size:18px;color:var(--blue)}
    .card p{margin:0;color:var(--muted);font-size:14px}
    .card .meta{margin-top:10px;font-size:13px;color:#374151}
    .btn{display:inline-block;padding:10px 14px;border-radius:10px;text-decoration:none;background:var(--blue);color:var(--white);font-weight:700;margin-top:12px;transition:background .2s}
    .btn:hover{background:var(--blue-600)}

    /* CONTACT STYLES */
    .contact-wrap{display:grid;grid-template-columns:1fr 420px;gap:20px;margin-top:18px;align-items:start}
    .contact-card{background:linear-gradient(180deg,var(--card-bg),#fbfdff);padding:18px;border-radius:14px;box-shadow:0 10px 30px rgba(2,6,23,0.06)}
    .contact-head{display:flex;align-items:center;gap:12px}
    .contact-head svg{flex:0 0 52px;height:52px;width:52px;border-radius:10px;padding:8px;background:var(--glass)}
    .contact-head h3{margin:0;font-size:20px;color:var(--blue)}
    .contact-desc{color:var(--muted);margin-top:8px}

    /* Form */
    form.contact-form{display:grid;gap:12px;margin-top:12px}
    .field{position:relative}
    .field input,.field textarea{width:100%;padding:14px 14px 14px 14px;border-radius:10px;border:1px solid #e6eefb;background:#fff;font-size:14px;outline:none;transition:box-shadow .15s,border-color .15s}
    .field textarea{min-height:140px;resize:vertical}
    .field input:focus,.field textarea:focus{box-shadow:0 8px 20px rgba(2,6,23,0.06);border-color:var(--blue)}
    .label{position:absolute;left:14px;top:12px;font-size:13px;color:#8b9bb3;pointer-events:none;transition:transform .12s, font-size .12s, top .12s}
    .field input:not(:placeholder-shown) + .label,
    .field textarea:not(:placeholder-shown) + .label,
    .field input:focus + .label,
    .field textarea:focus + .label{transform:translateY(-22px);font-size:12px;color:var(--blue)}

    .form-actions{display:flex;gap:10px;align-items:center;justify-content:flex-end;margin-top:6px}
    .btn-ghost{background:transparent;border:1px solid rgba(2,6,23,0.06);padding:10px 14px;border-radius:10px;color:var(--blue);font-weight:700}

    /* contact aside */
    .contact-info{background:linear-gradient(180deg,rgba(0,74,173,0.03),rgba(255,255,255,0.02));padding:18px;border-radius:14px;border:1px solid rgba(2,6,23,0.03)}
    .info-item{display:flex;gap:12px;align-items:flex-start;margin-bottom:12px}
    .info-item strong{display:block;color:var(--blue);}
    .small{font-size:13px;color:var(--muted)}

    /* Toast */
    .toast{position:fixed;right:20px;bottom:20px;background:linear-gradient(90deg,var(--blue),var(--blue-600));color:var(--white);padding:12px 16px;border-radius:10px;box-shadow:0 8px 24px rgba(2,6,23,0.18);display:none}

    footer{padding:20px;background:var(--blue);margin-top:26px;border-top:4px solid var(--yellow);color:var(--white)}

    /* responsivo */
    @media (max-width:980px){.contact-wrap{grid-template-columns:1fr}}
    @media (max-width:680px){.hero{grid-template-columns:1fr}.card img{height:140px}}

    /* Grid horizontal scroll */
.scroll-grid{
  display:flex;
  gap:18px;
  overflow-x:auto;
  padding-bottom:8px;
  scroll-snap-type:x mandatory;
}
.scroll-grid::-webkit-scrollbar{height:10px}
.scroll-grid::-webkit-scrollbar-thumb{background:var(--blue);border-radius:10px}
.scroll-grid::-webkit-scrollbar-track{background:#f0f6ff}
.scroll-card{
  flex:0 0 auto;
  width:240px;
  scroll-snap-align:start;
}
  </style>
</head>
<body>
  <header>
    <div class="container">
      <div class="brand">
        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden>
          <rect width="24" height="24" rx="6" fill="white" opacity="0.12"/>
          <path d="M6 14c1.5-3 3.5-5 6-5s4.5 2 6 5v3H6v-3z" fill="white" opacity="0.95"/>
        </svg>
        <div>
          <h1>Ourinhos — Turismo</h1>
          <div style="color:var(--white);font-size:13px">Guia rápido de pontos turísticos</div>
        </div>
      </div>
      <nav>
        <a href="#">Início</a>
        <a href="#atracoes">Atrações</a>
        <a href="#onde-comer">Onde Comer</a>
        <a href="#onde-ficar">Onde Ficar</a>
        <a href="#clima">Clima</a>
        <a href="#contato">Contato</a>
        <a href="https://turismo.ourinhos.sp.gov.br" target="_blank" rel="noopener">Portal Oficial</a>
      </nav>

      <div class="hero" style="margin-top:18px">
        <div class="hero-card">
          <h2 style="color:var(--yellow)">Descubra Ourinhos</h2>
          <p style="color:var(--white)">Explore parques, museus, praças e atividades culturais. Clique em um cartão para saber mais.</p>

          <div class="search" role="search">
            <input id="q" placeholder="Buscar atração, parque ou museu..." aria-label="Buscar atrações">
            <button id="btnSearch">Buscar</button>
          </div>

          <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
            <a class="btn" href="#atracoes" style="background:var(--yellow);color:var(--blue)">Ver atrações</a>
            <a class="btn" href="#contato">Entrar em contato</a>
          </div>
        </div>

        <aside style="background:var(--white);border-radius:12px;padding:14px;color:var(--blue)">
          <h3 style="margin:0 0 8px 0">Informações úteis</h3>
          <p style="margin:0 0 8px 0;color:var(--muted)">Secretaria de Turismo — Ourinhos<br>Rua Cardoso Ribeiro, 290 — Centro</p>
          <p style="margin:0;color:var(--muted)">Telefone: (14) 3302-1450</p>
        </aside>
      </div>

    </div>
  </header>

  <main class="container">
    <section id="atracoes">
      <h2 style="margin-top:18px;color:var(--blue)">Atrações em destaque</h2>
      <div class="grid" id="cards">
        <?php foreach($attractions as $a): ?>
          <article class="card" data-slug="<?= htmlspecialchars($a['slug']) ?>">
            <img src="<?= htmlspecialchars($a['img']) ?>" alt="<?= htmlspecialchars($a['title']) ?>">
            <div class="card-body">
              <h3><?= htmlspecialchars($a['title']) ?></h3>
              <p><?= htmlspecialchars($a['desc']) ?></p>
              <div class="meta"><?= htmlspecialchars($a['info']) ?></div>
              <a class="btn" href="attraction.php?slug=<?= urlencode($a['slug']) ?>">Saiba mais</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Onde Comer -->
    <section id="onde-comer" style="margin-top:28px">
      <h2 style="color:var(--blue)">Onde Comer</h2>
      <div class="grid">
        <?php foreach($restaurants as $r): ?>
          <div class="card">
            <img src="<?= htmlspecialchars($r['img']) ?>" alt="<?= htmlspecialchars($r['name']) ?>">
            <div class="card-body">
              <h3><?= htmlspecialchars($r['name']) ?></h3>
              <p><?= htmlspecialchars($r['desc']) ?></p>
              <a class="btn" href="<?= htmlspecialchars($r['link']) ?>">Ver mais</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Onde Ficar -->
    <section id="onde-ficar" style="margin-top:28px">
      <h2 style="color:var(--blue)">Onde Ficar</h2>
      <div class="grid">
        <?php foreach($hotels as $h): ?>
          <div class="card">
            <img src="<?= htmlspecialchars($h['img']) ?>" alt="<?= htmlspecialchars($h['name']) ?>">
            <div class="card-body">
              <h3><?= htmlspecialchars($h['name']) ?></h3>
              <p><?= htmlspecialchars($h['desc']) ?></p>
              <a class="btn" href="<?= htmlspecialchars($h['link']) ?>">Ver mais</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>


<!-- Fitness -->
<section id="fitness" style="margin-top:28px">
  <h2 style="color:var(--blue)">Fitness & Lazer</h2>
  <div class="scroll-grid">
    <?php foreach($fitness as $f): ?>
      <div class="card scroll-card">
        <img src="<?= htmlspecialchars($f['img']) ?>" alt="<?= htmlspecialchars($f['name']) ?>">
        <div class="card-body">
          <h3><?= htmlspecialchars($f['name']) ?></h3>
          <p><?= htmlspecialchars($f['desc']) ?></p>
          <a class="btn" href="<?= htmlspecialchars($f['link']) ?>">Ver mais</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Cultura -->
<section id="cultura" style="margin-top:28px">
  <h2 style="color:var(--blue)">Cultura & Arte</h2>
  <div class="scroll-grid">
    <?php foreach($cultura as $c): ?>
      <div class="card scroll-card">
        <img src="<?= htmlspecialchars($c['img']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
        <div class="card-body">
          <h3><?= htmlspecialchars($c['name']) ?></h3>
          <p><?= htmlspecialchars($c['desc']) ?></p>
          <a class="btn" href="<?= htmlspecialchars($c['link']) ?>">Ver mais</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Eventos -->
<section id="eventos" style="margin-top:28px">
  <h2 style="color:var(--blue)">Eventos</h2>
  <div class="scroll-grid">
    <?php foreach($eventos as $e): ?>
      <div class="card scroll-card">
        <img src="<?= htmlspecialchars($e['img']) ?>" alt="<?= htmlspecialchars($e['name']) ?>">
        <div class="card-body">
          <h3><?= htmlspecialchars($e['name']) ?></h3>
          <p><?= htmlspecialchars($e['desc']) ?></p>
          <a class="btn" href="<?= htmlspecialchars($e['link']) ?>">Ver mais</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

    <!-- Contato -->
    <section id="contato" style="margin-top:28px">
      <div class="contact-wrap">
        <div class="contact-card">
          <div class="contact-head">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="24" height="24" rx="6" fill="rgba(0,74,173,0.08)"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM6 18v-1c0-2.21 3.58-4 6-4s6 1.79 6 4v1H6z" fill="#004aad"/></svg>
            <div>
              <h3>Fale conosco</h3>
              <div class="contact-desc">Tem alguma dúvida, sugestão ou quer incluir sua atração? Envie uma mensagem — responderemos em breve.</div>
            </div>
          </div>

          <form class="contact-form" id="contactForm" action="contact_submit.php" method="post" novalidate>
            <div class="field">
              <input type="text" name="name" id="name" placeholder=" " required>
              <label class="label" for="name">Seu nome</label>
            </div>
            <div class="field">
              <input type="email" name="email" id="email" placeholder=" " required>
              <label class="label" for="email">Seu e-mail</label>
            </div>
            <div class="field">
              <textarea name="message" id="message" placeholder=" " required></textarea>
              <label class="label" for="message">Mensagem</label>
            </div>

            <div class="form-actions">
              <button type="button" class="btn-ghost" id="resetBtn">Limpar</button>
              <button type="submit" class="btn">Enviar mensagem</button>
            </div>
          </form>
        </div>

        <aside class="contact-info">
          <div class="info-item">
            <div>
              <strong>Secretaria de Turismo</strong>
              <div class="small">Rua Cardoso Ribeiro, 290 — Centro</div>
            </div>
          </div>
          <div class="info-item">
            <div>
              <strong>Telefone</strong>
              <div class="small">(14) 3302-1450</div>
            </div>
          </div>
          <div class="info-item">
            <div>
              <strong>E-mail</strong>
              <div class="small">turismo@ourinhos.sp.gov.br</div>
            </div>
          </div>
          <div style="margin-top:12px">
            <strong style="color:var(--blue)">Redes sociais</strong>
            <div class="small" style="margin-top:6px">Siga a Prefeitura e o Portal de Turismo para novidades e eventos.</div>
          </div>
        </aside>
      </div>

    </section>

  </main>

  <footer>
    <div class="container" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap">
      <div style="font-size:14px">&copy; <?= date('Y') ?> — Guia de Turismo Ourinhos</div>
      <div style="display:flex;gap:12px;align-items:center">
        <a href="https://www.ourinhos.sp.gov.br/" target="_blank" rel="noopener">Prefeitura de Ourinhos</a>
        <a href="https://turismo.ourinhos.sp.gov.br/" target="_blank" rel="noopener">Portal de Turismo</a>
      </div>
    </div>
  </footer>

  <div class="toast" id="toast">Mensagem enviada com sucesso!</div>

  <script>
    // Busca nos cards
    const attractions = Array.from(document.querySelectorAll('.card'));
    document.getElementById('btnSearch').addEventListener('click', ()=>{
      const q = document.getElementById('q').value.trim().toLowerCase();
      if(!q){ attractions.forEach(c=>c.style.display='block'); return; }
      attractions.forEach(c=>{
        const text = c.textContent.toLowerCase();
        c.style.display = text.includes(q) ? 'block' : 'none';
      });
    });

    // Form: reset, validation simples, envio com fetch e toast
    const form = document.getElementById('contactForm');
    const resetBtn = document.getElementById('resetBtn');
    const toast = document.getElementById('toast');

    resetBtn.addEventListener('click', ()=>{
      form.reset();
      // remove floating labels (placeholder trick): nothing else needed because labels float based on :placeholder-shown
    });

    form.addEventListener('submit', async (e)=>{
      e.preventDefault();
      const submitBtn = form.querySelector('button[type=submit]');
      submitBtn.disabled = true; submitBtn.textContent = 'Enviando...';

      const data = new FormData(form);
      try{
        const res = await fetch(form.action, {method:'POST', body:data});
        if(res.ok){
          showToast('Mensagem enviada com sucesso! Obrigado.');
          form.reset();
        } else {
          showToast('Erro ao enviar a mensagem. Tente novamente.');
        }
      }catch(err){
        showToast('Erro de rede ao enviar.');
      }finally{
        submitBtn.disabled = false; submitBtn.textContent = 'Enviar mensagem';
      }
    });

    function showToast(msg){
      toast.textContent = msg;
      toast.style.display = 'block';
      toast.style.opacity = '1';
      setTimeout(()=>{ toast.style.transition = 'opacity .6s'; toast.style.opacity = '0'; }, 2800);
      setTimeout(()=>{ toast.style.display = 'none'; toast.style.transition = ''; }, 3400);
    }
  </script>
</body>
</html>
