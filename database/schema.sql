CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL, 
  email VARCHAR(100) NOT NULL UNIQUE
  );
  CREATE TABLE chamados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    status VARCHAR(20) DEFAULT 'aberto',
    usuario_id INT NOT NULL, 
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
   );
   INSERT INTO usuarios (nome, email) VALUES ('Cosme Rodolfo', 'cosme@email.com');
   INSERT INTO usuarios (nome, email) VALUES ('Ana Silva', 'ana@email.com');
                                              
INSERT INTO chamados (titulo, status, usuario_id) VALUES ('Erro ao acessar VPN', 'aberto', 1);
INSERT INTO chamados (titulo, status, usuario_id) VALUES ('Monitor não liga', 'fechado', 1);
INSERT INTO chamados (titulo, status, usuario_id) VALUES ('Solicitação de aesso ao sistema', 'aberto', 2);

ALTER TABLE chamados 
ADD COLUMN prioridade VARCHAR(15) DEFAULT 'media'
;
SELECT chamados.titulo, chamados.status, usuarios.nome
FROM chamados
INNER JOIN usuarios ON chamados.usuario_id = usuarios.id
WHERE chamados.status = 'aberto';

SELECT status, COUNT(*) AS quantidade
FROM chamados 
GROUP BY status;

UPDATE chamados 
SET status = 'fechado'
WHERE id = 1;

SELECT * FROM chamados;

UPDATE chamados 
SET prioridade = 'alta'
WHERE id = 3;

DELETE FROM chamados 
WHERE id = 2;

SELECT usuarios.nome, chamados.titulo, chamados.prioridade
FROM chamados
INNER JOIN usuarios ON chamados.usuario_id = usuarios.id
ORDER BY chamados.prioridade ASC;