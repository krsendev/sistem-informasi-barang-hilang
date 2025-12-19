function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    // document.getElementById("main").style.marginLeft = "250px"; // Optional push effect
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    // document.getElementById("main").style.marginLeft= "0";
}

// Close sidebar if clicked outside (optional better UX)
window.onclick = function(event) {
    if (!event.target.matches('.logo-container') && !event.target.matches('.logo-container *') && !event.target.matches('.sidebar') && !event.target.matches('.sidebar *')) {
        // closeNav(); // Currently disabling auto-close on outside click to avoid conflicts
    }
}
