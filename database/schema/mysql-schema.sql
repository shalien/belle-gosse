/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;
DROP TABLE IF EXISTS `channels`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channels`
(
    `snowflake`  bigint(20) unsigned NOT NULL,
    `guild_id`   bigint(20) unsigned      DEFAULT NULL,
    `name`       varchar(255)             DEFAULT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`snowflake`),
    KEY `channels_guild_id_foreign` (`guild_id`),
    CONSTRAINT `channels_guild_id_foreign` FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`snowflake`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `collections`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `collections`
(
    `id`          bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `started_at`  datetime                 DEFAULT NULL,
    `finished_at` datetime                 DEFAULT NULL,
    `created_at`  timestamp           NULL DEFAULT NULL,
    `updated_at`  timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `destinations`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destinations`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `filename`   varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `destinations_filename_unique` (`filename`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `uuid`       varchar(255)        NOT NULL,
    `connection` text                NOT NULL,
    `queue`      text                NOT NULL,
    `payload`    longtext            NOT NULL,
    `exception`  longtext            NOT NULL,
    `failed_at`  timestamp           NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `guilds`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guilds`
(
    `snowflake`  bigint(20) unsigned NOT NULL,
    `name`       varchar(255)             DEFAULT NULL,
    `icon`       varchar(255)             DEFAULT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`snowflake`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `guilds_users`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guilds_users`
(
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    `guild_id`   bigint(20) unsigned NOT NULL,
    `user_id`    bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`guild_id`, `user_id`),
    KEY `guilds_users_user_id_foreign` (`user_id`),
    CONSTRAINT `guilds_users_guild_id_foreign` FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`snowflake`),
    CONSTRAINT `guilds_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`snowflake`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ignored_hosts`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ignored_hosts`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `host`       varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `ignored_hosts_host_unique` (`host`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ignored_hosts_provider_types`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ignored_hosts_provider_types`
(
    `ignored_host_id`  bigint(20) unsigned NOT NULL,
    `provider_type_id` bigint(20) unsigned NOT NULL,
    `created_at`       timestamp           NULL DEFAULT NULL,
    `updated_at`       timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`ignored_host_id`, `provider_type_id`),
    KEY `ignored_hosts_provider_types_provider_type_id_foreign` (`provider_type_id`),
    CONSTRAINT `ignored_hosts_provider_types_ignored_host_id_foreign` FOREIGN KEY (`ignored_host_id`) REFERENCES `ignored_hosts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `ignored_hosts_provider_types_provider_type_id_foreign` FOREIGN KEY (`provider_type_id`) REFERENCES `provider_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `medias`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medias`
