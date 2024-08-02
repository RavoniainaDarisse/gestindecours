<?php
include './Actions/editAction.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header>
        <div class="head">
            <div class="Logo">ALFALogo</div>
            <div class="nav">
                <ul>
                    <li>Acceuil</li>
                    <li>Services</li>
                    <li>Voir tous les cours</li>
                    <li>A propos</li>
                </ul>
            </div>
            <div class="search">
                <div class="input">
                    <input type="text" placeholder="Rechercher des cours...">
                </div>
                <div>
                    <img src="./assets/img/rechercher.png" width=33px" alt="" srcset="">
                </div>
            </div>
        </div>
    </header>

    <section class="Add">
    <div class="centerForm">
        <h1>Bonjour cher utilisateur !</h1>
        <h3>Ajoutez votre cours : </h3>
        <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post" enctype="multipart/form-data" >
            <div class="form">
                <label for="">Titre: </label>
                <input type="text" class="form-control" name="title" id="title" value="<?php echo htmlspecialchars($course['title']); ?>" required>
            </div>

            <div class="form">
                <label for="">Semestre: </label>
                <input type="text" class="form-control" name="class" id="class" value="<?php echo htmlspecialchars($course['class']); ?>" required>
            </div>

            <div class="form">
                <label for="">Niveau: </label>
                <select class="form-control" name="level" id="level" required>
                    <?php foreach ($levels as $level): ?>
                        <option value="<?= $level['id'] ?>"><?= $level['level_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form1">
                <label for="">Add file : </label>
                <input type="file" class="form-control-file" name="video_file" id="video_file">
                <input type="hidden" name="existing_video_file" value="<?php echo htmlspecialchars($course['video_file']); ?>">
                <?php if (!empty($course['video_file'])): ?>
                    <p>Fichier actuel : <?php echo htmlspecialchars($course['video_file']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form">
                <label for="">URL de la vidéo : </label>
                <input type="url" class="form-control"  value="<?php echo htmlspecialchars($course['video_url']); ?>" name="video_url" id="video_url" required>
            </div>

            <div class="btnAddForm">
                <div class="btnLeftAddForm">
                    <button type="submit" class="AddLessons">Modifier</button>
                </div>
            </div>
        </form>
    </div>
    </section>
    
</body>
</html>