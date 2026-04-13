<div class="col-md-12 text-center">
  <div class="pagination pagination-centered">

  {paginate_prev text="Previous"}&nbsp;

  {if $paginate.total gt $paginate.limit}
    &nbsp;&nbsp;{paginate_first text="First"}&nbsp;
  {/if}

  {if $paginate.total gt $paginate.limit}
    {paginate_middle page_limit="10" prefix="&nbsp;" suffix="&nbsp;" format="page" }
  {/if}

  {if $paginate.total gt $paginate.limit}
    &nbsp;{paginate_last text="Last"}
  {/if}
  &nbsp;&nbsp;{paginate_next text="Next"}&nbsp;

  {if $paginate.total gt $paginate.limit}
    [{$paginate.total}/{$paginate.page_total} pages]
  {/if}

  </div>
</div>

