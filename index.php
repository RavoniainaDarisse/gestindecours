<?php
include './Actions/indexAction.php';
?>

<!DOCTYPE html>
<html lang="fr">
<?php include './includes/head.php'; ?>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des Cours</h1>
        <a href="create.php" class="btn btn-primary mb-3">Ajouter un Cours</a>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Titre</th>
                    <th>Semestre</th>
                    <th>Date</th>
                    <th>URL de la Vidéo</th>
                    <th>Niveau</th>
                    <th>Vidéo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row['class'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row['created_at'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row['video_url'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row['level_name'] ?? ''); ?></td> <!-- Affichage du nom du niveau -->
                    <td>
                        <?php if (!empty($row['video_file'])): ?>
                            <video class="video-preview" controls>
                                <source src="uploads/<?php echo htmlspecialchars($row['video_file'] ?? ''); ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéo.
                            </video>
                        <?php else: ?>
                            Pas de vidéo
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="delete.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">Supprimer</a>
                        <a href="read.php?id=<?php echo htmlspecialchars($row['id'] ?? ''); ?>" class="btn btn-dark btn-sm">Détails</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>
