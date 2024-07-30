<?php

require_once 'DB.php';

class Note
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function getNotes(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM notes_app');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveNote(string $text, int|null $userId = null)
    {
        $save = $this->pdo->prepare('INSERT INTO notes_app (note, user_id) VALUES (:title, :user_id)');
        $save->execute(['title' => $text, 'user_id' => $userId]);
    }

    public function deleteNote(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM notes_app WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function editNote(int $id, string $newNote): void
    {
        $stmt = $this->pdo->prepare('UPDATE notes_app SET note = :note WHERE id = :id');
        $stmt->bindParam(':note', $newNote);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAllTodosByUser(int $userId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM notes_app WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
}