<?php
class ControllerExtensionFeedPsProductReviewFeed extends Controller
{
    /**
     * Generates and outputs the Google Product Review Feed XML.
     *
     * This method checks if the sitemap feature is enabled in the configuration.
     * If it is, it initializes the XMLWriter, sets the XML header, and populates
     * the sitemap with URLs for products, categories, manufacturers, and
     * information pages based on the active languages.
     *
     * @return void
     */
    public function index()
    {
        if (!$this->config->get('feed_ps_product_review_feed_status')) {
            return;
        }

        $this->load->model('setting/setting');

        $login = (string) $this->model_setting_setting->getSettingValue('feed_ps_product_review_feed_login', $this->config->get('config_store_id'));
        $password = (string) $this->model_setting_setting->getSettingValue('feed_ps_product_review_feed_password', $this->config->get('config_store_id'));

        if ($login && $password) {
            header('Cache-Control: no-cache, must-revalidate, max-age=0');

            if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
                header('WWW-Authenticate: Basic realm="ps_product_review_feed"');
                header('HTTP/1.1 401 Unauthorized');
                echo 'Invalid credentials';
                exit;
            } else {
                if ($_SERVER['PHP_AUTH_USER'] !== $login || $_SERVER['PHP_AUTH_PW'] !== $password) {
                    header('WWW-Authenticate: Basic realm="ps_product_review_feed"');
                    header('HTTP/1.1 401 Unauthorized');
                    echo 'Invalid credentials';
                    exit;
                }
            }
        }

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');

        $this->load->model('localisation/language');
        $this->load->model('extension/feed/ps_product_review_feed');

        $languages = $this->model_localisation_language->getLanguages();

        $language_id = (int) $this->config->get('config_language_id');
        $old_language_id = $language_id;

        if (isset($this->request->get['language']) && isset($languages[$this->request->get['language']])) {
            $cur_language = $languages[$this->request->get['language']];

            $language_id = $cur_language['language_id'];
        }

        $this->config->set('config_language_id', $language_id);

        $reviews = $this->model_extension_feed_ps_product_review_feed->getReviews();

        // Start <feed> element
        $xml->startElement('feed');
        $xml->writeAttribute('xmlns:vc', 'http://www.w3.org/2007/XMLSchema-versioning');
        $xml->writeAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $xml->writeAttribute('xsi:noNamespaceSchemaLocation', 'http://www.google.com/shopping/reviews/schema/product/2.3/product_reviews.xsd');

        $xml->writeElement('version', '2.3');

        $xml->startElement('aggregator');
        $xml->writeElement('name', $this->config->get('config_name'));
        $xml->endElement();

        $xml->startElement('publisher');
        $xml->writeElement('name', $this->config->get('config_name'));

        if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
            $xml->startElement('favicon');
            $xml->writeCData($server . 'image/' . $this->config->get('config_icon'));
            $xml->endElement();
		} else {
            $xml->writeElement('favicon');
        }

        $xml->endElement();

        $xml->startElement('reviews'); // Start <reviews>

        foreach ($reviews as $review) {
            $xml->startElement('review'); // Start <review>

            $xml->writeElement('review_id', $review['review_id']);

            $xml->startElement('reviewer'); // Start <reviewer>

            $xml->startElement('name');
            $xml->writeCData($review['author']);
            $xml->endElement();

            if ($review['customer_id'] > 0) {
                $xml->writeElement('reviewer_id', $review['customer_id']);
            }

            $xml->endElement(); // End <reviewer>

            $xml->writeElement('title');

            $xml->startElement('content');
            $xml->writeCData($review['text']);
            $xml->endElement();

            $product_link = $this->url->link('product/product', 'product_id=' . $review['product_id']);

            $xml->startElement('review_url');
            $xml->writeAttribute('type', 'singleton');
            $xml->writeCData($product_link);
            $xml->endElement();

            $xml->writeElement('ratings'); // Start <ratings>

            $xml->startElement('overall');
            $xml->writeAttribute('min', '1');
            $xml->writeAttribute('max', '5');
            $xml->text($review['rating']);
            $xml->endElement();

            $xml->endElement(); // End <ratings>

            $xml->startElement('products'); // Start <products>

            $xml->startElement('product'); // Start <product>

            $xml->startElement('product_ids'); // Start <product_ids>

            $xml->startElement('gtins'); // Start <gtins>

            if (isset($review['ean']) && $review['ean']) {
                $xml->startElement('ean');
                $xml->writeCData($review['ean']);
                $xml->endElement();
            } else if (isset($review['mpn']) && $review['mpn']) {
                $xml->startElement('mpn');
                $xml->writeCData($review['mpn']);
                $xml->endElement();
            }

            $xml->endElement(); // End <gtins>

            $xml->startElement('mpns'); // Start <mpns>

            if (isset($review['mpn']) && $review['mpn']) {
                $xml->startElement('mpn');
                $xml->writeCData($review['mpn']);
                $xml->endElement();
            }

            $xml->endElement(); // End <mpns>

            $xml->startElement('skus'); // Start <skus>

            if (isset($review['sku']) && $review['sku']) {
                $xml->startElement('sku');
                $xml->writeCData($review['sku']);
                $xml->endElement();
            }

            $xml->endElement(); // End <skus>

            $xml->startElement('brands'); // Start <brands>

            $xml->writeElement('brand', $review['manufacturer_name']);

            $xml->endElement(); // End <brands>

            $xml->endElement(); // End <product_ids>

            $xml->startElement('product_name');
            $xml->writeCData($review['product_name']);
            $xml->endElement();

            $xml->startElement('product_url');
            $xml->writeCData($product_link);
            $xml->endElement();

            $xml->endElement(); // End <product>

            $xml->endElement(); // End <products>

            $xml->endElement(); // End <review>
        }

        $xml->endElement(); // End <reviews>

        $xml->endElement(); // End <feed>

        $xml->endDocument();

        $this->config->set('config_language_id', $old_language_id);

        $this->response->addHeader('Content-Type: application/xml');
        $this->response->setOutput($xml->outputMemory());
    }
}
