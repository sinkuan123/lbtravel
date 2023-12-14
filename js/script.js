function toggleFunction() {
    var x = document.getElementById("trip_type").value;
    if (x === "Two Way Transfer") {
        document.getElementById("return_detail").style.display = "block";
    }
}
function openMalaysia() {
    document.getElementById("malaysia").style.display = "block";
    document.getElementById("openMalaysia").style.display = "none";
}

function closeMalaysia() {
    document.getElementById("malaysia").style.display = "none";
    document.getElementById("openMalaysia").style.display = "block";
}
let menuOpen = false; // Initialize a variable to track the menu state

function openNav() {
    if (window.innerWidth < 900) {
        document.getElementById("myNav").style.width = "100%";
        menuOpen = true; // Set the menu state to open
    } else {
        document.getElementById("myNav").style.width = "30%";
        document.getElementById("blur").classList.add("blur");
        menuOpen = true; // Set the menu state to open
    }
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    document.getElementById("blur").classList.remove("blur");
    menuOpen = false; // Set the menu state to closed
}

window.addEventListener("resize", function () {
    if (menuOpen == true) {
        // Only adjust the menu width if it wasn't explicitly opened
        if (window.innerWidth < 900) {
            document.getElementById("myNav").style.width = "100%";
        } else {
            document.getElementById("myNav").style.width = "30%";
        }
    }
});
document.addEventListener('DOMContentLoaded', function () {
    var nav = document.getElementById("myNav");
    var bar = document.getElementById("bar");
    window.addEventListener("click", function () {
        var isClickInsideNav = nav.contains(event.target);
        var isClickBar = bar.contains(event.target);
        if (menuOpen == true) {
            if (!isClickInsideNav && !isClickBar) {
                closeNav();
            }
        }
    })
})