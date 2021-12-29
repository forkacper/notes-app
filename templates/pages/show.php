<div>
    <?php $note = $params['note'] ?? null; ?>
    <?php if($note): ?>
    <ul>
        <li>Id: <?= (int) ($note['id']) ?></li>
        <li>Tytuł: <?= htmlentities($note['title']) ?></li>
        <li>Opis: <?= htmlentities($note['description']) ?></li>
        <li>Zapisano: <?= htmlentities($note['created']) ?></li>
    </ul>
    <?php else: ?>
        <div>Brak notatki do wyświetlenia</div>
    <?php endif; ?>
    <a href="/">
        <button>Powrót do listy notatek</button>
    </a>
</div>
