let currentAddress = null;

function buscarCEP() {
  const cep = document.getElementById("cep").value.replace(/\D/g, "");
  const errorMessage = document.getElementById("error-message");
  const result = document.getElementById("result");

  if (cep.length !== 8) {
    errorMessage.textContent = "CEP inválido. Digite 8 números.";
    result.style.display = "none";
    return;
  }

  errorMessage.textContent = "";

  fetch(`buscar_cep.php?cep=${cep}`)
    .then((response) => response.json())
    .then((data) => {
      if (data.erro) {
        errorMessage.textContent = "CEP não encontrado.";
        result.style.display = "none";
        return;
      }

      currentAddress = data;
      displayAddress(data);
      result.style.display = "block";
    })
    .catch((error) => {
      errorMessage.textContent = "Erro ao buscar o CEP. Tente novamente.";
      result.style.display = "none";
      console.error("Erro:", error);
    });
}

function displayAddress(address) {
  const addressInfo = document.getElementById("address-info");
  addressInfo.innerHTML = `
        <p><strong>CEP:</strong> ${address.cep}</p>
        <p><strong>Logradouro:</strong> ${address.logradouro}</p>
        <p><strong>Bairro:</strong> ${address.bairro}</p>
        <p><strong>Cidade:</strong> ${address.localidade}</p>
        <p><strong>Estado:</strong> ${address.uf}</p>
    `;
}

function salvarEndereco() {
  if (!currentAddress) return;

  fetch("salvar_endereco.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(currentAddress),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        carregarEnderecos();
        alert("Endereço salvo com sucesso!");
      } else {
        alert("Erro ao salvar o endereço.");
      }
    })
    .catch((error) => {
      console.error("Erro:", error);
      alert("Erro ao salvar o endereço.");
    });
}

function ordenarEnderecos() {
  const field = document.getElementById("sortField").value;
  const order = document.getElementById("sortOrder").value;

  fetch(`buscar_enderecos.php?field=${field}&order=${order}`)
    .then((response) => response.json())
    .then((data) => {
      displaySavedAddresses(data);
    })
    .catch((error) => {
      console.error("Erro:", error);
      alert("Erro ao carregar endereços.");
    });
}

function displaySavedAddresses(addresses) {
  const list = document.getElementById("saved-addresses-list");
  list.innerHTML = "";

  addresses.forEach((address) => {
    const card = document.createElement("div");
    card.className = "address-card";
    card.innerHTML = `
            <p><strong>CEP:</strong> ${address.cep}</p>
            <p><strong>Logradouro:</strong> ${address.logradouro}</p>
            <p><strong>Bairro:</strong> ${address.bairro}</p>
            <p><strong>Cidade:</strong> ${address.localidade}</p>
            <p><strong>Estado:</strong> ${address.uf}</p>
        `;
    list.appendChild(card);
  });
}

function carregarEnderecos() {
  ordenarEnderecos();
}

// Carregar endereços ao iniciar a página
document.addEventListener("DOMContentLoaded", carregarEnderecos);
