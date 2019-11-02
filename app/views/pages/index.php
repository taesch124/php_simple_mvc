<?php require APPROOT.'/views/inc/header.php'; ?>


<h1><?php echo $data['title']; ?></h1>


<ul>
    <?php foreach($data['posts'] as $post): ?>
    <li>
        <div>
            <h4><?php echo $post->title; ?></h4>
            <p><?php echo $post->text; ?></p>
    </li>
    <?php endforeach; ?>
</ul>


<?php require APPROOT.'/views/inc/footer.php'; ?>