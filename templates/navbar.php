<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-gradient">
        <a class="navbar-brand " href="#">
        <img src="http://localhost/ittfa/images/logo.png" width="80" height="80" class=" d-inline-block  mx-2" alt="">DispositionDiary</a>
        <button class="navbar-toggler btn-warning" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">  
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item px-5 ">
                    <a class="nav-link " href="http://localhost/ittfa/index.php">Home</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link " href="http://localhost/ittfa/user/all_entries.php">All entries</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link" href="http://localhost/ittfa/user/user_analytics.php">Analytics</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link" href="http://localhost/ittfa/user/profile.php">Profile</a>
                </li>
				<li class="nav-item px-5">
                    <a class="nav-link text-warning " href="http://localhost/ittfa/logout.php">Logout</a>
                </li>
                <li class="nav-item px-5 mt-2">
                    <!-- Darkmode switch -->
                <input class="form-check-input " type="checkbox" id="darkModeSwitch" checked>
                <label class="form-check-label" for="darkModeSwitch">Dark Mode</label>
                </li>
            </ul>
        </div>
    </nav>

    <script>document.addEventListener('DOMContentLoaded', (event) => {
    const htmlElement = document.documentElement;
    const switchElement = document.getElementById('darkModeSwitch');

    //Set the default theme to dark
    const currentTheme = localStorage.getItem('bsTheme') || 'dark';
    htmlElement.setAttribute('data-bs-theme', currentTheme);
    switchElement.checked = currentTheme === 'dark';
// Event listener
    switchElement.addEventListener('change', function () {
        if (this.checked) {
            htmlElement.setAttribute('data-bs-theme', 'dark');
            localStorage.setItem('bsTheme', 'dark');
        } else {
            htmlElement.setAttribute('data-bs-theme', 'light');
            localStorage.setItem('bsTheme', 'light');
        }
    });
});</script>