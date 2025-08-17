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
            $link = "<a class=\"pagination_link\" href=\"{$url}?page=" . $this->previous_page() . "\">Previous</a>";
        } else {
            $link = "<a class=\"pagination_link pagination_disabled\">Previous</a>";
        }
        return $link;
    }

    public function next_link($url="") {
        $link = '';
        if ($this->next_page() != false) {
            $link = "<a class=\"pagination_link\" href=\"{$url}?page=" . $this->next_page() . "\">Next</a>";
        } else {
            $link = "<a class=\"pagination_link pagination_disabled\">Next</a>";
        }
        return $link;
    }

    public function number_links($url="") {
        $output = '';
        for ($i=1; $i <= $this->total_pages(); $i++) {
            if ($i == $this->current_page) {
                $output .= "<a class=\"pagination_link current_page\" href=\"{$url}?page={$i}\">{$i}</a>";
            } else {
                $output .= "<a class=\"pagination_link\" href=\"{$url}?page={$i}\">{$i}</a>";
            }
        }
        return $output;
    }

    public function page_links($url="") {
        if ($this->total_pages() > 1) { 
            echo "<div class=\"pagination_container\">";

            // echo "<div class=\"pagination_left\">";
            // echo $pagination->previous_link($url);
            // echo "</div>";
            
            echo $this->previous_link($url);
            echo $this->number_links($url);
            echo $this->next_link($url);

            // echo "<div class=\"pagination_right\">";
            // echo $pagination->next_link($url);
            // echo "</div>";

            echo "</div>";
        }
    }

}

?>