<?php
require_once '../src/Note.php'; // src papkasi view papkasidan bir daraja yuqorida joylashgan

$note = new Note();

// Notlarni olish
$notes = $note->getNotes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Qo'shimcha CSS */
        .note-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Notes</h1>

    <!-- Add Note Form -->
    <form action="../notes_action.php" method="POST" class="mb-4">
        <input type="hidden" name="action" value="add">
        <div class="form-group">
            <input type="text" name="note" class="form-control" placeholder="Enter new note" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>

    <!-- Display Notes -->
    <ul class="list-group">
        <?php foreach ($notes as $noteItem): ?>
            <li class="list-group-item note-item">
                <?php echo htmlspecialchars($noteItem['note']); ?>
                <!-- Edit Note Form -->
                <form action="../notes_action.php" method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($noteItem['id']); ?>">
                    <input type="text" name="new_note" class="form-control d-inline-block w-50" placeholder="Edit note" required>
                    <button type="submit" class="btn btn-warning ml-2">Edit</button>
                </form>
                <!-- Delete Note Form -->
                <form action="../notes_action.php" method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($noteItem['id']); ?>">
                    <button type="submit" class="btn btn-danger ml-2">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>
