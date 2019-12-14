CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(20) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `grupo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `permissao` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO `grupos` (`id`, `nome`, `permissao`) VALUES
(1, 'Padrão', ''),
(2, 'Administrador', '{\r\n"Admin": 1,\r\n"Moderador" : 1\r\n}');

CREATE TABLE IF NOT EXISTS `sessao_usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


