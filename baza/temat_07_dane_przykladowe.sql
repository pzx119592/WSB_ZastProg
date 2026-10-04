-- Temat 07: dane przykladowe do tabel user i books.
-- Najpierw wykonaj php artisan migrate w NOWEJ bazie, potem importuj ten plik.
-- Import jednorazowy, przed uruchomieniem seedera i dodawaniem rekordow.
-- Zawiera tylko przykladowa Anne Nowak i ksiazki; bez sesji, kont i cache.

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `user` (`id`, `name`, `surname`, `birthday`, `create_user`) VALUES (1,'Anna','Nowak','1999-02-22','2026-10-04 17:02:34');
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (1,'The Catcher in the Rye','J. D. Salinger','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (2,'Iusto occaecati corporis delectus qui.','Justyna Duda','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (3,'Sed eligendi quo laborum.','inż. Cyprian Jankowski','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (4,'Ut possimus rerum molestiae.','Olaf Adamczyk','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (5,'Consequuntur et dolorem recusandae.','Olaf Olszewski','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (6,'Ullam et voluptatem sequi maiores.','dr dr Amelia Witkowska','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (7,'Ducimus aut quas ipsum repellat.','Helena Krajewska','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (8,'Voluptas eius optio rerum ut.','Dawid Szczepański','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (9,'Molestiae odit incidunt ut distinctio qui.','Kinga Nowak','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (10,'Rerum maiores nihil repellendus autem asperiores.','dr dr Bruno Pawlak','2026-10-04 14:56:56','2026-10-04 14:56:56');
INSERT INTO `books` (`id`, `title`, `author`, `created_at`, `updated_at`) VALUES (11,'Odio voluptate dignissimos recusandae quia.','Maria Wróbel','2026-10-04 14:56:56','2026-10-04 14:56:56');
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

