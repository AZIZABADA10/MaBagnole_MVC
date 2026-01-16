<?php
require_once __DIR__ . '/../layouts/top_side_bar.php';

?>

<main class="p-6">
    <?php if (!empty($_SESSION['error'])): ?>
  <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
  </div>
<?php endif; ?>

<?php if (!empty($_SESSION['success'])): ?>
  <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
  </div>
<?php endif; ?>
  <!-- Header + Boutons Ajouter -->
  <div class="flex justify-between items-center mb-6 gap-2">
    <h2 class="text-2xl font-semibold text-gray-800">Gestion des Catégories</h2>
    <div class="flex gap-2">
      <button onclick="document.getElementById('modal-ajouter').classList.remove('hidden')"
              class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Ajouter une catégorie
      </button>
      <button onclick="document.getElementById('modal-ajouter-multiple').classList.remove('hidden')"
              class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
        Ajouter plusieurs catégories
      </button>
    </div>
  </div>

  <!-- Table -->
  <div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left">ID</th>
          <th class="px-6 py-3 text-left">Titre</th>
          <th class="px-6 py-3 text-left">Description</th>
          <th class="px-6 py-3 text-right">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <?php foreach ($categories as $cat): ?>
          <tr>
            <td class="px-6 py-4"><?= $cat['id_categorie'] ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($cat['titre']) ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($cat['description']) ?></td>
            <td class="px-6 py-4 text-right space-x-2">

              <button
                onclick="ouvrirModifier(
                  <?= $cat['id_categorie'] ?>,
                  '<?= addslashes($cat['titre']) ?>',
                  '<?= addslashes($cat['description']) ?>'
                )"
                class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                Modifier
              </button>

              <a href="<?= BASE_URL ?>/admin/categorie/supprimer?id=<?= $cat['id_categorie'] ?>"
                 onclick="return confirm('Supprimer cette catégorie ?')"
                 class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                Supprimer
              </a>

            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- MODAL AJOUT -->
  <div id="modal-ajouter" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded p-6 w-96">
      <h3 class="text-lg font-semibold mb-4">Ajouter une catégorie</h3>
      <form method="POST" action="<?= BASE_URL ?>/admin/categorie/ajouter">
        <input type="text" name="titre" required placeholder="Titre"
               class="w-full mb-3 px-3 py-2 border rounded">
        <textarea name="description" required placeholder="Description"
                  class="w-full mb-4 px-3 py-2 border rounded"></textarea>

        <div class="flex justify-end gap-2">
          <button type="button"
                  onclick="document.getElementById('modal-ajouter').classList.add('hidden')"
                  class="px-4 py-2 bg-gray-300 rounded">
            Annuler
          </button>
          <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Ajouter
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL AJOUT MULTIPLE -->
  <div id="modal-ajouter-multiple" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded p-6 w-11/12 max-w-4xl">
      <h3 class="text-lg font-semibold mb-4">Ajouter plusieurs catégories</h3>

      <form method="POST" action="<?= BASE_URL ?>/admin/categorie/ajouter-multiple">
        <table class="w-full mb-4">
          <tbody id="categories-body">
            <tr>
              <td><input name="titre[]" required class="border px-2 py-1 w-full"></td>
              <td><input name="description[]" required class="border px-2 py-1 w-full"></td>
              <td>
                <button type="button" onclick="this.closest('tr').remove()"
                        class="text-red-600">X</button>
              </td>
            </tr>
          </tbody>
        </table>

        <button type="button" onclick="ajouterLigne()"
                class="mb-4 px-3 py-1 bg-gray-200 rounded">
          + Ajouter ligne
        </button>

        <div class="flex justify-end gap-2">
          <button type="button"
                  onclick="document.getElementById('modal-ajouter-multiple').classList.add('hidden')"
                  class="px-4 py-2 bg-gray-300 rounded">
            Annuler
          </button>
          <button class="px-4 py-2 bg-green-600 text-white rounded">
            Ajouter
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL MODIFIER -->
  <div id="modal-modifier" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded p-6 w-96">
      <h3 class="text-lg font-semibold mb-4">Modifier catégorie</h3>

      <form method="POST" action="<?= BASE_URL ?>/admin/categorie/modifier">
        <input type="hidden" name="id" id="mod-id">

        <input id="mod-titre" name="titre" required
               class="w-full mb-3 px-3 py-2 border rounded">

        <textarea id="mod-description" name="description" required
                  class="w-full mb-4 px-3 py-2 border rounded"></textarea>

        <div class="flex justify-end gap-2">
          <button type="button"
                  onclick="document.getElementById('modal-modifier').classList.add('hidden')"
                  class="px-4 py-2 bg-gray-300 rounded">
            Annuler
          </button>
          <button class="px-4 py-2 bg-yellow-400 text-white rounded">
            Modifier
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- JS -->
  <script>
    function ajouterLigne() {
      document.getElementById('categories-body').insertAdjacentHTML('beforeend', `
        <tr>
          <td><input name="titre[]" required class="border px-2 py-1 w-full"></td>
          <td><input name="description[]" required class="border px-2 py-1 w-full"></td>
          <td><button type="button" onclick="this.closest('tr').remove()" class="text-red-600">X</button></td>
        </tr>
      `);
    }

    function ouvrirModifier(id, titre, description) {
      document.getElementById('mod-id').value = id;
      document.getElementById('mod-titre').value = titre;
      document.getElementById('mod-description').value = description;
      document.getElementById('modal-modifier').classList.remove('hidden');
    }
  </script>

</main>
