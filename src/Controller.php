<?php

declare(strict_types=1);

namespace App;

require_once("src/Exception/ConfigurationException.php");

use App\Request;
use App\Exception\ConfigurationException;
use App\Exception\NotFoundException;

require_once("Database.php");
require_once("View.php");

class Controller
{
  private const DEFAULT_ACTION = 'list';

  private static array $configuration = [];

  private Database $database;
  private Request $request;
  private View $view;

  public static function initConfiguration(array $configuration): void
  {
    self::$configuration = $configuration;
  }

  public function __construct(Request $request)
  {
    if (empty(self::$configuration['db'])) {
      throw new ConfigurationException('Configuration error');
    }
    $this->database = new Database(self::$configuration['db']);

    $this->request = $request;
    $this->view = new View();
  }

  public function create() {
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

  public function show() {
      $page = 'show';

      $noteId = (int) $this->request->getParam('id');

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

  public function list() {
      $this->view->render(
          'list',
          [
              'notes' => $this->database->getNotes(),
              'before' => $this->request->getParam('before'),
              'error' => $this->request->getParam('error')
          ]
      );
  }

  public function run(): void
  {
    switch ($this->action()) {
      case 'create':
          $this->create();
        break;
      case 'show':
          $this->show();
        break;
      default:
          $this->list();
          break;
      }

  }

  private function action(): string
  {
    return $this->request->getParam('action', self::DEFAULT_ACTION);
  }

  private function getRequestPost(): array
  {
    return $this->request['post'] ?? [];
  }
}
