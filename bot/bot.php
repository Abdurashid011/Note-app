<?php

declare(strict_types=1);

$bot = new Bot();
use src\User;

if(isset($update->message)){
    $message = $update->message;
    $chatId = $message->chat->id;
    $text = $message->text;

    if($text == '/start'){
        $bot->handleStartCommand($chatId);
        return;
    }

    if($text == '/add'){
        $bot->handleAddCommand($chatId);
        return;
    }

    if($text == '/all'){
        $bot->getAllNotes($chatId);
        return;
    }

    $user = new User();
    if($user->getStatus($chatId)->status == 'add'){
    $bot->handlerSaveNote($chatId, $text);
    $user->setStatus($chatId, "");
    }

    if (isset($update->callback_query)) {
        $callback_query = $update->callback_query;
        $data = $callback_query->data;
        $chatId = $callback_query->message->chat->id;
        $messageId = $callback_query->message->message_id;
        if ($data === 'delete') {
            $bot->chuosetTodo($chatId);
            return;
        }
        if ($user->getStatus($chatId)->status == 'delete'){
            $bot->deleteNote($chatId, (int)$data);
            $user->setStatus($chatId, '');
        }

    }
}
