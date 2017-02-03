<?php

    $show_pagination_info = isset($show_pagination_info) ? $show_pagination_info : true;
    $limit = $summary->perPage();
    $total = $summary->total();
    
    $total_pages = ceil($total / $limit);
    
    $limit = $limit < $total ? $limit : $total;
?>

<table style="width:100%;">
    <tr>
        @if($show_pagination_info)
        <td class="bottom-left">
            <span class="font-md">
                Page {{ $summary->currentPage() }} of {{ $total_pages }}, 
                showing {{ $limit }} records out of {{ $total }} total 
            </span>
        </td>
        @endif
        <td>
            <div class="font-sm" style="float: right;">
                {{ $summary->links() }}
            </div>
        </td>
    </tr>
</table>