<div class="session-msg">
    @if(session()->has("success"))
        <div class="note note-success">
            <p> {{ session()->get("success") }}</p>
        </div>
    @endif
    
    @if(session()->has("info"))
        <div class="note note-info">
            <p> {{ session()->get("info") }}</p>
        </div>
    @endif
    
    @if(session()->has("warning"))
        <div class="note note-warning">
            <p> {{ session()->get("warning") }}</p>
        </div>
    @endif
    
    @if(session()->has("failure"))
        <div class="note note-danger">
            <p> {{ session()->get("failure") }}</p>
        </div>
    @endif
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $(".session-msg").delay(5000).fadeOut(2000);
    });
</script>