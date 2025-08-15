-- Script SQL para povoar a tabela usuarios com dados de teste
-- Senha para todos os usuários: 123456 (hash SHA-512)

-- Criar tabela usuarios se não existir
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(128) NOT NULL,
    departamento VARCHAR(50) NOT NULL,
    chave VARCHAR(100) DEFAULT NULL
);

-- Inserir 4 usuários de teste
-- Hash SHA-512 da senha '123456': ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413

INSERT INTO usuarios (usuario, nome, email, senha, departamento, chave) VALUES
('admin', 'Administrador do Sistema', 'admin@sistema.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Administração', 'ADM001'),
('recepcao', 'Maria Silva', 'maria.silva@empresa.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Recepção', 'REC001'),
('seguranca', 'João Santos', 'joao.santos@empresa.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Segurança', 'SEG001'),
('rh', 'Ana Costa', 'ana.costa@empresa.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Recursos Humanos', 'RH001');

-- Verificar os dados inseridos
SELECT id, usuario, nome, email, departamento, chave FROM usuarios;