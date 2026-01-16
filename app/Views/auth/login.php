<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion | MaBagnole</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../public/assets/logo.png" type="image/x-icon">
</head>

<body class="min-h-screen bg-gradient-to-tr from-blue-900 via-blue-800 to-blue-700 flex items-center justify-center font-sans">

<div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative overflow-hidden">

    <div class="text-center mb-6">
        <img src="../public/assets/logo.png" class="mx-auto h-16 mb-3">
        <h1 class="text-3xl font-bold text-blue-600">Connexion</h1>
        <p class="text-gray-500">Accédez à votre compte</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="mb-4 p-3 text-red-700 bg-red-100 border border-red-400 rounded">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form class="space-y-5" method="POST" action="<?= BASE_URL ?>/login_post">
        <div>
            <label>Email</label>
            <input type="email" name="email" required class="w-full p-3 border rounded">
        </div>

        <div>
            <label>Mot de passe</label>
            <input type="password" name="mot_de_passe" required class="w-full p-3 border rounded">
        </div>

        <button class="w-full bg-blue-600 text-white py-3 rounded">
            Se connecter
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="<?= BASE_URL ?>/register" class="text-blue-600">Créer un compte</a>
        <br><a href="<?= BASE_URL ?>" class="text-gray-700 hover:text-blue-600">Accueil</a>

    </div>

</div>

</body>
</html>
