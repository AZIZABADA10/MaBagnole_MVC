<?php
require_once __DIR__ . '/../layouts/top_side_bar.php';

?>
<h2>Gestion des réservations</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Client</th>
        <th>Email</th>
        <th>Véhicule</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Statut</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($reservations as $r): ?>
        <tr>
            <td><?= $r['client_nom'] ?></td>
            <td><?= $r['email'] ?></td>
            <td><?= $r['modele'] ?></td>
            <td><?= $r['date_debut'] ?></td>
            <td><?= $r['date_fin'] ?></td>
            <td><?= $r['statut_reservation'] ?></td>
            <td>
                <?php if ($r['statut_reservation'] === 'en_attente'): ?>
                    <a href="<?= BASE_URL ?>/admin/reservation/confirmer?id_user=<?= $r['id_utilisateur'] ?>&id_vehicule=<?= $r['id_vehicule'] ?>">✔ Confirmer</a>
                    |
                    <a href="<?= BASE_URL ?>/admin/reservation/refuser?id_user=<?= $r['id_utilisateur'] ?>&id_vehicule=<?= $r['id_vehicule'] ?>">✖ Refuser</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

