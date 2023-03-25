 
# Guia de Configuração do Projeto
## Servidor
 - Abra o arquivo _C:\xampp\apache\conf\extra\httpd-vhosts.conf.bak_ em um editor ou bloco de notas e adicione o seguinte código no final do arquivo:
 ```
<VirtualHost *:80>
    ServerAdmin webmaster@local.todolist.com
    DocumentRoot "C:/xampp/htdocs/todolist/public"
    ServerName local.todolist.com
    ErrorLog "logs/local.todolist.com-error.log"
    CustomLog "logs/local.todolist.com-access.log" common
</VirtualHost>
```
- Abra o arquivo _C:\Windows\System32\drivers\etc\hosts_ em um editor ou bloco de notas e adicione o seguinte comando ao final do arquivo:
```127.0.0.1  		local.todolist.com```
- Com o xampp instalado e configurado em sua máquina, siga os seguintes passos:
   - Extraia a pasta do projeto em `C:/xampp/htdocs/`;
   - Inicie o Apache e MySQL em seu xampp;
   - Abra o navegador e acesse `local.todolist.com`

## Banco de Dados
   Antes de tudo, pare o xampp e, em seguida, remova o ponto e vírgula inicial (;) do seu xampp/php/php.ini no código a seguir:
   `;extension=intl`,
   e então reinicie seu xampp.
 - Crie um novo banco de dados (todolist) em seu SGBD
 - Abra o arquivo **_.env_** e altere as seguintes informações do seu banco de dados:
```
   database.default.hostname = localhost
   database.default.database = todolist
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   database.default.DBPrefix =
```

## Importar tabelas
Adicione o diretório PHP de sua maquina (C:\xampp\php) ao PATH do Windows [(TUTORIAL)](https://knowledge.autodesk.com/pt-br/support/navisworks-products/troubleshooting/caas/sfdcarticles/sfdcarticles/PTB/Adding-folder-path-to-Windows-PATH-environment-variable.html) e siga os seguintes passos:
 - Execute o CMD na pasta principal do projeto e digite o comando `php spark migrate`, então a base de dados será criada;
 - Ainda com o CMD aberto, é preciso digitar o comando `php spark db:seed NOME_DO_ARQUIVO` para cada nome de arquivo .php existente na pasta app/database/Seeds;
   - Exemplo: `php spark db:seed User` 
   - Obs: Não se deve adicionar a extensão .php em NOME_DO_ARQUIVO;
   
## Login Padrão
Login e senha padrão criado pela seed:
- Login: admin
- Senha: admin
