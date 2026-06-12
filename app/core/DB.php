<?php 
class connectDB {

    private static $host = "localhost";
    private static $username = "root";
    private static $password = "quy25102005";
    private static $db_name = "68pm34";

    public static function Connect() {

        $conn = null;

        try {

            $conn = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                self::$username,
                self::$password
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Auto-migration based on the user's SQL script
            try {
                // 1. Ensure tbl_lop exists
                $conn->exec("CREATE TABLE IF NOT EXISTS `tbl_lop` (
                  `id` INT NOT NULL AUTO_INCREMENT,
                  `tenlop` VARCHAR(100) NOT NULL,
                  `mota` VARCHAR(100) NULL DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

                // 2. Check if tbl_sinhviens exists
                $tableExists = false;
                try {
                    $conn->query("SELECT 1 FROM tbl_sinhviens LIMIT 1");
                    $tableExists = true;
                } catch (Exception $e) {
                    $tableExists = false;
                }

                if (!$tableExists) {
                    $conn->exec("CREATE TABLE `tbl_sinhviens` (
                      `id` INT NOT NULL AUTO_INCREMENT,
                      `malop` INT NOT NULL,
                      `hoten` VARCHAR(255) NOT NULL,
                      `gioitinh` VARCHAR(10) NOT NULL,
                      `mssv` VARCHAR(20) NOT NULL,
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `mssv_unique` (`mssv`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
                } else {
                    // Table exists, check if 'malop' column exists
                    $q = $conn->query("SHOW COLUMNS FROM tbl_sinhviens LIKE 'malop'");
                    if ($q->rowCount() == 0) {
                        $conn->exec("ALTER TABLE tbl_sinhviens ADD COLUMN malop INT NOT NULL");
                    }
                }

                // 3. Ensure foreign key exists
                try {
                    $conn->exec("ALTER TABLE `tbl_sinhviens` 
                    ADD CONSTRAINT `fk_tbl_sinhviens_x_tbl_lop` 
                    FOREIGN KEY (`malop`) REFERENCES `tbl_lop` (`id`);");
                } catch (Exception $e_fk) {
                    // Ignore if foreign key already exists
                }
            } catch (Exception $e) {
                // Ignore other table creation errors
            }

        } catch(PDOException $e) {

            echo "Kết nối thất bại: " . $e->getMessage();
        }

        return $conn;
    }
}
?>