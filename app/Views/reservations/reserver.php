<h2>Réserver le véhicule : <?= htmlspecialchars($vehicule['modele']) ?></h2>

<form method="POST" action="<?= BASE_URL ?>/reserver">
    <input type="hidden" name="id_vehicule" value="<?= $vehicule['id_vehicule'] ?>">

    <label>Date début</label>
    <input type="date" name="date_debut" required>

    <label>Date fin</label>
    <input type="date" name="date_fin" required>

    <button type="submit">Confirmer la réservation</button>
</form>
