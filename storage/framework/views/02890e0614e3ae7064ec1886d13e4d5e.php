<style>
  :root{
    --red:#C41E17; --red-dark:#8E120D;
    --ink:#17171A; --paper:#FFFFFF; --bg:#EFEEE9; --line:#D8D6CF; --line-dark:#B9B7AE;
    --amber:#9A6B00; --amber-bg:#F6EDD8; --green:#1D6B3F; --green-bg:#E2EFE7;
    --red-bg:#F7E3E1; --muted:#6E6E66;
    --safe-top:env(safe-area-inset-top,0px); --safe-bot:env(safe-area-inset-bottom,0px);
    --mono:ui-monospace,"SF Mono","Roboto Mono",Menlo,Consolas,monospace;
  }
  *{margin:0;padding:0;box-sizing:border-box;-webkit-tap-highlight-color:transparent}
  html,body{height:100%}
  body{
    font-family:-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;
    background:var(--bg); color:var(--ink); max-width:520px; margin:0 auto;
    display:flex; flex-direction:column; min-height:100dvh; font-size:15px;
  }
  .caps{font-weight:800;text-transform:uppercase;letter-spacing:.09em}
  .mono{font-family:var(--mono)}

  header{
    background:var(--red); color:#fff; padding:calc(12px + var(--safe-top)) 16px 11px;
    display:flex; align-items:baseline; gap:10px; position:sticky; top:0; z-index:40;
    border-bottom:3px solid var(--ink);
  }
  header .t1{font-size:19px;font-weight:900;letter-spacing:.02em}
  header .t2{font-size:10px;letter-spacing:.14em;text-transform:uppercase;opacity:.85}
  header .who{margin-left:auto;font-size:10.5px;text-align:right;line-height:1.5;opacity:.95}
  .tape{height:5px;background:repeating-linear-gradient(-45deg,var(--ink) 0 9px,#E8B93B 9px 18px)}

  main{flex:1; overflow-y:auto; padding-bottom:calc(74px + var(--safe-bot))}
  .screen{display:none; padding:16px 14px 30px}
  .screen.active{display:block}

  .sec{display:flex;align-items:baseline;gap:8px;margin:24px 0 9px;border-bottom:1.5px solid var(--ink);padding-bottom:5px}
  .sec:first-child{margin-top:4px}
  .sec .kode{font-family:var(--mono);font-size:11px;font-weight:700;background:var(--ink);color:#fff;padding:2px 6px}
  .sec .jdl{font-size:12px;font-weight:800;letter-spacing:.1em;text-transform:uppercase}
  .sec .kanan{margin-left:auto;font-size:11px;color:var(--muted);font-family:var(--mono)}

  .card{background:var(--paper);border:1px solid var(--line-dark)}
  .pad{padding:13px}

  .auth-wrap{min-height:100dvh;display:flex;flex-direction:column;justify-content:center;padding:26px 20px calc(28px + var(--safe-bot));background:var(--bg)}
  .auth-mast{border:2px solid var(--ink);background:var(--paper)}
  .auth-mast .bar{background:var(--red);color:#fff;padding:14px 16px;border-bottom:2px solid var(--ink)}
  .auth-mast .bar .b1{font-size:26px;font-weight:900;letter-spacing:.02em}
  .auth-mast .bar .b2{font-size:10px;letter-spacing:.16em;text-transform:uppercase;opacity:.9;margin-top:3px}
  .auth-body{padding:18px 16px 20px}
  .auth-switch{text-align:center;font-size:13px;color:var(--muted);margin-top:16px}
  .auth-switch a{color:var(--red);font-weight:800;text-decoration:underline}
  .hint-cred{margin-top:14px;text-align:center;font-size:11px;color:var(--muted);font-family:var(--mono)}

  label.f{display:block;font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;margin:15px 0 5px;color:#3d3d38}
  input[type=text],input[type=password],textarea,select{
    width:100%;padding:12px;border:1.5px solid var(--line-dark);border-radius:0;font-size:15px;
    background:#fff;color:var(--ink);font-family:inherit;appearance:none;-webkit-appearance:none
  }
  select{background-image:linear-gradient(45deg,transparent 50%,var(--ink) 50%),linear-gradient(135deg,var(--ink) 50%,transparent 50%);
    background-position:calc(100% - 18px) 55%,calc(100% - 13px) 55%;background-size:5px 5px;background-repeat:no-repeat}
  input:focus,textarea:focus,select:focus,.btn:focus-visible,button:focus-visible{outline:3px solid rgba(196,30,23,.45);outline-offset:1px}
  textarea{min-height:86px;resize:vertical}

  .btn{display:flex;align-items:center;justify-content:center;width:100%;padding:14px;border:1.5px solid var(--ink);
    font-size:13px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;cursor:pointer;min-height:50px;font-family:inherit;border-radius:0}
  .btn-red{background:var(--red);color:#fff;border-color:var(--red-dark)}
  .btn-ghost{background:#fff;color:var(--ink)}
  .btn-green{background:var(--green);color:#fff;border-color:#14522F}
  .btn-amber{background:#B27C00;color:#fff;border-color:#7d5700}
  .btn-sm{width:auto;min-height:36px;padding:7px 12px;font-size:11px}
  .btn:active{transform:translateY(1px)}
  .btn[disabled]{opacity:.5;pointer-events:none}

  .cat-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;border:1.5px solid var(--line-dark);background:var(--line-dark);grid-gap:1px}
  .cat{border:none;background:#fff;padding:13px 11px;font-size:13px;font-weight:600;cursor:pointer;text-align:left;min-height:48px;font-family:inherit;position:relative}
  .cat.sel{background:var(--red);color:#fff;font-weight:800}
  .cat.sel::after{content:"✓";position:absolute;top:6px;right:9px;font-weight:400;opacity:.7}

  .photo-drop{border:1.5px dashed var(--line-dark);padding:22px 14px;text-align:center;color:var(--muted);font-size:12px;letter-spacing:.06em;text-transform:uppercase;font-weight:700;background:#fff;cursor:pointer;overflow:hidden}
  .photo-drop img{max-width:100%;display:block;margin:0 auto;border:1px solid var(--line-dark)}

  .gps-box{border:1.5px solid var(--line-dark);background:#fff;padding:11px 12px;font-family:var(--mono);font-size:12.5px;display:flex;align-items:center;gap:10px;flex-wrap:wrap}
  .gps-box .st{font-weight:700}
  .gps-box.ok{border-color:var(--green);background:var(--green-bg)}
  .gps-box.err{border-color:var(--red);background:var(--red-bg)}
  .gps-manual{display:none;gap:7px;margin-top:8px}
  .gps-manual.show{display:flex}
  .gps-manual input{font-family:var(--mono);font-size:13px;padding:10px}

  .estop-wrap{display:flex;flex-direction:column;align-items:center;padding:30px 0 12px}
  .estop{
    width:180px;height:180px;border-radius:50%;cursor:pointer;
    background:var(--red);color:#fff;border:10px solid var(--ink);
    box-shadow:inset 0 -8px 0 rgba(0,0,0,.28), 0 8px 0 #55554e;
    transition:transform .07s ease, box-shadow .07s ease;font-family:inherit;
  }
  .estop:active{transform:translateY(6px);box-shadow:inset 0 -4px 0 rgba(0,0,0,.28), 0 2px 0 #55554e}
  .estop .big{font-size:24px;font-weight:900;letter-spacing:.04em;display:block}
  .estop .small{font-size:10px;letter-spacing:.2em;display:block;margin-top:5px;opacity:.9;font-weight:700}
  .estop-hint{margin-top:22px;font-size:12.5px;color:var(--muted);text-align:center;max-width:260px;line-height:1.55}

  .stats{display:grid;grid-template-columns:repeat(3,1fr);gap:0;border:1.5px solid var(--line-dark);background:var(--line-dark);grid-gap:1px}
  .stat{background:#fff;padding:12px 8px;text-align:center}
  .stat .n{font-size:26px;font-weight:900;font-family:var(--mono)}
  .stat .l{font-size:9.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-top:2px;font-weight:700}
  .stat.open .n{color:var(--red)} .stat.prog .n{color:var(--amber)} .stat.done .n{color:var(--green)}

  .report{background:#fff;border:1px solid var(--line-dark);margin-bottom:10px}
  .report.emg{border:2px solid var(--red)}
  .report .head{display:flex;align-items:center;gap:9px;padding:9px 12px;border-bottom:1px solid var(--line);background:#FAFAF7}
  .report .rid{font-family:var(--mono);font-size:11.5px;font-weight:700}
  .report .tag{font-size:9.5px;font-weight:800;letter-spacing:.09em;text-transform:uppercase;padding:3px 8px;margin-left:auto}
  .t-open{background:var(--red-bg);color:var(--red);border:1px solid var(--red)}
  .t-prog{background:var(--amber-bg);color:var(--amber);border:1px solid var(--amber)}
  .t-done{background:var(--green-bg);color:var(--green);border:1px solid var(--green)}
  .t-emg{background:var(--red);color:#fff;border:1px solid var(--red-dark)}
  .t-pend{background:#E8E8F5;color:#3F3F9E;border:1px solid #3F3F9E}
  .report .body{padding:11px 12px}
  .report .cat-t{font-size:14.5px;font-weight:800}
  .report .meta{font-size:11.5px;color:var(--muted);margin-top:3px;font-family:var(--mono)}
  .report .desc{font-size:13px;margin-top:8px;color:#33332e;line-height:1.5}
  .report img.ph{width:100%;margin-top:9px;border:1px solid var(--line-dark)}
  .report .gps{font-size:11.5px;margin-top:8px;font-family:var(--mono)}
  .report .gps a{color:var(--red);font-weight:700}
  .report .actions{display:flex;gap:8px;margin-top:11px}

  .nav{position:fixed;bottom:0;left:50%;transform:translateX(-50%);width:100%;max-width:520px;
    background:var(--paper);border-top:2px solid var(--ink);display:flex;z-index:50;
    padding:0 0 var(--safe-bot)}
  .nav button{flex:1;background:none;border:none;border-left:1px solid var(--line);font-family:inherit;
    font-size:10px;font-weight:800;letter-spacing:.07em;text-transform:uppercase;color:var(--muted);
    cursor:pointer;padding:15px 2px 13px;min-height:52px;position:relative}
  .nav button:first-child{border-left:none}
  .nav button.on{color:var(--red)}
  .nav button.on::before{content:"";position:absolute;top:-2px;left:0;right:0;height:3px;background:var(--red)}
  .nav button.emg-tab{background:var(--red);color:#fff}
  .nav button.emg-tab.on::before{background:var(--ink)}

  .toast{position:fixed;left:50%;transform:translateX(-50%) translateY(16px);bottom:calc(88px + var(--safe-bot));
    background:var(--ink);color:#fff;font-size:12.5px;font-weight:700;padding:12px 18px;letter-spacing:.02em;
    opacity:0;pointer-events:none;transition:.22s;z-index:80;max-width:88%;text-align:center;border:1px solid #000}
  .toast.show{opacity:1;transform:translateX(-50%) translateY(0)}
  .overlay{position:fixed;inset:0;background:rgba(20,20,18,.6);display:none;place-items:center;z-index:70;padding:22px}
  .overlay.show{display:grid}
  .modal{background:#fff;border:2px solid var(--ink);padding:22px;width:100%;max-width:340px;text-align:center}
  .modal h3{font-size:18px;font-weight:900;letter-spacing:.03em;text-transform:uppercase;margin-bottom:9px}
  .modal p{font-size:13px;color:#4c4c46;margin-bottom:18px;line-height:1.55}
  .modal .btn+.btn{margin-top:9px}

  .empty{text-align:center;color:var(--muted);font-size:13px;padding:30px 12px;border:1.5px dashed var(--line-dark);background:#fff}
  .note{border:1px solid var(--line-dark);border-left:4px solid var(--red);background:#fff;padding:11px 13px;font-size:12.5px;color:#4c4c46;margin-top:18px;line-height:1.55}
  .userline{display:flex;align-items:center;gap:10px;padding:12px 13px;border-bottom:1px solid var(--line)}
  .userline:last-child{border-bottom:none}
  .userline .nm{font-size:14px;font-weight:800}
  .userline .un{font-size:11px;color:var(--muted);font-family:var(--mono)}
  .spin{display:inline-block;width:13px;height:13px;border:2.5px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:sp .7s linear infinite;vertical-align:-2px;margin-right:6px}
  @keyframes sp{to{transform:rotate(360deg)}}
  @media (prefers-reduced-motion:reduce){.spin{animation-duration:1.4s}}
  .kv{display:flex;justify-content:space-between;padding:10px 13px;border-bottom:1px solid var(--line);font-size:13px}
  .kv:last-child{border-bottom:none}
  .kv b{font-weight:800}
  .err-box{border:1.5px solid var(--red);background:var(--red-bg);color:var(--red);font-size:12.5px;font-weight:700;padding:10px 12px;margin-top:14px}
</style>
<?php /**PATH C:\xampp\htdocs\sigap\resources\views/partials/style.blade.php ENDPATH**/ ?>