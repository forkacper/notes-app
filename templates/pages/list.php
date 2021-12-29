<div class="list">
    <div class="message">
        <?php
        if (!empty($params['error'])) {
            switch ($params['error']) {
                case 'noteNotFound':
                    echo 'Nie znaleziono notatki';
                    break;
                case 'missingNoteId':
                    echo 'Niepoprawny id';
                    break;
            }
        }
        ?>
    </div>
  <div class="message">
    <?php
    if (!empty($params['before'])) {
      switch ($params['before']) {
        case 'created':
          echo 'Notatka została utworzona !!!';
          break;
      }
    }
    ?>
  </div>

  <div class="tbl-header">
      <table cellpadding="0" cellspacing="0" border="0">
          <thead>
              <tr>
                  <th>Id</th>
                  <th>Tytuł</th>
                  <th>Data</th>
                  <th>Opcje</th>
              </tr>
          </thead>
      </table>
    </div>
    <div class="tbl-content">
        <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
                <?php foreach ($params['notes'] ?? [] as $note): ?>
                    <tr>
                        <td><?= (int) $note['id'] ?></td>
                        <td><?= htmlentities($note['title']) ?></td>
                        <td><?= htmlentities($note['created']) ?></td>
                        <td>
                            <a href="/?action=show&id=<?= (int) $note['id'] ?>">
                                <button>Pokaż</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>