document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o comportamento padrão de envio do formulário
    
    // Cria um objeto FormData com os dados do formulário
    let formData = new FormData(this);

    // Envia os dados via Ajax
    fetch('../CONFIG/processamento.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Exibe a mensagem de sucesso
            var sucessoModal = new bootstrap.Modal(document.getElementById('sucessoModal'));
            sucessoModal.show();

            // Atualiza a lista de funcionários após fechar o modal
            sucessoModal._element.addEventListener('hidden.bs.modal', function() {
                // Redireciona para a página de listagem de funcionários
                window.location.href = 'listarFunc.php';
            });
        } else {
            alert(data.message); // Exibe a mensagem de erro
        }
    })
    .catch(error => console.error('Erro:', error));
});
