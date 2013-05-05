CREATE TABLE IF NOT EXISTS `apprec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `felicitations` int(11) NOT NULL DEFAULT '0',
  `compliments` int(11) NOT NULL DEFAULT '0',
  `encouragements` int(11) NOT NULL DEFAULT '0',
  `avert_travail` int(11) NOT NULL DEFAULT '0',
  `avert_conduite` int(11) NOT NULL DEFAULT '0',
  `apprec` text NOT NULL,
  `moyenne` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` text NOT NULL,
  `nom` text NOT NULL,
  `mail` text NOT NULL,
  `type` text NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `numero` bigint(20) NOT NULL DEFAULT '0',
  `pass` text NOT NULL,
  `first` int(11) NOT NULL DEFAULT '0',
  `pseudo` text NOT NULL,
  `news` int(11) NOT NULL DEFAULT '0',
  `mail_ok` text NOT NULL,
  `mail_public` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text NOT NULL,
  `contenu` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `auteur` text NOT NULL,
  `valide` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;
CREATE TABLE IF NOT EXISTS `param_conseils` (
  `id` int(11) NOT NULL,
  `prochain_conseil` bigint(20) NOT NULL,
  `orientation_possible` int(11) NOT NULL,
  `orientation_obligatoire` int(11) NOT NULL,
  `peremption_data` bigint(20) NOT NULL,
  `easter_egg` int(11) NOT NULL,
  `last_deletion` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS `param_site` (
  `id` int(11) NOT NULL,
  `is_conf_ok` int(11) NOT NULL,
  `classe` text NOT NULL,
  `mail` text NOT NULL,
  `mail_actif` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE IF NOT EXISTS `remarques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remarque` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
CREATE TABLE IF NOT EXISTS `sondage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` text NOT NULL,
  `Fait` int(11) NOT NULL DEFAULT '0',
  `orientation` text NOT NULL,
  `certitude` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;