<h2>Mes réservations</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Véhicule</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Prix / jour</th>
        <th>Statut</th>
        <th>Action</th>
    </tr>

    <?php foreach ($reservations as $r): ?>
        <tr>
            <td><?= $r['modele'] ?></td>
            <td><?= $r['date_debut'] ?></td>
            <td><?= $r['date_fin'] ?></td>
            <td><?= $r['prix_par_jour'] ?> DH</td>
            <td><?= $r['statut_reservation'] ?></td>
            <td>
                <?php if ($r['statut_reservation'] === 'en_attente'): ?>
                    <a href="<?= BASE_URL ?>/reservation/annuler?id_vehicule=<?= $r['id_vehicule'] ?>">
                        Annuler
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
