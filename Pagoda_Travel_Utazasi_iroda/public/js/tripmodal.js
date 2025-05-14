document.addEventListener("DOMContentLoaded", function () {
  const detailsModal = document.getElementById("detailsModal");
  const closeDetailsBtn = detailsModal?.querySelector(".close-modal");

  //const modalTitle = document.getElementById("modal-trip-title");
  const modalDesc = document.getElementById("modal-trip-desc");
  const modalLocation = document.getElementById("modal-location");
  const modalDates = document.getElementById("modal-dates");
  const modalSpots = document.getElementById("modal-spots");
  const modalPrice = document.getElementById("modal-price");
  const modalImage = document.getElementById("modal-trip-image");

  document.querySelectorAll(".details-btn").forEach(button => {
    button.addEventListener("click", function () {
      const destination = this.dataset.destination || "Utazás";
      const city = this.dataset.city || "";
      const country = this.dataset.country || "";
      const departure = this.dataset.departure || "–";
      const arrival = this.dataset.arrival || "–";
      const image = this.dataset.image || "/uploads/placeholder.jpg";

      modalTitle.textContent = destination;
      modalDesc.textContent = ""; // description_long ha lesz
      modalLocation.textContent = `${city}, ${country}`;
      modalDates.textContent = `Indulás: ${departure} - Érkezés: ${arrival}`;
      modalSpots.textContent = this.dataset.spots || "–";
      modalPrice.textContent = this.dataset.price || "–";
      modalImage.src = image;

      detailsModal.style.display = "flex";
    });
  });

  closeDetailsBtn?.addEventListener("click", () => {
    detailsModal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === detailsModal) {
      detailsModal.style.display = "none";
    }
  });
});
