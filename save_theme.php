<?php
session_start();

if (isset($_POST['theme'])) {
    $_SESSION['theme'] = $_POST['theme'];
    echo "Theme saved to session.";
} else {
    echo "No theme specified.";
}
?>