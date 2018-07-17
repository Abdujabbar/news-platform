<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 6/19/18
 * Time: 1:58 PM
 */

namespace core\helpers\pagination;

/**
 * Class Pagination
 * @package Pagination
 */
class Pagination
{
    private $baseURL;
    private $total;
    private $pagesCount;
    private $currentPageParam;
    private $itemsPerPage;
    private $currentPage;
    private $containerTag = 'ul';
    private $containerTagClass = 'pagination';
    private $itemTag = 'li';
    private $itemATagClass = 'page-link';
    private $itemClass = 'page-item';
    private $activeItemClass = 'active';
    public $previousButtonText = 'Prev';
    public $nextButtonText = 'Next';

    /**
     * Pagination constructor.
     * @param string $baseURL
     * @param int $total
     * @param int $itemsPerPage
     * @param string $currentPageParam
     * @throws \Exception
     */
    public function __construct($baseURL, $total = 0, $itemsPerPage = 0, $currentPageParam = 'page')
    {
        $this->baseURL = $baseURL;

        if ($total < 0) {
            throw new \Exception("Total number cannot be less than zero");
        }
        if ($itemsPerPage < 0) {
            throw new \Exception("Items per page cannot be less than zero");
        }

        $this->total = $total;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPageParam = $currentPageParam;
        $this->currentPage = isset($_GET[$this->currentPageParam]) && intval($_GET[$this->currentPageParam]) &&
        $_GET[$this->currentPageParam] > 0 ? ($_GET[$this->currentPageParam] - 1) : 0;
        $this->pagesCount = intval(ceil($this->total / $this->itemsPerPage));
    }

    /**
     * @return string
     */
    public function render()
    {
        if ($this->total == 0 || $this->itemsPerPage == 0 || $this->itemsPerPage >= $this->total) {
            return "";
        }
        $response = "";
        $response .= "<{$this->containerTag} class='{$this->containerTagClass}'>";
        $response .= $this->renderPreviousArrow();
        for ($i = 1; $i <= $this->pagesCount; $i++) {
            $response .= $this->renderItem($i);
        }
        $response .= $this->renderNextArrow();
        $response .= "</{$this->containerTag}>";
        return $response;
    }

    /**
     * @return string
     */
    public function renderPreviousArrow()
    {
        $response = "";
        if ($this->currentPage + 1 > 1) {
            $response .= $this->renderItem($this->currentPage, $this->previousButtonText);
        }
        return $response;
    }

    /**
     * @return string
     */
    public function renderNextArrow()
    {
        $response = "";
        if ($this->currentPage + 2 <= $this->pagesCount) {
            $response .= $this->renderItem($this->currentPage + 2, $this->nextButtonText);
        }
        return $response;
    }

    /**
     * @param int $page
     * @return string
     */
    public function renderItem($page, $symbol = '')
    {
        if (!$symbol) {
            $symbol = "{$page}";
        }
        $itemClass = $this->itemClass;
        if ($this->currentPage === $page - 1) {
            $itemClass .= " {$this->activeItemClass}";
        }


        $url = $this->generateItemURL();
        $response = sprintf(
            "<{$this->itemTag} class='%s'><a href='{$url}' class='%s'>%s</a></{$this->itemTag}>",
            $itemClass,
            $this->currentPageParam,
            $page,
            $this->itemATagClass,
            $symbol
        );
        return $response;
    }

    /**
     * @return string
     */
    public function generateItemURL()
    {
        $url = "{$this->baseURL}?%s=%s";

        if (!empty($_SERVER['QUERY_STRING'])) {
            $params = [];
            parse_str($_SERVER['QUERY_STRING'], $params);
            if (isset($params['page'])) {
                unset($params['page']);
            }
            if (count($params) > 0) {
                $url = $this->baseURL . '?' . urldecode(http_build_query($params));
                $url .= '&%s=%s';
            } else {
                $url = "?%s=%s";
            }
        }
        return $url;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}
