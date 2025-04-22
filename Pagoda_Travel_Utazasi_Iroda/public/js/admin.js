document.querySelectorAll(".sidebar a").forEach(link => {
    link.addEventListener("click", e => {
        e.preventDefault();
        const target = link.getAttribute("href").substring(1);
        document.querySelectorAll(".admin-section").forEach(sec => {
            sec.style.display = "none";
        });
        document.getElementById(target).style.display = "block";
    });
});
