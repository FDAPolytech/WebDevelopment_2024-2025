CREATE TABLE wp_user_pass1 (
    ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_login varchar(60) NOT NULL,
    user_pass varchar(255) NOT NULL,
    user_nicename varchar(50) NOT NULL,
    user_email varchar(100) NOT NULL,
    user_url varchar(100) NOT NULL,
    user_registered datetime NOT NULL,
    user_activation_key varchar(255) NOT NULL,
    user_status int(11) NOT NULL DEFAULT 0,
    display_name varchar(250) NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE wp_user_pass2 (
    ID bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_login varchar(60) NOT NULL,
    user_pass varchar(255) NOT NULL,
    user_nicename varchar(50) NOT NULL,
    user_email varchar(100) NOT NULL,
    user_url varchar(100) NOT NULL,
    user_registered datetime NOT NULL,
    user_activation_key varchar(255) NOT NULL,
    user_status int(11) NOT NULL DEFAULT 0,
    display_name varchar(250) NOT NULL,
    PRIMARY KEY (ID)
);
