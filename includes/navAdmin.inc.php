<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="indexAdmin.php"><img style="width:60px" class="logo" src="images/logo.png" alt="todo logo"></a>
    <a class="text-danger nav-link" href="subject.php">Add subject</a>
    <a class="text-danger nav-link" href="addAdmin.php">Add admin</a>
    <p class="nav-link"><?php echo $_SESSION['email']; ?></p>
    <a class="text-danger nav-link" href="includes/logout.inc.php">Logout</a>
</nav>