<?php
include './Actions/editAction.php';
?>

<!DOCTYPE html>
<html lang="fr">
<?php include './includes/head.php'; ?>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier le Cours</h1>
        <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titre :</label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="class">Semestre :</label>
                <input type="text" class="form-control" name="class" id="class" value="<?php echo htmlspecialchars($course['class']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="level">Niveau :</label>
                <select name="level" id="level" class="form-control" required>
                    <?php foreach ($levels as $levelOption): ?>
                        <option value="<?php echo htmlspecialchars($levelOption['id']); ?>" <?php if ($course['level_id'] == $levelOption['id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($levelOption['level_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="video_url">URL de la Vidéo :</label>
                <input type="url" class="form-control" name="video_url" id="video_url" value="<?php echo htmlspecialchars($course['video_url']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="video_file">Fichier Vidéo :</label>
                <input type="file" class="form-control-file" name="video_file" id="video_file">
                <input type="hidden" name="existing_video_file" value="<?php echo htmlspecialchars($course['video_file']); ?>">
                <?php if (!empty($course['video_file'])): ?>
                    <p>Fichier actuel : <?php echo htmlspecialchars($course['video_file']); ?></p>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Retour à la Liste</a>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>
