// Script administrativo para funcionalidades do painel admin

/**
 * Sistema de Confirmação de Exclusão
 * Gerencia modais de confirmação para operações de delete
 */

// Função principal para confirmar exclusão
function confirmarExclusao(idServico, nomeServico) {
    // Atualizar o conteúdo do modal
    document.getElementById('nomeServicoExcluir').textContent = nomeServico;
    document.getElementById('linkExcluir').href = 'administrador/processa/adm_apagar_servico.php?id=' + idServico;
    
    // Exibir o modal usando JavaScript vanilla
    var modal = document.getElementById('modalConfirmacao');
    modal.style.display = 'block';
    modal.classList.add('show');
    document.body.classList.add('modal-open');
    
    // Criar backdrop
    var backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'modalBackdrop';
    document.body.appendChild(backdrop);
}

// Função para fechar o modal
function fecharModal() {
    var modal = document.getElementById('modalConfirmacao');
    modal.style.display = 'none';
    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
    
    // Remover backdrop
    var backdrop = document.getElementById('modalBackdrop');
    if (backdrop) {
        backdrop.remove();
    }
}

// Event listeners para fechar o modal
document.addEventListener('DOMContentLoaded', function() {
    // Botão fechar (X)
    var closeBtn = document.querySelector('#modalConfirmacao .close');
    if (closeBtn) {
        closeBtn.addEventListener('click', fecharModal);
    }
    
    // Botão cancelar
    var cancelBtn = document.querySelector('#modalConfirmacao .btn-secondary');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', fecharModal);
    }
    
    // Fechar ao clicar fora do modal
    var modal = document.getElementById('modalConfirmacao');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                fecharModal();
            }
        });
    }
    
    // Fechar modal com tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            var modal = document.getElementById('modalConfirmacao');
            if (modal && modal.classList.contains('show')) {
                fecharModal();
            }
        }
    });
});

/**
 * Futuras funcionalidades administrativas podem ser adicionadas aqui
 * - Validações de formulários
 * - Funções de upload
 * - Filtros de tabelas
 * - etc.
 */

/**
 * Sistema de Contatos - Funções específicas para gerenciamento de mensagens
 */

// Função para confirmar exclusão de contatos
function confirmarExclusaoContato(idContato, nomeContato) {
    document.getElementById('nomeContatoExcluir').textContent = nomeContato;
    document.getElementById('linkExcluirContato').href = 'administrador/processa/adm_apagar_contato.php?id=' + idContato;
    
    var modal = document.getElementById('modalConfirmacaoContato');
    modal.style.display = 'block';
    modal.classList.add('show');
    document.body.classList.add('modal-open');
    
    var backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'modalBackdropContato';
    document.body.appendChild(backdrop);
}

// Função para fechar modal de contatos
function fecharModalContato() {
    var modal = document.getElementById('modalConfirmacaoContato');
    modal.style.display = 'none';
    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
    
    var backdrop = document.getElementById('modalBackdropContato');
    if (backdrop) {
        backdrop.remove();
    }
}

// Função para alterar status de contatos
function alterarStatus(id, novoStatus) {
    if (confirm('Deseja alterar o status desta mensagem para "' + novoStatus + '"?')) {
        window.location.href = 'administrador/processa/adm_alterar_status_contato.php?id=' + id + '&status=' + novoStatus;
    }
}

// Função para marcar todas as mensagens como lidas
function marcarTodasLidas() {
    if (confirm('Deseja marcar todas as mensagens visíveis como lidas?')) {
        // Pegar parâmetros atuais da URL para manter filtros
        var urlParams = new URLSearchParams(window.location.search);
        var params = [];
        
        for (var pair of urlParams.entries()) {
            if (pair[0] !== 'link') {
                params.push(pair[0] + '=' + encodeURIComponent(pair[1]));
            }
        }
        
        var paramString = params.length > 0 ? '?' + params.join('&') : '';
        window.location.href = 'administrador/processa/adm_marcar_todas_lidas.php' + paramString;
    }
}

/**
 * Sistema de Usuários - Funções específicas para gerenciamento de usuários
 */

