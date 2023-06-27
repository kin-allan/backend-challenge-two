<p align="center">
    <h1 align="center">Modulo de Perguntas Frequentes</h1>
    <br>
</p>

<h3>Instruções</h3>

<ul>
    <li>1. Entre na raiz do seu projeto</li>
    <li>1. Rode o comando: <code>composer config repositories.kin-allan-faq-module git https://github.com/kin-allan/backend-challenge-two</code></li>
    <li>2. Então: <code>composer require kin-allan/backend-challenge-two:1.0.0</code></li>
    <li>3. Após o término do comando acima, execute:</li>
    <li><code>bin/magento module:enable InfoBase_FAQ</code></li>
    <li><code>bin/magento setup:upgrade</code></li>
    <li><code>bin/magento setup:di:compile</code></li>
    <li><code>bin/magento cache:flush</code></li>
</ul>

<hr/>

<h3>O que esse modulo faz?</h3>
<p>Adiciona a funcionalidade de página de perguntas frequentes. Sendo accesível através da url de sua loja + /faq</p>
<p>O Painel de gerenciamento está localizado no menu principal em "FAQ"</p>
<p>É possível ter perguntas especificas para cada visão de loja</p>
<p>É possível habilitar/desabilitar perguntas a qualquer momento</p>
<p>É possível habilitar/desabilitar a página a qualquer momento via configurações</p>
<small><strong>Nota:</strong> O modulo já vem ativo, para desativá-lo, basta acessar o menu: <strong>FAQ</strong>, <strong>Settings</strong> (FAQ -> Configurações caso esteja usando o admin em português)</small>