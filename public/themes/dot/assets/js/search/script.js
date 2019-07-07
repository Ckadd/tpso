var Search = {
    vars: {
        num_found: $_num_found,
        max_pages: $_max_pages,
        current_page: $_current_page,
        url: $_url,
        count_per_page: $_count_per_page
    },
    init: function() {
        this.pagination();
    },
    pagination: function() {
        $this = this;
        $('.selector-pagination.pagination').pagination({
            items: $this.vars.max_pages,
            itemOnPage: $this.vars.count_per_page,
            currentPage: $this.vars.current_page,
            cssStyle: '',
            prevText: '<span aria-hidden="true">&laquo;</span>',
            nextText: '<span aria-hidden="true">&raquo;</span>',
            hrefTextPrefix: $this.vars.url,
            onInit: function () {
                // fire first page loading
                $this.addPaginationClass();
            },
            onPageClick: function (page, evt) {
                // some code
                window.location.href = $this.vars.url+page;
                $this.addPaginationClass();
            }
        });
    },
    addPaginationClass: function() {
        $('.selector-pagination.pagination ul').addClass('pagination');
    }
}

jQuery(document).ready(function() {
    Search.init();
});