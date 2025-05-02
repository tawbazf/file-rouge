<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Bienvenue sur CodeClass</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen text-gray-800">

  <!-- Header -->
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <i class="fas fa-code w-8 h-8 text-indigo-700"></i>
        <span class="text-2xl font-bold text-indigo-700">CodeClass</span>
      </div>
      <nav class="space-x-6">
        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Connexion</a>
        <a href="{{ route('register') }}" class="text-white bg-indigo-600 px-4 py-2 rounded-md shadow hover:bg-indigo-700 transition">Inscription</a>
      </nav>
    </div>
  </header>

  <!-- Hero -->
  <section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
      <div class="md:w-1/2 mb-10 md:mb-0">
        <h1 class="text-5xl font-extrabold text-indigo-800 mb-6 leading-tight">
          La plateforme pédagogique de demain
        </h1>
        <p class="text-lg text-gray-700 mb-6">
          Centralisez la gestion de projets, suivez la progression des étudiants et renforcez l’apprentissage grâce à des outils modernes.
        </p>
        <div class="flex gap-4">
          <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-indigo-700 transition">Commencer</a>
          <a href="{{ route('login') }}" class="bg-white border border-indigo-600 text-indigo-700 px-6 py-3 rounded-lg font-semibold shadow hover:bg-indigo-50 transition">Déjà inscrit ?</a>
        </div>
      </div>
      <div class="md:w-1/2">
        <img src="/images/education.jpg" alt="Illustration of digital education tools" class="rounded-xl shadow-lg" onerror="this.src='/images/fallback-education.jpg'">
      </div>
    </div>
  </section>

  <!-- Fonctionnalités principales -->
  <section class="px-6 py-20 bg-indigo-50">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-extrabold text-indigo-800">Fonctionnalités principales</h2>
      <p class="text-gray-600 mt-4">Optimisez votre pédagogie grâce à des outils intuitifs et automatisés</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <i class="fab fa-github text-6xl text-indigo-600 mx-auto mb-4"></i>
        <h3 class="font-bold text-lg mb-2">Création de dépôts GitHub</h3>
        <p class="text-gray-600">Générez automatiquement un dépôt pour chaque devoir avec accès personnalisé aux enseignants et étudiants.</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <i class="fas fa-folder text-6xl text-indigo-600 mx-auto mb-4"></i>
        <h3 class="font-bold text-lg mb-2">Gestion des accès</h3>
        <p class="text-gray-600">Contrôle des permissions automatisé selon les rôles et les projets attribués.</p>
      </div>
      <div class="bg-white rounded-lg shadow p-6 text-center">
        <i class="fas fa-code-branch text-6xl text-indigo-600 mx-auto mb-4"></i>
        <h3 class="font-bold text-lg mb-2">Code Review intégrée</h3>
        <p class="text-gray-600">Les enseignants ou les pairs peuvent annoter le code et proposer des améliorations directement dans l'interface.</p>
      </div>
    </div>
  </section>

  <!-- Suivi pédagogique -->
  <section class="bg-white px-6 py-20">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-extrabold text-indigo-800">Suivi pédagogique</h2>
      <p class="text-gray-600 mt-4">Des outils visuels pour comprendre et accompagner l’évolution des étudiants</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
      <div class="bg-indigo-100 rounded-lg shadow p-6 text-center">
        <i class="fas fa-chart-bar text-6xl text-indigo-600 mx-auto mb-4"></i>
        <h3 class="font-bold text-lg mb-2">Tableau de bord</h3>
        <p class="text-gray-700">Visualisez les projets réalisés, les scores obtenus et l’évolution des compétences de chaque étudiant.</p>
      </div>
      <div class="bg-indigo-100 rounded-lg shadow p-6 text-center">
        <i class="fas fa-brain text-6xl text-indigo-600 mx-auto mb-4"></i>
        <h3 class="font-bold text-lg mb-2">Analyse des compétences</h3>
        <p class="text-gray-700">Identifiez les points forts et les lacunes pour adapter le parcours pédagogique.</p>
      </div>
      <div class="bg-indigo-100 rounded-lg shadow p-6 text-center">
        <i class="fas fa-history text-6xl text-indigo-600 mx-auto mb-4"></i>
        <h3 class="font-bold text-lg mb-2">Historique d'apprentissage</h3>
        <p class="text-gray-700">Gardez une trace des corrections, projets, commits et apprentissages de chaque étudiant.</p>
      </div>
    </div>
  </section>

  <!-- Fonctionnalités avancées -->
  <section class="bg-indigo-600 text-white px-6 py-20">
    <div class="text-center mb-16">
      <h2 class="text-3xl font-extrabold">Fonctionnalités avancées</h2>
      <p class="text-indigo-100 mt-4">Un apprentissage personnalisé et stimulant</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto">
      <div class="flex items-start space-x-6">
        <i class="fas fa-medal w-16 h-16 text-indigo-200"></i>
        <div>
          <h3 class="text-xl font-bold mb-1">Système de badges</h3>
          <p class="text-indigo-100">Motivez les étudiants avec des récompenses visuelles qui valorisent les compétences acquises.</p>
        </div>
      </div>
      <div class="flex items-start space-x-6">
        <i class="fas fa-book-open w-16 h-16 text-indigo-200"></i>
        <div>
          <h3 class="text-xl font-bold mb-1">Ressources recommandées</h3>
          <p class="text-indigo-100">Des suggestions de contenus basées sur les lacunes détectées dans les performances de l’étudiant.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center text-gray-500 py-8 bg-white">
    © {{ date('Y') }} CodeClass. Tous droits réservés.
  </footer>

</body>
</html>