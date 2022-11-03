# Desafio-de-desenvolvimento---Full-Stack
Solução web para cadastro de receitas com ingredientes com frontend em HTML e backend em PHP, com banco de dados em mySQL. Com estilo usando Boostrap e CSS.

Comentários

-> O site foi desenvolvimento com auxílio XAMPP; 

-> Para conectar o banco de dados pode ser necessário alterar em "funcoes.php" em "conectarBanco()" os parametros de nome do servidor, nome usuario e senha: 
        "$conexao = new mysqli("localhost", "root", "", "racao");"
        
-> Alguns bugs que não deu tempo para tratar: 
   + Ao usar o comando "excluir um ingrediente de uma receita" que tem um ingrediente só cadastrado, ele é excluido mas retorna tela de erro;
   + Ao escolher alterar ordem de ingredientes em uma receita se for escolhido o mesmo nos dois espaços retorna tela de erro;
   + Somente é possível excluir um ingrediente do cadastro se ele não estiver sendo utilizado em uma receita. Isso acontece por pela tabela "ingredientes" estar sendo usada na tabela relacional "ingrediente_receitas". Para resolver isso deixei limitado excluir ingredientes que não estão sendo usados em receitas;


     
        



