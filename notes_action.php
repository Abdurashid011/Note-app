<?php
require_once 'src/Note.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $noteText = $_POST['note'] ?? '';
        if ($noteText !== '') {
            $note = new Note();
            $note->addNotes($noteText);
        }
    } elseif ($action === 'delete') {
        $id = $_POST['id'] ?? '';
        if ($id !== '') {
            $note = new Note();
            $note->deleteNote((int)$id);
        }
    } elseif ($action === 'edit') {
        $id = $_POST['id'] ?? '';
        $newNote = $_POST['new_note'] ?? '';
        if ($id !== '' && $newNote !== '') {
            $note = new Note();
            $note->editNote((int)$id, $newNote);
        }
    }

    header('Location: view/view.php');
    exit();
}
