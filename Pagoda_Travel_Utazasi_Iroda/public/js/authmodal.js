document.addEventListener("DOMContentLoaded", function () {
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

    window.addEventListener("click", (e) => {
        if (e.target === authModal) {
            authModal.style.display = "none";
        }
    });
});
