<?php
include './Actions/detailAction.php';
?>

<!DOCTYPE html>
<html lang="fr">
<?php include './includes/head.php'; ?>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Détails du Cours</h1>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Titre</th>
                    <td><?php echo htmlspecialchars($course['title']); ?></td>
                </tr>
                <tr>
                    <th>Semestre</th>
                    <td><?php echo htmlspecialchars($course['class']); ?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><?php echo htmlspecialchars($course['created_at']); ?></td>
                </tr>
                <tr>
                    <th>URL de la Vidéo</th>
                    <td><?php echo htmlspecialchars($course['video_url']); ?></td>
                </tr>
                <tr>
                    <th>Niveau</th>     
                    <td><?php echo htmlspecialchars($course['level_name']); ?></td> <!-- Assurez-vous d'utiliser 'level_name' -->
               
                </tr>
                <tr>
                    <th>Vidéo</th>
                    <td>
                        <?php if (!empty($course['video_file'])): ?>
                            <video class="video-preview" controls>
                                <source src="uploads/<?php echo htmlspecialchars($course['video_file']); ?>" type="video/mp4">
                                Votre navigateur ne supporte pas la lecture de vidéo.
                            </video>
                        <?php else: ?>
                            Pas de vidéo
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Retour à la Liste</a>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>
