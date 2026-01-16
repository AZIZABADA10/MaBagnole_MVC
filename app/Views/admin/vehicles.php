<?php require_once __DIR__ . '/../layouts/TOP_SIDE_BAR.php'; ?>

<main class="p-6">

<!-- Titre + Boutons -->
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Gestion des véhicules</h2>
    <button onclick="openModal('modal-ajouter')"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        Ajouter un véhicule
    </button>
</div>

<!-- TABLE -->
<div class="bg-white shadow rounded overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Image</th>
            <th class="px-4 py-3">Modèle</th>
            <th class="px-4 py-3">Marque</th>
            <th class="px-4 py-3">Prix/Jour</th>
            <th class="px-4 py-3">Catégorie</th>
            <th class="px-4 py-3">Disponible</th>
            <th class="px-4 py-3 text-right">Actions</th>
        </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
        <?php foreach ($vehicules as $v): ?>
            <tr>
                <td class="px-4 py-2"><?= $v['id_vehicule'] ?></td>
                <td class="px-4 py-2">
                    <img src="<?= htmlspecialchars($v['image']) ?>" class="w-16 h-12 rounded object-cover">
                </td>
                <td class="px-4 py-2"><?= htmlspecialchars($v['modele']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($v['marque']) ?></td>
                <td class="px-4 py-2"><?= number_format($v['prix_par_jour'], 2) ?> DH</td>
                <td class="px-4 py-2">
                    <?php foreach ($categories as $c) {
                        if ($c['id_categorie'] == $v['id_categorie']) {
                            echo htmlspecialchars($c['titre']);
                        }
                    } ?>
                </td>
                <td class="px-4 py-2"><?= $v['disponible'] ? 'Oui' : 'Non' ?></td>
                <td class="px-4 py-2 text-right space-x-2">
                    <button
                        onclick="openEditModal(
                            <?= $v['id_vehicule'] ?>,
                            '<?= addslashes($v['modele']) ?>',
                            '<?= addslashes($v['marque']) ?>',
                            <?= $v['prix_par_jour'] ?>,
                            <?= $v['id_categorie'] ?>,
                            '<?= addslashes($v['image']) ?>',
                            <?= $v['disponible'] ? 1 : 0 ?>
                        )"
                        class="px-3 py-1 bg-yellow-400 text-white rounded">
                        Modifier
                    </button>

                    <a href="<?= BASE_URL ?>/admin/vehicule/supprimer?id=<?= $v['id_vehicule'] ?>"
                    onclick="return confirm('Supprimer ce véhicule ?')"
                    class="px-3 py-1 bg-red-500 text-white rounded">
                    Supprimer
                    </a>


                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</main>

<!-- MODAL AJOUT -->
<div id="modal-ajouter" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded w-96">
        <h3 class="text-lg font-semibold mb-4">Ajouter un véhicule</h3>

        <form method="POST" action="<?= BASE_URL ?>/admin/vehicule/ajouter">
            <input name="modele" required placeholder="Modèle" class="input">
            <input name="marque" required placeholder="Marque" class="input">
            <input name="prix_par_jour" type="number" step="0.01" required placeholder="Prix/Jour" class="input">

            <select name="id_categorie" class="input" required>
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['id_categorie'] ?>">
                        <?= htmlspecialchars($c['titre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input name="image" required placeholder="URL image" class="input">
            <label class="flex items-center gap-2 mt-2">
                <input type="checkbox" name="disponible" checked> Disponible
            </label>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal('modal-ajouter')">Annuler</button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL MODIFIER -->
<div id="modal-modifier" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded w-96">
        <h3 class="text-lg font-semibold mb-4">Modifier véhicule</h3>

        <form method="POST" action="<?= BASE_URL ?>/admin/vehicule/modifier">
            <input type="hidden" name="id_vehicule" id="edit-id">

            <input name="modele" id="edit-modele" required class="input">
            <input name="marque" id="edit-marque" required class="input">
            <input name="prix_par_jour" id="edit-prix" type="number" step="0.01" required class="input">

            <select name="id_categorie" id="edit-categorie" class="input">
                <?php foreach ($categories as $c): ?>
                    <option value="<?= $c['id_categorie'] ?>">
                        <?= htmlspecialchars($c['titre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input name="image" id="edit-image" required class="input">
            <label class="flex items-center gap-2 mt-2">
                <input type="checkbox" name="disponible" id="edit-disponible"> Disponible
            </label>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal('modal-modifier')">Annuler</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
function openEditModal(id, modele, marque, prix, categorie, image, dispo) {
    openModal('modal-modifier');
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-modele').value = modele;
    document.getElementById('edit-marque').value = marque;
    document.getElementById('edit-prix').value = prix;
    document.getElementById('edit-categorie').value = categorie;
    document.getElementById('edit-image').value = image;
    document.getElementById('edit-disponible').checked = dispo === 1;
}
</script>

<style>
.input {
    width: 100%;
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 6px;
    margin-bottom: 10px;
}
</style>
