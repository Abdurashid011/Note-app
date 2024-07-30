<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use src\User;

class Bot
{
    const string TOKEN = '7285834378:AAFZnk2Sap7l5AqrvBQRtBDt6j4Fi8HtbjA';
    const string API = 'https://api.telegram.org/bot' . self::TOKEN . '/';

    public Client $http;

    private PDO $pdo;

    public function __construct()
    {
        $this->http = new Client(['base_uri' => self::API]);
        $this->pdo = DB::connect();
    }

    public function sendMessage(int $chatId, string $text, $reply_markup = null)
    {
        $params = [
            'chat_id' => $chatId,
            'text' => $text
        ];
        $reply_markup ? $params['reply_markup'] = json_encode($reply_markup) : null;
        $this->http->post('sendMessage', [
            'form_params' => $params
        ]);

    }

    public function handleStartCommand(int $chatId): void
    {
        $user = new User();
        $user->saveUser($chatId);
        $this->sendMessage($chatId, "***Welcome***");
    }

    public function handleAddCommand(int $chatId): void
    {
        $user = new User();
        $user->setStatus($chatId, 'add');
        $this->sendMessage($chatId, "Plecase enter your task");
    }

    public function handlerSaveNote(int $chatId, string $text)
    {
        $user = new User();
        $user = $user->getUserInfo($chatId);

        $note = new Note();
        $note->saveNote($text, $user->id);

        $this->sendMessage($chatId, "Task saved");
    }

    public function prepareButtons($todos, $additional_button = [])
    {
        $i = 0;
        $keyboard = [];
        foreach ($todos as $todo) {
            $i++;
            $keyboard[] = ['text' => $i, 'callback_data' => $todo['id']];
        }
        $additional_button ? $keyboard[] = $additional_button : null;
        $reply_markup = [
            'inline_keyboard' => array_chunk($keyboard, 2)
        ];
        return $reply_markup;
    }

    public function prepareText($todos): string
    {
        $i = 0;
        $text = "";
        foreach ($todos as $todo) {
            $i++;
            $text .= $i . ") " . ($todo['status'] ? '✅' : '❎') . $todo['title'] . "\n";
        }
        return $text;
    }

    public function chuosetTodo(int $chatId)
    {
        $user = new User();
        $user->setStatus($chatId, 'delete');
        $user = new User();
        $user = $user->getUserInfo($chatId);

        $note = new Note();
        $todos = $note->getAllTodosByUser($user->id);
        $reply_markup = $this->prepareButtons($todos);
        $text = "Chuose your todo: \n" . $this->prepareText($todos);
        $this->sendMessage($chatId, $text, $reply_markup);
    }
}


