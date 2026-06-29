document.getElementById("formLogin").addEventListener("submit", function (e) {
  e.preventDefault();

  const usuario = document.getElementById("usuario").value;
  const senha = document.getElementById("senha").value;

  if (usuario && senha) {
    alert("Login realizado com sucesso!");
    // Aqui você pode fazer a validação real com backend
  } else {
    alert("Por favor, preencha todos os campos.");
  }
});
