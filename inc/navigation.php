<!-- Navigation -->
<style>
    /* Custom Navbar Styling */
    .navbar {
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: scale(1.05);
    }

    .logo-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }

    .logo-circle img {
        max-width: 70%;
        max-height: 70%;
        object-fit: contain;
    }

    .navbar-brand:hover .logo-circle {
        transform: rotate(360deg);
    }

    /* Logout Icon Animation */
    .logout-icon {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .logout-icon svg {
        fill: #dc3545;
        transition: all 0.3s ease;
    }

    .logout-icon:hover svg {
        fill: #fff;
        transform: scale(1.2) rotate(15deg);
    }

    .logout-icon::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: rgba(220, 53, 69, 0.2);
        border-radius: 50%;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: -1;
    }

    .logout-icon:hover::before {
        opacity: 1;
        transform: scale(1.2);
    }

    /* Date and Time Styling */
    .datetime-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #f8f9fa;
        font-weight: 500;
        text-align: center;
    }

    .date-display {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 2px;
    }

    .time-display {
        font-size: 1.1rem;
        letter-spacing: 1px;
    }

    .time-display span {
        margin: 0 2px;
    }

    .welcome-text {
        color: #f8f9fa;
        font-weight: 500;
        margin-right: 15px;
        transition: color 0.3s ease;
    }

    .welcome-text:hover {
        color: #28a745;
    }

    .logout-container {
        display: flex;
        align-items: center;
    }

    /* Pulse Animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .time-display {
        animation: pulse 2s infinite;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">
            <div class="logo-circle">
                <img src="logo.png" alt="Inventory System Logo">
            </div>
            Infinity Step
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item datetime-container">
                    <div class="date-display" id="current-date"></div>
                    <div class="time-display" id="current-time"></div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item logout-container">
                    <span class="welcome-text mr-3">Welcome <?php echo $_SESSION['fullName']; ?></span>
                    <a href="model/login/logout.php" class="logout-icon" title="Log Out">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30">
                            <path d="M16 13v-2H7V8l-5 4 5 4v-3z"/>
                            <path d="M20 3h-9c-1.11 0-2 .9-2 2v4h2V5h9v14h-9v-4H9v4c0 1.1.89 2 2 2h9c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Function to update date and time for Sri Jayawardenepura time zone
    function updateDateTime() {
        const dateTimeContainer = document.querySelector('.datetime-container');
        const dateDisplay = document.getElementById('current-date');
        const timeDisplay = document.getElementById('current-time');

        // Create a formatter for Sri Lanka time
        const formatter = new Intl.DateTimeFormat('en-LK', {
            timeZone: 'Asia/Colombo',
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        const timeFormatter = new Intl.DateTimeFormat('en-LK', {
            timeZone: 'Asia/Colombo',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        });

        function updateDisplay() {
            const now = new Date();
            
            // Format date
            const formattedDate = formatter.format(now);
            dateDisplay.textContent = formattedDate;

            // Format time
            const formattedTime = timeFormatter.format(now);
            timeDisplay.textContent = formattedTime;
        }

        // Initial update
        updateDisplay();

        // Update every second
        setInterval(updateDisplay, 1000);
    }

    // Call the function when the page loads
    document.addEventListener('DOMContentLoaded', updateDateTime);

    // Optional: Logout confirmation
    document.querySelector('.logout-icon').addEventListener('click', function(e) {
        e.preventDefault();
        if(confirm('Are you sure you want to log out?')) {
            window.location.href = this.getAttribute('href');
        }
    });
</script>