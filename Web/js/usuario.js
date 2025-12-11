$(document).ready(function() {

    $('#btn-logout').on('click', handleLogout);

    // 1. Obtém o ID do usuário logado do LocalStorage
    const USUARIO_ID = localStorage.getItem('usuario_logado_id'); 
    
    // Verifica se o usuário está logado
    if (!USUARIO_ID) {
        alert('Sessão expirada ou usuário não logado. Redirecionando para o login.');
        window.location.href = './login.html'; // Ajuste o caminho conforme necessário
        return;
    }

    // =============================================================
    // 2. FUNÇÃO PARA CARREGAR OS DADOS ATUAIS (GET /usuarios/{id})
    // =============================================================
    let timeAtualDoUsuario = null;

    function carregarDadosUsuario() {
        $.ajax({
            url: `http://localhost/ProjetoWebService/ApiGolSolidario/usuarios/${USUARIO_ID}`,
            type: 'GET',
            dataType: 'json',
            success: function(resposta) {
                const dados = resposta[0] || resposta; 

                // Preenche o formulário
                $('#nome').val(dados.nome);
                $('#telefone').val(dados.telefone);
                $('#email').val(dados.email);
                $('#senha').val('');
                
                // Salva o time_id do usuário logado
                timeAtualDoUsuario = dados.time_id || null; 
                
                // CHAMA A NOVA FUNÇÃO QUE ESTARÁ NO ARQUIVO times.js
                // Passamos o ID do usuário para que a lógica de seleção funcione.
                if (typeof carregarTimes === 'function') {
                    carregarTimes(USUARIO_ID, timeAtualDoUsuario); 
                }
            },
            error: function(xhr) {
                console.error('Erro ao carregar os dados do usuário:', xhr.responseText);
                alert('Não foi possível carregar suas configurações. Tente recarregar a página.');
            }
        });
    }

    // Chama a função para carregar os dados ao iniciar
    carregarDadosUsuario(); 


    // =============================================================
    // 3. FUNÇÃO PARA SALVAR AS ALTERAÇÕES (PUT /usuarios/{id})
    // =============================================================
    $('#form-atualizacao').on('submit', function(e) {
        e.preventDefault();

        const novaSenha = $('#senha').val();
        
        // Coleta os dados que estão no formulário
        const dadosAtualizados = {
            nome: $('#nome').val(),
            telefone: $('#telefone').val(),
            // Email geralmente não é atualizável ou requer validação extra, mas o coletamos se for necessário
            email: $('#email').val() 
        };

        // Se a senha foi preenchida, adicionamos ao objeto de dados
        if (novaSenha.length > 0) {
            dadosAtualizados.senha = novaSenha;
        }

        $.ajax({
            url: `http://localhost/ProjetoWebService/ApiGolSolidario/usuarios/${USUARIO_ID}`, // Endpoint PUT
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(dadosAtualizados),
            
            beforeSend: function() {
                $('#form-atualizacao button[type="submit"]').text('Salvando...').prop('disabled', true);
            },
            
            success: function(resposta) {
                console.log('Dados atualizados com sucesso!', resposta);
                alert('Suas configurações foram salvas com sucesso!');
                
                // Limpa o campo de senha por segurança
                $('#senha').val('');
                
                // Opcional: Atualizar o nome do usuário no localStorage
                localStorage.setItem('usuario_nome', dadosAtualizados.nome);
            },

            error: function(xhr) {
                console.error('Erro ao atualizar:', xhr.responseText);
                alert('Falha ao salvar. Verifique os dados e tente novamente.');
            },
            
            complete: function() {
                $('#form-atualizacao button[type="submit"]').text('Salvar Alterações').prop('disabled', false);
            }
        });
    });

});

function handleLogout() {
    // 1. Chamada à API (para fins de padronização e escalabilidade)
    $.ajax({
        url: 'http://localhost/ProjetoWebService/ApiGolSolidario/logout',
        type: 'GET',
        dataType: 'json',
        // O bloco 'complete' será executado independentemente de sucesso ou falha da API
        complete: function() {
            console.log("Logout local concluído.");
            
            // 2. AÇÃO CRUCIAL: Limpar as credenciais no cliente
            localStorage.removeItem('usuario_logado_id'); 
            localStorage.removeItem('usuario_nome');
            localStorage.removeItem('time_id'); // Se estiver usando para armazenar o time
            
            // 3. Redirecionar para a tela de login
            window.location.href = 'login.html'; 
        }
    });
}