<?php

class Pagination {

    // INSTANCE VARIABLES
    public $current_page;
    public $per_page;
    public $total_count;

    // CONSTRUCTOR
    public function __construct($current_page=1, $per_page=20, $total_count=0) {
        $this->current_page = (int) $current_page;
        $this->per_page = (int) $per_page;
        $this->total_count = (int) $total_count;
    }

    public function offset() {
        return $this->per_page * ($this->current_page - 1);
    }

    public function total_pages() {
        return ceil($this->total_count / $this->per_page);
    }

    public function previous_page() {
        $previous = $this->current_page - 1;
        return ($previous > 0) ? $previous : false;
    }
    
    public function next_page() {
        $next = $this->current_page + 1;
        return ($next <= $this->total_pages()) ? $next : false;
    }

    public function previous_link($url="") {
        $link = '';
        if ($this->previous_page() != false) {
            $link = "<a class=\"tertiary_button\" href=\"{$url}?page=" . $this->previous_page() . "\"><i class=\"bi bi-arrow-left\"></i>Previous</a>";
        }
        return $link;
    }

    public function next_link($url="") {
        $link = '';
        if ($this->next_page() != false) {
            $link = "<a class=\"tertiary_button\" href=\"{$url}?page=" . $this->next_page() . "\">Next<i class=\"bi bi-arrow-right\"></i></a>";
        }
        return $link;
    }

    public function number_links($url="") {
        $output = '';
        for ($i=1; $i <= $this->total_pages(); $i++) {
            if ($i == $this->current_page) {
                $output .= "<span class=\"current_page\">{$i}</span>";
            } else {
                $output .= "<a class=\"pagination_link\" href=\"{$url}?page={$i}\">{$i}</a>";
            }
        }
        return $output;
    }

}

?>