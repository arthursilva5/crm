SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `5lobos_crm` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `5lobos_crm` ;

-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_uf`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_uf` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `sigla` CHAR(2) NULL ,
  `nome` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_cidades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_cidades` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(45) NULL ,
  `uf_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_uf_id_idx` (`uf_id` ASC) ,
  CONSTRAINT `fk_cidade_uf_id`
    FOREIGN KEY (`uf_id` )
    REFERENCES `5lobos_crm`.`tbl_uf` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_clientes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_clientes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cnpj_cpf` VARCHAR(22) NULL ,
  `usuario` VARCHAR(15) NULL ,
  `nome_razao` VARCHAR(145) NULL ,
  `email` VARCHAR(190) NULL ,
  `telefone` VARCHAR(22) NULL ,
  `celular` VARCHAR(22) NULL ,
  `endereco` VARCHAR(200) NULL ,
  `end_numero` INT NULL ,
  `end_complemento` VARCHAR(22) NULL ,
  `end_bairro` VARCHAR(100) NULL ,
  `end_cep` INT NULL ,
  `cidade_id` INT NULL ,
  `url_marca` VARCHAR(199) NULL ,
  `descricao` VARCHAR(220) NULL ,
  `data_cadastro` DATE NULL ,
  `divulgar` CHAR(1) NULL COMMENT 'Divulgar ou não para a rede de CRM' ,
  `status` CHAR(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_clientes_cidade_id_idx` (`cidade_id` ASC) ,
  CONSTRAINT `fk_cliente_cidade_id`
    FOREIGN KEY (`cidade_id` )
    REFERENCES `5lobos_crm`.`tbl_cidades` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_tipos_grupos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_tipos_grupos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NULL ,
  `titulo` VARCHAR(60) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tipo_grupo_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_tipos_grupos`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NOT NULL ,
  `nome` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(190) NULL ,
  `usuario` VARCHAR(45) NOT NULL ,
  `senha` VARCHAR(32) NOT NULL ,
  `grupo_id` INT NULL ,
  `data_nascimento` DATE NULL ,
  `data_cadastro` DATE NOT NULL ,
  `chmod` CHAR(9) NOT NULL COMMENT 'Irá verificar a permissão do usuário no sistema\\n\\nrrrrrrrrr = Só leitura' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_usuarios_cliente_id_idx` (`cliente_id` ASC) ,
  INDEX `fk_tbl_usuarios_departamento_id_idx` (`grupo_id` ASC) ,
  CONSTRAINT `fk_usuario_cliente_id`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_departamento_id`
    FOREIGN KEY (`grupo_id` )
    REFERENCES `5lobos_crm`.`tbl_tipos_grupos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_tipos_industrias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_tipos_industrias` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(60) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_usuarios_contas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_usuarios_contas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario_id` INT NOT NULL ,
  `conta_nome` VARCHAR(180) NULL ,
  `conta_numero` VARCHAR(20) NULL ,
  `site` VARCHAR(190) NULL ,
  `telefone` VARCHAR(22) NULL ,
  `linkedin` VARCHAR(190) NULL ,
  `facebook` VARCHAR(190) NULL ,
  `twitter` VARCHAR(190) NULL ,
  `funcionarios` INT NULL ,
  `endereco` VARCHAR(200) NULL ,
  `end_numero` INT NULL ,
  `end_complemento` VARCHAR(22) NULL ,
  `end_cep` VARCHAR(45) NULL ,
  `receita_anual` DECIMAL(10,2) NULL ,
  `cidade_id` INT NULL ,
  `industria_id` INT NULL ,
  `grupo_id` INT NULL ,
  `tags` VARCHAR(45) NULL ,
  `descricao` TEXT NULL ,
  `data_cadastro` DATE NULL ,
  `data_atualizacao` DATE NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_usuarios_usuario_id_idx` (`usuario_id` ASC) ,
  INDEX `fk_tbl_usuarios_contas_cidade_id_idx` (`cidade_id` ASC) ,
  INDEX `fk_tbl_usuarios_contas_industria_id_idx` (`industria_id` ASC) ,
  INDEX `fk_tbl_usuarios_contas_departamento_id_idx` (`grupo_id` ASC) ,
  CONSTRAINT `fk_usuario_conta_usuario_id`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `5lobos_crm`.`tbl_usuarios` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_conta_cidade_id`
    FOREIGN KEY (`cidade_id` )
    REFERENCES `5lobos_crm`.`tbl_cidades` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_conta_industria_id`
    FOREIGN KEY (`industria_id` )
    REFERENCES `5lobos_crm`.`tbl_tipos_industrias` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_conta_departamento_id`
    FOREIGN KEY (`grupo_id` )
    REFERENCES `5lobos_crm`.`tbl_tipos_grupos` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_usuarios_contatos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_usuarios_contatos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `conta_id` INT NOT NULL ,
  `usuario_id` INT NOT NULL ,
  `nome` VARCHAR(145) NULL ,
  `cargo` VARCHAR(100) NULL ,
  `email` VARCHAR(190) NULL ,
  `email_secundario` VARCHAR(190) NULL ,
  `telefone` VARCHAR(22) NULL ,
  `telefone_outro` VARCHAR(22) NULL ,
  `celular` VARCHAR(22) NULL ,
  `data_nascimento` DATE NULL ,
  `data_cadastro` DATE NULL ,
  `descricao` TEXT NULL ,
  `compartilhamento` CHAR(1) NULL COMMENT 'Tipo de compartilhamento do contato:\\n\\nPrivado\\nGrupo' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuarios_contas_contatos_conta_id_idx` (`conta_id` ASC) ,
  INDEX `fk_tbl_usuarios_contatos_conta_id_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_usuario_contato_conta_id`
    FOREIGN KEY (`conta_id` )
    REFERENCES `5lobos_crm`.`tbl_usuarios_contas` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_contato_usuario_id`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `5lobos_crm`.`tbl_usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_tipos_negocios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_tipos_negocios` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(60) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_tipos_fonte_contato`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_tipos_fonte_contato` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_tipos_estagio_venda`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_tipos_estagio_venda` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `titulo` VARCHAR(60) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_usuarios_contas_oportunidades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_usuarios_contas_oportunidades` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nome_oportunidade` VARCHAR(220) NOT NULL ,
  `conta_id` INT NOT NULL ,
  `tipo` INT NULL COMMENT 'Novo negócio\\nNegócio existente' ,
  `tipo_fonte` INT NULL ,
  `tipo_estagio_venda` INT NULL ,
  `proximo_passo` VARCHAR(144) NULL ,
  `valor` DECIMAL(10,2) NULL ,
  `valor_esperado` DECIMAL(10,2) NULL ,
  `data_expectativa_fechar` DATE NULL ,
  `descricao` TEXT NULL ,
  `compartilhamento` CHAR(1) NULL COMMENT 'Privado\\nGrupo' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usu_idx` (`conta_id` ASC) ,
  INDEX `fk_usuario_conta_oportunidade_tipo_idx` (`tipo` ASC) ,
  INDEX `fk_usuario_conta_oportunidade_tipo_fonte_idx` (`tipo_fonte` ASC) ,
  INDEX `fk_usuario_conta_oportunidade_tipo_estagio_venda_idx` (`tipo_estagio_venda` ASC) ,
  CONSTRAINT `fk_usuario_conta_oportunidade_conta_id`
    FOREIGN KEY (`conta_id` )
    REFERENCES `5lobos_crm`.`tbl_usuarios_contas` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_conta_oportunidade_tipo`
    FOREIGN KEY (`tipo` )
    REFERENCES `5lobos_crm`.`tbl_tipos_negocios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_conta_oportunidade_tipo_fonte`
    FOREIGN KEY (`tipo_fonte` )
    REFERENCES `5lobos_crm`.`tbl_tipos_fonte_contato` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_conta_oportunidade_tipo_estagio_venda`
    FOREIGN KEY (`tipo_estagio_venda` )
    REFERENCES `5lobos_crm`.`tbl_tipos_estagio_venda` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_clientes_comissoes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_clientes_comissoes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NOT NULL ,
  `cliente_id_indicou` INT NULL ,
  `data_pagamento` DATE NULL ,
  `data_adicao` DATE NULL ,
  `descricao` VARCHAR(200) NULL ,
  `valor` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_cliente_revenda_cliente_id_idx` (`cliente_id` ASC) ,
  INDEX `fk_tbl_cliente_comissao_cliente_id_indicou_idx` (`cliente_id_indicou` ASC) ,
  CONSTRAINT `fk_tbl_cliente_comissao_cliente_id`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_cliente_comissao_cliente_id_indicou`
    FOREIGN KEY (`cliente_id_indicou` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_clientes_faturas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_clientes_faturas` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NOT NULL ,
  `data_vencimento` DATE NOT NULL ,
  `data_pagamento` DATE NULL ,
  `descricao` TEXT NULL ,
  `valor` DECIMAL(10,2) NOT NULL ,
  `status` CHAR(1) NOT NULL COMMENT 'u = unpaid\\np = paid' ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cliente_fatura_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_cliente_fatura_cliente_id`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_clientes_cupons`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_clientes_cupons` (
  `codigo` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NULL ,
  `titulo` VARCHAR(144) NULL ,
  `percentual_desconto` INT NULL ,
  `percentual_comissao` INT NULL ,
  PRIMARY KEY (`codigo`) ,
  INDEX `fk_cupom_cliente_id_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_cupom_cliente_id`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_clientes_pedidos_saque`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_clientes_pedidos_saque` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NULL ,
  `valor` DECIMAL(10,2) NULL ,
  `data_pedido` DATE NULL ,
  `data_pagamento` DATE NULL ,
  `status` CHAR(1) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pedido_saque_cliente_id_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_cliente_pedido_saque_cliente_id`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_clientes_modulos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_clientes_modulos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NULL ,
  `mod_revendedor` CHAR(1) NULL ,
  `mod_contatos` CHAR(1) NULL ,
  `mod_newsletter` CHAR(1) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cliente_modulo_cliente_id_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_cliente_modulo_cliente_id`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_clientes_planos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_clientes_planos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `cliente_id` INT NULL ,
  `plano` CHAR(1) NULL ,
  `total_usuarios` INT NULL ,
  `valor` DECIMAL(10,2) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_cliente_plano_cliente_id_idx` (`cliente_id` ASC) ,
  CONSTRAINT `fk_cliente_plano_cliente_id`
    FOREIGN KEY (`cliente_id` )
    REFERENCES `5lobos_crm`.`tbl_clientes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_usuarios_contas_atividades`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_usuarios_contas_atividades` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `conta_id` INT NOT NULL ,
  `descricao` TEXT NULL ,
  `data_cadastro` DATE NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_usuario_conta_atividades_conta_id_idx` (`conta_id` ASC) ,
  CONSTRAINT `fk_usuario_conta_atividades_conta_id`
    FOREIGN KEY (`conta_id` )
    REFERENCES `5lobos_crm`.`tbl_usuarios_contas` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_sessions` (
  `session_id` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(120) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`session_id`) ,
  INDEX `last_activity_idx` (`last_activity` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_sessions` (
  `session_id` VARCHAR(40) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '0' ,
  `ip_address` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT '0' ,
  `user_agent` VARCHAR(120) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  `last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `user_data` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
  PRIMARY KEY (`session_id`) ,
  INDEX `last_activity_idx` (`last_activity` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `5lobos_crm`.`tbl_senhas_tmp`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `5lobos_crm`.`tbl_senhas_tmp` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `usuario_id` INT NULL ,
  `pass_key` VARCHAR(32) NULL ,
  `data` DATE NULL ,
  `status` CHAR(1) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_senha_tmp_usuario_id_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_senha_tmp_usuario_id`
    FOREIGN KEY (`usuario_id` )
    REFERENCES `5lobos_crm`.`tbl_usuarios` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
