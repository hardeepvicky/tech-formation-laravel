<div class="page-footer-inner"> 
    <b>Test Laravel</b>    
</div>
<div class="scroll-to-top">        
    <i class="icon-arrow-up"></i>
</div>

@if (Config::get('app.debug'))
<div class="row">
    <div class="col-md-12">
        <span class="caption-subject font-red-sunglo bold">
            Memory Used : {{ memory_used() }},
            Execution Time : {{ exec_time() }}
        </span>
        <?php $logs = get_query_log(DB::getQueryLog()); ?>
        <table class="table table-hover">
            <tr class="active">
                <td># ({{ count($logs)  }})</td>
                <td>Sql</td>
                <td>Time</td>
            </tr>            
            @foreach($logs as $i => $log)            
            <tr class="active">
                <td>{{ $i + 1 }}</td>
                <td>{{ e($log["query"]) }}</td>
                <td>{{ e($log["time"] / 1000) }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endif