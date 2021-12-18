<?php

declare(strict_types=1);

namespace App;

require_once ("src/View.php");

class Controller {

    private array $postData = [];

    public function __construct(array $postData) {
        $this->postData = $postData;
    }

    public function run(string $action): void {

        $view = new View();
        $viewParams = [];

        switch ($action) {
            case 'create':
                $page = 'create';
                $created = false;

                if (!empty($this->postData)) {
                    $created = true;
                    $viewParams = [
                        'title' => $this->postData['title'],
                        'description' => $this->postData['description']
                    ];
                }

                $viewParams['created'] = $created;
                break;
            case 'show':
                $viewParams = [
                    'title' => ['Moja notatka'],
                    'description' => 'Opis'
                ];
                break;
            default:
                $page = 'list';
                $viewParams['resultList'] = "wyświetlamy notatki";
                break;
        }

        $view->render($page, $viewParams);

    }
}