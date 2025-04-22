document.addEventListener("DOMContentLoaded", function () {
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

    window.addEventListener("click", (e) => {
        if (e.target === detailsModal) {
            detailsModal.style.display = "none";
        }
    });
});
