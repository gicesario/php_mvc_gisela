CREATE TABLE `categoria` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `nome_categoria` varchar(100) NOT NULL,
 `desc_categoria` varchar(200) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1
clientes	CREATE TABLE `clientes` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `id_usuarios` bigint(20) NOT NULL,
 `nome` varchar(100) NOT NULL,
 `fone` varchar(20) NOT NULL,
 `cpf` varchar(22) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_usuarios` (`id_usuarios`),
 CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_usuarios`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
dados_entrega	

CREATE TABLE `dados_entrega` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `id_pedidos` bigint(20) NOT NULL,
 `data_atualizacao` decimal(8,0) NOT NULL,
 `texto_atualizacao` varchar(500) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_pedidos` (`id_pedidos`),
 CONSTRAINT `dados_entrega_ibfk_1` FOREIGN KEY (`id_pedidos`) REFERENCES `pedidos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `endereco_cliente` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `id_clientes` bigint(20) NOT NULL,
 `cep` varchar(20) NOT NULL,
 `endereco` varchar(200) NOT NULL,
 `num_endereco` varchar(20) NOT NULL,
 `compl_endereco` varchar(50) DEFAULT NULL,
 `bairro` varchar(100) NOT NULL,
 `cidade` varchar(100) NOT NULL,
 `uf` char(2) NOT NULL,
 `is_favorito` bit(1) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_clientes` (`id_clientes`),
 CONSTRAINT `endereco_cliente_ibfk_1` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `formas_pagamento` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `id_clientes` bigint(20) NOT NULL,
 `nome_titular` varchar(200) NOT NULL,
 `numero_cartao` varchar(40) NOT NULL,
 `data_validade` decimal(6,0) NOT NULL,
 `numero_cvv` decimal(3,0) NOT NULL,
 `is_favorito` bit(1) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_clientes` (`id_clientes`),
 CONSTRAINT `formas_pagamento_ibfk_1` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `marca_chocolate` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `nome_marca` varchar(100) NOT NULL,
 `pais_fornecedor` varchar(100) DEFAULT NULL,
 `cidade_fornecedor` varchar(100) DEFAULT NULL,
 `uf_forcenecor` char(2) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1

CREATE TABLE `pedidos` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `id_clientes` bigint(20) NOT NULL,
 `valot_total` decimal(17,2) NOT NULL,
 `valor_frete` decimal(17,2) NOT NULL,
 `valor_subtotal` decimal(17,2) NOT NULL,
 `data_recebimento` decimal(8,0) NOT NULL,
 `data_entrega` decimal(8,0) DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `id_clientes` (`id_clientes`),
 CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `produtos` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `id_categoria` bigint(20) NOT NULL,
 `id_marca_chocolate` bigint(20) NOT NULL,
 `nome_chocolate` varchar(100) NOT NULL,
 `desc_chocolate` varchar(200) NOT NULL,
 `valor_preco` decimal(17,2) NOT NULL,
 `valor_desconto` decimal(17,2) DEFAULT NULL,
 `quant_diponivel` decimal(5,0) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_categoria` (`id_categoria`),
 KEY `id_marca_chocolate` (`id_marca_chocolate`),
 CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
 CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`id_marca_chocolate`) REFERENCES `marca_chocolate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1

CREATE TABLE `produtos_pedidos` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `id_pedidos` bigint(20) NOT NULL,
 `id_produtos` bigint(20) NOT NULL,
 `quantidade_produtos` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_pedidos` (`id_pedidos`),
 KEY `id_produtos` (`id_produtos`),
 CONSTRAINT `produtos_pedidos_ibfk_1` FOREIGN KEY (`id_pedidos`) REFERENCES `pedidos` (`id`),
 CONSTRAINT `produtos_pedidos_ibfk_2` FOREIGN KEY (`id_produtos`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `usuarios` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `email` varchar(100) NOT NULL,
 `senha` varchar(100) NOT NULL,
 `is_admin` tinyint(1) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1