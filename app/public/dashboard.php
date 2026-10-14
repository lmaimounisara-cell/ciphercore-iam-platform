<?php
require_once __DIR__ . '/../src/auth.php';
requireLogin();
$user = $_SESSION['user'];
$name = h((string)($user['name'] ?? 'CipherBank Customer'));
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>CipherBank | Your dashboard</title>
<style>
*{box-sizing:border-box}body{margin:0;background:#f4f7fc;color:#152442;font:15px/1.5 Inter,system-ui,sans-serif}
header{background:#0b1730;color:white;padding:20px 6%;display:flex;justify-content:space-between;align-items:center}
.brand{font-size:22px;font-weight:800}.brand span{color:#79b5ff}
a{color:inherit;text-decoration:none}.button{background:#2864ed;color:white;border:0;padding:11px 16px;border-radius:10px;font-weight:700}
main{max-width:1150px;margin:auto;padding:35px 22px}.muted{color:#7a879d;font-size:13px}
h1{font-size:30px;margin:0 0 6px}.layout{display:grid;grid-template-columns:1.2fr .8fr;gap:20px;margin-top:25px}
.panel{background:white;border:1px solid #e5ebf4;border-radius:18px;padding:24px;min-width:0}
.label{font-size:12px;color:#d7e4ff}.amount{font-size:36px;font-weight:800;margin:8px 0 20px}
.card{background:linear-gradient(125deg,#0d2043,#2364c4);border-radius:17px;padding:22px;color:white}
.row{display:flex;justify-content:space-between;gap:12px;align-items:center}
.actions{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:18px}
.actions a{background:#edf3ff;color:#1f55c4;padding:14px 8px;border-radius:11px;text-align:center;font-size:12px;font-weight:700}
.tx{padding:15px 0;border-bottom:1px solid #edf0f6;display:flex;justify-content:space-between;gap:10px;font-size:13px}
.tx:last-child{border:0}.tag{font-size:11px;color:#168568}
.notice{margin-top:20px;padding:13px 15px;background:#fff8e8;border:1px solid #f2e2b5;border-radius:11px;color:#735d20;font-size:12px}
@media(max-width:720px){.layout{grid-template-columns:1fr}h1{font-size:26px}.amount{font-size:30px}}
</style>
</head>
<body>
<header><a class="brand" href="/">Cipher<span>Bank</span></a><div class="row"><span><?= $name ?></span>&nbsp; <a class="button" href="/logout.php">Sign out</a></div></header>
<main>
<div class="muted">PERSONAL BANKING / OVERVIEW</div>
<h1>Welcome back, <?= $name ?></h1>
<p class="muted">Your secure CipherBank demo dashboard.</p>
<div class="layout">
<section>
<div class="card">
<div class="row"><span class="label">DEMO TOTAL BALANCE</span><span>◈ CIPHERBANK</span></div>
<div class="amount">124,580.50 MAD</div>
<div class="row"><span class="label">Demo account •••• 4582</span><span>VISA · DEBIT</span></div>
</div>
<div class="actions"><a href="#">Transfer<br>(demo)</a><a href="#">Cards<br>(demo)</a><a href="#">Statements<br>(demo)</a></div>
<div class="panel" style="margin-top:20px"><strong>Account overview</strong>
<div class="tx"><span>Everyday account<br><span class="muted">•••• 4582</span></span><strong>24,580.50 MAD</strong></div>
<div class="tx"><span>Savings account<br><span class="muted">•••• 7861</span></span><strong>100,000.00 MAD</strong></div>
</div>
</section>
<section class="panel"><strong>Recent activity</strong>
<div class="tx"><span>Market & grocery<br><span class="muted">Demo card payment</span></span><span>−248.50 MAD</span></div>
<div class="tx"><span>Monthly salary<br><span class="muted">Demo incoming payment</span></span><span class="tag">+12,500 MAD</span></div>
<div class="tx"><span>Home & utilities<br><span class="muted">Demo direct debit</span></span><span>−680 MAD</span></div>
<div class="tx"><span>Transfer to savings<br><span class="muted">Demo transfer</span></span><span>−2,000 MAD</span></div>
<div class="notice">Portfolio demo only. Balances and transactions are fictional. No real banking or money movement is connected.</div>
</section>
</div>
</main>
</body>
</html>
