<?php
class ModelExtensionFeedPsProductReviewFeed extends Model
{
    public function getReviews(): array {
		$query = $this->db->query("SELECT
                `r`.`review_id`,
                `r`.`author`,
                `r`.`customer_id`,
                `r`.`text`,
                `p`.`product_id`,
                `pd`.`name` AS `product_name`,
                `m`.`name` AS `manufacturer_name`,
                `r`.`rating`
            FROM " . DB_PREFIX . "review r
            LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id)
            LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)
            LEFT JOIN `" . DB_PREFIX . "manufacturer` `m` ON (`p`.`manufacturer_id` = `m`.`manufacturer_id`)
            WHERE
                p.date_available <= NOW() AND
                p.status = '1' AND
                r.status = '1' AND
                pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"
        );

		return $query->rows;
	}
}
