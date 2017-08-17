<nav class=".navbar-nav">
    <a class=".navbar-brand" href="index.php">Logo</a>
    <a href="list.php">Add list</a>
    <a href="task.php">Add task</a>
    <p><?php echo $_SESSION['email']; ?></p>
    <a href="includes/logout.inc.php">Logout</a>
</nav>