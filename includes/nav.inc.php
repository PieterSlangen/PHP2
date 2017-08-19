<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand logo" href="index.php"><img style="width:60px" class="logo" src="images/logo.png" alt="todo logo"></a><br>
    <a class="text-danger nav-link" href="list.php">Add list</a><br>
    <a class="text-danger nav-link" href="task.php">Add task</a><br>
    <p class="nav-link"><?php echo $_SESSION['email']; ?></p><br>
    <a class="text-danger nav-link" href="includes/logout.inc.php">Logout</a>
</nav>