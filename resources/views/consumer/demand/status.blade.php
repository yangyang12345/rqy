@switch($demand->status)
    @case(0)
    <span class="label label-primary">已提交</span>
    @break
    @case(1)
    <span class="label label-info">正在审核</span>
    @break
    @case(2)
    <span class="label label-success">审核通过</span>
    @break
    @case(3)
    <span class="label label-warning">审核未通过</span>
    @break
@endswitch