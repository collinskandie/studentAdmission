<style>
    .sidebar {
        width: 200px;
        color: white;

    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    #nav li {
        position: relative;
    }

    #nav li ul {
        display: none;
    }

    #nav li.active ul {
        display: block;
    }

    #nav a {
        display: block;
        padding: 10px;

        text-decoration: none;
    }

    #nav a:hover {
        background-color: #ddd;
    }

    #nav ul li {
        padding-left: 20px;
    }
</style>
<div class="topnav">
    <div class="top_nav">
        <a href="../resetpass.php" class="user-profile">User Profile</a>
        <a href="../../php/logout.php" class="logout">Logout</a>
    </div>
</div>

<div class="sidenav">
    <div style="text-align: center">
        <img src="../../imgs/logo.png" style="display: block; margin: 0 auto" />
    </div>
    <div class="sidebar">
        <a href="admin.php">Home</a>
        <ul id="nav">
            <li><a href="#">Enrollments</a>
                <ul>
                    <li><a href="active.php">Process</a></li>
                    <li><a href="approvedenroll.php">Approved</a></li>
                    <li><a href="rejectedenroll.php">Rejected</a></li>
                </ul>
            </li>
            <li><a href="#">Application</a>
                <ul>
                    <li><a href="./proceesapp.php">Process</a></li>
                    <li><a href="./approvedapp.php">Approved</a></li>
                    <li><a href="./rejectedapp.php">Rejected</a></li>
                </ul>
            </li>
            <li><a href="#">Reports</a>
                <ul>
                    <li><a href="./faculties.php">Faculties</a></li>
                    <li><a href="./departments.php">Departments</a></li>
                    <li> <a href="./courses.php">Programs</a></li>
                    <li> <a href="./perfacult.php">Students per Faculty</a></li>
                    <li> <a href="./perdepart.php">Student per Department</a></li>
                    <li> <a href="./perlevel.php">Student per Level</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var items = document.querySelectorAll('#nav li');

        for (var i = 0; i < items.length; i++) {
            items[i].addEventListener('click', function(e) {
                var clickedItem = e.target.parentElement;

                if (clickedItem.classList.contains('active')) {
                    clickedItem.classList.remove('active');
                } else {
                    var activeItem = document.querySelector('#nav li.active');
                    if (activeItem) {
                        activeItem.classList.remove('active');
                    }

                    clickedItem.classList.add('active');
                }
            });
        }
    });
</script>