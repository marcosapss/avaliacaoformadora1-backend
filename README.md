# Quiz - Avaliação Formadora 1

Projeto desenvolvido para a disciplina de **Back-end (PHP)**.  
Consiste em um **Quiz interativo** com 15 perguntas sobre **HTML, CSS, JavaScript e PHP**.

## Tecnologias
- PHP 8+
- HTML5
- CSS3
- Bootstrap 5
- Sessions (PHP)

## Estrutura de arquivos
- `index.php` → Página principal (renderiza as telas: inicial, perguntas e resultado).
- `Quiz.php` → Processa as respostas (POST), inicia o quiz e reseta a sessão (GET).
- `perguntas.php` → Contém o array de perguntas, alternativas e gabarito.
- `style.css` → Estilos adicionais (tema neon gamer futurista).
- `README.md` → Documento de explicação do projeto.

## Como funciona
1. O usuário acessa `index.php`.
2. Na tela inicial, clica em **Começar** → `Quiz.php` seta a sessão e redireciona.
3. Cada pergunta é exibida pelo `index.php`.  
   - O usuário escolhe uma alternativa e clica em **Responder** → `Quiz.php` valida a resposta, soma pontos se correto e avança.
   - Também é possível clicar em **Recomeçar** a qualquer momento para zerar a sessão.
4. Ao final, o resultado mostra a pontuação total.

## Demonstração
- Tela inicial: botão **Começar**.
- Tela de pergunta: enunciado + alternativas (radios).
- Tela final: resultado da pontuação e opção de **Recomeçar**.

## Como executar
1. Copie os arquivos para a pasta `htdocs` do **XAMPP** (ex.: `C:\xampp\htdocs\formadora1\`).
2. Inicie o Apache no painel do XAMPP.
3. Abra o navegador em: http://localhost/formadora1/
4. O quiz já estará rodando.

## Objetivo
Este projeto foi feito para praticar:
- Estruturas condicionais e laços em PHP.
- Manipulação de **sessions**.
- Separação de lógica (PHP) e visual (HTML/CSS).
- Envio de dados via **POST/GET**.

---