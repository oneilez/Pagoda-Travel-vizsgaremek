document.addEventListener("DOMContentLoaded", function () {
    // === Bejelentkezés/Regisztráció modal ===
    const authModal = document.getElementById("authModal");
    const openAuthBtn = document.getElementById("openAuthModal");
    const closeAuthBtn = authModal ? authModal.querySelector(".close") : null;

    if (openAuthBtn && authModal) {
        openAuthBtn.addEventListener("click", () => {
            authModal.style.display = "flex";
        });
    }

    if (closeAuthBtn && authModal) {
        closeAuthBtn.addEventListener("click", () => {
            authModal.style.display = "none";
        });
    }
    
    // Kattintás a háttérre bezáráshoz (auth modal)
    window.addEventListener("click", (e) => {
        if (e.target === authModal) {
            authModal.style.display = "none";
        }
    });
    
});
