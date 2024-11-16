-- Create syntax for TABLE 'Role'
CREATE TABLE `Role` (
    `roleName` varchar(50) NOT NULL,
    `class` varchar(75) NOT NULL,
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `parentRole_id` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `roleName_idx` (`roleName`),
    KEY `IDX_F75B2554AF9E3F75` (`parentRole_id`),
    CONSTRAINT `FK_F75B2554AF9E3F75` FOREIGN KEY (`parentRole_id`) REFERENCES `Role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create syntax for TABLE 'PassportRole'
CREATE TABLE `PassportRole` (
    `userId` int(11) NOT NULL,
    `entityId` int(11) NOT NULL,
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `role_id` int(11) DEFAULT NULL,
    `approvedById` int(11) DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_4FADA901D60322AC` (`role_id`),
    CONSTRAINT `FK_4FADA901D60322AC` FOREIGN KEY (`role_id`) REFERENCES `Role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
