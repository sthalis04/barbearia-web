document.getElementById('formCadastro').addEventListener('submit', function(e) {
  const senha = document.getElementById('senha').value;
  const senha2 = document.getElementById('senha_2').value;
  if (senha !== senha2) {
    alert('As senhas não coincidem!');
    e.preventDefault();
  }
});

window.addEventListener("load", () => {
  const container = document.querySelector(".container");
  if (container) {
    container.classList.add("show");
  }
});
