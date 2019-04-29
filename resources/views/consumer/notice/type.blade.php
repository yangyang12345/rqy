@switch($n->type)
    @case(1)
    <span><small class="label bg-red">重要</small></span>
    @break
    @case(2)
    <span><small class="label bg-yellow">次要</small></span>
    @break
    @case(3)
    <span><small class="label bg-green">其他</small></span>
    @break
@endswitch<?php
