$(document).ready(function() {
    
    // Seletor para o formulário de cadastro
    const $formCadastro = $('#form-cadastro');

    $formCadastro.on('submit', function(e) {
        e.preventDefault(); // Impede o envio padrão do formulário

        const senha = $('#senha').val();
        const confirmarSenha = $('#confirmar-senha').val();
        
        // 1. Validação de Senha
        if (senha !== confirmarSenha) {
            alert('As senhas digitadas não coincidem. Por favor, verifique.');
            $('#senha').focus(); 
            return; // Interrompe o envio
        }
        
        // 2. Coleta dos dados
        const dadosUsuario = {
            nome: $('#nome').val(),
            telefone: $('#telefone').val(),
            email: $('#email').val(),
            senha: senha // Usa a senha validada
        };
        
        // Validação simples de campos obrigatórios
        if (!dadosUsuario.nome || !dadosUsuario.telefone || !dadosUsuario.email || !dadosUsuario.senha) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return; 
        }

        // 3. Requisição AJAX (jQuery) para POST /usuarios
        $.ajax({
            url: 'http://localhost/ProjetoWebService/ApiGolSolidario/usuarios', // Endpoint de criação
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(dadosUsuario), // Transforma o objeto JS em string JSON
            
            beforeSend: function() {
                // Feedback visual: desabilita o botão
                $formCadastro.find('button[type="submit"]').text('Cadastrando...').prop('disabled', true);
            },
            
            success: function(resposta) {
                console.log('Sucesso no cadastro:', resposta);
                alert('🎉 Cadastro realizado! Agora você pode fazer o login.');
                
                // Limpa o formulário e redireciona (ajuste o caminho se necessário)
                $formCadastro[0].reset();
                window.location.href = './login.html'; 
            },

            error: function(xhr, status, error) {
                console.error('Erro ao cadastrar:', xhr.responseText);
                
                let mensagemErro = 'Erro no cadastro. Tente novamente.';
                
                // Tenta buscar uma mensagem de erro específica da API
                if (xhr.responseJSON && xhr.responseJSON.mensagem) {
                    mensagemErro = xhr.responseJSON.mensagem; 
                }
                
                alert('Falha no cadastro: ' + mensagemErro);
            },

            complete: function() {
                // Restaura o botão ao finalizar
                $formCadastro.find('button[type="submit"]').text('Finalizar Cadastro').prop('disabled', false);
            }
        });
    });
});