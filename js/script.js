// Scroll spy effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Validação do formulário de contato
function validarFormulario() {
    const nome = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const mensagem = document.getElementById('comments').value.trim();
    
    // Remove mensagens de erro anteriores
    document.querySelectorAll('.campo-erro').forEach(el => el.remove());
    document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));
    
    let temErro = false;
    
    // Validar nome
    if (nome === '') {
        mostrarErro('name', 'O campo nome é obrigatório.');
        temErro = true;
    } else if (nome.length < 2) {
        mostrarErro('name', 'O nome deve ter pelo menos 2 caracteres.');
        temErro = true;
    }
    
    // Validar email
    if (email === '') {
        mostrarErro('email', 'O campo e-mail é obrigatório.');
        temErro = true;
    } else if (!validarEmail(email)) {
        mostrarErro('email', 'Por favor, insira um e-mail válido.');
        temErro = true;
    }
    
    // Validar mensagem
    if (mensagem === '') {
        mostrarErro('comments', 'O campo mensagem é obrigatório.');
        temErro = true;
    } else if (mensagem.length < 10) {
        mostrarErro('comments', 'A mensagem deve ter pelo menos 10 caracteres.');
        temErro = true;
    }
    
    return !temErro;
}

function mostrarErro(campoId, mensagem) {
    const campo = document.getElementById(campoId);
    campo.classList.add('is-invalid');
    
    const divErro = document.createElement('div');
    divErro.className = 'campo-erro text-danger mt-1';
    divErro.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>' + mensagem;
    
    campo.parentNode.appendChild(divErro);
}

function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Auto-hide para mensagens de sucesso/erro
document.addEventListener('DOMContentLoaded', function() {
    const alertas = document.querySelectorAll('.alert-custom');
    
    alertas.forEach(function(alerta) {
        // Adiciona botão de fechar
        const btnFechar = document.createElement('button');
        btnFechar.type = 'button';
        btnFechar.className = 'btn-close btn-close-white float-end';
        btnFechar.setAttribute('aria-label', 'Fechar');
        btnFechar.onclick = function() {
            alerta.style.opacity = '0';
            setTimeout(() => alerta.remove(), 300);
        };
        alerta.appendChild(btnFechar);
        
        // Remove automaticamente após 5 segundos
        setTimeout(function() {
            if (alerta.parentNode) {
                alerta.style.opacity = '0';
                setTimeout(() => {
                    if (alerta.parentNode) {
                        alerta.remove();
                    }
                }, 300);
            }
        }, 5000);
    });
    
    // Se há mensagem de sucesso ou erro, rola para a seção de contato
    if (document.querySelector('.alert-custom')) {
        setTimeout(function() {
            document.getElementById('contact').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 100);
    }
});