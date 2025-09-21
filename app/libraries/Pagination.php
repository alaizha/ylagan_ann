<?php

class Pagination
{
    protected $total_rows;
    protected $per_page;
    protected $current_page;
    protected $base_url;
    protected $options = [
        'first_link'     => '⏮ First',
        'last_link'      => 'Last ⏭',
        'next_link'      => 'Next →',
        'prev_link'      => '← Prev',
        'page_delimiter' => '&page='
    ];

    public function set_options(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    public function set_theme($theme)
    {
        // only bootstrap theme for now, but can extend later
        if ($theme !== 'bootstrap') {
            throw new Exception("Only bootstrap theme supported.");
        }
    }

    public function initialize($total_rows, $per_page, $current_page, $base_url)
    {
        $this->total_rows   = (int)$total_rows;
        $this->per_page     = (int)$per_page;
        $this->current_page = max(1, (int)$current_page);
        $this->base_url     = $base_url;
    }

    public function paginate()
    {
        $total_pages = ceil($this->total_rows / $this->per_page);
        if ($total_pages <= 1) {
            return ''; // nothing to paginate
        }

        $html = '<nav><ul class="pagination justify-content-center">';

        // First link
        if ($this->current_page > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->base_url . $this->options['page_delimiter'] . '1">' . $this->options['first_link'] . '</a></li>';
        }

        // Previous link
        if ($this->current_page > 1) {
            $prev = $this->current_page - 1;
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->base_url . $this->options['page_delimiter'] . $prev . '">' . $this->options['prev_link'] . '</a></li>';
        }

        // Page numbers
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $this->current_page) ? ' active' : '';
            $html .= '<li class="page-item' . $active . '"><a class="page-link" href="' . $this->base_url . $this->options['page_delimiter'] . $i . '">' . $i . '</a></li>';
        }

        // Next link
        if ($this->current_page < $total_pages) {
            $next = $this->current_page + 1;
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->base_url . $this->options['page_delimiter'] . $next . '">' . $this->options['next_link'] . '</a></li>';
        }

        // Last link
        if ($this->current_page < $total_pages) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $this->base_url . $this->options['page_delimiter'] . $total_pages . '">' . $this->options['last_link'] . '</a></li>';
        }

        $html .= '</ul></nav>';

        return $html;
    }
}