(
    `id`             bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `link`           longtext            NOT NULL,
    `created_at`     timestamp           NULL DEFAULT NULL,
    `updated_at`     timestamp           NULL DEFAULT NULL,
    `source_id`      bigint(20) unsigned      DEFAULT NULL,
    `destination_id` bigint(20) unsigned      DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `medias_link_unique` (`link`) USING HASH,
    KEY `medias_source_id_foreign` (`source_id`),
    KEY `medias_destination_id_foreign` (`destination_id`),
    CONSTRAINT `medias_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE SET NULL,
    CONSTRAINT `medias_source_id_foreign` FOREIGN KEY (`source_id`) REFERENCES `sources` (`id`) ON DELETE SET NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages`
(
    `snowflake`  bigint(20) unsigned NOT NULL,
    `content`    varchar(255)             DEFAULT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    `user_id`    bigint(20) unsigned      DEFAULT NULL,
    `message_id` bigint(20) unsigned      DEFAULT NULL,
    `channel_id` bigint(20) unsigned      DEFAULT NULL,
    PRIMARY KEY (`snowflake`),
    KEY `messages_user_id_foreign` (`user_id`),
    KEY `messages_message_id_foreign` (`message_id`),
    KEY `messages_channel_id_foreign` (`channel_id`),
    CONSTRAINT `messages_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`snowflake`) ON DELETE CASCADE,
    CONSTRAINT `messages_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`snowflake`) ON DELETE CASCADE,
    CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`snowflake`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations`
(
    `id`        int(10) unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255)     NOT NULL,
    `batch`     int(11)          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets`
(
    `email`      varchar(255) NOT NULL,
    `token`      varchar(255) NOT NULL,
    `created_at` timestamp    NULL DEFAULT NULL,
    KEY `password_resets_email_index` (`email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `path_supplier`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `path_supplier`
(
    `supplier_id` bigint(20) unsigned NOT NULL,
    `path_id`     bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`supplier_id`, `path_id`),
    KEY `path_supplier_path_id_foreign` (`path_id`),
    CONSTRAINT `path_supplier_path_id_foreign` FOREIGN KEY (`path_id`) REFERENCES `paths` (`id`) ON DELETE CASCADE,
    CONSTRAINT `path_supplier_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `path_topic`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `path_topic`
(
    `path_id`  bigint(20) unsigned NOT NULL,
    `topic_id` bigint(20) unsigned NOT NULL,
    KEY `path_topic_path_id_foreign` (`path_id`),
    KEY `path_topic_topic_id_foreign` (`topic_id`),
    CONSTRAINT `path_topic_path_id_foreign` FOREIGN KEY (`path_id`) REFERENCES `paths` (`id`),
    CONSTRAINT `path_topic_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `paths`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paths`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `content`    varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `paths_content_unique` (`content`),
    KEY `paths_content_index` (`content`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens`
(
    `id`             bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `tokenable_type` varchar(255)        NOT NULL,
    `tokenable_id`   bigint(20) unsigned NOT NULL,
    `name`           varchar(255)        NOT NULL,
    `token`          varchar(64)         NOT NULL,
    `abilities`      text                     DEFAULT NULL,
    `last_used_at`   timestamp           NULL DEFAULT NULL,
    `expires_at`     timestamp           NULL DEFAULT NULL,
    `created_at`     timestamp           NULL DEFAULT NULL,
    `updated_at`     timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`, `tokenable_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `prohibited_domains`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prohibited_domains`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `domain`     varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `prohibited_domains_domain_unique` (`domain`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `provider_types`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provider_types`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `provider_types_name_unique` (`name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles`
(
    `snowflake`  bigint(20) unsigned NOT NULL,
    `name`       varchar(255)             DEFAULT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    `guild_id`   bigint(20) unsigned      DEFAULT NULL,
    PRIMARY KEY (`snowflake`),
    KEY `roles_guild_id_foreign` (`guild_id`),
    CONSTRAINT `roles_guild_id_foreign` FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`snowflake`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sources`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sources`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `link`       longtext            NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    `path_id`    bigint(20) unsigned      DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `sources_link_unique` (`link`) USING HASH,
    KEY `sources_path_id_foreign` (`path_id`),
    CONSTRAINT `sources_path_id_foreign` FOREIGN KEY (`path_id`) REFERENCES `paths` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers`
(
    `id`               bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `host`             varchar(255)        NOT NULL,
    `created_at`       timestamp           NULL DEFAULT NULL,
    `updated_at`       timestamp           NULL DEFAULT NULL,
    `provider_type_id` bigint(20) unsigned      DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `suppliers_host_unique` (`host`),
    KEY `suppliers_host_index` (`host`),
    KEY `suppliers_provider_type_id_foreign` (`provider_type_id`),
    CONSTRAINT `suppliers_provider_type_id_foreign` FOREIGN KEY (`provider_type_id`) REFERENCES `provider_types` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255)        NOT NULL,
    `order`      int(11)             NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `topics_name_unique` (`name`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `unmanaged_reddit_hosts`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unmanaged_reddit_hosts`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `host`       varchar(255)        NOT NULL,
    `url`        varchar(255)        NOT NULL,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users`
(
    `id`                        bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `snowflake`                 bigint(20) unsigned      DEFAULT NULL,
    `name`                      varchar(255)        NOT NULL,
    `email`                     varchar(255)        NOT NULL,
    `email_verified_at`         timestamp           NULL DEFAULT NULL,
    `password`                  varchar(255)        NOT NULL,
    `two_factor_secret`         text                     DEFAULT NULL,
    `two_factor_recovery_codes` text                     DEFAULT NULL,
    `remember_token`            varchar(100)             DEFAULT NULL,
    `created_at`                timestamp           NULL DEFAULT NULL,
    `updated_at`                timestamp           NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`),
    UNIQUE KEY `users_snowflake_unique` (`snowflake`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_roles`
(
    `id`         bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `created_at` timestamp           NULL DEFAULT NULL,
    `updated_at` timestamp           NULL DEFAULT NULL,
    `user_id`    bigint(20) unsigned      DEFAULT NULL,
    `role_id`    bigint(20) unsigned      DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `users_roles_user_id_foreign` (`user_id`),
    KEY `users_roles_role_id_foreign` (`role_id`),
    CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`snowflake`),
    CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`snowflake`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (6, '2022_10_03_110830_create_topics_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (7, '2022_10_03_110832_create_sources_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (8, '2022_10_03_110855_create_medias_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (9, '2022_10_03_120559_create_providers_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (10, '2022_10_03_150921_alter_providers_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (11, '2023_05_24_125120_create_unmanaged_reddit_hosts', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (12, '2023_05_25_120701_create_ignored_hosts_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (13, '2023_05_25_122304_create_provider_types_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (14, '2023_05_25_124803_alter_providers_table_add_provider_type', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (15, '2023_05_25_140002_create_ignored_hosts_provider_types_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (16, '2023_05_25_140508_alter_ignored_hosts_provider_types_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (17, '2023_06_10_171144_create_destinations_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (18, '2023_06_10_173236_alter_sources_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (19, '2023_06_10_173516_alter_medias_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (20, '2023_06_25_211721_create_provider_links_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (21, '2023_06_25_292702_migrate_to_v2', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (22, '2023_06_26_212900_alter_table_providers_add_provider_link_id', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (23, '2023_06_27_202508_migrate_providers', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (24, '2023_06_28_140926_purge_providers_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (25, '2023_06_28_141504_create_topic_aliases_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (26, '2023_07_12_074125_delete_fk_provider_links', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (27, '2023_07_12_074800_renew_fk_provider_links', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (28, '2023_07_12_080549_delete_fk_providers', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (29, '2023_07_12_081856_renew_fk_providers', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (30, '2023_07_12_083205_delete_fk_sources', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (31, '2023_07_12_083222_renew_fk_sources', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (32, '2023_07_12_083301_delete_fk_medias', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (33, '2023_07_12_083308_renew_fk_medias', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (34, '2023_10_09_190355_alter_users_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (47, '2023_10_09_191309_create_prohibited_domains_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (48, '2023_10_09_191742_create_messages_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (49, '2023_10_09_192704_create_roles', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (50, '2023_10_09_192807_create_guilds_migration', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (51, '2023_10_09_192951_create_channels_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (52, '2023_10_09_194801_alter_channels_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (53, '2023_10_09_194921_alter_messages_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (54, '2023_10_09_195254_create_users_roles_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (55, '2023_10_09_195308_alter_users_roles_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (56, '2023_10_09_195533_alter_roles_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (57, '2023_10_10_195849_create_guilds_users_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (58, '2023_10_10_200310_alter_guilds_users_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (59, '2023_11_23_200742_v3_create_collections_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (60, '2023_11_23_201447_v3_create_suppliers_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (61, '2023_11_23_201629_v3_add_provider_type_id_to_suppliers_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (62, '2023_11_23_202657_v3_create_paths_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (63, '2023_11_23_203050_v3_create_paths_topics_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (64, '2023_11_23_203119_v3_add_path_id_to_queries_topics', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (65, '2023_11_23_203146_v3_add_topic_id_to_queries_topics', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (66, '2023_11_25_104505_v3_create_query_supplier_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (67, '2023_11_25_104700_v3_alter_provider_query_table_add_foreign_key', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (68, '2023_11_25_111825_v3_alter_sources_add_path_id', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (69, '2023_11_25_214731_v3_transform_provider_links_into_providers_and_queries', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (70, '2023_11_26_123305_v3_transform_booru_providers', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (71, '2023_11_26_125525_v3_drop_topic_alias_table', 5);
