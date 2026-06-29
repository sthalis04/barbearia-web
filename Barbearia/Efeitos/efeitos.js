window.addEventListener("load", () => {
  const cards = document.querySelectorAll(".card");
  cards.forEach((card, i) => {
    setTimeout(() => {
      card.classList.add("show");
    }, i * 150); // atraso entre os cards
  });
});
