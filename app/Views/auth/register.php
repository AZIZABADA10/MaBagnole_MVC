<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription | MaBagnole</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="/assets/logos/logo.png" type="image/x-icon">
</head>

<body class="min-h-screen bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 flex items-center justify-center">

<div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8">

    <div class="text-center mb-6">
        <img src="/assets/logos/logo.png" class="mx-auto h-14 mb-2">
        <h1 class="text-2xl font-bold text-blue-600">Créer un compte</h1>
        <p class="text-gray-500 text-sm">Rejoignez MaBagnole</p>
    </div>

    <!-- Message d'erreur du Controller -->
    <?php if (!empty($error)): ?>
        <div class="mb-4 p-3 text-red-700 bg-red-100 rounded">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/register" class="space-y-5">
        <div>
            <label>Nom complet</label>
            <input name="nom" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" required class="w-full p-2 border rounded">
        </div>

        <div>
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" required class="w-full p-2 border rounded">
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded">
            S'inscrire
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="/login" class="text-blue-600">Déjà un compte ?</a>
    </div>

</div>

</body>
</html>
