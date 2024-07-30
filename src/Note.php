<?php

require_once 'DB.php';

class Note
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function addNotes(string $note): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO notes_app (note) VALUES (:note)");
        $stmt->bindParam(':note', $note);
        $stmt->execute();
    }

    public function getNotes(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM notes_app');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}