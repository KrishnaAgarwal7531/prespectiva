<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: user/dashboard.php");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Perspectiva - Collaborative Research Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: hsl(210,15%,12%);
            background: hsl(210,25%,98%);
        }

        .gradient-text {
            background: linear-gradient(135deg, hsl(195,85%,45%), hsl(185,75%,50%));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 32px;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed; top: 0; left: 0; right: 0;
            height: 64px;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid hsl(210,25%,88%);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; z-index: 100;
        }
        .navbar-logo {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .navbar-logo img {
            width: 40px; height: 40px;
            border-radius: 10px; object-fit: cover;
        }
        .logo-text {
            font-size: 17px; font-weight: 800;
            letter-spacing: 1px; color: hsl(210,15%,12%);
        }
        .navbar-links {
            display: flex; align-items: center; gap: 32px;
        }
        .navbar-links a {
            text-decoration: none; font-size: 14px; font-weight: 500;
            color: hsl(210,15%,40%); transition: color 0.15s;
        }
        .navbar-links a:hover { color: hsl(210,15%,12%); }
        .navbar-right { display: flex; align-items: center; gap: 16px; }
        .nav-signin {
            text-decoration: none; font-size: 14px;
            color: hsl(210,15%,40%); font-weight: 500; transition: color 0.15s;
        }
        .nav-signin:hover { color: hsl(210,15%,12%); }
        .btn-getstarted {
            background: linear-gradient(135deg, hsl(195,85%,45%), hsl(185,75%,50%));
            color: white; border: none; padding: 9px 20px;
            border-radius: 25px; font-size: 14px; font-weight: 600;
            cursor: pointer; text-decoration: none; display: inline-block;
            box-shadow: 0 10px 40px -15px hsl(195,85%,45%,0.4);
            transition: opacity 0.2s;
        }
        .btn-getstarted:hover { opacity: 0.9; }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(180deg, hsl(210,25%,98%), hsl(210,30%,96%));
            position: relative; overflow: hidden;
            padding: 80px 0 40px;
        }
        .blob {
            position: absolute; border-radius: 50%;
            filter: blur(80px); pointer-events: none;
            animation: blobpulse 4s ease-in-out infinite;
        }
        .blob1 {
            top: 25%; left: 25%;
            width: 380px; height: 380px;
            background: hsl(195,85%,45%,0.1);
        }
        .blob2 {
            bottom: 25%; right: 25%;
            width: 380px; height: 380px;
            background: hsl(185,75%,50%,0.1);
            animation-delay: 1s;
        }
        @keyframes blobpulse {
            0%,100% { opacity:1; transform:scale(1); }
            50% { opacity:0.7; transform:scale(1.05); }
        }
        .hero-grid {
            position: relative; z-index: 10;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 48px; align-items: center;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 8px 16px; border-radius: 99px;
            background: hsl(195,85%,45%,0.1);
            border: 1px solid hsl(195,85%,45%,0.2);
            font-size: 13px; font-weight: 500;
            color: hsl(195,85%,35%); margin-bottom: 24px;
        }
        .hero-badge svg { width: 14px; height: 14px; }
        .hero-title {
            font-size: clamp(40px,6vw,68px);
            font-weight: 700; line-height: 1.1; margin-bottom: 24px;
        }
        .hero-desc {
            font-size: 18px; line-height: 1.7;
            color: hsl(210,10%,45%); max-width: 500px; margin-bottom: 32px;
        }
        .hero-btns {
            display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 48px;
        }
        .btn-primary-lg {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, hsl(195,85%,45%), hsl(185,75%,50%));
            color: white; border: none; padding: 13px 28px;
            border-radius: 8px; font-size: 15px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            box-shadow: 0 10px 40px -15px hsl(195,85%,45%,0.4);
            transition: opacity 0.2s;
        }
        .btn-primary-lg:hover { opacity: 0.9; }
        .btn-outline-lg {
            display: inline-flex; align-items: center;
            background: white; color: hsl(210,15%,20%);
            border: 1px solid hsl(210,25%,85%);
            padding: 13px 28px; border-radius: 8px;
            font-size: 15px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: background 0.2s;
        }
        .btn-outline-lg:hover { background: hsl(210,25%,96%); }
        .hero-stats {
            display: grid; grid-template-columns: repeat(3,1fr); gap: 24px;
        }
        .stat-num {
            font-size: 28px; font-weight: 700;
            background: linear-gradient(135deg, hsl(195,85%,45%), hsl(185,75%,50%));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label { font-size: 13px; color: hsl(210,10%,50%); margin-top: 2px; }
        .hero-img-wrap {
            border-radius: 16px; overflow: hidden; position: relative;
            box-shadow: 0 10px 40px -15px hsl(195,85%,45%,0.25);
        }
        .hero-img-wrap img { width: 100%; height: auto; display: block; }
        .hero-img-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(248,250,252,0.5), transparent);
        }

        /* ── SHARED SECTION STYLES ── */
        .section { padding: 96px 0; }
        .bg-white { background: hsl(210,25%,98%); }
        .bg-subtle { background: linear-gradient(180deg, hsl(210,25%,98%), hsl(210,30%,96%)); }
        .section-header { text-align: center; margin-bottom: 64px; }
        .section-title { font-size: clamp(28px,4vw,44px); font-weight: 700; margin-bottom: 16px; }
        .section-sub {
            font-size: 17px; color: hsl(210,10%,45%);
            max-width: 560px; margin: 0 auto; line-height: 1.6;
        }

        /* ── CARD ── */
        .card {
            background: rgba(255,255,255,0.5);
            border: 1px solid hsl(210,25%,88%);
            border-radius: 12px; padding: 32px;
            backdrop-filter: blur(8px); transition: box-shadow 0.2s;
        }
        .card:hover { box-shadow: 0 10px 40px -15px hsl(195,85%,45%,0.2); }

        /* ── FEATURES ── */
        .grid3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 32px; }
        .feature-icon {
            width: 56px; height: 56px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 24px; box-shadow: 0 0 50px hsl(195,85%,45%,0.15);
        }
        .feature-icon svg { width: 28px; height: 28px; color: white; }
        .feature-title { font-size: 18px; font-weight: 600; margin-bottom: 12px; }
        .feature-desc { font-size: 14px; color: hsl(210,10%,45%); line-height: 1.6; }

        /* ── HOW IT WORKS ── */
        .steps { max-width: 800px; margin: 0 auto; display: grid; gap: 24px; }
        .step-card {
            background: rgba(255,255,255,0.8);
            border: 1px solid hsl(210,25%,88%);
            border-radius: 12px; padding: 32px;
            display: flex; gap: 24px; align-items: flex-start;
            backdrop-filter: blur(8px); transition: box-shadow 0.2s;
        }
        .step-card:hover { box-shadow: 0 10px 40px -15px hsl(195,85%,45%,0.2); }
        .step-num {
            width: 64px; height: 64px; border-radius: 16px; flex-shrink: 0;
            background: linear-gradient(135deg, hsl(195,85%,45%), hsl(185,75%,50%));
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 700; color: white;
            box-shadow: 0 0 50px hsl(195,85%,45%,0.15);
        }
        .step-body { padding-top: 8px; }
        .step-title {
            font-size: 20px; font-weight: 600; margin-bottom: 8px;
            display: flex; align-items: center; gap: 8px;
        }
        .step-title svg { width: 20px; height: 20px; color: hsl(142,76%,36%); flex-shrink: 0; }
        .step-desc { font-size: 15px; color: hsl(210,10%,45%); line-height: 1.6; }

        /* ── COMMUNITIES ── */
        .grid3c { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
        .comm-card {
            background: rgba(255,255,255,0.5);
            border: 1px solid hsl(210,25%,88%);
            border-radius: 12px; padding: 24px;
            backdrop-filter: blur(8px); transition: box-shadow 0.2s; cursor: pointer;
        }
        .comm-card:hover { box-shadow: 0 10px 40px -15px hsl(195,85%,45%,0.2); }
        .comm-top {
            display: flex; justify-content: space-between;
            align-items: flex-start; margin-bottom: 16px;
        }
        .comm-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12); transition: transform 0.2s;
        }
        .comm-card:hover .comm-icon { transform: scale(1.1); }
        .comm-icon svg { width: 24px; height: 24px; color: white; }
        .comm-badge {
            background: hsl(210,25%,93%); color: hsl(210,15%,35%);
            padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 500;
        }
        .comm-name { font-size: 18px; font-weight: 600; margin-bottom: 4px; }
        .comm-members { font-size: 13px; color: hsl(210,10%,50%); }

        /* ── FOOTER ── */
        footer {
            background: linear-gradient(180deg, hsl(210,25%,98%), hsl(210,30%,96%));
            border-top: 1px solid hsl(210,25%,88%);
            padding: 48px 0 24px;
        }
        .footer-grid {
            display: grid; grid-template-columns: 1.5fr 1fr 1fr 1fr;
            gap: 32px; margin-bottom: 32px;
        }
        .footer-logo {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 16px; text-decoration: none;
        }
        .footer-logo img { width: 40px; height: 40px; border-radius: 10px; }
        .footer-desc { font-size: 13px; color: hsl(210,10%,50%); line-height: 1.6; }
        .footer-heading { font-size: 14px; font-weight: 600; margin-bottom: 16px; }
        .footer-links { list-style: none; display: grid; gap: 8px; }
        .footer-links li a { font-size: 13px; color: hsl(210,10%,50%); text-decoration: none; transition: color 0.15s; }
        .footer-links li a:hover { color: hsl(195,85%,40%); }
        .footer-links li span { font-size: 13px; color: hsl(210,10%,50%); opacity: 0.6; }
        .footer-bottom {
            border-top: 1px solid hsl(210,25%,88%);
            padding-top: 24px; text-align: center;
            font-size: 13px; color: hsl(210,10%,55%);
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <a href="index.php" class="navbar-logo">
        <img src="assets/logo.png" alt="Perspectiva">
        <span class="logo-text">PERSPECTIVA</span>
    </a>
    <div class="navbar-links">
        <a href="#features">Features</a>
        <a href="#how-it-works">How It Works</a>
        <a href="#communities">Communities</a>
        <a href="#">Pricing</a>
    </div>
    <div class="navbar-right">
        <a href="auth/login.php" class="nav-signin">Sign In</a>
        <a href="auth/signup.php" class="btn-getstarted">Get Started</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="blob blob1"></div>
    <div class="blob blob2"></div>
    <div class="container">
        <div class="hero-grid">
            <!-- Left -->
            <div>
                <div class="hero-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 3l1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5z"/>
                        <path d="M19 3l.75 2.25L22 6l-2.25.75L19 9l-.75-2.25L16 6l2.25-.75z"/>
                    </svg>
                    Gamified Research Platform
                </div>

                <h1 class="hero-title">
                    Research Made
                    <span class="gradient-text"> Collaborative</span>
                </h1>

                <p class="hero-desc">
                    Join Perspectiva, where students and researchers exchange surveys,
                    earn points, and gain insights through a gamified community-driven platform.
                </p>

                <div class="hero-btns">
                    <a href="auth/signup.php" class="btn-primary-lg">
                        Get Started
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </a>
                    <a href="#how-it-works" class="btn-outline-lg">Learn More</a>
                </div>

                <div class="hero-stats">
                    <div>
                        <div class="stat-num">10K+</div>
                        <div class="stat-label">Active Users</div>
                    </div>
                    <div>
                        <div class="stat-num">50K+</div>
                        <div class="stat-label">Surveys Completed</div>
                    </div>
                    <div>
                        <div class="stat-num">95%</div>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                </div>
            </div>

            <!-- Right: Hero Image -->
            <div class="hero-img-wrap">
                <img src="assets/hero-image.jpg" alt="Perspectiva Platform">
                <div class="hero-img-overlay"></div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="section bg-white" id="features">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                Everything You Need for
                <span class="gradient-text"> Better Research</span>
            </h2>
            <p class="section-sub">From survey creation to advanced analytics, we provide all the tools you need to succeed.</p>
        </div>
        <div class="grid3">
            <div class="card">
                <div class="feature-icon" style="background:linear-gradient(135deg,hsl(195,85%,45%),hsl(185,75%,50%))">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                </div>
                <div class="feature-title">Point-Based System</div>
                <div class="feature-desc">Complete surveys to earn points. Spend points to launch your own research.</div>
            </div>
            <div class="card">
                <div class="feature-icon" style="background:linear-gradient(135deg,hsl(185,75%,50%),hsl(195,85%,45%))">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                </div>
                <div class="feature-title">Smart Matching</div>
                <div class="feature-desc">AI-powered targeting ensures your surveys reach the right respondents.</div>
            </div>
            <div class="card">
                <div class="feature-icon" style="background:linear-gradient(135deg,hsl(195,85%,45%),hsl(185,75%,50%))">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </div>
                <div class="feature-title">Advanced Analytics</div>
                <div class="feature-desc">Get instant insights with professional-grade data visualization dashboards.</div>
            </div>
            <div class="card">
                <div class="feature-icon" style="background:linear-gradient(135deg,hsl(185,75%,50%),hsl(195,85%,45%))">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="feature-title">Community Driven</div>
                <div class="feature-desc">Join specialized communities across tech, sports, finance, and more.</div>
            </div>
            <div class="card">
                <div class="feature-icon" style="background:linear-gradient(135deg,hsl(195,85%,45%),hsl(185,75%,50%))">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div class="feature-title">Google Forms Integration</div>
                <div class="feature-desc">Seamlessly import your existing Google Forms or create surveys from scratch.</div>
            </div>
            <div class="card">
                <div class="feature-icon" style="background:linear-gradient(135deg,hsl(185,75%,50%),hsl(195,85%,45%))">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="feature-title">Quality Assured</div>
                <div class="feature-desc">Anti-bot measures and quality controls ensure reliable, authentic responses.</div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section bg-subtle" id="how-it-works">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">How <span class="gradient-text">Perspectiva</span> Works</h2>
            <p class="section-sub">A simple, gamified approach to collaborative research</p>
        </div>
        <div class="steps">
            <div class="step-card">
                <div class="step-num">01</div>
                <div class="step-body">
                    <div class="step-title">
                        Create Your Profile
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="step-desc">Sign up and tell us about your expertise, interests, and academic background.</div>
                </div>
            </div>
            <div class="step-card">
                <div class="step-num">02</div>
                <div class="step-body">
                    <div class="step-title">
                        Complete Surveys
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="step-desc">Answer surveys matched to your interests. Each completed survey earns you 1 point.</div>
                </div>
            </div>
            <div class="step-card">
                <div class="step-num">03</div>
                <div class="step-body">
                    <div class="step-title">
                        Launch Your Research
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="step-desc">Spend 2 points to post your own survey and reach targeted respondents.</div>
                </div>
            </div>
            <div class="step-card">
                <div class="step-num">04</div>
                <div class="step-body">
                    <div class="step-title">
                        Gain Insights
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <div class="step-desc">Access advanced analytics dashboards with AI-generated insights and visualizations.</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- COMMUNITIES -->
<section class="section bg-white" id="communities">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Join Thriving <span class="gradient-text">Communities</span></h2>
            <p class="section-sub">Connect with researchers and students in your field of expertise</p>
        </div>
        <div class="grid3c">
            <div class="comm-card">
                <div class="comm-top">
                    <div class="comm-icon" style="background:linear-gradient(135deg,#3b82f6,#06b6d4)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                    </div>
                    <span class="comm-badge">450 surveys</span>
                </div>
                <div class="comm-name">Technology</div>
                <div class="comm-members">3.2K active members</div>
            </div>
            <div class="comm-card">
                <div class="comm-top">
                    <div class="comm-icon" style="background:linear-gradient(135deg,#22c55e,#10b981)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                    </div>
                    <span class="comm-badge">380 surveys</span>
                </div>
                <div class="comm-name">Economics</div>
                <div class="comm-members">2.8K active members</div>
            </div>
            <div class="comm-card">
                <div class="comm-top">
                    <div class="comm-icon" style="background:linear-gradient(135deg,#a855f7,#ec4899)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                    </div>
                    <span class="comm-badge">520 surveys</span>
                </div>
                <div class="comm-name">Business</div>
                <div class="comm-members">4.1K active members</div>
            </div>
            <div class="comm-card">
                <div class="comm-top">
                    <div class="comm-icon" style="background:linear-gradient(135deg,#f97316,#ef4444)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                    </div>
                    <span class="comm-badge">290 surveys</span>
                </div>
                <div class="comm-name">Sports Science</div>
                <div class="comm-members">1.9K active members</div>
            </div>
            <div class="comm-card">
                <div class="comm-top">
                    <div class="comm-icon" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v11m0 0h10m-10 0H3m0 0v5a2 2 0 0 0 2 2h4M3 14h6"/></svg>
                    </div>
                    <span class="comm-badge">410 surveys</span>
                </div>
                <div class="comm-name">Research</div>
                <div class="comm-members">2.5K active members</div>
            </div>
            <div class="comm-card">
                <div class="comm-top">
                    <div class="comm-icon" style="background:linear-gradient(135deg,#eab308,#f59e0b)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <span class="comm-badge">480 surveys</span>
                </div>
                <div class="comm-name">Education</div>
                <div class="comm-members">3.7K active members</div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <a href="index.php" class="footer-logo">
                    <img src="assets/logo.png" alt="Perspectiva">
                    <span class="logo-text">PERSPECTIVA</span>
                </a>
                <p class="footer-desc">Collaborative research made simple through gamification and community.</p>
            </div>
            <div>
                <div class="footer-heading">Product</div>
                <ul class="footer-links">
                    <li><a href="#features">Features</a></li>
                    <li><a href="#communities">Communities</a></li>
                    <li><a href="#">Analytics</a></li>
                    <li><span>Pricing (Coming soon)</span></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">Company</div>
                <ul class="footer-links">
                    <li><span>About (Coming soon)</span></li>
                    <li><span>Blog (Coming soon)</span></li>
                    <li><span>Careers (Coming soon)</span></li>
                    <li><span>Contact (Coming soon)</span></li>
                </ul>
            </div>
            <div>
                <div class="footer-heading">Legal</div>
                <ul class="footer-links">
                    <li><span>Privacy (Coming soon)</span></li>
                    <li><span>Terms (Coming soon)</span></li>
                    <li><span>Security (Coming soon)</span></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?php echo date('Y'); ?> Perspectiva. All rights reserved.
        </div>
    </div>
</footer>

</body>
</html>