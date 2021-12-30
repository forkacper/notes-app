<?php

declare(strict_types=1);

namespace App;

use App\Request;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;

require_once("AbstractController.php");

class NoteController extends AbstractController
{

    public function createAction()
    {
        $page = 'create';

        if ($this->request->hasPost()) {
            $noteData = [
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description')
            ];
            $this->database->createNote($noteData);
            header('Location: /?before=created');
            exit;
        }

        $this->view->render($page, $viewParams ?? []);
    }

    public function showAction()
    {
        $page = 'show';

        $noteId = (int)$this->request->getParam('id');

        if (!$noteId) {
            header('Location: /?error=missingNoteId');
            exit;
        }

        try {
            $note = $this->database->getNote($noteId);
        } catch (NotFoundException $e) {
            header('Location: /?error=noteNotFound');
            exit;
        }

        $viewParams = [
            'note' => $note
        ];

        $this->view->render(
            'show',
            ['note' => $note]
        );
    }

    public function listAction()
    {
        $this->view->render(
            'list',
            [
                'notes' => $this->database->getNotes(),
                'before' => $this->request->getParam('before'),
                'error' => $this->request->getParam('error')
            ]
        );
    }
}