// Função para confirmar exclusão de usuários
function confirmarExclusaoUsuario(idUsuario, nomeUsuario) {
    document.getElementById('nomeUsuarioExcluir').textContent = nomeUsuario;
    document.getElementById('linkExcluirUsuario').href = 'administrador/processa/adm_apagar_usuario.php?id=' + idUsuario;
    
    var modal = document.getElementById('modalConfirmacaoUsuario');
    modal.style.display = 'block';
    modal.classList.add('show');
    document.body.classList.add('modal-open');
    
    var backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'modalBackdropUsuario';
    document.body.appendChild(backdrop);
}

// Função para fechar modal de usuários
function fecharModalUsuario() {
    var modal = document.getElementById('modalConfirmacaoUsuario');
    modal.style.display = 'none';
    modal.classList.remove('show');
    document.body.classList.remove('modal-open');
    
    var backdrop = document.getElementById('modalBackdropUsuario');
    if (backdrop) {
        backdrop.remove();
    }
}

// Validação do formulário de cadastro de usuário
function validarFormularioCadastroUsuario() {
    var form = document.getElementById('formCadUsuario');
    if (!form) return; // Se não existe o formulário, não faz nada
    
    form.addEventListener('submit', function(e) {
        var nome = document.getElementById('inputNome').value.trim();
        var email = document.getElementById('inputEmail').value.trim();
        var senha = document.getElementById('inputSenha').value;
        var status = document.querySelector('select[name="status"]').value;
        var nivel = document.querySelector('select[name="nivel"]').value;
        
        var erros = [];
        
        // Validar nome
        if (nome === '' || nome.length < 2) {
            erros.push('Nome deve ter pelo menos 2 caracteres.');
        }
        
        // Validar email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '' || !emailRegex.test(email)) {
            erros.push('E-mail deve ter um formato válido.');
        }
        
        // Validar senha
        if (senha === '' || senha.length < 6) {
            erros.push('Senha deve ter pelo menos 6 caracteres.');
        }
        
        // Validar status
        if (status === '') {
            erros.push('Status deve ser selecionado.');
        }
        
        // Validar nível
        if (nivel === '') {
            erros.push('Nível de acesso deve ser selecionado.');
        }
        
        // Mostrar erros se houver
        if (erros.length > 0) {
            e.preventDefault();
            alert('Por favor, corrija os seguintes erros:\n\n' + erros.join('\n'));
            return false;
        }
        
        return true;
    });
}

// Validação do formulário de edição de usuário
function validarFormularioEdicaoUsuario() {
    var form = document.getElementById('formEditUsuario');
    if (!form) return; // Se não existe o formulário, não faz nada
    
    form.addEventListener('submit', function(e) {
        var nome = document.getElementById('inputNome').value.trim();
        var email = document.getElementById('inputEmail').value.trim();
        var senha = document.getElementById('inputSenha').value;
        var status = document.querySelector('select[name="status"]').value;
        var nivel = document.querySelector('select[name="nivel"]').value;
        
        var erros = [];
        
        // Validar nome
        if (nome === '' || nome.length < 2) {
            erros.push('Nome deve ter pelo menos 2 caracteres.');
        }
        
        // Validar email
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '' || !emailRegex.test(email)) {
            erros.push('E-mail deve ter um formato válido.');
        }
        
        // Validar senha (apenas se foi preenchida)
        if (senha !== '' && senha.length < 6) {
            erros.push('Nova senha deve ter pelo menos 6 caracteres.');
        }
        
        // Validar status
        if (status === '') {
            erros.push('Status deve ser selecionado.');
        }
        
        // Validar nível
        if (nivel === '') {
            erros.push('Nível de acesso deve ser selecionado.');
        }
        
        // Mostrar erros se houver
        if (erros.length > 0) {
            e.preventDefault();
            alert('Por favor, corrija os seguintes erros:\n\n' + erros.join('\n'));
            return false;
        }
        
        return true;
    });
}

// Inicializar validações quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    validarFormularioCadastroUsuario();
    validarFormularioEdicaoUsuario();
});