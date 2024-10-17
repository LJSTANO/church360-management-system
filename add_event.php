<?php
// Include database connection
include 'connect.php';

// Initialize variables
$title = $description = $date = $location = '';
$errors = array();

// Add event
if (isset($_POST['add_event'])) {
    // Retrieve event details from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = isset($_POST['location']) ? $_POST['location'] : ''; // Check if location is set

    // Validate form data
    if (empty($title) || empty($description) || empty($date)) {
        $errors[] = "All fields are required.";
    } else {
        // Add event to database
        $sql = "INSERT INTO Events (event_name, description, event_date, location) VALUES ('$title', '$description', '$date', '$location')";
        if (mysqli_query($conn, $sql)) {
            $success_message = "Event added successfully.";
            // Clear form fields after successful addition
            $title = $description = $date = $location = '';
        } else {
            $errors[] = "Error adding event: " . mysqli_error($conn);
        }
    }
}

// Edit event
if (isset($_POST['edit_event'])) {
    $event_id = $_POST['event_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $location = isset($_POST['location']) ? $_POST['location'] : ''; // Check if location is set

    // Validate form data
    if (empty($title) || empty($description) || empty($date)) {
        $errors[] = "All fields are required.";
    } else {
        // Update event in database
        $sql = "UPDATE Events SET event_name='$title', description='$description', event_date='$date', location='$location' WHERE id='$event_id'";
        if (mysqli_query($conn, $sql)) {
            $success_message = "Event updated successfully.";
        } else {
            $errors[] = "Error updating event: " . mysqli_error($conn);
        }
    }
}

// Delete event
if (isset($_POST['delete_event'])) {
    $event_id = $_POST['event_id'];

    // Delete event from database
    $sql = "DELETE FROM Events WHERE id='$event_id'";
    if (mysqli_query($conn, $sql)) {
        $success_message = "Event deleted successfully.";
    } else {
        $errors[] = "Error deleting event: " . mysqli_error($conn);
    }
}

// Fetch events from database
$sql = "SELECT * FROM Events ORDER BY event_date DESC";
$result = mysqli_query($conn, $sql);

// Array to store events
$events = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e6f7ff; /* Soft blue background color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Events</h2>
        <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success" role="alert"><?php echo $success_message; ?></div>
        <?php } ?>
        <h3 class="mt-4">Add Event</h3>
        <form method="post">
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" required>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" class="form-control" rows="3" required><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label>Date:</label>
                <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" required>
            </div>
            <div class="form-group">
                <label>Location:</label>
                <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" required>
            </div>
            <button type="submit" name="add_event" class="btn btn-primary">Add Event</button>
        </form>

        <h3 class="mt-5">Events</h3>
        <div class="list-group mt-3">
            <?php foreach ($events as $event) { ?>
                <div class="list-group-item list-group-item-action">
                    <h5 class="mb-1"><?php echo $event['event_name']; ?></h5>
                    <p class="mb-1">Location: <?php echo $event['location']; ?></p>
                    <small><?php echo $event['event_date']; ?></small>
                    <p class="mb-1"><?php echo $event['description']; ?></p>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                        <input type="hidden" name="title" value="<?php echo $event['event_name']; ?>">
                        <input type="hidden" name="description" value="<?php echo $event['description']; ?>">
                        <input type="hidden" name="date" value="<?php echo $event['event_date']; ?>">
                        <input type="hidden" name="location" value="<?php echo $event['location']; ?>">
                        <button type="submit" name="edit_event" class="btn btn-primary btn-sm">Edit</button>
                    </form>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                        <button type="submit" name="delete_event" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
