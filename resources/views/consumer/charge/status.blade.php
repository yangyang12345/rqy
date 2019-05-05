@switch($charge->status)
    @case(0)
    <span><small class="label bg-yellow">审核中</small></span>
    @break
    @case(1)
    <span><small class="label bg-green">审核通过</small></span>
    @break
    @case(2)
    <span><small class="label bg-red">失败</small></span>
    @break
@endswitch