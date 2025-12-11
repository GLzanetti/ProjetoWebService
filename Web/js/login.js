$(document).ready(function() {
    
    const $formLogin = $('#form-login');

    $formLogin.on('submit', function(e) {
        e.preventDefault(); 

        const credenciais = {
            email: $('#email-login').val(),
            senha: $('#senha-login').val()
        };
        
        if (!credenciais.email || !credenciais.senha) {
            alert('Por favor, preencha o email e a senha.');
            return;
        }

        // Requisição AJAX (POST para o endpoint de autenticação)
        $.ajax({
            url: 'http://localhost/ProjetoWebService/ApiGolSolidario/usuarios/login', // Endpoint que você configurou no index.php
            type: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(credenciais),
            
            beforeSend: function() {
                $formLogin.find('button[type="submit"]').text('Entrando...').prop('disabled', true);
            },
            
            success: function(resposta) {
                // A resposta vem com status 200 OK (Login bem-sucedido)
                
                // A resposta deve ser um array com o usuário, então pegamos o primeiro elemento
                const usuario = resposta[0]; 

                if (usuario && usuario.id) { 
                    // PASSO CRUCIAL: Salvar o ID do usuário para uso futuro (GET e PUT)
                    localStorage.setItem('usuario_logado_id', usuario.id);
                    localStorage.setItem('usuario_nome', usuario.nome); // Opcional, para personalizar a saudação
                    
                    alert('Login efetuado! Bem-vindo(a), ' + usuario.nome + '!');
                    
                    // Redirecionar para a página de configurações após o login
                    window.location.href = 'usuario.html'; 
                } else {
                    alert('Login efetuado, mas os dados do usuário não foram encontrados.');
                }
            },

            error: function(xhr, status, error) {
                // A resposta vem com status 401 Unauthorized (Falha no Login)
                console.error('Erro no Login:', xhr.responseText);
                
                let mensagemErro = 'Erro no servidor. Tente novamente mais tarde.';
                
                // Se a API retornou o JSON de erro (com o 401)
                if (xhr.responseJSON && xhr.responseJSON.mensagem) {
                    mensagemErro = xhr.responseJSON.mensagem; 
                } else if (xhr.status === 401) {
                    mensagemErro = 'Email ou senha incorretos.';
                }
                
                alert('Falha no Login: ' + mensagemErro);
            },

            complete: function() {
                $formLogin.find('button[type="submit"]').text('Login').prop('disabled', false);
            }
        });
    });
});