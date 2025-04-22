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

    // === Utazási kártya részletek modal ===
    const detailsModal = document.getElementById("detailsModal");
    const closeDetailsBtn = detailsModal ? detailsModal.querySelector(".close") : null;
    const modalContent = document.getElementById("modalContent");

    document.querySelectorAll(".details-btn").forEach(button => {
        button.addEventListener("click", function () {
            const description = this.getAttribute("data-trip");
            modalContent.innerHTML = `<p>${description}</p>`;
            detailsModal.style.display = "flex";
        });
    });

    if (closeDetailsBtn && detailsModal) {
        closeDetailsBtn.addEventListener("click", () => {
            detailsModal.style.display = "none";
        });
    }

    // Kattintás a háttérre bezáráshoz (details modal)
    window.addEventListener("click", (e) => {
        if (e.target === detailsModal) {
            detailsModal.style.display = "none";
        }
    });
});
