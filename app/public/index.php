<?php
session_start();
$loggedIn = isset($_SESSION['user']);
$name = htmlspecialchars($_SESSION['user']['name'] ?? 'Sara Test', ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CipherBank — Banking, refined.</title>
<style>
:root{
  --navy:#0b1730;--navy2:#10274d;--blue:#2864ed;--sky:#eaf1ff;
  --ink:#17243c;--muted:#7b879c;--line:#e8edf5;--bg:#f5f7fb;
  --green:#168568;--red:#d75d68;--white:#fff;
}
*{box-sizing:border-box}
body{margin:0;background:var(--bg);color:var(--ink);
font:14px/1.5 Inter,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}
a{text-decoration:none;color:inherit}
button{font:inherit;cursor:pointer}
.shell{max-width:1500px;margin:auto;min-height:100vh;background:#fff}
.top{height:76px;background:var(--navy);color:white;display:flex;
align-items:center;justify-content:space-between;padding:0 5%;gap:20px}
.brand{display:flex;align-items:center;gap:11px;font-size:22px;font-weight:800;letter-spacing:-.6px}
.brandmark{width:39px;height:39px;display:grid;place-items:center;border-radius:12px;
background:linear-gradient(145deg,#61b7ff,#2560f2);box-shadow:0 5px 18px #2064e955}
.brandmark svg{width:27px;height:27px}
.nav{display:flex;align-items:center;gap:29px;color:#d6dfef;font-size:13px}
.nav a:hover{color:#fff}
.topright{display:flex;align-items:center;gap:17px}
.iconbtn{border:1px solid #ffffff25;background:#ffffff0c;color:#fff;
width:39px;height:39px;border-radius:12px;display:grid;place-items:center}
.avatar{width:37px;height:37px;border-radius:50%;display:grid;place-items:center;
background:#dce8ff;color:#1949b3;font-weight:800}
.signin{background:#fff;color:var(--navy);padding:11px 17px;border-radius:10px;font-weight:700}
.hero{position:relative;overflow:hidden;background:linear-gradient(112deg,#0c1b36 0%,#12366e 63%,#1a4c91 100%);
color:white;padding:59px 6% 57px;min-height:365px}
.hero:before{content:"";position:absolute;width:450px;height:450px;border-radius:50%;
right:8%;top:-210px;border:1px solid #ffffff17;box-shadow:0 0 0 45px #ffffff08,0 0 0 90px #ffffff05}
.hero:after{content:"";position:absolute;right:10%;bottom:-170px;width:410px;height:270px;
transform:rotate(-24deg);border:1px solid #ffffff18;border-radius:38px}
.hero-inner{position:relative;z-index:1;max-width:1300px;margin:auto;
display:grid;grid-template-columns:1.05fr .95fr;align-items:center;gap:45px}
.eyebrow{font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#9dc8ff;font-weight:800}
h1{font-size:clamp(36px,4.2vw,58px);line-height:1.08;letter-spacing:-2px;margin:18px 0}
h1 span{color:#7db8ff}
.hero-copy{max-width:525px;color:#d3def1;font-size:16px;line-height:1.8}
.actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:25px}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:9px;
padding:13px 19px;border-radius:11px;border:1px solid transparent;font-weight:750}
.btn-primary{background:#fff;color:#123064}
.btn-ghost{border-color:#ffffff45;color:white;background:#ffffff09}
.trust{display:flex;align-items:center;gap:9px;margin-top:27px;color:#c4d5ed;font-size:12px}
.trust-dot{width:8px;height:8px;border-radius:50%;background:#51d5ad;box-shadow:0 0 0 5px #51d5ad20}
.bank-visual{position:relative;max-width:440px;width:100%;justify-self:end}
.bank-card{position:relative;min-height:235px;padding:25px;border:1px solid #ffffff47;
border-radius:22px;background:linear-gradient(125deg,#ffffff24,#ffffff0a);
backdrop-filter:blur(12px);box-shadow:0 28px 65px #0003;transform:rotate(-3deg)}
.card-top{display:flex;align-items:center;justify-content:space-between}
.cardbrand{display:flex;align-items:center;gap:8px;font-size:15px;font-weight:800}
.chip{width:42px;height:31px;border-radius:7px;border:1px solid #e8d49b99;
background:linear-gradient(135deg,#f5e9bc,#bca66d);position:relative}
.chip:before,.chip:after{content:"";position:absolute;top:0;bottom:0;left:13px;
border-left:1px solid #927b4e88;border-right:1px solid #927b4e88;width:12px}
.chip:after{top:10px;bottom:10px;left:0;right:0;border:0;border-top:1px solid #927b4e88;border-bottom:1px solid #927b4e88;width:auto}
.card-number{font-size:19px;letter-spacing:3px;margin:30px 0 23px;color:#eef4ff}
.card-bottom{display:flex;justify-content:space-between;align-items:end}
.card-caption{font-size:9px;text-transform:uppercase;letter-spacing:1.5px;color:#c6d8f3}
.card-value{font-size:12px;font-weight:700;margin-top:4px}
.card-circles{display:flex}
.card-circles i{width:29px;height:29px;border-radius:50%;background:#f04453;display:block}
.card-circles i+i{background:#ffbd46;margin-left:-11px;mix-blend-mode:screen}
.float-tag{position:absolute;right:-14px;bottom:-20px;padding:14px 17px;border-radius:13px;
background:white;color:var(--ink);box-shadow:0 12px 35px #0002;font-size:12px}
.float-tag strong{display:block;color:var(--green);font-size:17px;margin-top:2px}
.trustbar{display:grid;grid-template-columns:repeat(3,1fr);max-width:1300px;
margin:auto;padding:24px 6%;border-bottom:1px solid var(--line);gap:20px}
.trustitem{display:flex;align-items:center;gap:13px}
.trusticon{width:43px;height:43px;border-radius:13px;background:#edf3ff;color:var(--blue);
display:grid;place-items:center;flex-shrink:0}
.trusticon svg{width:21px;height:21px}
.trustitem strong{display:block;font-size:13px}
.trustitem small{color:var(--muted);font-size:11px}
.content{max-width:1300px;margin:auto;padding:42px 6% 55px}
.sectionhead{display:flex;justify-content:space-between;align-items:end;gap:15px;margin-bottom:22px}
h2{font-size:23px;letter-spacing:-.6px;margin:0 0 5px}
.sub{color:var(--muted);font-size:12px}
.textlink{color:var(--blue);font-weight:750;font-size:12px}
.dashboard{display:grid;grid-template-columns:1.08fr .92fr;gap:19px}
.panel{border:1px solid var(--line);border-radius:18px;background:white;padding:23px;min-width:0}
.panelhead{display:flex;align-items:center;justify-content:space-between;gap:12px}
.paneltitle{font-size:14px;font-weight:800}
.selectlabel{font-size:11px;color:var(--muted);border:1px solid var(--line);
padding:7px 10px;border-radius:8px;background:#fff}
.totalrow{display:flex;align-items:center;justify-content:space-between;gap:15px;margin-top:25px}
.balance-label{font-size:12px;color:var(--muted)}
.total{font-size:clamp(29px,3vw,39px);letter-spacing:-1.5px;font-weight:800;margin:5px 0}
.change{color:var(--green);font-size:11px;font-weight:700}
.accountcards{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:23px}
.account{border:1px solid var(--line);background:#fbfcff;border-radius:13px;padding:15px}
.accounttop{display:flex;justify-content:space-between;align-items:center}
.accounticon{width:34px;height:34px;background:#e8f0ff;color:var(--blue);
border-radius:10px;display:grid;place-items:center;font-weight:800}
.accountname{font-size:11px;color:var(--muted);margin-top:12px}
.accountbalance{font-size:18px;font-weight:800;margin-top:3px}
.accountnum{font-size:10px;color:var(--muted);margin-top:4px}
.chart{width:100%;height:115px;margin-top:12px;overflow:visible}
.chartlabels{display:flex;justify-content:space-between;color:#9aa5b6;font-size:10px;margin-top:3px}
.quick{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:22px}
.quick a{display:flex;flex-direction:column;align-items:center;gap:9px;text-align:center;
font-size:11px;font-weight:700;color:#46546d}
.quickicon{width:48px;height:48px;border-radius:15px;background:#eff4ff;color:var(--blue);
display:grid;place-items:center;font-size:20px}
.quick a:hover .quickicon{background:#dce8ff}
.transactions{margin-top:19px}
.tx{display:grid;grid-template-columns:minmax(0,1fr) auto;align-items:center;
gap:12px;padding:14px 0;border-bottom:1px solid #edf0f6}
.tx:last-child{border-bottom:0;padding-bottom:0}
.txleft{display:flex;align-items:center;gap:12px;min-width:0}
.txicon{width:39px;height:39px;border-radius:12px;background:#f0f3f8;
display:grid;place-items:center;font-weight:800;flex-shrink:0}
.txname{font-size:12px;font-weight:750}
.txdate{font-size:10px;color:var(--muted);margin-top:3px}
.txamount{text-align:right;font-size:12px;font-weight:800}
.txstatus{display:block;color:var(--green);font-size:10px;font-weight:600;margin-top:3px}
.txamount.negative{color:#29364c}
.services{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:23px}
.service{padding:22px;border:1px solid var(--line);border-radius:16px;background:#fff}
.service .trusticon{margin-bottom:15px}
.service h3{font-size:14px;margin:0 0 7px}
.service p{color:var(--muted);font-size:12px;line-height:1.7;margin:0}
.footer{background:#0b1730;color:#b8c6dd;padding:29px 6%;font-size:11px}
.footerinner{max-width:1300px;margin:auto;display:flex;justify-content:space-between;gap:18px;flex-wrap:wrap}
.footer strong{color:white}
.mobilemenu{display:none}
@media(max-width:850px){
 .nav{display:none}.hero{padding:45px 6%}.hero-inner{grid-template-columns:1fr;gap:38px}
 .bank-visual{justify-self:start;max-width:420px}.trustbar{grid-template-columns:1fr;gap:15px}
 .dashboard{grid-template-columns:1fr}.services{grid-template-columns:1fr}
}
@media(max-width:520px){
 .top{padding:0 5%;height:68px}.brand{font-size:19px}.topright{gap:8px}
 .hero{padding:39px 5%}.hero-inner{gap:32px}h1{font-size:39px}
 .bank-card{padding:20px;min-height:220px}.card-number{font-size:15px;letter-spacing:2px}
 .content{padding:31px 5%}.panel{padding:17px}.accountcards{grid-template-columns:1fr}
 .quick{grid-template-columns:repeat(2,1fr)}.total{font-size:31px}
 .sectionhead{align-items:start}.trustbar{padding:22px 5%}
}
</style>
</head>
<body>
<div class="shell">
<header class="top">
  <a class="brand" href="/">
    <span class="brandmark">
      <svg viewBox="0 0 40 40" fill="none" aria-hidden="true">
        <path d="M25 4H12L3 20l9 16h13l-9-16 9-16Z" fill="white"/>
        <path d="M27 4H37L28 15H17L27 4Z" fill="#9CCFFF"/>
        <path d="M28 25h9L28 36H17l11-11Z" fill="#D8E9FF"/>
      </svg>
    </span>
    CipherBank
  </a>
  <nav class="nav">
    <a href="#accounts">Accounts</a><a href="#transactions">Transactions</a>
    <a href="#services">Services</a><a href="#security">Security</a>
  </nav>
  <div class="topright">
    <button class="iconbtn" aria-label="Notifications" title="Notifications">♧</button>
    <?php if($loggedIn): ?>
      <span class="avatar"><?= strtoupper(substr($name,0,1)) ?></span>
      <a class="signin" href="/dashboard.php">My banking</a>
    <?php else: ?>
      <a class="signin" href="/login.php">Sign in</a>
    <?php endif; ?>
  </div>
</header>

<section class="hero">
  <div class="hero-inner">
    <div>
      <div class="eyebrow">A more considered kind of banking</div>
      <h1>Make money<br>move <span>with you.</span></h1>
      <p class="hero-copy">A clearer view of your finances. A smarter way to manage everyday banking. Built around the security and simplicity you deserve.</p>
      <div class="actions">
        <a class="btn btn-primary" href="/login.php">Explore your account <span>↗</span></a>
        <a class="btn btn-ghost" href="#accounts">Discover CipherBank</a>
      </div>
      <div class="trust"><span class="trust-dot"></span> Identity protected with Keycloak and multi-factor authentication</div>
    </div>
    <div class="bank-visual">
      <div class="bank-card">
        <div class="card-top">
          <div class="cardbrand"><span class="brandmark" style="width:29px;height:29px;border-radius:8px;font-size:18px">C</span> CipherBank</div>
          <span style="font-size:11px;color:#d4e5ff">WORLD DEBIT</span>
        </div>
        <div style="margin-top:24px"><div class="chip"></div></div>
        <div class="card-number">•••• &nbsp; •••• &nbsp; •••• &nbsp; 4582</div>
        <div class="card-bottom">
          <div><div class="card-caption">Card holder</div><div class="card-value">CIPHERBANK CUSTOMER</div></div>
          <div class="card-circles"><i></i><i></i></div>
        </div>
      </div>
      <div class="float-tag">Designed around you<strong>Security at every step</strong></div>
    </div>
  </div>
</section>

<div class="trustbar">
  <div class="trustitem"><div class="trusticon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3 20 6v5c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6l8-3Z"/><path d="m8 12 3 3 5-6"/></svg></div><div><strong>Security at the core</strong><small>Layered identity protection</small></div></div>
  <div class="trustitem"><div class="trusticon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h18v13H3zM3 11h18M7 4h10"/></svg></div><div><strong>Your finances, organized</strong><small>A clear view of your accounts</small></div></div>
  <div class="trustitem"><div class="trusticon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 17 9 12l3 3 8-9"/><path d="M15 6h5v5"/></svg></div><div><strong>Built for clarity</strong><small>Simple tools, less friction</small></div></div>
</div>

<main class="content">
  <div class="sectionhead">
    <div><h2>Your financial overview</h2><div class="sub">A preview of the CipherBank digital banking experience</div></div>
    <span class="selectlabel">Demo preview · MAD ▾</span>
  </div>

  <div class="dashboard" id="accounts">
    <section class="panel">
      <div class="panelhead"><div class="paneltitle">Total balance</div><span class="selectlabel">All accounts⌄</span></div>
      <div class="totalrow">
        <div><div class="balance-label">Combined available balance</div><div class="total">124,580.50 <span style="font-size:15px;color:#7c899e;letter-spacing:0">MAD</span></div><div class="change">↗ Demo overview · illustrative values only</div></div>
        <div class="trusticon" style="width:48px;height:48px;font-size:22px">◈</div>
      </div>
      <div class="accountcards">
        <div class="account"><div class="accounttop"><div class="accounticon">▣</div><span class="sub">•• 4582</span></div><div class="accountname">EVERYDAY ACCOUNT</div><div class="accountbalance">24,580.50 MAD</div><div class="accountnum">Available balance</div></div>
        <div class="account"><div class="accounttop"><div class="accounticon" style="background:#e7f7f1;color:#168568">◉</div><span class="sub">•• 7861</span></div><div class="accountname">SAVINGS ACCOUNT</div><div class="accountbalance">100,000.00 MAD</div><div class="accountnum">Savings balance</div></div>
      </div>
      <div class="panelhead" style="margin-top:28px"><div class="paneltitle">Spending activity</div><span class="sub">Last 7 days</span></div>
      <svg class="chart" viewBox="0 0 520 120" preserveAspectRatio="none" role="img" aria-label="Illustrative spending trend">
        <defs><linearGradient id="area" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#2864ed" stop-opacity=".2"/><stop offset="100%" stop-color="#2864ed" stop-opacity="0"/></linearGradient></defs>
        <path d="M0 93 L0 78 C25 75 35 85 58 68 S95 61 115 72 S153 44 178 55 S213 78 238 54 S278 62 300 36 S344 52 365 39 S405 62 430 31 S485 41 520 15 L520 120 L0 120Z" fill="url(#area)"/>
        <path d="M0 78 C25 75 35 85 58 68 S95 61 115 72 S153 44 178 55 S213 78 238 54 S278 62 300 36 S344 52 365 39 S405 62 430 31 S485 41 520 15" fill="none" stroke="#2864ed" stroke-width="2.5" stroke-linecap="round"/>
        <path d="M0 110H520 M0 75H520 M0 40H520" stroke="#e9eef7" stroke-dasharray="3 5" fill="none"/>
      </svg>
      <div class="chartlabels"><span>Oct 08</span><span>Oct 10</span><span>Oct 12</span><span>Oct 14</span></div>
    </section>

    <section class="panel" id="transactions">
      <div class="panelhead"><div class="paneltitle">Recent transactions</div><a class="textlink" href="/login.php">View all ↗</a></div>
      <div class="transactions">
        <div class="tx"><div class="txleft"><div class="txicon">▤</div><div><div class="txname">Market & grocery</div><div class="txdate">Today · Card payment</div></div></div><div class="txamount negative">− 248.50 MAD<span class="txstatus">Completed</span></div></div>
        <div class="tx"><div class="txleft"><div class="txicon" style="color:#168568;background:#e9f8f1">↙</div><div><div class="txname">Monthly salary</div><div class="txdate">Yesterday · Incoming</div></div></div><div class="txamount" style="color:#168568">+ 12,500.00 MAD<span class="txstatus">Received</span></div></div>
        <div class="tx"><div class="txleft"><div class="txicon">⌂</div><div><div class="txname">Home & utilities</div><div class="txdate">12 Oct · Direct debit</div></div></div><div class="txamount negative">− 680.00 MAD<span class="txstatus">Completed</span></div></div>
        <div class="tx"><div class="txleft"><div class="txicon" style="color:#7b58cb;background:#f2edff">↗</div><div><div class="txname">Transfer to savings</div><div class="txdate">11 Oct · Internal transfer</div></div></div><div class="txamount negative">− 2,000.00 MAD<span class="txstatus">Completed</span></div></div>
        <div class="tx"><div class="txleft"><div class="txicon">☕</div><div><div class="txname">Coffee House</div><div class="txdate">10 Oct · Card payment</div></div></div><div class="txamount negative">− 42.00 MAD<span class="txstatus">Completed</span></div></div>
      </div>
    </section>
  </div>

  <div class="sectionhead" id="services" style="margin-top:43px">
    <div><h2>Banking that works around you</h2><div class="sub">Useful tools, presented without the clutter.</div></div>
  </div>
  <div class="quick">
    <a href="/login.php"><span class="quickicon">↗</span>Send money</a>
    <a href="/login.php"><span class="quickicon">⇄</span>Transfer funds</a>
    <a href="/login.php"><span class="quickicon">▤</span>Manage cards</a>
    <a href="/login.php"><span class="quickicon">＋</span>Explore services</a>
  </div>
  <div class="services" id="security">
    <article class="service"><div class="trusticon">⌑</div><h3>Identity you can trust</h3><p>Keycloak-based authentication, a dedicated identity layer, and a foundation for multi-factor security.</p></article>
    <article class="service"><div class="trusticon">◈</div><h3>Clear account controls</h3><p>A planned account experience with access controls, account summaries, and transaction history.</p></article>
    <article class="service"><div class="trusticon">↗</div><h3>Protection by design</h3><p>Session management, audit events, and role-based permissions are part of the platform roadmap.</p></article>
  </div>
</main>

<footer class="footer"><div class="footerinner">
  <div><strong>CipherBank</strong> &nbsp; Banking, refined.</div>
  <div>Portfolio demonstration only · No real accounts, payments, or financial services</div>
  <div>Identity powered by Keycloak</div>
</div></footer>
</div>
</body>
</html>
