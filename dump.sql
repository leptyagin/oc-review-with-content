--
-- Структура таблицы `oc_review_content`
--
CREATE TABLE `oc_review_content` (
  `id` int NOT NULL,
  `company_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `company_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `frame` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Структура таблицы `oc_review_content_image`
--
CREATE TABLE `oc_review_content_image` (
  `content_image_id` int NOT NULL,
  `content_blogger_id` int NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `sort_order` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Индексы таблицы `oc_review_content`
--
ALTER TABLE `oc_review_content`
  ADD PRIMARY KEY (`id`);


--
-- Индексы таблицы `oc_review_content_image`
--
ALTER TABLE `oc_review_content_image`
  ADD PRIMARY KEY (`content_image_id`),
  ADD KEY `content_blogger_id` (`content_blogger_id`);


--
-- AUTO_INCREMENT для таблицы `oc_review_content`
--
ALTER TABLE `oc_review_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;


--
-- AUTO_INCREMENT для таблицы `oc_review_content_image`
--
ALTER TABLE `oc_review_content_image`
  MODIFY `content_image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;


--
-- Ограничения внешнего ключа таблицы `oc_review_content_image`
--
ALTER TABLE `oc_review_content_image`
  ADD CONSTRAINT `oc_review_content_image_ibfk_1` FOREIGN KEY (`content_blogger_id`) REFERENCES `oc_review_content` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
