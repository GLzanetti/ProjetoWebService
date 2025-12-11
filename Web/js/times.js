/**
 * Função principal para carregar e exibir os times, e configurar o manipulador de seleção.
 * @param {string} USUARIO_ID - O ID do usuário logado (necessário para o PUT).
 * @param {string | null} timeAtualDoUsuario - O ID do time que o usuário já pertence.
 */
function carregarTimes(USUARIO_ID, timeAtualDoUsuario) {
    
    // =============================================================
    // 1. REQUISIÇÃO PARA BUSCAR TIMES (GET /times)
    // =============================================================
    $.ajax({
        url: 'http://localhost/ProjetoWebService/ApiGolSolidario/times', // Endpoint GET /times
        type: 'GET',
        dataType: 'json',
        
        success: function(times) {
            const $timesContainer = $('.times-container'); 
            $timesContainer.empty(); 
            
            if (times && times.length > 0) {
                
                times.forEach(function(time) {
                    
                    const isSelecionado = timeAtualDoUsuario == time.id;
                    const statusClass = isSelecionado ? ' time-selecionado' : '';
                    const buttonText = isSelecionado ? 'SELECIONADO' : 'Selecionar';
                    const isDisabled = isSelecionado ? ' disabled' : '';

                    // Criação do Card (Molde HTML)
                    const timeCard = `
                        <div class="time-card${statusClass}" data-time-id="${time.id}">
                            <h3>${time.nome}</h3>
                            <p>${time.descricao || 'Time pronto para entrar em campo!'}</p>
                            <p>Meta de Doações: <strong>R$ ${time.meta_doacoes || 'N/A'}</strong></p>
                            <button class="btn-selecionar-time" 
                                    data-id="${time.id}"
                                    ${isDisabled}>
                                ${buttonText}
                            </button>
                        </div>
                    `;
                    
                    $timesContainer.append(timeCard);
                });
                
                // 2. Inicializa a lógica de clique após renderizar os cards
                initTimeSelectionHandler(USUARIO_ID);
                
            } else {
                $timesContainer.html('<p>Nenhum time disponível no momento.</p>');
            }
        },
        
        error: function(xhr) {
            console.error('Erro ao carregar times:', xhr.responseText);
            $('.times-container').html('<p class="error-message">Erro ao carregar a lista de times.</p>');
        }
    });
}

// =============================================================
// 3. FUNÇÃO PARA SELECIONAR UM TIME (PUT /usuarios/{id})
// =============================================================
function initTimeSelectionHandler(USUARIO_ID) {
    $('.btn-selecionar-time').off('click').on('click', function() { // Usamos .off('click') para evitar múltiplos handlers
        const timeId = $(this).data('id');
        
        if (!confirm(`Tem certeza que deseja entrar para o time de ID ${timeId}?`)) {
            return;
        }

        const $button = $(this);
        $button.prop('disabled', true).text('Entrando...');
        
        const dadosParaAtualizar = {
            time_id: timeId 
        };

        $.ajax({
            url: `http://localhost/ProjetoWebService/ApiGolSolidario/usuarios/${USUARIO_ID}`,
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(dadosParaAtualizar),
            
            success: function(resposta) {
                alert('Time selecionado com sucesso! Atualize sua página para ver as mudanças.');
                
                // Recarrega a página inteira para recarregar todos os dados do usuário e times
                window.location.reload(); 
            },

            error: function(xhr) {
                console.error('Erro ao selecionar time:', xhr.responseText);
                alert('Falha ao selecionar o time. Tente novamente.');
                
                $button.prop('disabled', false).text('Selecionar');
            }
        });
    });
}