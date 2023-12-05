<?php
error_reporting(-1);
session_start();

if (!array_key_exists('logged_in', $_SESSION)) {
  header('Location: ./views/login.php');
  die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Add an appropriate title in this tag -->
  <title>The Real Deal</title>
  <!-- Links to stylesheets -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Your visible elements -->
  <nav>
      <a href="https://keep.google.com">Google Keep</a> | <a href="https://box.com">Box</a> | <a href="https://xkcd.com">Comics</a> | <a href="actions/logout_action.php"> LOGOUT </a>
  </nav>
  <h1>The Grand TODO</h1>
  <input type='checkbox' class="toggle-switch" id="sortByDate"/><label for='sortByDate'>Sort by date</label>
  <input type='checkbox' class="toggle-switch" id="filterByCompleted"/><label for='filterByCompleted'>Filter completed tasks</label>

  <ul class="tasklist" id="mainList">
      <li class="task"><input type='checkbox' class="task-done checkbox-icon" checked/>
        <span class="task-description task-descriptionOnComplete">Religion Reading catch-up</span>
        <span class="task-date">01-08-2021</span>
         <button class="task-delete material-icon">delete_sweep</button></li>
      <li class="task"><input type='checkbox' class="task-done checkbox-icon"/>
        <span class="task-description">Math reading</span>
         <span class="task-date">01-08-2021</span>
         <button class="task-delete material-icon">delete_sweep</button></li>
      <li class="task"><input type='checkbox' class="task-done checkbox-icon"/>
        <span class="task-description">ITC 210 lab</span>
         <span class="task-date">01-10-2021</span>
         <button class="task-delete material-icon">delete_sweep</button></li>
  </ul>
  <form class="form-create-task" id="newTaskForm">
      <input type='text' name='taskName' class="descriptionInput" required/><br>
      <input type='date' name='taskDate' class="dateInput" required/><br>
      <button class="createButton">Create Task</button>
  </form>

</body>

</html>
