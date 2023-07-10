function toggleFunction() {
    var x = document.getElementById("trip_type").value;
    if (x === "Two Way Transfer") {
        document.getElementById("return_detail").style.display = "block";
    }
}