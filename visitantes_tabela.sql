-- Script para criar a tabela de visitantes

CREATE TABLE IF NOT EXISTS `visitantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `tipo_documento` enum('CPF','RG','CNH','Passaporte') NOT NULL DEFAULT 'CPF',
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `motivo_visita` text NOT NULL,
  `pessoa_visitada` varchar(100) NOT NULL,
  `departamento_visitado` varchar(50) NOT NULL,
  `data_entrada` datetime NOT NULL,
  `data_saida` datetime DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `status` enum('Ativo','Finalizado') NOT NULL DEFAULT 'Ativo',
  `usuario_cadastro` varchar(50) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `documento` (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserir alguns dados de exemplo
INSERT INTO `visitantes` (`nome`, `documento`, `tipo_documento`, `telefone`, `email`, `empresa`, `motivo_visita`, `pessoa_visitada`, `departamento_visitado`, `data_entrada`, `status`, `usuario_cadastro`) VALUES
('João Silva', '12345678901', 'CPF', '(11) 99999-9999', 'joao@email.com', 'Empresa ABC', 'Reunião de negócios', 'Maria Santos', 'Administração', NOW(), 'Ativo', 'admin'),
('Ana Costa', '98765432100', 'CPF', '(11) 88888-8888', 'ana@email.com', 'Fornecedor XYZ', 'Entrega de documentos', 'Carlos Lima', 'Recursos Humanos', NOW(), 'Ativo', 'recepcao');