<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .container {
      position: relative;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      background: linear-gradient(to bottom right, #f9fafb, #ffffff);
    }

    /* Balayage */
    .sweep {
      position: absolute;
      inset: 0;
      background: #111827;
      transform: translateX(0);
      animation: sweep 1s ease-out 0.3s forwards;
    }

    .sweep::after {
      content: '';
      position: absolute;
      right: 0;
      top: 0;
      bottom: 0;
      width: 2px;
      background: rgba(255, 255, 255, 0.5);
      filter: blur(2px);
    }

    .sweep::before {
      content: '';
      position: absolute;
      right: -4px;
      top: 0;
      bottom: 0;
      width: 100px;
      background: linear-gradient(to right, #111827, transparent);
    }

    /* Cercles d'ambiance */
    .ambient-circle {
      position: absolute;
      border-radius: 50%;
      opacity: 0.05;
      background: radial-gradient(circle at center, black, transparent);
      animation: pulse 20s infinite alternate ease-in-out;
    }

    /* Logo */
    .logo-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      align-items: center;
      gap: 0.5rem;
      animation: logoMove 1s ease-out 1.7s forwards;
    }

    .logo-circle {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: linear-gradient(to bottom right, #111827, #374151);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      transition: transform 0.5s;
    }

    .logo-text {
      font-size: 24px;
      font-weight: 600;
      background: linear-gradient(to right, #111827, #374151);
      -webkit-background-clip: text;
      color: transparent;
      transition: transform 0.5s;
    }

    .logo-shine {
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.3), transparent);
      transform: skewX(-12deg) translateX(-200%);
      animation: shine 3s infinite;
    }

    /* Contenu */
    .content {
      position: absolute;
      inset: 0;
      padding: 2rem;
      opacity: 0;
      transform: translateY(1rem);
      animation: fadeIn 1s ease-out 2s forwards;
    }

    .content-inner {
      max-width: 42rem;
      margin: 8rem auto 0;
    }

    .title {
      font-size: 3.75rem;
      font-weight: 300;
      overflow: hidden;
    }

    .title span {
      display: block;
      transform: translateY(100%);
      animation: slideUp 0.8s ease-out 2.2s forwards;
    }

    .subtitle {
      font-size: 2.5rem;
      margin-top: 0.5rem;
      transform: translateY(100%);
      animation: slideUp 0.8s ease-out 2.4s forwards;
    }

    .text {
      font-size: 1.25rem;
      color: #4b5563;
      margin-top: 1.5rem;
    }

    .text span {
      display: inline-block;
      opacity: 0;
      transform: translateY(1rem);
    }

    .button {
      margin-top: 2rem;
      padding: 0.75rem 2rem;
      background: linear-gradient(to right, #111827, #374151);
      color: white;
      border: none;
      border-radius: 9999px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s;
      opacity: 0;
      animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) 2.8s forwards;
    }

    .button:hover {
      transform: scale(1.1) rotate(1deg);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Animations */
    @keyframes sweep {
      to { transform: translateX(100%); }
    }

    @keyframes pulse {
      0% { transform: scale(1); opacity: 0.05; }
      100% { transform: scale(1.1); opacity: 0.1; }
    }

    @keyframes logoMove {
      to {
        top: 24px;
        transform: translate(-50%, 0) scale(0.75) rotate(360deg);
      }
    }

    @keyframes shine {
      0% { transform: skewX(-12deg) translateX(-200%); }
      100% { transform: skewX(-12deg) translateX(200%); }
    }

    @keyframes fadeIn {
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
      to { transform: translateY(0); }
    }

    @keyframes bounceIn {
      0% { transform: scale(0); opacity: 0; }
      50% { transform: scale(1.1); opacity: 0.7; }
      100% { transform: scale(1); opacity: 1; }
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Balayage -->
    <div class="sweep"></div>

    <!-- Cercles d'ambiance -->
    <div class="ambient-circle" style="width: 300px; height: 300px; top: 20%; left: 30%;"></div>
    <div class="ambient-circle" style="width: 200px; height: 200px; top: 60%; left: 70%;"></div>
    <div class="ambient-circle" style="width: 250px; height: 250px; top: 40%; left: 50%;"></div>

    <!-- Logo -->
    <div class="logo-container">
      <div class="logo-shine"></div>
      <div class="logo-circle"></div>
      <span class="logo-text">VOTRE LOGO</span>
    </div>

    <!-- Contenu -->
    <div class="content">
      <div class="content-inner">
        <h1 class="title">
          <span>Découvrez</span>
        </h1>
        <div class="subtitle">
          notre collection
        </div>
        <p class="text">
          Des parfums d'exception pour des moments inoubliables
        </p>
        <button class="button">Explorer</button>
      </div>
    </div>
  </div>
</body>
</html>